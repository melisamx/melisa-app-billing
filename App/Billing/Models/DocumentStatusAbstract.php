<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class DocumentStatusAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'documentStatus';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'name',
        'key'
    ];    
}
