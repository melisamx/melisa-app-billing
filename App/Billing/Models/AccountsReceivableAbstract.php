<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class AccountsReceivableAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'accountsReceivable';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'idAccount',
        'idFileVoucher',
        'idInvoice',
        'idPaymentMethod',
        'idReferralNote',
        'idAccountReceivableStatus',
        'idIdentityCreated',
        'amountCharged',
        'expiredDate',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt',
        'receivableDate',
        'dueDate'
    ];    
}
