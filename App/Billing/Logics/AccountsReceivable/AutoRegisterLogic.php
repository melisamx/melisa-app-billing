<?php

namespace App\Billing\Logics\AccountsReceivable;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\AccountsReceivableRepository;
use App\Billing\Repositories\InvoiceRepository;

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
    protected $invoiceRepo;

    public function __construct(
        AccountsReceivableRepository $accRecRepo,
        InvoiceRepository $invoiceRepo
    ) {
        $this->accRecRepo = $accRecRepo;
        $this->invoiceRepo = $invoiceRepo;
    }

    public function init(array $input)
    {
        $this->accRecRepo->beginTransaction();
        
        $invoice = $this->getInvoice($input['idInvoice']);
        
        if( !$invoice) {
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
    
    public function createAccountReceivable($cerApp)
    {
        $dateVoucher = new \Carbon\Carbon($cerApp->invoice->createdAt);
        
        $result = $this->accRecRepo->init([
            'idAccount'=>$cerApp->supplier->idAccountDebsToPay,
            'idFileVoucher'=>$cerApp->invoice->idFilePdf,
            'amountPayable'=>(float)$cerApp->supplier->certificateRight,
            'dateVoucher'=>$cerApp->invoice->createdAt,
            'dueDate'=>$dateVoucher->addDays($cerApp->supplier->accountDebtsToPay->expirationDays),
        ]);
        
        if( $result) {
            return $result['id'];
        }
        
        return $this->error('Imposible auto registrar cuenta por pagar al proveedor {p} por la factura {f}', [
            'p'=>$cerApp->supplier->name,
            'f'=>$cerApp->idInvoice,
        ]);
    }
    
    public function getInvoice($idInvoice)
    {
        $result = $this->invoiceRepo
            ->getModel()
            ->where([
                'id'=>$idInvoice
            ])
            ->first();
        
        if( $result) {
            return $result;
        }
        
        return $this->error('La factura {f} no se encuentra o acaba de ser eliminada', [
            'f'=>$idInvoice
        ]);
    }
    
}
