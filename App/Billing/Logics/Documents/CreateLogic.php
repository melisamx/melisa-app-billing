<?php

namespace App\Billing\Logics\Documents;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Repositories\VoucherTypesRepository;
use App\Billing\Repositories\DocumentStatusRepository;
use App\Billing\Repositories\DocumentTypesRepository;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Repositories\PaymentMethodsRepository;
use App\Billing\Repositories\WaytopayRepository;
use App\Billing\Repositories\UseCfdiRepository;
use App\Billing\Repositories\CoinsRepository;
use App\Billing\Repositories\ConceptKeysRepository;
use App\Billing\Repositories\ConceptUnitsRepository;
use App\Billing\Repositories\TaxesRepository;
use App\Billing\Repositories\TaxActionsRepository;
use App\Billing\Repositories\TypesFactorRepository;
use App\Billing\Repositories\CustomersRepository;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateLogic extends BaseCreateLogic
{
    
    protected $fireEvent = 'billing.documents.created.success';
    protected $repoVoucherTypes;
    protected $repoDocumentStatus;
    protected $repoDocTypes;
    protected $repoSeries;
    protected $repoPaymentMethod;
    protected $repoWaytopay;
    protected $repoUseCfdi;
    protected $repoCoins;
    protected $repoConceptKeys;
    protected $repoConceptUnits;
    protected $repoTaxes;
    protected $repoTaxActions;
    protected $repoTypesFactor;
    protected $repoCustomers;
    
    public function __construct(
        DocumentsRepository $repository ,
        VoucherTypesRepository $repoVoucherTypes,
        DocumentStatusRepository $repoDocumentStatus,
        DocumentTypesRepository $repoDocTypes,
        SeriesRepository $repoSeries,
        PaymentMethodsRepository $repoPaymentMethod,
        WaytopayRepository $repoWaytopay,
        UseCfdiRepository $repoUseCfdi,
        CoinsRepository $repoCoins,
        ConceptKeysRepository $repoConceptKeys,
        ConceptUnitsRepository $repoConceptUnits,
        TaxesRepository $repoTaxes,
        TaxActionsRepository $repoTaxActions,
        TypesFactorRepository $repoTypesFactor,
        CustomersRepository $repoCustomers
    )
    {
        $this->repository = $repository;
        $this->repoVoucherTypes = $repoVoucherTypes;
        $this->repoDocumentStatus = $repoDocumentStatus;
        $this->repoDocTypes = $repoDocTypes;
        $this->repoSeries = $repoSeries;
        $this->repoPaymentMethod = $repoPaymentMethod;
        $this->repoWaytopay = $repoWaytopay;
        $this->repoUseCfdi = $repoUseCfdi;
        $this->repoCoins = $repoCoins;
        $this->repoConceptKeys = $repoConceptKeys;
        $this->repoConceptUnits = $repoConceptUnits;
        $this->repoTaxes = $repoTaxes;
        $this->repoTaxActions = $repoTaxActions;
        $this->repoTypesFactor = $repoTypesFactor;
        $this->repoCustomers = $repoCustomers;
    }
    
    public function save(&$input)
    {
        if (!$this->inyectIds($input)) {
            return false;
        }
        
        $idDocument = parent::create($input);
        dd($idDocument);
        if( !$idDocument) {
            return false;
        }
        
    }
    
    public function inyectIds(&$input)
    {
        $input ['idTransmitter'] = $this->getIdTransmitter($input);
        
        if (!$input['idTransmitter']) {
            return false;
        }
        
        $input ['idCustomer'] = $this->getIdCustomer($input);
        
        if (!$input['idCustomer']) {
            return false;
        }
        
        $input ['idVoucherType'] = $this->getIdVoucherType();
        
        if (!$input['idVoucherType']) {
            return false;
        }
        
        $input ['idDocumentStatus']= $this->getIdDocumentStatus();
        
        if (!$input['idVoucherType']) {
            return false;
        }
        
        $input ['idDocumentType']= $this->getIdDocumentType();
        
        if (!$input['idDocumentType']) {
            return false;
        }
        
        $input ['idSerie']= $this->getIdSerie();
        
        if (!$input['idSerie']) {
            return false;
        }
        
        $input ['idPaymentMethod']= $this->getIdPaymentMethod($input);
        
        if (!$input['idPaymentMethod']) {
            return false;
        }
        
        $input ['idWaytopay']= $this->getIdWaytopay($input);
        
        if (!$input['idWaytopay']) {
            return false;
        }
        
        $input ['idUseCfdi']= $this->getIdUseCfdi($input);
        
        if (!$input['idUseCfdi']) {
            return false;
        }
        
        $input ['idCoin']= $this->getIdCoin($input);
        
        if (!$input['idCoin']) {
            return false;
        }
        
        if (!$this->inyectIdsConcepts($input)) {
            return false;
        }
        
        return true;
    }
    
    public function getIdCustomer(&$input)
    {
        if (isset($input['idCustomer'])) {
            return $input['idCustomer'];
        }
        
        $result = $this->repoCustomers->getByIdContributorAddress($input['idCustomerAddress']);
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener el id de quien espide el documento');
    }
    
    public function getIdTransmitter(&$input)
    {
        if (isset($input['idTransmitter'])) {
            return $input['idTransmitter'];
        }
        
        $result = $this->repoCustomers->getByIdContributorAddress($input['idTransmitterAddress']);
        
        if ($result) {
            return $result->idContributor;
        }
        
        return $this->error('Imposible obtener el id de quien espide el documento');
    }
    
    public function inyectIdsConcepts(&$input)
    {
        $input ['subTotal']= 0;
        $input ['total']= 0;
        foreach ($input['concepts'] as $i => &$concept) {
            $concept ['idConceptKey'] = $this->getIdConcepKey($concept);
        
            if (!$concept ['idConceptKey']) {
                return false;
            }
            
            $concept ['idConceptUnit'] = $this->getIdConcepUnit($concept);
        
            if (!$concept ['idConceptUnit']) {
                return false;
            }
            
            if (!$this->inyectIdsTaxes($concept)) {
                return false;
            }
            
            $input ['subTotal']= $this->calculateSubTotal($input['subTotal'], $concept);
        }
        dd($input);
        return true;
    }
    
    public function calculateSubTotal($subTotal, $concept)
    {
        return $subTotal + ($concept['quantity'] * $concept['unitValue']);
    }
    
    public function inyectIdsTaxes(&$concept)
    {
        $concept ['totalTaxTransfer']= 0;
        $concept ['totalTaxRetention']= 0;
        foreach ($concept['taxes'] as $i => &$tax) {
            $tax ['idTax'] = $this->getIdTax($tax);

            if (!$tax['idTax']) {
                return false;
            }
            
            $tax ['idTaxAction'] = $this->getIdTaxAction($tax);

            if (!$tax['idTaxAction']) {
                return false;
            }

            $tax ['idTypeFactor'] = $this->getIdTypeFactor($tax);

            if (!$tax['idTypeFactor']) {
                return false;
            }
        }
        return true;
    }
    
    public function getIdTypeFactor(&$tax)
    {
        if (isset($tax['idTypeFactor'])) {
            return $tax['idTypeFactor'];
        }
        
        $result = $this->repoTypesFactor->getByName($tax['typeFactor']);
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener la clave de la acción impuesto a usar en un concepto del documento');
    }
    
    public function getIdTaxAction(&$tax)
    {
        if (isset($tax['idTaxAction'])) {
            return $tax['idTaxAction'];
        }
        
        $result = $this->repoTaxActions->getByKey($tax['action']);
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener la clave de la acción impuesto a usar en un concepto del documento');
    }
    
    public function getIdTax(&$concept)
    {
        if (isset($concept['idTax'])) {
            return $concept['idTax'];
        }
        
        $result = $this->repoTaxes->getByName($concept['tax']);
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener la clave el impuesto a usar en un concepto del documento');
    }
    
    public function getIdConcepUnit(&$concept)
    {
        if (isset($concept['idConceptUnit'])) {
            return $concept['idConceptUnit'];
        }
        
        $result = $this->repoConceptUnits->getByKey($concept['conceptUnit']);
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener la clave de la unidad a usar en un concepto del documento');
    }
    
    public function getIdConcepKey(&$concept)
    {
        if (isset($concept['idConceptKey'])) {
            return $concept['idConceptKey'];
        }
        
        $result = $this->repoConceptKeys->getByKey($concept['conceptKey']);
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener la clave del concepto a usar en un concepto del documento');
    }
    
    public function getIdCoin(&$input)
    {
        if (isset($input['idCoin'])) {
            return $input['idCoin'];
        }
        
        $result = $this->repoCoins->getByShortName($input['coin']);
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener la moneda a usar en el documento');
    }
    
    public function getIdUseCfdi(&$input)
    {
        if (isset($input['idUseCfdi'])) {
            return $input['idUseCfdi'];
        }
        
        $result = $this->repoUseCfdi->getByKey($input['useCfdi']);
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener el uso cfdi a usar en el documento');
    }
    
    public function getIdWaytopay(&$input)
    {
        if (isset($input['idWaytopay'])) {
            return $input['idWaytopay'];
        }
        
        $result = $this->repoWaytopay->getByKey($input['waytopay']);
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener forma de pago a usar en el documento');
    }
    
    public function getIdPaymentMethod(&$input)
    {
        if (isset($input['idPaymentMethod'])) {
            return $input['idPaymentMethod'];
        }
        
        $result = $this->repoPaymentMethod->getByKey($input['paymentMethod']);
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener el metodo de pago a usar en el documento');
    }
    
    public function getIdSerie()
    {
        $result = $this->repoSeries->getDefault();
        
        if( $result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener la serie default a asignar al documento');
    }
    
    public function getIdDocumentType()
    {
        $result = $this->repoDocTypes->getNote();
        
        if( $result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener el tipo de documento factura');
    }
    
    public function getIdDocumentStatus()
    {
        $result = $this->repoDocumentStatus->getStatusNew();
        
        if( $result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener el estatus del documento');
    }
    
    public function getIdVoucherType()
    {
        $result = $this->repoVoucherTypes->getEntry();
        
        if ($result) {
            return $result->id;
        }
        
        return $this->error('Imposible obtener el tipo de voucher de entrada');
    }
    
}
