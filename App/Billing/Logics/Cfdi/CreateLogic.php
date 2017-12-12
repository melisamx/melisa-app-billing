<?php

namespace App\Billing\Logics\Cfdi;

use Carbon\Carbon;
use Melisa\core\LogicBusiness;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Models\DocumentStatus;
use App\Billing\Logics\Documents\ReportLogic;
use App\Billing\Logics\Provider\Profact\InvoiceGenerate;

/**
 * Create CFDI
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic
{
    use LogicBusiness;
    
    protected $eventSuccess = 'billing.cfdi.create.success';
    protected $eventError = 'billing.cfdi.create.error';
    
    protected $repoDocument;
    protected $repoSeries;
    protected $logicReport;
    protected $logicGenerate;

    public function __construct(
        DocumentsRepository $repoDocument,
        SeriesRepository $repoSeries,
        ReportLogic $logicReport,
        InvoiceGenerate $logicGenerate
    )
    {
        $this->repoDocument = $repoDocument;
        $this->repoSeries = $repoSeries;
        $this->logicReport = $logicReport;
        $this->logicGenerate = $logicGenerate;
    }
    
    public function init(array $input)
    {
        $this->repoDocument->beginTransaction();
        
        $document = $this->getDocument($input['id']);
        
        if( !$document) {
            return false;
        }
        
        if( !$this->isValid($document)) {
            return false;
        }
        
        if( !$this->setInvoiceGeneratingCfdi($document)) {
            return false;
        }
        
        if( !$this->updateSerie($document)) {
            return false;
        }
        
        $uuid = $this->generateCfdi($document);
        
        if( !$uuid) {
            return $this->setStatusError($document->id);
        } else {
            return $this->setStatusNew($document->id, $uuid);
        }
    }
    
    public function setInvoiceGeneratingCfdi(&$document)
    {
        $folio = $document->serie->folioCurrent + 1;
        $carbon = Carbon::now();
        $dateCfdi = $carbon->format('Y-m-d\TH:i:s');
        $status = DocumentStatus::generatingCfdi()->first();
        
        $document->folio = $folio;
        $document->dateCfdi = $dateCfdi;
        
        if( !$this->updateDocument($document->id, [
            'idDocumentStatus'=>$status->id,
            'folio'=>$folio,
            'dateCfdi'=>$dateCfdi
        ])) {
            return $this->error('Imposible establecer estatus {s} al documento {d}', [
                's'=>$status->name,
                'd'=>$document->id
            ]);
        }
        
        return true;
    }
    
    public function setStatusError($idDocument)
    {
        $status = DocumentStatus::errorGenerateCfdi()->first();
        
        if( !$this->updateDocument($idDocument, [
            'idDocumentStatus'=>$status->id
        ])) {
            return $this->repoDocument->rollback();
        }
        
        $event = [
            'idDocument'=>$idDocument,
        ];
        
        if( !$this->emitEvent($this->eventError, $event)) {
            return $this->repoDocument->rollback();
        }
        
        $this->repoDocument->commit();
        return false;
    }
    
    public function setStatusNew($idDocument, $uuid)
    {
        $status = DocumentStatus::newInvoice()->first();
        
        if( !$this->updateDocument($idDocument, [
            'idDocumentStatus'=>$status->id
        ])) {
            return $this->repoDocument->rollback();
        }
        
        $event = [
            'idDocument'=>$idDocument,
            'uuid'=>$uuid,
        ];
        
        if( !$this->emitEvent($this->eventSuccess, $event)) {
            return $this->repoDocument->rollback();
        }
        
        $this->repoDocument->commit();
        return $event;
    }
    
    public function updateSerie(&$documents)
    {
        $result = $this->repoSeries->update([
            'folioCurrent'=>$documents->folio
        ], $documents->idSerie);
        
        if( $result === false) {
            return $this->error('Imposible incrementar folio de la serie {s}', [
                's'=>$documents->serie->name
            ]);
        }
        
        return true;
    }
    
    public function updateDocument($idDocument, array $input)
    {
        $result = $this->repoDocument->update($input, $idDocument);
        
        if( $result === false) {
            return false;
        }
        
        return true;
    }
    
    public function generateCfdi(&$documents)
    {
        return $this->logicGenerate->init($documents);
    }
    
    public function getDocument($id)
    {
        $documents = $this->logicReport->init($id);
        
        if( !$documents) {
            return $this->error('Imposible obtener reporte de la factura {f}', [
                'f'=>$id
            ]);
        }
        
        return $documents;
    }
    
    public function isValid(&$documents)
    {
        if( $documents->status->key === DocumentStatus::PENDING_GENERATE_CFDI) {
            return true;
        }
        
        switch ($documents->status->key) {
            case DocumentStatus::GENERATING_CFDI:
                return $this->error('Ya se encuentra generando el CFDI');
                break;

            default:
                $this->error('Imposible generar CFDI');
                break;
        }
    }
    
}
