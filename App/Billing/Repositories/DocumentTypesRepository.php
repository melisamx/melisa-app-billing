<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class DocumentTypesRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\DocumentTypes';        
    }
    
    public function getNote()
    {
        return $this->getModel()->note()->first();
    }
    
}
