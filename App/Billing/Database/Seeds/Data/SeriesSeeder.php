<?php

namespace App\Billing\Database\Seeds\Data;

use Melisa\Laravel\Database\InstallSeeder;
use App\Billing\Models\Series;

/**
 * Install default series
 *
 * @author Luis Josafat Heredia Contreras
 */
class SeriesSeeder extends InstallSeeder
{
    
    public function run()
    {
        Series::updateOrCreate([
            'serie'=>'TEST',
        ], [
            'folioInitial'=>1,
            'folioCurrent'=>0,
            'idIdentityCreated'=>$this->findIdentity()->id
        ]);
    }
    
}
