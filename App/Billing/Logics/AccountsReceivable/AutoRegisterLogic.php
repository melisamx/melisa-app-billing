<?php

namespace App\Billing\Logics\AccountsReceivable;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\AccountsReceivableRepository;
use App\Billing\Logics\Documents\ReportLogic;
use App\Billing\Logics\Documents\GeneratePdfLogic;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Repositories\AccountingAccountsRepository;

/**
 * Register debts to pay
 *
 * @author Luis Josafat Heredia Contreras
 */
class AutoRegisterLogic
{
    use LogicBusiness;
    
    protected $eventSuccess = 'billing.accountsReceivable.autoregister.success';
    protected $accRecRepo;
    protected $accountRepo;
    protected $logicDocument;

    public function __construct(
        AccountsReceivableRepository $accRecRepo,
        AccountingAccountsRepository $accountRepo,
        ReportLogic $logicDocument
    ) {
        $this->accRecRepo = $accRecRepo;
        $this->accountRepo = $accountRepo;
        $this->logicDocument = $logicDocument;
    }

    public function init(array $input)
    {
        $this->accRecRepo->beginTransaction();
        
        $document = $this->getDocument($input['idDocument']);
        
        if( !$document) {
            return $this->accRecRepo->rollback();
        }
        
        if( !$this->isValid($document)) {
            return $this->accRecRepo->rollback();
        }
        
        if( !$this->generatePdf($document)) {
            return $this->accRecRepo->rollback();
        }
        
        $idAccRec = $this->createAccountReceivable($document);
        
        if( !$idAccRec) {
            return false;
        }
        
        $event = [
            'idAccountReceivable'=>$idAccRec,
            'idDocument'=>$document->id
        ];
        
        if( !$this->fireEvent($event)) {
            return $this->accRecRepo->rollback();
        }
        
        $this->accRecRepo->commit();
        return $event;
    }
    
    public function generatePdf(&$documents)
    {
        if( !empty($documents->idFilePdf)) {
            return true;
        }
        
        $idFile = app(GeneratePdfLogic::class)->init($documents);
        
        if( !$idFile) {
            return $this->error('Imposible generar archivo PDF del documento {d}', [
                'd'=>$documents->id
            ]);
        }
        
        if( !app(DocumentsRepository::class)->update([
            'idFilePdf'=>$idFile
        ], $documents->id)) {
            return $this->error('Imposible asignar archivo {f} PDF de la factura {i}', [
                'i'=>$documents->id,
                'f'=>$idFile,
            ]);
        }
        
        $documents->idFilePdf = $idFile;
        return true;
    }
    
    public function isValid(&$documents)
    {
        if( empty($documents->uuid)) {
            return $this->error('No se ha generado el CFDI');
        }
        
        return true;
    }
    
    public function createAccountReceivable(&$documents)
    {
        $dateVoucher = new \Carbon\Carbon($documents->createdAt);
        
        $result = $this->accRecRepo->createNew([
            'idIdentityCreated'=>$this->getIdentity(),
            'idAccountingAccount'=>$documents->customer_address->accounting_account->id,
            'idFileVoucher'=>$documents->idFilePdf,
            'idDocument'=>$documents->id,
            'amountCharged'=>(float)$documents->total,
            'dateVoucher'=>new \Carbon\Carbon($dateVoucher),
            'balance'=>(float)$documents->total,
            'dueDate'=>$dateVoucher->addDays($documents->customer_address->accounting_account->expirationDays),
        ]);
        
        if( $result) {
            return $result;
        }
        
        return $this->error('Imposible auto registrar cuenta por cobrar a la cuenta {a} por la factura {i}', [
            'a'=>$documents->customer_address->accounting_account->id,
            'i'=>$documents->id,
        ]);
    }
    
    public function getDocument($id)
    {
        $result = $this->logicDocument->init($id);
        
        if( $result) {
            return $result;
        }
        
        return $this->error('El docuento {f} no se encuentra o acaba de ser eliminado', [
            'f'=>$id
        ]);
    }
    
}
