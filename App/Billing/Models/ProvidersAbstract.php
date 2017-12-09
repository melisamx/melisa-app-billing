<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class ProvidersAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'providers';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'idIdentityCreated',
        'active',
        'createdAt',
        'accountingAccount',
        'expirationDays',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
