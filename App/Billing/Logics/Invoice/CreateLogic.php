<?php

namespace App\Billing\Logics\Invoice;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Repositories\InvoiceConceptsRepository;
use App\Billing\Repositories\InvoiceConceptsTaxesRepository;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Repositories\PaymentMethodsRepository;
use App\Billing\Repositories\InvoiceStatusRepository;
use App\Billing\Repositories\VoucherTypesRepository;
use App\Billing\Repositories\TaxesRepository;
use App\Billing\Repositories\TaxActionsRepository;
use App\Billing\Repositories\TypesFactorRepository;

class CreateLogic extends BaseCreateLogic
{
    
    protected $fireEvent = 'billing.invoice.success';
    protected $repoSeries;
    protected $repoPaymentMethod;
    protected $repoInvoiceStatus;
    protected $repoVoucherTypes;
    protected $repoConcepts;
    protected $repoTaxes;
    protected $repoConceptsTax;
    protected $repoTaxActions;
    protected $repoTypesFactor;

    public function __construct(
        InvoiceRepository $repository,
        InvoiceConceptsRepository $repoConcepts,
        InvoiceConceptsTaxesRepository $repoConceptsTax,
        SeriesRepository $repoSeries,
        PaymentMethodsRepository $repoPaymentMethod,
        InvoiceStatusRepository $repoInvoiceStatus,
        VoucherTypesRepository $repoVoucherTypes,
        TaxesRepository $repoTaxes,
        TaxActionsRepository $repoTaxActions,
        TypesFactorRepository $repoTypesFactor
    )
    {
        $this->repository = $repository;
        $this->repoSeries = $repoSeries;
        $this->repoPaymentMethod = $repoPaymentMethod;
        $this->repoInvoiceStatus = $repoInvoiceStatus;
        $this->repoVoucherTypes = $repoVoucherTypes;
        $this->repoConcepts = $repoConcepts;
        $this->repoTaxes = $repoTaxes;
        $this->repoConceptsTax = $repoConceptsTax;
        $this->repoTaxActions = $repoTaxActions;
        $this->repoTypesFactor = $repoTypesFactor;
    }
    
    public function create(&$input)
    {
        if( !$this->getDefaultsValue($input)) {
            return false;
        }
        
        $idInvoice = parent::create($input);
        
        if( !$idInvoice) {
            return false;
        }
        
        $result = $this->createConcepts($idInvoice, $input['concepts']);
        
        if( !$result) {
            return false;
        }
        
        return $idInvoice;
    }
    
    public function createConcepts($idInvoice, $concepts)
    {
        $idIdentity = $this->getIdentity();
        
        foreach($concepts as $concept) {
            $idConcept = $this->repoConcepts->create([
                'idIdentityCreated'=>$idIdentity,
                'idInvoice'=>$idInvoice,
                'idConcept'=>$concept['id'],
                'idConceptKey'=>$concept['idConceptKey'],
                'idConceptUnit'=>$concept['idConceptUnit'],
                'description'=>$concept['description'],
                'unitValue'=>$concept['unitValue'],
                'amount'=>(float)$concept['quantity'] * (float)$concept['unitValue'],
                'quantity'=>$concept['quantity'],
                'discount'=>isset($concept['discount']) ? $concept['discount'] : 0,
            ]);
            
            if( !$idConcept) {
                return $this->error('Imposible registrar concepto {c} de la factura {i}', [
                    'c'=>$concept['id'],
                    'i'=>$idInvoice
                ]);
            }
            
            $result = $this->createConceptTaxes($idConcept, $concept['taxes']);
            
            if( !$result) {
                return false;
            }
        }
        
        return true;
    }
    
    public function createConceptTaxes($idInvoiceConcept, $taxes)
    {
        $ids = [];
        $idIdentity = $this->getIdentity();
        
        foreach($taxes as $tax) {
            
            if( isset($tax['idTax'])) {
                $idTax = $tax['idTax'];
            } else {
                $idTax = $this->getTax($tax['tax']);
            }
            
            if( !$idTax) {
                return false;
            }
            
            if( isset($tax['idTaxAction'])) {
                $idTaxAction = $tax['idTaxAction'];
            } else {
                $idTaxAction = $this->getTaxAction($tax['action']);
            }
            
            if( !$idTaxAction) {
                return false;
            }
            
            $typeFactor = $this->getTypeFactor($tax['typeFactor']);
            
            if( !$typeFactor) {
                return false;
            }
            
            if( !$this->repoConceptsTax->create([
                'idInvoiceConcept'=>$idInvoiceConcept,
                'idIdentityCreated'=>$idIdentity,
                'idTax'=>$idTax,
                'idTaxAction'=>$idTaxAction,
                'idTypeFactor'=>$typeFactor->id,
                'base'=>$tax['base'],
                'rateOrFee'=>$tax['rateOrFee'],
                'amount'=>(float)$tax['base'] * (float)$tax['rateOrFee'],
            ])) {
                return false;
            }
        }
        
        return true;
    }
    
    public function getTypeFactor($name)
    {
        $result = $this->repoTypesFactor->getModel()->getByName($name);
        
        if( $result) {
            return $result;
        }
        
        return $this->error('Imposible obtener el tipo de factor {f}', [
            'f'=>$name
        ]);
    }
    
    public function getTaxAction($key)
    {
        $result = $this->repoTaxActions->getModel()->getByKey($key);
        
        if( $result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener la acción del impuesto {t}', [
            't'=>$key
        ]);
    }
    
    public function getTax($name)
    {
        $result = $this->repoTaxes->getModel()->getByName($name);
        
        if( $result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener el identificador del impuesto {t}', [
            't'=>$name
        ]);
    }
    
    public function getDefaultsValue(&$input)
    {
        if( !isset($input['idVoucherType']) && !$this->getVoucherType($input)) {
            return false;
        }
        
        $input ['idInvoiceStatus']= $this->getInvoiceStatus();
        $input ['version']= $this->getVersion();
        
        if( !isset($input['idSerie']) && !$this->getSerieDefault($input)) {
            return false;
        }
        
        if( !isset($input['idPaymentMethod']) && !$this->getPaymentMethod($input)) {
            return false;
        }
        
        return true;
    }
    
    public function getVersion()
    {
        return 3.3;
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
            ->generatingCfdi();
        
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
