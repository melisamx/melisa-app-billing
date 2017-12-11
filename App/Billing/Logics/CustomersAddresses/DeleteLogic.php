<?php

namespace App\Billing\Logics\CustomersAddresses;

use Melisa\Laravel\Logics\DeleteLogic as BaseDeleteLogic;
use App\Billing\Repositories\ContributorsAddressesRepository;
use App\Billing\Repositories\DocumentsRepository;

/**
 * Delete addresse contributor
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteLogic extends BaseDeleteLogic
{
    
    protected $repoDocuments;
    
    public function __construct(
        ContributorsAddressesRepository $repo,
        DocumentsRepository $repoDocuments
    )
    {
        $this->repository = $repo;
        $this->repoDocuments = $repoDocuments;
    }
    
    public function delete(&$input)
    {
        if( !$this->isValidDelete($input)) {
            return false;
        }
        
        return parent::delete($input);
    }
    
    public function isValidDelete($input)
    {
        $documents = $this->repoDocuments->findWhere([
            'idCustomerAddress'=>$input['id']
        ]);
        
        if( !$documents->count()) {
            return true;
        }
        
        return $this->error('Imposible eliminar la dirección ya que existe una factura relacionada');
    }
    
}
