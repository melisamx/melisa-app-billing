<?php

namespace App\Billing\Logics\Invoice;

use App\Billing\Interfaces\Invoice\Invoice;
use App\Billing\Logics\Invoice\v33\TransformerLogic;

/**
 * Preview invoice
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
    
    public function init(Invoice $invoice)
    {
        return $this->transformer->init($invoice);
    }
    
}
