<?php

namespace App\Billing\Logics\Invoice\v32;

use Melisa\core\LogicBusiness;
use App\Billing\Interfaces\Invoice\v32\Invoice;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Repositories\CsdRepository;
use App\Drive\Logics\Files\GetContentLogic;

/**
 * Invoice generate version 3.2
 *
 * @author Luis Josafat Heredia Contreras
 */
class GenerateLogic
{
    use LogicBusiness;
    
    protected $serieRepo;
    protected $csdRepo;
    protected $fileRepo;

    public function __construct(
        SeriesRepository $serieRepo,
        CsdRepository $csdRepo,
        GetContentLogic $fileRepo
    )
    {
        $this->serieRepo = $serieRepo;
        $this->csdRepo = $csdRepo;
        $this->fileRepo = $fileRepo;
    }
    
    public function init(Invoice $invoice, $idSerie, $idCsd)
    {
        $pac = $this->getPac();
        
        $serie = $this->getSerie($idSerie);
        
        if( !$serie) {
            return false;
        }
        
        $csd = $this->getCsd($idCsd);
        
        if( !$csd) {
            return false;
        }
        
        $result = $this->getInvoicePac($pac, $invoice, $serie, $csd);
        
        if( !$result) {
            return false;
        }
        
        return $result;
    }
    
    public function getCsd($id)
    {        
        $result = $this->csdRepo->find($id);
        
        if( !$result) {
            return $this->error('Imposible get CSD {s}', [
                's'=>$id
            ]);
        }
        
        $cerContent = $this->fileRepo->init($result->idFileCer);
        
        if( !$cerContent) {
            return $this->error('Imposible get content file CER');
        }
        
        $pemContent = $this->fileRepo->init($result->idFilePem);
        
        if( !$pemContent) {
            return $this->error('Imposible get content file PEM');
        }
        
        return [
            'csd'=>$result,
            'cerContent'=>$cerContent,
            'pemContent'=>$pemContent,
        ];
    }
    
    public function getSerie($id)
    {
        $result = $this->serieRepo->find($id);
        
        if( $result) {
            return $result;
        }
        
        return $this->error('Imposible get serie {s}', [
            's'=>$id
        ]);
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
