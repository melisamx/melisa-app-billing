<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class InvoiceConceptsTaxesAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'invoiceConceptsTaxes';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'idInvoiceConcept',
        'idTax',
        'idTaxAction',
        'idTypeFactor',
        'idIdentityCreated',
        'base',
        'rateOrFee',
        'amount',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
