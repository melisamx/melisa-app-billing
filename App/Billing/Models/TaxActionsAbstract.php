<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class TaxActionsAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'taxActions';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'name',
        'key'
    ];    
}
