<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class DocumentsConceptsTaxesAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'documentsConceptsTaxes';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'idDocumentConcept',
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
