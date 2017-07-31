<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class TaxesAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'taxes';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'key',
        'name',
        'retention',
        'transfer'
    ];    
}
