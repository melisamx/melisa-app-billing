<?php

namespace App\Billing\Logics\AccountsReceivable;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\AccountsReceivableRepository;
use App\Billing\Logics\Invoice\ReportLogic;
use App\Billing\Logics\Invoice\GeneratePdfLogic;
use App\Billing\Repositories\InvoiceRepository;
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
    protected $invoiceLogic;

    public function __construct(
        AccountsReceivableRepository $accRecRepo,
        AccountingAccountsRepository $accountRepo,
        ReportLogic $invoiceLogic
    ) {
        $this->accRecRepo = $accRecRepo;
        $this->accountRepo = $accountRepo;
        $this->invoiceLogic = $invoiceLogic;
    }

    public function init(array $input)
    {
        $this->accRecRepo->beginTransaction();
        
        $invoice = $this->getInvoice($input['idInvoice']);
        
        if( !$invoice) {
            return $this->accRecRepo->rollback();
        }
        
        if( !$this->isValid($invoice)) {
            return $this->accRecRepo->rollback();
        }
        
        if( !$this->generateInvoicePdf($invoice)) {
            return $this->accRecRepo->rollback();
        }
        
        $idAccRec = $this->createAccountReceivable($invoice);
        
        if( !$idAccRec) {
            return false;
        }
        
        $event = [
            'idAccountReceivable'=>$idAccRec,
            'idInvoice'=>$invoice->id
        ];
        
        if( !$this->fireEvent($event)) {
            return $this->accRecRepo->rollback();
        }
        
        $this->accRecRepo->commit();
        return $event;
    }
    
    public function generateInvoicePdf(&$invoice)
    {
        if( !empty($invoice->idFilePdf)) {
            return true;
        }
        
        $idFile = app(GeneratePdfLogic::class)->init($invoice);
        
        if( !$idFile) {
            return $this->error('Imposible generar archivo PDF de la factura {i}', [
                'i'=>$invoice->id
            ]);
        }
        
        if( !app(InvoiceRepository::class)->update([
            'idFilePdf'=>$idFile
        ], $invoice->id)) {
            return $this->error('Imposible asignar archivo {f} PDF de la factura {i}', [
                'i'=>$invoice->id,
                'f'=>$idFile,
            ]);
        }
        
        $invoice->idFilePdf = $idFile;
        return true;
    }
    
    public function isValid(&$invoice)
    {
        if( empty($invoice->uuid)) {
            return $this->error('No se ha generado el CFDI');
        }
        
        return true;
    }
    
    public function createAccountReceivable(&$invoice)
    {
        $dateVoucher = new \Carbon\Carbon($invoice->createdAt);
        
        $result = $this->accRecRepo->createNew([
            'idIdentityCreated'=>$this->getIdentity(),
            'idAccountingAccount'=>$invoice->customer_address->accounting_account->id,
            'idFileVoucher'=>$invoice->idFilePdf,
            'idInvoice'=>$invoice->id,
            'amountCharged'=>(float)$invoice->total,
            'dateVoucher'=>new \Carbon\Carbon($dateVoucher),
            'balance'=>(float)$invoice->total,
            'dueDate'=>$dateVoucher->addDays($invoice->customer_address->accounting_account->expirationDays),
        ]);
        
        if( $result) {
            return $result;
        }
        
        return $this->error('Imposible auto registrar cuenta por cobrar a la cuenta {a} por la factura {i}', [
            'a'=>$invoice->customer_address->accounting_account->id,
            'i'=>$invoice->id,
        ]);
    }
    
    public function getInvoice($idInvoice)
    {
        $result = $this->invoiceLogic->init($idInvoice);
        
        if( $result) {
            return $result;
        }
        
        return $this->error('La factura {f} no se encuentra o acaba de ser eliminada', [
            'f'=>$idInvoice
        ]);
    }
    
}
