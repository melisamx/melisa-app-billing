<?php

namespace App\Billing\Logics\Customers;

use Melisa\Laravel\Logics\DeleteLogic as BaseDeleteLogic;
use App\Billing\Repositories\CustomersRepository;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Repositories\ContributorsRepository;

/**
 * Delete customer
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteLogic extends BaseDeleteLogic
{
    
    protected $repoDocuments;
    protected $repoContributors;

    public function __construct(
        CustomersRepository $repo
    )
    {
        parent::__construct($repo);
        $this->repoDocuments = app(DocumentsRepository::class);
        $this->repoContributors = app(ContributorsRepository::class);
    }
    
    public function delete(&$input)
    {        
        if( !$this->isValidDelete($input)) {
            return false;
        }
        
        $customer = $this->getCustomer($input['id']);
        
        if( !$customer) {
            return false;
        }
        
        $result = parent::delete($input);
        
        if( $result === false) {
            return false;
        }
        
        if( !$this->deleteContributor($customer->idContributor)) {
            return false;
        }
        
        return $result;
    }
    
    public function deleteContributor($idContributor)
    {
        $result = $this->repoContributors->delete($idContributor);
        
        if( $result === false) {
            return $this->error('Imposible eliminar detalle del cliente');
        }
        
        return true;
    }
    
    public function getCustomer($id)
    {
        $customer = $this->repository->find($id);
        
        if( $customer) {
            return $customer;
        }
        
        return $this->error('Imposible obtener la información del cliente');
    }
    
    public function isValidDelete(&$input)
    {
        $documents = $this->repoDocuments->findWhere([
            'idCustomer'=>$input['id']
        ]);
        
        if( !$documents->count()) {
            return true;
        }
        
        return $this->error('Imposible eliminar el cliente, ya cuenta con documentos');
    }
    
}
