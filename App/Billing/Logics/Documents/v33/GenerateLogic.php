<?php

namespace App\Billing\Logics\Documents\v33;

use Melisa\core\LogicBusiness;
use App\Billing\Interfaces\Documents\Documents;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Repositories\CsdRepository;
use App\Drive\Logics\Files\GetContentLogic;

/**
 * Documents generate version 3.3
 *
 * @author Luis Josafat Heredia Contreras
 */
class GenerateLogic
{
    use LogicBusiness;
    
    protected $eventSuccess = 'billing.documents.create.success';
    
    public function init(Documents $documents, $idSerie, $idCsd)
    {
        $pac = $this->getPac();        
        $result = $this->getInvoicePac($pac, $documents, $serie, $csd);
        
        if( !$result) {
            return false;
        }
        
        if( !$this->fireEvent($result)) {
            return false;
        }
        
        return $result;
    }
    
    public function getInvoicePac($pac, &$documents, &$serie, &$csd)
    {
        return app('App\Billing\Logics\\Provider\\' . $pac . '\InvoiceGenerate')
            ->init($documents, $serie, $csd);
    }
    
    public function getPac()
    {
        return env('PAC');
    }
    
}
