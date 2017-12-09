<?php

namespace App\Billing\Logics\Documents;

use Melisa\Laravel\Logics\DeleteLogic as BaseDeleteLogic;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Logics\Documents\ReportLogic;
use App\Billing\Models\InvoiceStatus;

/**
 * Delete documents
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteLogic extends BaseDeleteLogic
{
    
    protected $eventSuccess = 'billing.documents.delete.success';
    protected $repository;
    protected $logicReport;
    
    public function __construct(
        DocumentsRepository $repository
    )
    {
        parent::__construct($repository);
        $this->logicReport = app(ReportLogic::class);
    }
    
    public function delete(&$input)
    {        
        $documents = $this->getDocument($input['id']);
        
        if( !$documents) {
            return false;
        }
        
        if( !$this->isValid($documents)) {
            return false;
        }
        
        return parent::delete($input);
    }
    
    public function getDocument($id)
    {
        $documents = $this->logicReport->init($id);
        
        if( !$documents) {
            return $this->error('Imposible obtener reporte del documento {f}', [
                'f'=>$id
            ]);
        }
        
        return $documents;
    }
    
    public function isValid(&$documents)
    {
        if( $documents->status->key === InvoiceStatus::PENDING_GENERATE_CFDI) {
            return true;
        }
        
        return false;
    }
    
}
