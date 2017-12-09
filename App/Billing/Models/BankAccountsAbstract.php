<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class BankAccountsAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'bankAccounts';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'idBank',
        'accountNumber',
        'name',
        'idIdentityCreated',
        'beginningBalance',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
