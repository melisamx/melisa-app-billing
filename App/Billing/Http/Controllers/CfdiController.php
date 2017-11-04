<?php

namespace App\Billing\Http\Controllers;

use Melisa\Laravel\Http\Controllers\CrudController;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CfdiController extends CrudController
{
    
    protected $create = [
        'request'=>'Cfdi\CreateRequest',
        'logic'=>'Cfdi\CreateLogic',
        'repository'=>'InvoiceRepository',
    ];
    
}
