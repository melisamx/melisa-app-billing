<?php

namespace App\Billing\Http\Requests\Csd;

use Melisa\Laravel\Http\Requests\Generic;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class CreateRequest extends Generic
{
    
    protected $rules = [        
        'idFileCer'=>'required|xss|size:36|exists:drive.files,id',
        'idFileKey'=>'required|xss|size:36|exists:drive.files,id',
        'password'=>'required|xss|max:200',
    ];
    
}
