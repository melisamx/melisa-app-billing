<?php

namespace App\Billing\Logics\Invoice;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Models\InvoiceStatus;
use App\Billing\Models\VoucherTypes;

class CreateLogic extends BaseCreateLogic
{
    
    protected $fireEvent = 'billing.invoice.success';

    public function __construct(
        InvoiceRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
    public function create(&$input)
    {
        dd($input);
        $result = $this->repository->create([
            'idVoucherType'=>$this->getVoucherType('i'),
            'idInvoiceStatus'=>$this->getInvoiceStatus('new'),
            'idCustomer'=>$input['preinvoice']->extraData->idCustomer,
            'idCustomerAddress'=>$input['preinvoice']->extraData->idContributorAddress,
            'idTransmitter'=>$input['preinvoice']->extraData->idTransmitter,
            'idTransmitterAddress'=>$input['preinvoice']->extraData->idTransmitterAddress,
            'idSerie'=>$input['idSerie'],
            'idCsd'=>$input['idCsd'],
            'idIdentityCreated'=>$this->getIdentity(),
        ]);
        dd($result);
    }
    
    public function getInvoiceStatus($key)
    {
        return InvoiceStatus::where('key', $key)->first()->id;
    }
    
    public function getVoucherType($key)
    {
        return VoucherTypes::where('key', $key)->first()->id;
    }
    
}
