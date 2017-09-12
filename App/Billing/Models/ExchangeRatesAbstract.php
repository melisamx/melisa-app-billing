<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class ExchangeRatesAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'exchangeRates';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'idCoin',
        'date',
        'idIdentityCreated',
        'rate',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
