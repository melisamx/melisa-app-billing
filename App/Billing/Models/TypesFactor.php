<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class TypesFactor extends TypesFactorAbstract
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
