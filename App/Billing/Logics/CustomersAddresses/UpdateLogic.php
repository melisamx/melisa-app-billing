<?php

namespace App\Billing\Logics\CustomersAddresses;

use App\Billing\Logics\CustomersAddresses\CreateLogic;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Repositories\ContributorsAddressesRepository;

/**
 * Update addresse contributor
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateLogic extends CreateLogic
{
    
    protected $fieldIdIdentityCreated = 'idIdentityUpdated';
    protected $invoiceRepo;
    
    public function __construct(
        ContributorsAddressesRepository $repo,
        InvoiceRepository $invoiceRepo
    )
    {
        $this->repository = $repo;
        $this->invoiceRepo = $invoiceRepo;
    }
    
    public function create(&$input)
    {
        if( !$this->isValidUpdate($input)) {
            return false;
        }
        
        $result = $this->repository->update([
            'idContributor'=>$input['idContributor'],
            'idAccountingAccount'=>$input['idAccountingAccount'],
            'idCountry'=>$input['idCountry'],
            'idState'=>$input['idState'],
            'idMunicipality'=>$input['idMunicipality'],
            'address'=>$input['address'],
            'colony'=>$input['colony'],
            'postalCode'=>$input['postalCode'],
            'interiorNumber'=>$input['interiorNumber'],
            'exteriorNumber'=>$input['exteriorNumber'],
            'active'=>$input['active'],
            'isDefault'=>$input['isDefault'],
            'idIdentityUpdated'=>$input['idIdentityUpdated'],
        ], $input['id']);
        
        if( $result === false) {
            return $this->error('Imposible modificar dirección de cliente');
        }
        
        if( !$input['isDefault']) {
            return $result;
        }
        
        if( !$this->setDefaultUnique($input['id'], $input['idContributor'])) {
            return false;
        }
        
        return $input['id'];
    }
    
    public function isValidUpdate($input)
    {
        $documents = $this->invoiceRepo->findWhere([
            'idCustomerAddress'=>$input['id']
        ]);
        
        if( !$documents->count()) {
            return true;
        }
        
        return $this->error('Imposible modificar la dirección ya que existe una factura relacionada');
    }
    
}
