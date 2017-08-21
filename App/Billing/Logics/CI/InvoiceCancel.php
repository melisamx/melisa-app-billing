<?php

namespace App\Billing\Logics\CI;

use Melisa\core\LogicBusiness;
use App\Billing\Interfaces\Invoice\v32\Invoice;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Interfaces\Invoice\v32\InvoiceXmlReader;
use App\Billing\Models\InvoiceStatus;
use App\Drive\Logics\Files\GetContentLogic;

/**
 * Invoice cancel
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceCancel
{
    use LogicBusiness, Client;
    
    protected $logicGetContentFile;

    public function __construct(
        GetContentLogic $logicGetContentFile
    )
    {
        $this->logicGetContentFile = $logicGetContentFile;
    }
    
    public function init($invoice)
    {
        $client = $this->createClient();
        
        if( !$client) {
            return false;
        }
        
        $cfd = $this->getCfd($invoice->idFileXml);
        
        if( !$cfd) {
            return false;
        }
        
        $params = $this->getRequestParams();
        $params ['CFD']= $cfd;
        
        $result = $this->cancelCfdi($client, $params);
        dd($result);
        if( !$result) {
            return false;
        }
        
        $this->repoInvoice->beginTransaction();
        
        $dataXml = $this->getXmlData($xmlString);
        
        if( !$dataXml) {
            return false;
        }
        
        $idFileXml = $this->saveFileXml($xmlString, $dataXml);
        
        if( !$idFileXml) {
            return $this->error('Imposible guardar XML de la factura');
        }
        
        $idFilePdf = $this->saveFilePdf($pdfString, $dataXml);
        
        if( !$idFilePdf) {
            return $this->error('Imposible guardar PDF de la factura');
        }
        
        if( !$this->updateInvoice($idInvoice, [
            'idFilePdf'=>$idFilePdf
        ])) {
            return $this->repoInvoice->rollback();
        }
        
        $this->repoInvoice->commit();        
        return [
            'idInvoice'=>$idInvoice,
            'idFilePdf'=>$idFilePdf,
            'idFileXml'=>$idFileXml,
        ];
    }
    
    public function getCfd($idFileCfd)
    {
        $content = $this->logicGetContentFile->init($idFileCfd);
        
        if( $content === false) {
            return $this->error('Imposible obtener el contenido del CFD timbrado');
        }
        
        return str_replace([ PHP_EOL, '\r'], '', $content);
    }
    
    public function cancelCfdi(&$client, &$params)
    {
//        dd($params);
        $result = $this->runRequest($client, 'CancelarCFDI', $params);
        dd($result);
        if( !$result) {
            return $this->error('Imposible cancelar la factura');
        }
        
        return $result['CancelaCFDIResult'];
    }   
        
    public function getRequestParams()
    {
        return [
            'LoginWS'=>$this->getUser(),
            'PasswordWS'=>$this->getPass(),
        ];
    }    
    
}
