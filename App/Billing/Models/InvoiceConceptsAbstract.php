<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class InvoiceConceptsAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'invoiceConcepts';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'idConcept',
        'idConceptKey',
        'idConceptUnit',
        'idInvoice',
        'idIdentityCreated',
        'idIdentification',
        'description',
        'price',
        'amount',
        'discount',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
