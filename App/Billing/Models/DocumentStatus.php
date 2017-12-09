<?php 

namespace App\Billing\Models;

/**
 * 
 * @author Luis Josafat Heredia Contreras
 */
class DocumentStatus extends DocumentStatusAbstract
{
    
    const PENDING_GENERATE_CFDI = 'pendingGenerateCFDI';
    const GENERATING_CFDI = 'generatingCFDI';
    const NNEW = 'new';
    const CANCELLED = 'cancelled';

    public function scopePendingGenerateCfdi()
    {
        return $this->where('key', self::PENDING_GENERATE_CFDI)->first();
    }

    public function scopeErrorGenerateCfdi()
    {
        return $this->where('key', self::PENDING_GENERATE_CFDI)->first();
    }

    public function scopeGeneratingCfdi()
    {
        return $this->where('key', self::GENERATING_CFDI)->first();
    }

    public function scopeNewInvoice()
    {
        return $this->where('key', self::NNEW)->first();
    }
    
}
