<?php

namespace App\Billing\Logics\Provider\Profact;

use Melisa\core\LogicBusiness;
use App\Drive\Logics\Files\StringCreateLogic;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Libraries\NumberToLetterConverter;

/**
 * Documents generate with Profact
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceGenerate
{
    use LogicBusiness, Client;
    
    protected $repoDocuments;
    protected $readerXml;
    protected $logicFile;
    protected $repoSeries;
    protected $libNumberToLetter;

    public function __construct(
        DocumentsRepository $repoDocuments,
        StringCreateLogic $logicFile,
        SeriesRepository $repoSeries,
        NumberToLetterConverter $libNumberToLetter
    )
    {
        $this->repoDocuments = $repoDocuments;
        $this->logicFile = $logicFile;
        $this->repoSeries = $repoSeries;
        $this->libNumberToLetter = $libNumberToLetter;
    }
    
    public function init($documents)
    {
        $xmlString = $this->generateXmlCfd($documents);
        
        $params = $this->getClientParams([
            'xmlComprobanteBase64'=>base64_encode($xmlString)
        ]);
        
        $client = $this->createClient($params);
        
        $result = $this->generateXml($client, $params);
        
        if( !$result) {
            return false;
        }
        
        $dataBell = $this->getDataBell($result['xml']);
        
        $this->repoDocuments->beginTransaction();
        
        if( !$this->updateDocument($documents->id, [
            'uuid'=>$dataBell['uuid'],
            'stringOriginal'=>$result['stringOriginal'],
            'cfdiResult'=>base64_encode(serialize($result)),
        ])) {
            return $this->repoDocuments->rollback();
        }
        
        $this->repoDocuments->commit();        
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
    
    public function generateXmlCfd(&$documents)
    {
        if( env('PROFACT_ENVIROMENT') === 'sandbox') {
            $documents->transmitter->rfc = env('PROFACT_RFC_TRANSMITTER');
            $documents->transmitter->fiscal_regime->key = '601';
            $documents->customer->rfc = env('PROFACT_RFC_CUSTOMER');
        }
        
        $xml = view('layouts/documents/xml33', [
            'documents'=>$documents
        ])->render();
        
        return $xml;
    }
    
    public function updateDocument($idDocument, $data)
    {
        $result = $this->repoDocuments->update($data, $idDocument);
        
        if( $result === false) {
            return $this->error('Imposible modificar documento {i}', [
                'i'=>$idDocument
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
