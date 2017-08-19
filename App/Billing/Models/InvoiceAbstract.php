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
        'idFileXml',
        'idFilePdf',
        'idFileCfdSeal',
        'idFileCfdBeforeSeal',
        'version',
        'folio',
        'serie',
        'rfc',
        'name',
        'rfcTransmitter',
        'nameTransmitter',
        'date',
        'transmitter',
        'receiver',
        'concepts',
        'taxes',
        'total',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt',
        'canceledAt'
    ];    
}
