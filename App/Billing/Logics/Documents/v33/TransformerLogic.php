<?php

namespace App\Billing\Logics\Documents\v33;

use App\Billing\Libraries\NumberToLetterConverter;
use App\Billing\Interfaces\Documents\Invoice;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Repositories\CustomersRepository;
use App\Billing\Repositories\ContributorsRepository;
use App\Billing\Repositories\ContributorsAddressesRepository;
use App\Billing\Repositories\FiscalRegimeRepository;
use App\Billing\Repositories\UseCfdiRepository;
use App\Billing\Repositories\VoucherTypesRepository;
use App\Billing\Repositories\CoinsRepository;
use App\Billing\Repositories\PaymentMethodsRepository;
use App\Billing\Repositories\ConceptsRepository;
use App\Billing\Repositories\ConceptKeysRepository;
use App\Billing\Repositories\ConceptUnitsRepository;
use App\Billing\Repositories\TaxesRepository;

/**
 * Transformer documents in version 3.3
 *
 * @author Luis Josafat Heredia Contreras
 */
class TransformerLogic
{
    
    protected $convertNumber;
    protected $documents;
    protected $repoSeries;
    protected $repoCustomers;
    protected $repoContributor;
    protected $repoUseCfdi;
    protected $repoVoucherType;
    protected $repoContributorAddresses;
    protected $repoCoins;
    protected $repoPaymentMethods;
    protected $repoConcepts;
    protected $repoConceptKeys;
    protected $repoConceptUnits;
    protected $repoTaxes;

    public function __construct(
        NumberToLetterConverter $convertNumber,
        SeriesRepository $repoSeries,
        CustomersRepository $repoCustomers,
        ContributorsRepository $repoContributor,
        FiscalRegimeRepository $repoFiscalRegime,
        UseCfdiRepository $repoUseCfdi,
        VoucherTypesRepository $repoVoucherType,
        ContributorsAddressesRepository $repoContributorAddresses,
        CoinsRepository $repoCoins,
        PaymentMethodsRepository $repoPaymentMethods,
        ConceptsRepository $repoConcepts,
        ConceptKeysRepository $repoConceptKeys,
        ConceptUnitsRepository $repoConceptUnits,
        TaxesRepository $repoTaxes
    )
    {
        $this->convertNumber = $convertNumber;
        $this->repoSeries = $repoSeries;
        $this->repoCustomers = $repoCustomers;
        $this->repoContributor = $repoContributor;
        $this->repoFiscalRegime = $repoFiscalRegime;
        $this->repoUseCfdi = $repoUseCfdi;
        $this->repoVoucherType = $repoVoucherType;
        $this->repoContributorAddresses = $repoContributorAddresses;
        $this->repoCoins = $repoCoins;
        $this->repoPaymentMethods = $repoPaymentMethods;
        $this->repoConcepts = $repoConcepts;
        $this->repoConceptKeys = $repoConceptKeys;
        $this->repoConceptUnits = $repoConceptUnits;
        $this->repoTaxes = $repoTaxes;
    }
    
    public function init(Invoice $documents)
    {
        $this->documents = $documents;
        $receiver = $this->getReceiver();
        $concepts = $this->getConcepts();
        $taxes = $this->getTaxes($concepts);
        return json_decode(json_encode([
            'dateTimeExpedition'=>\Carbon\Carbon::now(),
            'transmitter'=>$this->getTransmitter(),
            'receiver'=>$receiver->contributor,
            'fiscalRegime'=>$this->getFiscalRegime(),
            'serie'=>$this->getSerie(),
            'useCfdi'=>$this->getUseCfdi(),
            'voucherType'=>$this->getVoucherType(),
            'placeExpedition'=>$this->getPlaceExpedition(),
            'coin'=>$this->getCoin(),
            'wayToPay'=>$receiver->waytopay,
            'paymentMethod'=>$this->getPaymentMethod(),
            'subTotal'=>$this->documents->getSubtotal(),
            'total'=>$this->documents->getTotal(),
            'totalLetter'=>$this->convertNumber->convertir($this->documents->getTotal()),
            'concepts'=>$concepts,
            'taxes'=>$taxes,
        ]));
    }
    
    public function getTaxes($concepts)
    {
        $taxes = [];
        foreach($concepts as $concept) {
            foreach($concept['taxes'] as $tax) {
                if( !isset($taxes[$tax['action']])) {
                    $taxes [$tax['action']]= [
                        'amount'=>0,
                        'display'=>$tax['display'],
                        'rateOrFee'=>$tax['rateOrFee']
                    ];
                }
                $taxes [$tax['action']]['amount']+= $tax['amount'];
            }
        }
        return $taxes;
    }
    
