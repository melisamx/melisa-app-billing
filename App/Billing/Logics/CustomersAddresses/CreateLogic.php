<?php

namespace App\Billing\Logics\CustomersAddresses;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\ContributorsAddressesRepository;

/**
 * Create contributor address
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    protected $fireEvent = 'billing.customersAddresses.create.success';

    public function __construct(
        ContributorsAddressesRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
    public function create(&$input)
    {
        $result = parent::create($input);
        
        if( !$result) {
            return false;
        }
        
        if( !$input['isDefault']) {
            return $result;
        }
        
        if( !$this->setDefaultUnique($result, $input['idContributor'])) {
            return false;
        }
        
        return $result;
    }
    
    public function setDefaultUnique($id, $idContributor)
    {        
        $result = $this->repository->getModel()
            ->where('id', '!=', $id)
            ->where('idContributor', $idContributor)
            ->update([
                'isDefault'=>false
            ]);
        
        if( $result === false) {
            return $this->error('Imposible establecer dirección como default');
        }
        
        return true;
    }
    
}
