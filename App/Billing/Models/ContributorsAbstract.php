<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class ContributorsAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'contributors';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'idIdentityCreated',
        'rfc',
        'name',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt',
        'email'
    ];    
}