    public function getConcepts()
    {
        $concepts = $this->documents->getConcepts();
        $result = [];
        
        foreach($concepts as $i => &$concept) {
            $result []= [
                'quantity'=>$concept->getQuantity(),
                'key'=>$this->getConceptKey($concept->getIdConceptKey()),
                'concept'=>$this->getConcept($concept->getId()),
                'unitKey'=>$this->getConceptUnit($concept->getIdConceptUnit()),
                'price'=>$concept->getUnitValue(),
                'amount'=>$concept->getUnitValue() * $concept->getQuantity(),
                'taxes'=>$this->getConceptTaxes($concept->getTaxes()),
                'discount'=>$concept->getDiscount(),
                'totalTaxRetention'=>$concept->getTotalTaxRetention(),
                'totalTaxTransfer'=>$concept->getTotalTaxTransfer()
            ];
        }
        
        return $result;
    }
    
    public function getConceptTaxes($taxes)
    {
        $result = [];
        foreach($taxes as $i => &$tax) {
            $result []= [
                'action'=>$tax->getAction(),
                'display'=>$tax->getTax(),
                'tax'=>$this->getTax($tax->getTax()),
                'base'=>$tax->getBase(),
                'typeFactor'=>$tax->getTypeFactor(),
                'rateOrFee'=>$tax->getRateOrFee(),
                'amount'=>$tax->getBase() * $tax->getRateOrFee(),
            ];
        }
        return $result;
    }
    
    public function getTax($key)
    {
        return $this->repoTaxes->getModel()->where('name', $key)->first()->key;
    }
    
    public function getConceptUnit($id)
    {
        return $this->repoConceptUnits->find($id);
    }
    
    public function getConceptKey($id)
    {
        return $this->repoConceptKeys->find($id);
    }
    
    public function getConcept($id)
    {
        return $this->repoConcepts->find($id);
    }
    
    public function getPaymentMethod()
    {
        $idPaymentMethod = $this->documents->getIdPaymentMethod();
        
        if( !is_null($idPaymentMethod)) {
            return $this->repoPaymentMethods->find($idPaymentMethod);
        }
        
        return $this->repoPaymentMethods->getModel()
            ->where('key', 'PUE')
            ->first();
    }
    
    public function getCoin()
    {
        return $this->repoCoins->find($this->documents->getIdCoin());
    }
    
    public function getPlaceExpedition()
    {
        return $this->repoContributorAddresses
            ->find($this->documents->getTransmitter()->getIdContributorAddress());
    }
    
    public function getVoucherType()
    {
        $idVoucherType = $this->documents->getIdVoucherType();
        
        if( is_null($idVoucherType)) {
            return $this->repoVoucherType
                ->getModel()
                ->where('key', 'I')
                ->first();
        }
        
        return $this->repoVoucherType->find($idVoucherType);
    }
    
    public function getUseCfdi()
    {
        $idUseCfdi = $this->documents->getIdUseCfdi();
        
        if( !is_null($idUseCfdi)) {
            return $this->repoUseCfdi->find($idUseCfdi);
        }
        
        return $this->repoUseCfdi
            ->getModel()
            ->where('key', 'P01')
            ->first();
    }
    
    public function getFiscalRegime()
    {
        return $this->repoFiscalRegime->find(
            $this->documents->getTransmitter()->getIdFiscalRegime()
        );
    }
    
    public function getTransmitter()
    {
        return $this->repoContributor->find(
            $this->documents->getTransmitter()->getIdContributor()
        );
    }
    
    public function getReceiver()
    {
        return $this->repoCustomers
            ->getModel()
            ->with([
                'contributor',
                'waytopay'
            ])
            ->where('id', $this->documents->getReceiver()->getIdCustomer())
            ->first();
    }
    
    public function getTotalLetter()
    {
        return app(NumberToLetterConverter::class)
            ->convertir($this->getTotal());
    }
    
    public function getSerie()
    {
        $idSerie = $this->documents->getIdSerie();
        
        if( !is_null($idSerie)) {
            return $this->repoSeries->find($idSerie);
        }
        
        return $this->repoSeries
            ->getModel()
            ->where('isDefault', true)
            ->first();
    }
    
}
