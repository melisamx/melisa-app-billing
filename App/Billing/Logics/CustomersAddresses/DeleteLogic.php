<?php

namespace App\Billing\Logics\CustomersAddresses;

use Melisa\Laravel\Logics\DeleteLogic as BaseDeleteLogic;
use App\Billing\Repositories\ContributorsAddressesRepository;
use App\Billing\Repositories\InvoiceRepository;

/**
 * Delete addresse contributor
 *
 * @author Luis Josafat Heredia Contreras
 */
class DeleteLogic extends BaseDeleteLogic
{
    
    protected $invoiceRepo;
    
    public function __construct(
        ContributorsAddressesRepository $repo,
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
        
        return parent::delete($input);
    }
    
    public function isValidDelete($input)
    {
        $invoice = $this->invoiceRepo->findWhere([
            'idContributorAddress'=>$input['id']
        ]);
        
        if( !$invoice->count()) {
            return true;
        }
        
        return $this->error('Imposible eliminar la dirección ya que existe una factura relacionada');
    }
    
}
