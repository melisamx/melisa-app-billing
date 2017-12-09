<?php

namespace App\Billing\Logics\Provider\Profact;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Models\InvoiceStatus;
use App\Drive\Logics\Files\GetContentLogic;

/**
 * Documents cancel
 *
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceCancel
{
    use LogicBusiness, Client;
    
    protected $logicGetContentFile;

    public function __construct(
        GetContentLogic $logicGetContentFile,
        InvoiceRepository $invoiceRepo
    )
    {
        $this->logicGetContentFile = $logicGetContentFile;
        $this->invoiceRepo = $invoiceRepo;
    }
    
    public function init($documents)
    {
        $params = $this->getClientParams([
            'folioUUID'=>$documents->uuid,
        ]);
        
        $client = $this->createClient($params);
        
        if( !$client) {
            return false;
        }
        
        $result = $this->cancelCfdi($client, $params);
        dd($result);
        if( !$result) {
            return false;
        }
        
        $this->repoInvoice->beginTransaction();
        
        if( !$this->updateInvoice($idInvoice)) {
            return $this->repoInvoice->rollback();
        }
        
        $this->repoInvoice->commit();
        
        return [
            'idInvoice'=>$idInvoice,
        ];
    }
    
    public function updateInvoice($idInvoice)
    {
        $result = $this->repoInvoice->update([
            'canceledAt'=>date('Y-m-d h:m:s'),
            'idInvoiceStatus'=>InvoiceStatus::CANCELLED
        ]);
        
        if( $result === false) {
            return $this->error('Imposible modificar status de la factura a {c}', [
                'c'=>InvoiceStatus::CANCELLED
            ]);
        }
        
        return true;
    }
    
    public function cancelCfdi(&$client, &$params)
    {
        $result = $this->runRequestCancel($client, 'CancelaCFDI', $params);
        
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
