<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class CustomerGroupsIdentitiesAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'customerGroupsIdentities';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'idCustomerGroup',
        'idIdentity',
        'idIdentityCreated',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
