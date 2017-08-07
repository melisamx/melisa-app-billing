<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class SuppliersAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'suppliers';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'idIdentityCreated',
        'name',
        'key',
        'isPac',
        'active',
        'isDefault',
        'enviromentProduction',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
