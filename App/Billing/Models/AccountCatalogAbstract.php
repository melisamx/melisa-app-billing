<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class AccountCatalogAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'accountCatalog';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'name',
        'nivel',
        'groupingCode'
    ];    
}
