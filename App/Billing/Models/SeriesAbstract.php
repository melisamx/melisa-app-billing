<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class SeriesAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'series';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'serie',
        'idIdentityCreated',
        'folioInitial',
        'folioCurrent',
        'totalInvoice',
        'active',
        'isDefault',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
