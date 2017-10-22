<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class DebtsToPayStatusAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'debtsToPayStatus';
    public $timestamps = false;
    /* incrementing */
    protected $fillable = [
        'id',
        'name',
        'key'
    ];    
}
