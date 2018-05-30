<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class DocumentStatusRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\DocumentStatus';        
    }
    
    public function getStatusNew()
    {
        return $this->getModel()->newNote()->first();
    }
    
}
