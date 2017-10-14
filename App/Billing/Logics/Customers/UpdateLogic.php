<?php

namespace App\Billing\Logics\Customers;

use App\Billing\Logics\Contributors\UpdateLogic as UpdateContributor;
use App\Billing\Repositories\CustomersRepository;
use App\Billing\Repositories\InvoiceRepository;

/**
 * Update customer
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateLogic extends CreateLogic
{
    
    protected $eventSuccess = 'billing.customers.update.success';
    protected $invoiceRepo;
    
    public function __construct(
        CustomersRepository $customers,
        UpdateContributor $contributors,
        InvoiceRepository $invoiceRepo
    )
    {
        $this->customers = $customers;
        $this->contributors = $contributors;
        $this->invoiceRepo = $invoiceRepo;
    }
    
    public function createCustomer($idContributor, &$input)
    {
        $result = $this->customers->update([
            'idRepository'=>$input['idRepository'],
            'idContributor'=>$idContributor,
            'active'=>$input['active'],
            'idWaytopay'=>$input['idWaytopay'],
            'idIdentityUpdated'=>$input['idIdentityUpdated'],
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
        $invoice = $this->invoiceRepo->findWhere([
            'idCustomer'=>$input['id']
        ]);
        
        if( $invoice->count()) {
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
