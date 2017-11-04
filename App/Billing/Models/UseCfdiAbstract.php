<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class UseCfdiAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'useCfdi';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'key',
        'description',
        'applyPhysical',
        'applyMoral'
    ];    
}
