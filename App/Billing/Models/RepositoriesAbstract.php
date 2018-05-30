<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class RepositoriesAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'repositories';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'name',
        'idIdentityCreated',
        'expirationDays',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt',
        'allowChangeQuota',
        'quota'
    ];    
}
