<?php

namespace App\Billing\Database\Seeds\Modules;

use Melisa\Laravel\Database\InstallSeeder;

/**
 * 
 *
 * @author Luis Josafat Heredia Contreras
 */
class ModulesUniversalSeeder extends InstallSeeder
{
    
    public function run()
    {        
        $this->invoice();
        $this->series();
    }
    
    public function series()
    {
        $this->installModuleJson('Universal/Series', [
            'create',
            'delete',
            'paging',
            'report',
            'update',
        ]);
    }
    
    public function invoice()
    {
        $this->installModuleJson('Universal/Invoice', [
            'cancel',
            'create',
            'paging',
            'pdf',
            'xml',
        ]);
        
        $this->installAssetCss('billing.invoice.preview', [
            'name'=>'Billing invoice preview',
            'path'=>'/billing/css/invoice-preview.min.css',
        ]);
    }
    
}
