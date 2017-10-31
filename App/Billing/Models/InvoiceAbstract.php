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
        'idCsd',
        'idCustomer',
        'idCustomerAddress',
        'idFilePdf',
        'idFileXml',
        'idInvoiceStatus',
        'idSerie',
        'idTransmitter',
        'idTransmitterAddress',
        'idVoucherType',
        'idCoin',
        'idWaytopay',
        'idPaymentMethod',
        'idIdentityCreated',
        'preInvoice',
        'subTotal',
        'total',
        'version',
        'active',
        'createdAt',
        'idIdentityUpdated',
        'idFileCfdSeal',
        'idFileCfdBeforeSeal',
        'folio',
        'stringOriginal',
        'sealSat',
        'numberCertificateSat',
        'sealCfd',
        'uuid',
        'cfdiResult',
        'updatedAt',
        'canceledAt',
        'dateCfdi'
    ];    
}
