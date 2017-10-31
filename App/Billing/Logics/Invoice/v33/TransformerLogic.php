<?php

namespace App\Billing\Logics\Invoice\v33;

use App\Billing\Libraries\NumberToLetterConverter;
use App\Billing\Interfaces\Invoice\Invoice;
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
 * Transformer invoice in version 3.3
 *
 * @author Luis Josafat Heredia Contreras
 */
class TransformerLogic
{
    
    protected $convertNumber;
    protected $invoice;
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
    
    public function init(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $receiver = $this->getReceiver();
        
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
            'subTotal'=>$this->invoice->getSubtotal(),
            'total'=>$this->invoice->getTotal(),
            'totalLetter'=>$this->convertNumber->convertir($this->invoice->getTotal()),
            'concepts'=>$this->getConcepts()
        ]));
    }
    
    public function getConcepts()
    {
        $concepts = $this->invoice->getConcepts();
        $result = [];
        
        foreach($concepts as $i => &$concept) {
            $result []= [
                'quantity'=>$concept->getQuantity(),
                'key'=>$this->getConceptKey($concept->getIdConceptKey()),
                'concept'=>$this->getConcept($concept->getId()),
                'unitKey'=>$this->getConceptUnit($concept->getIdConceptUnit()),
                'price'=>$concept->getPrice(),
                'amount'=>$concept->getPrice() * $concept->getQuantity(),
                'taxes'=>$this->getConceptTaxes($concept->getTaxes()),
                'discount'=>$concept->getDiscount()
            ];
        }
        
        return $result;
    }
    
    public function getConceptTaxes($taxes)
    {
        $result = [];
        foreach($taxes as $i => &$tax) {
            $result []= [
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
        $idPaymentMethod = $this->invoice->getIdPaymentMethod();
        
        if( !is_null($idPaymentMethod)) {
            return $this->repoPaymentMethods->find($idPaymentMethod);
        }
        
        return $this->repoPaymentMethods->getModel()
            ->where('key', 'PUE')
            ->first();
    }
    
    public function getCoin()
    {
        return $this->repoCoins->find($this->invoice->getIdCoin());
    }
    
    public function getPlaceExpedition()
    {
        return $this->repoContributorAddresses
            ->find($this->invoice->getTransmitter()->getIdContributorAddress());
    }
    
    public function getVoucherType()
    {
        $idVoucherType = $this->invoice->getIdVoucherType();
        
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
        $idUseCfdi = $this->invoice->getIdUseCfdi();
        
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
            $this->invoice->getTransmitter()->getIdFiscalRegime()
        );
    }
    
    public function getTransmitter()
    {
        return $this->repoContributor->find(
            $this->invoice->getTransmitter()->getIdContributor()
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
            ->where('id', $this->invoice->getReceiver()->getIdCustomer())
            ->first();
    }
    
    public function getTotalLetter()
    {
        return app(NumberToLetterConverter::class)
            ->convertir($this->getTotal());
    }
    
    public function getSerie()
    {
        $idSerie = $this->invoice->getIdSerie();
        
        if( !is_null($idSerie)) {
            return $this->repoSeries->find($idSerie);
        }
        
        return $this->repoSeries
            ->getModel()
            ->where('isDefault', true)
            ->first();
    }
    
}
