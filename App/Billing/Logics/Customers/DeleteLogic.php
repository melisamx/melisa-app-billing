<?php

namespace App\Billing\Logics\Customers;

use Melisa\Laravel\Logics\DeleteLogic as BaseDeleteLogic;
use App\Billing\Repositories\CustomersRepository;
use App\Billing\Repositories\InvoiceRepository;

/**
 * Delete customer
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteLogic extends BaseDeleteLogic
{
    
    protected $invoiceRepo;

    public function __construct(
        CustomersRepository $repo,
        InvoiceRepository $invoiceRepo
    )
    {
        $this->repository = $repo;
        $this->invoiceRepo = $invoiceRepo;
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
        $invoice = $this->invoiceRepo->findWhere([
            'idCustomer'=>$input['id']
        ]);
        dd($invoice);
    }
    
}
