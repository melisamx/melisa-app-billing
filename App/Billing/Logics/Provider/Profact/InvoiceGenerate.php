<?php

namespace App\Billing\Logics\Provider\Profact;

use Melisa\core\LogicBusiness;
use App\Drive\Logics\Files\ReportLogic;
use App\Drive\Interfaces\FileContent;
use App\Drive\Logics\Files\StringCreateLogic;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Interfaces\Invoice\v32\InvoiceXmlReader;
use App\Billing\Models\InvoiceStatus;
use App\Billing\Modules\Universal\Invoice\ReportModule;
use App\Billing\Logics\Invoice\v32\PreviewLogic;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Libraries\NumberToLetterConverter;

/**
 * Invoice generate with Profact
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceGenerate
{
    use LogicBusiness, Client;
    
    protected $repoInvoice;
    protected $readerXml;
    protected $logicFile;
    protected $repoSeries;
    protected $libNumberToLetter;

    public function __construct(
        InvoiceRepository $repoInvoice,
        InvoiceXmlReader $readerXml,
        StringCreateLogic $logicFile,
        SeriesRepository $repoSeries,
        NumberToLetterConverter $libNumberToLetter
    )
    {
        $this->repoInvoice = $repoInvoice;
        $this->readerXml = $readerXml;
        $this->logicFile = $logicFile;
        $this->repoSeries = $repoSeries;
        $this->libNumberToLetter = $libNumberToLetter;
    }
    
    public function init($invoice)
    {
        $xmlString = $this->generateXmlCfd($invoice);
        
        $params = $this->getClientParams([
            'xmlComprobanteBase64'=>base64_encode($xmlString)
        ]);
        
        $client = $this->createClient($params);
        
        $result = $this->generateXml($client, $params);
        
        if( !$result) {
            return false;
        }
        
        $dataBell = $this->getDataBell($result['xml']);
        
        $this->repoInvoice->beginTransaction();
        
        if( !$this->updateInvoice($invoice->id, [
            'uuid'=>$dataBell['uuid'],
            'stringOriginal'=>$result['stringOriginal'],
            'cfdiResult'=>base64_encode(serialize($result)),
        ])) {
            return $this->repoInvoice->rollback();
        }
        
        $this->repoInvoice->commit();        
        return $dataBell['uuid'];
    }
    
    public function getDataBell(&$bell)
    {
        $xmlTimbre = new \DOMDocument('1.0', 'UTF-8');
        $xmlTimbre->loadXML($bell);
        
        $c = $xmlTimbre->getElementsByTagNameNS('http://www.sat.gob.mx/TimbreFiscalDigital', 'TimbreFiscalDigital')->item(0); 
        return [
            'date'=>$c->getAttribute('FechaTimbrado'),
            'sealCfd'=>$c->getAttribute('selloCFD'),
            'version'=>$c->getAttribute('version'),
            'numberCertificateSat'=>$c->getAttribute('noCertificadoSAT'),
            'sealSat'=>$c->getAttribute('selloSAT'),
            'uuid'=>$c->getAttribute('UUID')
        ];
    }
    
    public function generateXmlCfd(&$invoice)
    {
        if( env('PROFACT_ENVIROMENT') === 'sandbox') {
            $invoice->transmitter->rfc = env('PROFACT_RFC_TRANSMITTER');
            $invoice->transmitter->fiscal_regime->key = '601';
        }
        
        $xml = view('layouts/invoice/xml33', [
            'invoice'=>$invoice
        ])->render();
        
        return $xml;
    }
    
    public function updateInvoice($idInvoice, $data)
    {
        $result = $this->repoInvoice->update($data, $idInvoice);
        
        if( $result === false) {
            return $this->error('Imposible modificar registro de factura {i}', [
                'i'=>$idInvoice
            ]);
        }
        
        return true;
    }
    
    public function generateXml(&$client, $params)
    {
        $result = $this->runRequest($client, 'TimbraCFDI', [
            'parameters'=>$params
        ]);
        
        if( !$result) {
            return $this->error('Imposible generar XML con Profact');
        }
        
        return $result;
    }
    
}
