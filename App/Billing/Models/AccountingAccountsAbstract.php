<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class AccountingAccountsAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'accountingAccounts';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'name',
        'idIdentityCreated',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'expirationDays',
        'groupingCode',
        'updatedAt'
    ];    
}
