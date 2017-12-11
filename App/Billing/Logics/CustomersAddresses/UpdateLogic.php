<?php

namespace App\Billing\Logics\CustomersAddresses;

use App\Billing\Logics\CustomersAddresses\CreateLogic;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Repositories\ContributorsAddressesRepository;

/**
 * Update addresse contributor
 *
 * @author Luis Josafat Heredia Contreras
 */
class UpdateLogic extends CreateLogic
{
    
    protected $fieldIdIdentityCreated = 'idIdentityUpdated';
    protected $repoDocuments;
    
    public function __construct(
        ContributorsAddressesRepository $repo,
        DocumentsRepository $repoDocuments
    )
    {
        $this->repository = $repo;
        $this->repoDocuments = $repoDocuments;
    }
    
    public function create(&$input)
    {
        if( !$this->isValidUpdate($input)) {
            return false;
        }
        
        $result = $this->repository->update([
            'idContributor'=>$input['idContributor'],
            'idCountry'=>$input['idCountry'],
            'idState'=>$input['idState'],
            'idMunicipality'=>$input['idMunicipality'],
            'idIdentityUpdated'=>$input['idIdentityUpdated'],
            'address'=>$input['address'],
            'colony'=>$input['colony'],
            'postalCode'=>$input['postalCode'],
            'interiorNumber'=>$input['interiorNumber'],
            'exteriorNumber'=>$input['exteriorNumber'],
            'active'=>$input['active'],
            'isDefault'=>$input['isDefault'],
            'expirationDays'=>$input['expirationDays'],
            'accountingAccount'=>isset($input['accountingAccount']) ? $input['accountingAccount'] : null,
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
        $documents = $this->repoDocuments->findWhere([
            'idCustomerAddress'=>$input['id']
        ]);
        
        if( !$documents->count()) {
            return true;
        }
        
        return $this->error('Imposible modificar la dirección ya que existe una factura relacionada');
    }
    
}
