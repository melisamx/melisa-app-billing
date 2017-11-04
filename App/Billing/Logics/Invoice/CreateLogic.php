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
        
        $input ['idInvoiceStatus']= $this->getInvoiceStatus();
        
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
            ->default();
        
        if( $result) {
            $input ['idSerie']= $result->id;
            return $result;
        }
        
        return $this->error('Imposible obtener la serie default a asignar a la factura');
    }
    
    public function getInvoiceStatus()
    {
        $result = $this->repoInvoiceStatus
            ->getModel()
            ->new();
        
        if( $result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener el estatus de pendiente generar CFDI');
    }
    
    public function getVoucherType(&$input)
    {
        $result = $this->repoVoucherTypes
            ->getModel()
            ->entry();
        
        if( $result) {
            $input ['idVoucherType']= $result->id;
            return $result;
        }
        
        return $this->error('Imposible obtener el tipo de voucher {k}', [
            'k'=>$key
        ]);
    }
    
    public function getPaymentMethod(&$input)
    {
        $result = $this->repoPaymentMethod
            ->getModel()
            ->pue();
        
        if( $result) {
            $input ['idPaymentMethod']= $result->id;
            return $result;
        }
        
        return $this->error('Imposible obtenr el metodo de pago {k}', [
            'k'=>$key
        ]);
    }
    
}
