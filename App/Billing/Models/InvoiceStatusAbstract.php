<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class InvoiceStatusAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'invoiceStatus';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'name',
        'key'
    ];    
}
