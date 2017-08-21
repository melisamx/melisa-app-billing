<?php

namespace App\Billing\Logics\Invoice\v32;

use App\Billing\Interfaces\Invoice\v32\Invoice;
use App\Billing\Libraries\NumberToLetterConverter;

/**
 * Invoice generate version 3.2
 *
 * @author Luis Josafat Heredia Contreras
 */
class PreviewLogic
{
    
    protected $libNumbertToLetter;

    public function __construct(
        NumberToLetterConverter $libNumbertToLetter
    )
    {
        $this->libNumbertToLetter = $libNumbertToLetter;
    }
    
    public function init(Invoice $invoice)
    {
        return json_decode(json_encode([
            'methodPayment'=>$invoice->getMethodPayment(),
            'folio'=>$invoice->getFolio(),
            'serie'=>$invoice->getSeries(),
            'voucherType'=>$invoice->getVoucherType(),
            'expeditionPlace'=>$invoice->getExpeditionPlace(),
            'coin'=>$invoice->getCoin(),
            'subTotal'=>$invoice->getSubtotal(),
            'total'=>$invoice->getTotal(),
            'transmitter'=>$this->getFormatTransmitter($invoice->getTransmitter()),
            'receiver'=>$this->getFormatReceiver($invoice->getReceiver()),
            'taxes'=>$this->getFormatTaxes($invoice->getTaxes()),
            'concepts'=>$this->getFormatConceps($invoice->getConcepts()),
            'totalLetter'=>$this->libNumbertToLetter->convertir($invoice->getTotal())
        ]));
    }
    
    public function getFormatTransmitter($transmitter)
    {
        return [
            'rfc'=>$transmitter->getRfc(),
            'businessName'=>$transmitter->getBusinessName(),
            'address'=>$transmitter->getAddress(),
            'exteriorNumber'=>$transmitter->getExteriorNumber(),
            'interiorNumber'=>$transmitter->getInteriorNumber(),
            'colony'=>$transmitter->getColony(),
            'country'=>$transmitter->getCountry(),
            'state'=>$transmitter->getState(),
            'municipality'=>$transmitter->getMunicipality(),
            'postalCode'=>$transmitter->getPostalCode(),
        ];
    }
    
    public function getFormatConceps($concepts)
    {
        $items = [];
        foreach($concepts as $concept) {
            $items []= [
                'quantity'=>$concept->getQuantity(),
                'unit'=>$concept->getUnit(),
                'description'=>$concept->getDescription(),
                'price'=>$concept->getPrice(),
                'amount'=>$concept->getAmount(),
            ];
        }
        return $items;
    }
    
    public function getFormatTaxes($taxes)
    {
        $items = [];
        foreach($taxes as $tax) {
            $items []= [
                'type'=>$tax->getType(),
                'rate'=>$tax->getRate(),
                'amount'=>$tax->getAmount(),
            ];
        }
        return $items;
    }
    
    public function getFormatReceiver($receiver)
    {
        return [
            'rfc'=>$receiver->getRfc(),
            'businessName'=>$receiver->getBusinessName(),
            'address'=>$receiver->getAddress(),
            'exteriorNumber'=>$receiver->getExteriorNumber(),
            'interiorNumber'=>$receiver->getInteriorNumber(),
            'colony'=>$receiver->getColony(),
            'country'=>$receiver->getCountry(),
            'state'=>$receiver->getState(),
            'municipality'=>$receiver->getMunicipality(),
            'postalCode'=>$receiver->getPostalCode(),
        ];
    }
    
}
