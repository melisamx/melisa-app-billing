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
        'idContributorAddress',
        'idCsd',
        'idCustomer',
        'idInvoiceStatus',
        'idSerie',
        'idVoucherType',
        'idIdentityCreated',
        'serie',
        'folio',
        'uuid',
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
        'version',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'idFileXml',
        'idFilePdf',
        'idFileCfdSeal',
        'idFileCfdBeforeSeal',
        'extraData',
        'updatedAt',
        'canceledAt'
    ];    
}
