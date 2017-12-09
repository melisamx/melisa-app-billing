<?php

namespace App\Billing\Logics\Customers;

use Melisa\Laravel\Logics\DeleteLogic as BaseDeleteLogic;
use App\Billing\Repositories\CustomersRepository;
use App\Billing\Repositories\DocumentsRepository;

/**
 * Delete customer
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteLogic extends BaseDeleteLogic
{
    
    protected $repoDocuments;

    public function __construct(
        CustomersRepository $repo,
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
        
        return parent::delete(&$input);        
    }
    
    public function isValidDelete(&$input)
    {
        $documents = $this->repoDocuments->findWhere([
            'idCustomer'=>$input['id']
        ]);
        dd($documents);
    }
    
}
