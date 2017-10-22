<?php

namespace App\Billing\Logics\DebtsToPay;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\DebtsToPayRepository;
use App\Billing\Models\DebtsToPayStatus;

/**
 * Payoff debts to pay
 *
 * @author Luis Josafat Heredia Contreras
 */
class PayoffLogic
{
    use LogicBusiness;
    
    protected $eventSuccess = 'billing.debtsToPay.payoff.success';
    protected $repoDebtsToPay;

    public function __construct(
        DebtsToPayRepository $repoDebtsToPay
    )
    {
        $this->repoDebtsToPay = $repoDebtsToPay;
    }
    
    public function init(array $input)
    {
        $this->repoDebtsToPay->beginTransaction();
        
        $debtsToPay = $this->getDebtsToPay($input['id']);
        
        if( !$debtsToPay) {
            return false;
        }
        
        if( !$this->isValidDebtsToPay($debtsToPay)) {
            return false;
        }
        
        if( !$this->updateDebtsToPay($debtsToPay->id, $input)) {
            return $this->repoDebtsToPay->rollback();
        }
        
        $event = [
            'idDebtsToPay'=>$input['id'],
            'idFilePayment'=>$input['idFilePayment'],
        ];
        
        if ( !$this->fireEvent($event)) {
            return $this->repoDebtsToPay->rollBack();
        }
        
        $this->repoDebtsToPay->commit();
        return $event;
    }
    
    public function isValidDebtsToPay(&$debtsToPay)
    {
        if( $debtsToPay->idDebtsToPayStatus === DebtsToPayStatus::NNEW) {
            return true;
        }
        
        return $this->error('La cuenta {n} ya fue saldada', [
            'n'=>$debtsToPay->account->name
        ]);
    }
    
    public function getDebtsToPay($id)
    {
        $result = $this->repoDebtsToPay->find($id);
        
        if( $result) {
            return $result;
        }
        
        return $this->error('Imposible obtener la cuenta por pagar {i}', [
            'i'=>$id
        ]);
    }
    
    public function updateDebtsToPay($id, $input)
    {
        $result = $this->repoDebtsToPay->update([
            'idDebtsToPayStatus'=>DebtsToPayStatus::PAYOFF,
            'idFilePayment'=>$input['idFilePayment'],
            'paymentDate'=>$input['paymentDate'],
            'idIdentityUpdated'=>$this->getIdentity(),
        ], $id);
        
        if( $result) {
            return true;
        }
        
        return $this->error('Imposible saldar cuenta por pagar {i}', [
            'i'=>$id
        ]);
    }
    
}
