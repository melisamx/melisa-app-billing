<?php

namespace App\Billing\Http\Requests\Documents;

use Melisa\Laravel\Http\Requests\WithFilter;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateRequest extends WithFilter
{
    
    protected $rules = [
        'idTransmitter'=>'required|xss|numeric|exists:billing.contributors,id',
        'idTransmitterAddress'=>'required|xss|numeric|exists:billing.contributorsAddresses,id',
        'idCoin'=>'required|xss|numeric|exists:billing.coins,id',
        'idWaytopay'=>'required|xss|numeric|exists:billing.waytopay,id',
        'idCustomer'=>'required|xss|size:36|exists:billing.customers,id',
        'idCustomerAddress'=>'required|xss|numeric|exists:billing.contributorsAddresses,id',
        'subTotal'=>'required|xss|numeric',
        'total'=>'required|xss|numeric',
        'totalTaxRetention'=>'required|xss|numeric',
        'totalTaxTransfer'=>'required|xss|numeric',
        'concepts'=>'required|xss|array',
        
        'idVoucherType'=>'nullable|xss|numeric|exists:billing.voucherTypes,id',
        'idSerie'=>'nullable|xss|numeric|exists:billing.voucherTypes,id',
        'idPaymentMethod'=>'nullable|xss|numeric|exists:billing.paymentMethods,id',
        'idUseCfdi'=>'nullable|xss|numeric|exists:billing.useCfdi,id',
    ];
    
    protected $rulesConcepts = [
        'id'=>'required|xss|numeric|exists:billing.concepts,id',
        'idConceptKey'=>'required|xss|numeric|exists:billing.conceptKeys,id',
        'idConceptUnit'=>'required|xss|numeric|exists:billing.conceptUnits,id',
        'description'=>'required|xss|max:255',
        'unitValue'=>'required|xss|numeric',
        'quantity'=>'required|xss|numeric',
        'discount'=>'sometimes|xss|numeric',
        'taxes'=>'required|array'
    ];
    
    protected $rulesConceptsTax = [
        'idTax'=>'nullable|xss|numeric|exists:billing.taxes,id',
        'idTaxAction'=>'nullable|xss|numeric|exists:billing.taxActions,id',
        'idTypeFactor'=>'nullable|xss|numeric|exists:billing.typesFactor,id',
        'action'=>'required_without:idTaxAction|xss|exists:billing.taxActions,key',
        'tax'=>'required_without:idTax|xss|exists:billing.taxes,name',
        'typeFactor'=>'required_without:idTypeFactor|xss|exists:billing.typesFactor,name',
        'base'=>'required|xss|numeric',
        'rateOrFee'=>'required|xss|numeric',
    ];

    public function validationData()
    {
        $concepts = json_decode($this->get('concepts'), true);
        
        if( is_null($concepts)) {
            return $this->failedValidation(validator()->make([], $this->rulesConcepts));
        }
        
        foreach($concepts as $concept) {
            $validator = validator()->make($concept, $this->rulesConcepts);
            
            if( !$validator->passes()) {
                return $this->failedValidation($validator);
            }
            
            foreach($concept['taxes'] as $conceptTax) {
                $taxValidator = validator()->make($conceptTax, $this->rulesConceptsTax);

                if( !$taxValidator->passes()) {
                    return $this->failedValidation($taxValidator);
                }
            }
        }
        
        $this->merge([
            'concepts'=>$concepts
        ]);
        
        return $this->all();
    }
    
}
