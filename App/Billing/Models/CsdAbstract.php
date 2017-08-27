<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class CsdAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'csd';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'number',
        'idIdentityCreated',
        'idFileCer',
        'idFileKey',
        'idFilePem',
        'name',
        'dateExpedition',
        'dateExpiration',
        'valid',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
