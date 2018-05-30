<?php

namespace App\Billing\Http\Requests\Documents\Receipt;

use Melisa\Laravel\Http\Requests\WithFilter;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateRequest extends WithFilter
{
    
    protected $rules = [
        'idTransmitterAddress'=>'required|xss|numeric|exists:billing.contributorsAddresses,id',
        'idCoin'=>'nullable|xss|numeric|exists:billing.coins,id',
        'idWaytopay'=>'nullable|xss|numeric|exists:billing.waytopay,id',
        'idCustomerAddress'=>'required|xss|numeric|exists:billing.contributorsAddresses,id',
        'idPaymentMethod'=>'nullable|xss|numeric|exists:billing.paymentMethods,id',
        'idUseCfdi'=>'nullable|xss|numeric|exists:billing.useCfdi,id',
        'coin'=>'required_without:idCoin|xss|exists:billing.coins,shortName',
        'waytopay'=>'required_without:idWaytopay|xss|exists:billing.waytopay,key',
        'paymentMethod'=>'required_without:idPaymentMethod|xss|exists:billing.paymentMethods,key',
        'useCfdi'=>'required_without:idUseCfdi|xss|exists:billing.useCfdi,key',
        'concepts'=>'required|xss|array',
    ];
    
    protected $rulesConcepts = [
        'id'=>'required|xss|numeric|exists:billing.concepts,id',
        'idConceptKey'=>'nullable|xss|numeric|exists:billing.conceptKeys,id',
        'idConceptUnit'=>'nullable|xss|numeric|exists:billing.conceptUnits,id',
        'conceptKey'=>'required_without:idConceptKey|xss|numeric|exists:billing.conceptKeys,key',
        'conceptUnit'=>'required_without:idConceptUnit|xss|exists:billing.conceptUnits,key',
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
        $concepts = $this->get('concepts');
        
        if( is_null($concepts)) {
            return $this->failedValidation(validator()->make($this->all(), $this->rules));
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
        return parent::validationData();
    }
    
}
