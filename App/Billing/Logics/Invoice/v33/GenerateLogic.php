<?php

namespace App\Billing\Logics\Invoice\v33;

use Melisa\core\LogicBusiness;
use App\Billing\Interfaces\Invoice\Invoice;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Repositories\CsdRepository;
use App\Drive\Logics\Files\GetContentLogic;

/**
 * Invoice generate version 3.3
 *
 * @author Luis Josafat Heredia Contreras
 */
class GenerateLogic
{
    use LogicBusiness;
    
    protected $eventSuccess = 'billing.invoice.create.success';
    
    public function init(Invoice $invoice, $idSerie, $idCsd)
    {
        $pac = $this->getPac();        
        $result = $this->getInvoicePac($pac, $invoice, $serie, $csd);
        
        if( !$result) {
            return false;
        }
        
        if( !$this->fireEvent($result)) {
            return false;
        }
        
        return $result;
    }
    
    public function getInvoicePac($pac, &$invoice, &$serie, &$csd)
    {
        return app('App\Billing\Logics\\Provider\\' . $pac . '\InvoiceGenerate')
            ->init($invoice, $serie, $csd);
    }
    
    public function getPac()
    {
        return env('PAC');
    }
    
}
