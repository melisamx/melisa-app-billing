<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class RepositoriesIdentitiesAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'repositoriesIdentities';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'idRepository',
        'idIdentityCreated',
        'idIdentity',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
