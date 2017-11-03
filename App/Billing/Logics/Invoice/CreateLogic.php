<?php

namespace App\Billing\Logics\Invoice;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Repositories\PaymentMethodsRepository;
use App\Billing\Repositories\InvoiceStatusRepository;
use App\Billing\Repositories\VoucherTypesRepository;

class CreateLogic extends BaseCreateLogic
{
    
    protected $fireEvent = 'billing.invoice.success';
    protected $repoSeries;
    protected $repoPaymentMethod;
    protected $repoInvoiceStatus;
    protected $repoVoucherTypes;

    public function __construct(
        InvoiceRepository $repository,
        SeriesRepository $repoSeries,
        PaymentMethodsRepository $repoPaymentMethod,
        InvoiceStatusRepository $repoInvoiceStatus,
        VoucherTypesRepository $repoVoucherTypes
    )
    {
        $this->repository = $repository;
        $this->repoSeries = $repoSeries;
        $this->repoPaymentMethod = $repoPaymentMethod;
        $this->repoInvoiceStatus = $repoInvoiceStatus;
        $this->repoVoucherTypes = $repoVoucherTypes;
    }
    
    public function create(&$input)
    {
        if( !$this->getDefaultsValue($input)) {
            return false;
        }
        
        return parent::create($input);
    }
    
    public function getDefaultsValue(&$input)
    {
        if( !isset($input['idVoucherType']) && !$this->getVoucherType($input)) {
            return false;
        }
        
        $input ['idInvoiceStatus']= $this->getInvoiceStatus('new');
        
        if( !isset($input['idSerie']) && !$this->getSerieDefault($input)) {
            return false;
        }
        
        if( !isset($input['idPaymentMethod']) && !$this->getPaymentMethod($input)) {
            return false;
        }
        
        return true;
    }
    
    public function getSerieDefault(&$input)
    {
        $result = $this->repoSeries
            ->getModel()
            ->where([
                'isDefault'=>true,
                'active'=>true
            ])
            ->first();
        
        if( $result) {
            $input ['idSerie']= $result->id;
            $input ['folio']= ++$result->folioCurrent;
            return $result;
        }
        
        return $this->error('Imposible obtener la serie default a asignar a la factura');
    }
    
    public function getInvoiceStatus($key)
    {
        $result = $this->repoInvoiceStatus
            ->getModel()
            ->where('key', $key)
            ->first();
        
        if( $result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener el estatus {k} de facturación', [
            'k'=>$key
        ]);
    }
    
    public function getVoucherType(&$input, $key = 'i')
    {
        $result = $this->repoVoucherTypes
            ->getModel()
            ->where('key', $key)
            ->first();
        
        if( $result) {
            $input ['idVoucherType']= $result->id;
            return $result;
        }
        
        return $this->error('Imposible obtener el tipo de voucher {k}', [
            'k'=>$key
        ]);
    }
    
    public function getPaymentMethod(&$input, $key = 'PUE')
    {
        $result = $this->repoPaymentMethod
            ->getModel()
            ->where('key', $key)
            ->first();
        
        if( $result) {
            $input ['idPaymentMethod']= $result->id;
            return $result;
        }
        
        return $this->error('Imposible obtenr el metodo de pago {k}', [
            'k'=>$key
        ]);
    }
    
}
