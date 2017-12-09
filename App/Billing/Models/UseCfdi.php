<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class UseCfdi extends UseCfdiAbstract
{
    
    const P01 = 'P01';
    
    public function toDefine()
    {
        return $this->where('key', self::P01)->first();
    }
    
}
