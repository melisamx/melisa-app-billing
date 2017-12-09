<?php

namespace App\Billing\Logics\Documents;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\DocumentsRepository;
use App\Billing\Models\DocumentStatus;
use App\Billing\Logics\Provider\Profact\InvoiceCancel;

class CancelLogic
{
    use LogicBusiness;
    
    protected $repoDocument;

    public function __construct(
        DocumentsRepository $repoDocuments
    )
    {
        $this->repoDocument = $repoDocuments;
    }
    
    public function init(array $input)
    {
        $document = $this->getDocument($input['id']);
        
        if( !$document) {
            return $this->error('Imposible obtener el documento a cancelar');
        }
        
        if( !$this->isValidDocument($document)) {
            return false;
        }
        
        return $this->cancelLogic($document);
    }
    
    public function cancelLogic(&$repoDocuments)
    {
        switch ($repoDocuments->version)
        {
            default:
                return app(InvoiceCancel::class)->init($repoDocuments);
        }
    }
    
    public function isValidDocument(&$repoDocuments)
    {
        if( $repoDocuments->idDocumentStatus === DocumentStatus::NNEW) {
            return true;
        }
        
        return $this->error('No es posible cancelar el documento, su estatus no es nuevooooo');        
    }
    
    public function getDocument($id)
    {
        return $this->repoDocument->find($id);
    }
    
}