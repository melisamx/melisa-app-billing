<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class DocumentsAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'documents';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'idCoin',
        'idCsd',
        'idCustomer',
        'idCustomerAddress',
        'idDocumentStatus',
        'idDocumentType',
        'idFilePdf',
        'idFileXml',
        'idPaymentMethod',
        'idSerie',
        'idTransmitter',
        'idTransmitterAddress',
        'idUseCfdi',
        'idVoucherType',
        'idWaytopay',
        'idIdentityCreated',
        'subTotal',
        'total',
        'totalTaxRetention',
        'totalTaxTransfer',
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
        'dateCfdi',
        'preInvoice',
        'comments'
    ];    
}
