<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class PaymentMethodsAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'paymentMethods';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'name',
        'key'
    ];    
}
