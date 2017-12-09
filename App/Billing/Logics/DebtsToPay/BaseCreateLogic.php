<?php

namespace App\Billing\Logics\DebtsToPay;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\DebtsToPayRepository;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Models\DocumentStatus;

/**
 * Base debts to pay create
 *
 * @author Luis Josafat Heredia Contreras
 */
class BaseCreateLogic
{
    use LogicBusiness;
    
    protected $eventSuccess = 'billing.debtsToPay.create.success';
    protected $repoDocuments;
    protected $repoDebtsToPay;

    public function __construct(
        DebtsToPayRepository $repoDebtsToPay,
        DocumentsRepository $repoDocuments
    )
    {
        $this->repoDebtsToPay = $repoDebtsToPay;
        $this->repoDocuments = $repoDocuments;
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
        $documents = $this->repoDocuments
            ->getModel()
            ->with('status')
            ->find($input['idDocument']);
        
        if( !$documents) {
            return $this->error('No existe la factura');
        }
        
        if( $documents->status->key === DocumentStatus::NNEW) {
            return true;
        }
        
        return $this->error('Imposible generar cuentas por pagar, ya que la factura no esta timbraba');
    }
    
}
