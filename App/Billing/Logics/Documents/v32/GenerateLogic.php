<?php

namespace App\Billing\Logics\Documents\v32;

use Melisa\core\LogicBusiness;
use App\Billing\Interfaces\Documents\v32\Documents;
use App\Billing\Repositories\SeriesRepository;
use App\Billing\Repositories\CsdRepository;
use App\Drive\Logics\Files\GetContentLogic;

/**
 * Documents generate version 3.2
 *
 * @author Luis Josafat Heredia Contreras
 */
class GenerateLogic
{
    use LogicBusiness;
    
    protected $serieRepo;
    protected $csdRepo;
    protected $fileRepo;
    protected $eventSuccess = 'billing.documents.create.success';

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
    
    public function init(Documents $documents, $idSerie, $idCsd)
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
        
        $result = $this->getInvoicePac($pac, $documents, $serie, $csd);
        
        if( !$result) {
            return false;
        }
        
        if( !$this->fireEvent($result)) {
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
