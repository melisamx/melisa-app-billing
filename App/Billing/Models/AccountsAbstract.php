<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class AccountsAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'accounts';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'name',
        'key',
        'idIdentityCreated',
        'active',
        'expirationDays',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
