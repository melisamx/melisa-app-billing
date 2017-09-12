<?php 

namespace App\Billing\Models;

use Melisa\Laravel\Models\Base;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
abstract class ReferralNotesStatusAbstract extends Base
{    
    protected $connection = 'billing';
    protected $table = 'referralNotesStatus';
    public $timestamps = false;
    /* incrementing */
    protected $fillable = [
        'id',
        'name'
    ];    
}
