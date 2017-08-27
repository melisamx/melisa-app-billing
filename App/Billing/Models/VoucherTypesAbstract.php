<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class VoucherTypesAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'voucherTypes';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'name',
        'valueV32',
        'valueV33'
    ];    
}
