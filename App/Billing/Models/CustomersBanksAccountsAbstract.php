<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class CustomersBanksAccountsAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'customersBanksAccounts';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'idCustomer',
        'idBank',
        'account',
        'idCoin',
        'active',
        'idIdentityCreated',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
