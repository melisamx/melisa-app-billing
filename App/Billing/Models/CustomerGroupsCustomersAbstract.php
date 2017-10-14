<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class CustomerGroupsCustomersAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'customerGroupsCustomers';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'idCustomerGroup',
        'idCustomer',
        'idIdentityCreated',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
