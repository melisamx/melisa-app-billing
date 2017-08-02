<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class InvoiceAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'invoice';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'uuid',
        'idInvoiceStatus',
        'idIdentityCreated',
        'xml',
        'pdf',
        'folio',
        'date',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
