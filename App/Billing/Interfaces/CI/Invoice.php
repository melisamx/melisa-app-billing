<?php

namespace App\Billing\Interfaces\CI;

use Carbon\Carbon;
use App\Billing\Interfaces\InvoiceInterface;
use App\Billing\Interfaces\ReceiverAbstract;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class Invoice extends InvoiceInterface
{
    
    public function __construct(
        ReceiverAbstract $receiver
    )
    {
        parent::__construct($receiver);
        $this->date = Carbon::now()->format('Y-m-d\Th:i:s');
    }
    
    public function format()
    {
        return [
            'DatosCFDI'=>[
                'Serie'=>$this->series,
                'Folio'=>$this->folio,
                'Fecha'=>$this->date,
                'FormadePago'=>$this->methodPayment,
                'CondcionesDePago'=>$this->paymentConditions,
                'Subtotal'=>$this->subtotal,
                'Descuento'=>$this->discount,
                'Moneda'=>$this->coin,
                'TipoCambio'=>$this->exchangeRate,
                'Total'=>$this->total,
                'TipodeComprobante'=>$this->voucherType,
                'MetodoPago'=>$this->methodPayment,
                'LugarDeExpedicion'=>$this->expeditionPlace,
                'MensajePDF'=>'',
            ],
            'ReceptorCFDI'=>$this->getReceiver(),
            'ConceptosCFD'=>[
                'Conceptos'=>$this->getConcepts()
            ],
            'Traslados'=>$this->getTaxTransferred(),
            'Retenciones'=>$this->getTaxDetained()
        ];
    }
    
}
