<?php

namespace App\Billing\Logics\Documents;

use Melisa\core\LogicBusiness;
use App\Billing\Repositories\InvoiceRepository;
use App\Billing\Models\DocumentStatus;
use App\Billing\Logics\Provider\Profact\InvoiceCancel;

class CancelLogic
{
    use LogicBusiness;
    
    protected $repoDocument;

    public function __construct(
        InvoiceRepository $documents
    )
    {
        $this->repoDocument = $documents;
    }
    
    public function init(array $input)
    {
        $documents = $this->getDocument($input['id']);
        
        if( !$documents) {
            return $this->error('Imposible obtener el documento a cancelar');
        }
        
        if( !$this->isValidDocument($documents)) {
            return false;
        }
        
        return $this->cancelLogic($documents);
    }
    
    public function cancelLogic(&$documents)
    {
        switch ($documents->version)
        {
            default:
                return app(InvoiceCancel::class)->init($documents);
        }
    }
    
    public function isValidDocument(&$documents)
    {
        if( $documents->idDocumentStatus === DocumentStatus::NNEW) {
            return true;
        }
        
        return $this->error('No es posible cancelar el documento, su estatus no es nuevooooo');        
    }
    
    public function getDocument($id)
    {
        return $this->repoDocument->find($id);
    }
    
}