<?php

namespace App\Billing\Logics\DebtsToPay;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Logics\Documents\ReportLogic;
use App\Billing\Repositories\DebtsToPayRepository;
use App\Insurance\Logics\CertificatesApplications\ReportLogic as CerAppReport;
use App\Billing\Models\DebtsToPayStatus;

/**
 * Create debts to pay
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    
    protected $logicCerApp;

    public function __construct(
        DebtsToPayRepository $repository,
        ReportLogic $logicDocument,
        CerAppReport $logicCerApp
    )
    {
        $this->repository = $repository;
        $this->logicDocument = $logicDocument;
        $this->logicCerApp = $logicCerApp;
    }
    
    public function save(&$input)
    {
        $document = $this->getDocument($input['idDocument']);
        
        if (!$document) {
            return $this->repoAccRec->rollback();
        }
        
        if (!$this->isValidRegisterCommissions($document->id)) {
            return false;
        }
        
        $extraData = json_decode($document->preInvoice)->extraData;
        $commissions = $this->getCommissions($extraData->certificateApplication->id);
        
        if (empty($commissions)) {
            $this->info('No hay cuentas por pagar por registrar');
            return true;
        }
        
        return $this->saveCommissions($document, $commissions);
    }
    
    public function isValidRegisterCommissions($idDocument)
    {
        $oldCommissions = $this->repository->getByIdDocument($idDocument);
        
        if (!$oldCommissions->count()) {
            return true;
        }
        
        return $this->error('Ya se registrarón cuentas por pagar sobre la factura');
    }
    
    public function saveCommissions($document, &$commissions)
    {
        $ids = [];
        foreach ($commissions as $commission) {
            $dateVoucher = new \Carbon\Carbon($document->createdAt);
            $expirationDays = $this->getExpirationDays($document);
            
            $result = $this->repository->create([
                'idIdentityCreated'=>$commission->idProvider,
                'idProvider'=>$commission->idProvider,
                'idDocument'=>$document->id,
                'idDebtsToPayStatus'=>DebtsToPayStatus::NNEW,
                'amountPayable'=>$commission->calculation,
                'dateVoucher'=>$document->createdAt,
                'dueDate'=>$dateVoucher->addDays($expirationDays),
            ]);
            
            if ( !$result) {
                return $this->error('Imposible registrar comisión');
            }
            
            $ids []= $result;
        }
        return $ids;
    }
    
    public function getExpirationDays(&$document)
    {
        if (!is_null($document->customer_address->expirationDays)) {
            return $document->customer_address->expirationDays;
        }
        
        if (!is_null($document->customer->expirationDays)) {
            return $document->customer->expirationDays;
        }
        
        return $document->customer->repository->expirationDays;
    }
    
    public function getReturnData(&$event, &$input)
    {
        return $event['id'];
    }
    
    public function getCommissions($idCertificateApplication)
    {
        $result = $this->logicCerApp->init($idCertificateApplication);
        
        if ($result) {
            return $result->commissions;
        }
        
        return $this->error('Imposible obtener las comisiones');
    }
    
    public function getDocument($id)
    {
        $result = $this->logicDocument->init($id);
        
        if ($result) {
            return $result;
        }
        
        return $this->error('El docuento {f} no se encuentra o acaba de ser eliminado', [
            'f'=>$id
        ]);
    }
    
}
