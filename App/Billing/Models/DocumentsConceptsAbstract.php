<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class DocumentsConceptsAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'documentsConcepts';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'idConcept',
        'idConceptKey',
        'idConceptUnit',
        'idDocument',
        'idIdentityCreated',
        'description',
        'unitValue',
        'amount',
        'discount',
        'quantity',
        'createdAt',
        'idIdentification',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
