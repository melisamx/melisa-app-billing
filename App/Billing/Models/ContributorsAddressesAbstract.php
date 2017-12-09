<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class ContributorsAddressesAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'contributorsAddresses';
    public $timestamps = true;
    public $incrementing = true;
    protected $fillable = [
        'id',
        'idContributor',
        'idIdentityCreated',
        'idCountry',
        'idState',
        'idMunicipality',
        'address',
        'colony',
        'postalCode',
        'exteriorNumber',
        'active',
        'isDefault',
        'createdAt',
        'accountingAccount',
        'interiorNumber',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
