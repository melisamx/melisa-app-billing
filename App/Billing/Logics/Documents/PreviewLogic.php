<?php

namespace App\Billing\Logics\Documents;

use App\Billing\Interfaces\Documents\Invoice;
use App\Billing\Logics\Documents\v33\TransformerLogic;

/**
 * Preview documents
 *
 * @author Luis Josafat Heredia Contreras
 */
class PreviewLogic
{
    
    protected $libNumbertToLetter;
    protected $transformer;

    public function __construct(
        TransformerLogic $transformer
    )
    {
        $this->transformer = $transformer;
    }
    
    public function init(Invoice $documents)
    {
        return $this->transformer->init($documents);
    }
    
}
