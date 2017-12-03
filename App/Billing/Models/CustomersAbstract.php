<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class CustomersAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'customers';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'idRepository',
        'idContributor',
        'idWaytopay',
        'idIdentityCreated',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
