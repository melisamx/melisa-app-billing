<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class AccountsReceivableStatusAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'accountsReceivableStatus';
    public $timestamps = false;
    /* incrementing */
    protected $fillable = [
        'id',
        'name'
    ];    
}
