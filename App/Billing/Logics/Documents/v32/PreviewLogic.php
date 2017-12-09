<?php

namespace App\Billing\Logics\Documents\v32;

use App\Billing\Interfaces\Documents\v32\Documents;
use App\Billing\Libraries\NumberToLetterConverter;

/**
 * Documents generate version 3.2
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
    
    public function init(Documents $documents)
    {
        return json_decode(json_encode([
            'methodPayment'=>$documents->getMethodPayment(),
            'folio'=>$documents->getFolio(),
            'serie'=>$documents->getSeries(),
            'voucherType'=>$documents->getVoucherType(),
            'expeditionPlace'=>$documents->getExpeditionPlace(),
            'coin'=>$documents->getCoin(),
            'subTotal'=>$documents->getSubtotal(),
            'total'=>$documents->getTotal(),
            'transmitter'=>$this->getFormatTransmitter($documents->getTransmitter()),
            'receiver'=>$this->getFormatReceiver($documents->getReceiver()),
            'taxes'=>$this->getFormatTaxes($documents->getTaxes()),
            'concepts'=>$this->getFormatConceps($documents->getConcepts()),
            'totalLetter'=>$this->libNumbertToLetter->convertir($documents->getTotal())
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
