<?php

namespace App\Billing\Repositories;

use Melisa\Repositories\Eloquent\Repository;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class SeriesRepository extends Repository
{
    
    public function model()
    {        
        return 'App\Billing\Models\Series';        
    }
    
}
