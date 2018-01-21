<?php

namespace App\Billing\Logics\Customers;

use App\Billing\Logics\Contributors\UpdateLogic as UpdateContributor;
use App\Billing\Repositories\CustomersRepository;
use App\Billing\Repositories\DocumentsRepository;

/**
 * Update customer
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateLogic extends CreateLogic
{
    
    protected $eventSuccess = 'billing.customers.update.success';
    protected $repoDocuments;
    
    public function __construct(
        CustomersRepository $customers,
        UpdateContributor $contributors,
        DocumentsRepository $repoDocuments,
        ReportLogic $reportCustomer
    )
    {
        $this->customers = $customers;
        $this->contributors = $contributors;
        $this->repoDocuments = $repoDocuments;
        $this->reportCustomer = $reportCustomer;
    }
    
    public function isValidCustomer($input)
    {
        $result = $this->customers->getModel()
            ->select([
                'customers.*',
                'c.name',
                'c.rfc',
            ])
            ->join('contributors as c', 'c.id', '=', 'customers.idContributor')
            ->where([
                'idRepository'=>$input['idRepository'],
                'rfc'=>$input['rfc'],
                'name'=>$input['name'],
            ])
            ->first();
        
        if( !$result) {
            return true;
        }
        
        if( $result->id === $input['id']) {
            return true;
        }
        
        return $this->error('Ya existe un cliente con el RFC {r} y el nombre {n}', [
            'r'=>$input['rfc'],
            'n'=>$input['name'],
        ]);
    }
    
    public function createCustomer($idContributor, &$input)
    {
        $result = $this->customers->update([
            'idRepository'=>$input['idRepository'],
            'idContributor'=>$idContributor,
            'active'=>$input['active'],
            'idWaytopay'=>$input['idWaytopay'],
            'idIdentityUpdated'=>$input['idIdentityUpdated'],
            'expirationDays'=>isset($input['expirationDays']) ? 
                $input['expirationDays'] : null,
        ], $input['id']);
        
        if( $result === false) {
            return $this->error('Imposible modificar cliente');
        }
        
        return $input['id'];        
    }
    
    public function createContributor(&$input)
    {
        if( !$this->isValidUpdate($input)) {
            return false;
        }
        
        $contributor = $this->contributors->init($input);
        
        if( !$contributor) {
            return $this->error('Imposible modificar contribuyente');
        }
        
        return $input['idContributor'];        
    }
    
    public function isValidUpdate(&$input)
    {
        $documents = $this->repoDocuments->findWhere([
            'idCustomer'=>$input['id']
        ]);
        
        if( $documents->count()) {
            return $this->error('Ya hay facturas con este cliente, no es posible modificarlo');
        }
        
        return true;
    }
    
    public function inyectIdentity(&$input)
    {
        if( !isset($input ['idIdentityUpdated'])) {
            $input ['idIdentityUpdated']= $this->getIdentity();
        }
    }
    
}
