<?php

namespace App\Billing\Logics\Customers;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\CustomersRepository;
use App\Billing\Logics\Contributors\CreateLogic as CreateContributor;

/**
 * Create customer and contributor
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic
{
    use LogicBusiness;
    
    protected $customers;
    protected $contributors;
    protected $eventDisabled = false;
    protected $eventSuccess = 'billing.customers.create.success';

    public function __construct(
        CustomersRepository $customers,
        CreateContributor $contributors
    )
    {
        $this->customers = $customers;
        $this->contributors = $contributors;
    }
    
    public function init(array $input)
    {        
        $this->customers->beginTransaction();
        
        $this->inyectIdentity($input);
        
        $idContributor = $this->createContributor($input);
        
        if( !$idContributor) {
            return $this->customers->rollback();
        }
        
        $idCustomer = $this->createCustomer($idContributor, $input);
        
        if( !$idCustomer) {
            return $this->customers->rollback();
        }
        
        $event = [
            'idCustomer'=>$idCustomer,
            'idContributor'=>$idContributor,
        ];
        
        if( $this->eventDisabled) {
            $this->customers->commit();
            return $event;
        }
        
        if ( !$this->fireEvent($event)) {
            return $this->customers->rollBack();
        }
        
        $this->customers->commit();
        return $event;        
    }
    
    public function eventDisabled()
    {
        $this->eventDisabled = true;
        return $this;
    }
    
    public function createContributor(&$input)
    {        
        $contributor = $this->contributors->init($input);
        
        if( !$contributor) {
            return $this->error('Imposible crear contribuyente');
        }
        
        return $contributor['id'];        
    }
    
    public function createCustomer($idContributor, &$input)
    {        
        $id = $this->customers->create([
            'idRepository'=>$input['idRepository'],
            'idContributor'=>$idContributor,
            'active'=>$input['active'],
            'idWaytopay'=>$input['idWaytopay'],
            'idIdentityCreated'=>$input['idIdentityCreated'],
        ]);
        
        if( $id) {
            return $id;
        }
        
        return $this->error('Imposible crear cliente');  
    }
    
}
