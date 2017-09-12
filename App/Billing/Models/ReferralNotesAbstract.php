<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\BaseUuid;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
abstract class ReferralNotesAbstract extends BaseUuid
{    
    protected $connection = 'billing';
    protected $table = 'referralNotes';
    public $timestamps = true;
    /* incrementing */
    protected $fillable = [
        'id',
        'idReferralStatus',
        'idIdentityCreated',
        'rfc',
        'name',
        'rfcTransmitter',
        'nameTransmitter',
        'date',
        'transmitter',
        'receiver',
        'concepts',
        'taxes',
        'extraData',
        'coin',
        'methodPayment',
        'subTotal',
        'total',
        'createdAt',
        'idIdentityUpdated',
        'updatedAt',
        'canceledAt'
    ];    
}
