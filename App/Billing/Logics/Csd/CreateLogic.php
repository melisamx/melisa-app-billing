<?php

namespace App\Billing\Logics\Csd;

use Melisa\Laravel\Logics\CreateLogic as BaseCreateLogic;
use App\Billing\Repositories\CsdRepository;
use App\Drive\Logics\Files\ViewLogic;
use App\Drive\Logics\Files\GetContentLogic;
use App\Drive\Logics\Files\StringCreateLogic;
use App\Drive\Interfaces\FileContent;

class CreateLogic extends BaseCreateLogic
{
    
    protected $fireEvent = 'billing.csd.create.success';
    protected $logicFiles;
    protected $logicFilesContent;
    protected $logicFilesCreate;
    
    public function __construct(
        CsdRepository $repository,
        ViewLogic $logicFiles,
        GetContentLogic $logicFilesContent,
        StringCreateLogic $logicFilesCreate
    )
    {
        $this->repository = $repository;
        $this->logicFiles = $logicFiles;
        $this->logicFilesContent = $logicFilesContent;
        $this->logicFilesCreate = $logicFilesCreate;
    }
    
    public function create(&$input)
    {
        $pathFileKey = $this->getFilePathKey($input['idFileKey']);
        
        if( !$pathFileKey) {dd('fal');
            return false;
        }
        
        $contentPem = $this->getContentPem($pathFileKey, $input['password']);
        
        if( !$contentPem) {
            return false;
        }
        
        $contentCer = $this->getContentCer($input['idFileCer']);
        
        if( !$contentCer) {
            return false;
        }
        
        $infoCertificate = $this->getInfoCertificate($contentCer);
        
        if( !$infoCertificate) {
            return false;
        }
        
        $idFilePem = $this->createFilePem($infoCertificate['number'], $contentPem);
        
        if( !$idFilePem) {
            return false;
        }
        
        $input ['idFilePem']= $idFilePem;
        $input ['number']= $infoCertificate['number'];
        $input ['name']= $infoCertificate['name'];
        $input ['dateExpedition']= $infoCertificate['dateExpedition'];
        $input ['dateExpiration']= $infoCertificate['dateExpiration'];
        
        return parent::create($input);
    }
    
    public function createFilePem($name, &$content)
    {
        $file = new FileContent();
        $file
            ->setName($name . '.pem')
            ->setOriginalName($name)
            ->setExtension('pem')
            ->setContent($content);
        
        return $this->logicFilesCreate->init($file);
    }
    
    public function getInfoCertificate(&$contentCer)
    {
        $pem = '-----BEGIN CERTIFICATE-----' . 
            PHP_EOL .
            chunk_split($contentCer, 64).
            '-----END CERTIFICATE-----' . 
            PHP_EOL;
        
        $infoCertificate = openssl_x509_parse($pem);
        
        if( !$infoCertificate) {
            return $this->error('Imposible get information from certificate CER');
        }
        
        $data = [
            'name'=>$infoCertificate['subject']['CN'],
            'number'=>$this->getNumberCertificate($infoCertificate['serialNumberHex']),
            'dateExpedition'=>date('Y-m-d H:i:s', $infoCertificate['validFrom_time_t']),
            'dateExpiration'=>date('Y-m-d H:i:s', $infoCertificate['validTo_time_t']),
        ];       
        
        return $data;
    }
    
    public function getNumberCertificate(&$serialNumberHex)
    {
        $numberCertificate = '';
        
        for ($i = 1; $i < strlen($serialNumberHex); $i = $i+2) {
            $numberCertificate .= substr($serialNumberHex, $i, 1);
        }
        
        return $numberCertificate;
    }
    
    public function getContentCer($idFile)
    {
        $result = $this->logicFilesContent->init($idFile);
        
        if( $result === false) {
            return $this->error('Imposible get content file CER');
        }
        
        return base64_encode($result);
    }
    
    public function getContentPem(&$pathFileKey, $password)
    {
        @exec('openssl pkcs8 -inform DER -in ' . $pathFileKey . ' -passin pass:' . $password, $result, $code);
        
        if( $code !== 0) {
            return $this->error('Imposible get content PEM');
        }
        
        return implode(PHP_EOL, $result);
    }
    
    public function getFilePathKey($idFile)
    {
        $result = $this->logicFiles->init($idFile);
        
        if( $result === false) {
            return $this->error('Imposible get path file key');
        }
        
        return $result['path'];
    }
    
}
