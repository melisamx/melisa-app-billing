<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class Taxes extends TaxesAbstract
{
    
    public function getByName($name)
    {
        return $this
            ->where([
                'name'=>$name
            ])
            ->first();
    }
    
}
