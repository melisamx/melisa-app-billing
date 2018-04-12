<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Repositories extends RepositoriesAbstract
{
    
    protected $casts = [
        'quota'=>'float',
    ];
    
}
