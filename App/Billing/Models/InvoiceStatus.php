<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class InvoiceStatus extends InvoiceStatusAbstract
{
    
    const PENDING_GENERATE_CFDI = 'pendingGenerateCFDI';
    const GENERATING_CFDI = 'generatingCFDI';
    const NNEW = 'new';

    public function scopePendingGenerateCfdi()
    {
        return $this->where('key', self::PENDING_GENERATE_CFDI)->first();
    }

    public function scopeGeneratingCfdi()
    {
        return $this->where('key', self::GENERATING_CFDI)->first();
    }

    public function scopeNew()
    {
        return $this->where('key', self::NNEW)->first();
    }
    
}
