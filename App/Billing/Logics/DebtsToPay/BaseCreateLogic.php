<?php

namespace App\Billing\Logics\DebtsToPay;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\DebtsToPayRepository;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Models\InvoiceStatus;

/**
 * Base debts to pay create
 *
 * @author Luis Josafat Heredia Contreras
 */
class BaseCreateLogic
{
    use LogicBusiness;
    
    protected $eventSuccess = 'billing.debtsToPay.create.success';
    protected $repoInvoice;
    protected $repoDebtsToPay;

    public function __construct(
        DebtsToPayRepository $repoDebtsToPay,
        InvoiceRepository $repoInvoice
    )
    {
        $this->repoDebtsToPay = $repoDebtsToPay;
        $this->repoInvoice = $repoInvoice;
    }
    
    public function init(array $input)
    {        
        if( !$this->isValid($input)) {
            return false;
        }        
        
        return $this->runLogic($input);
    }
    
    public function runLogic(&$input)
    {
        
    }
    
    public function isValid(&$input)
    {
        $invoice = $this->repoInvoice
            ->getModel()
            ->with('status')
            ->find($input['idInvoice']);
        
        if( !$invoice) {
            return $this->error('No existe la factura');
        }
        
        if( $invoice->status->key === InvoiceStatus::NNEW) {
            return true;
        }
        
        return $this->error('Imposible generar cuentas por pagar, ya que la factura no esta timbraba');
    }
    
}
