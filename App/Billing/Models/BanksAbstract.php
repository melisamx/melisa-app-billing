<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class BanksAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'banks';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'key',
        'name',
        'shortname',
        'active'
    ];    
}
