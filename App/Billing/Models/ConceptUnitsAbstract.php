<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class ConceptUnitsAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'conceptUnits';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'key',
        'name'
    ];    
}
