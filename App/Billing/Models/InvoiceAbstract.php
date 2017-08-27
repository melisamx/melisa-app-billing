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
        'idCsd',
        'idInvoiceStatus',
        'idSerie',
        'idVoucherType',
        'idIdentityCreated',
        'idFileXml',
        'idFilePdf',
        'idFileCfdSeal',
        'idFileCfdBeforeSeal',
        'version',
        'serie',
        'folio',
        'rfc',
        'name',
        'rfcTransmitter',
        'nameTransmitter',
        'date',
        'transmitter',
        'receiver',
        'concepts',
        'taxes',
        'stringOriginal',
        'sealCfd',
        'sealSat',
        'voucherType',
        'coin',
        'expeditionPlace',
        'methodPayment',
        'numberCertificateSat',
        'subTotal',
        'total',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt',
        'canceledAt'
    ];    
}
