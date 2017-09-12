<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class DebtsToPayAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'debtsToPay';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'idAccount',
        'idDebtsToPayStatus',
        'idIdentityCreated',
        'idFileVoucher',
        'idInvoice',
        'amountPayable',
        'dateVoucher',
        'dueDate',
        'expiredDate',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt'
    ];    
}
