<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class CustomersContactsAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'customersContacts';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'idCustomer',
        'idPeople',
        'active',
        'idIdentityCreated',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
