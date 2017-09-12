<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class ConceptsAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'concepts';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'key',
        'name',
        'idConceptKey',
        'idIdentityCreated',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
