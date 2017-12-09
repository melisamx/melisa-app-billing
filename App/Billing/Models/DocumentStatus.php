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
    
    public function scopePendingGenerateCfdi($query)
    {
        return $query->where('key', self::PENDING_GENERATE_CFDI);
    }
    
    public function scopeErrorGenerateCfdi($query)
    {
        return $query->where('key', self::PENDING_GENERATE_CFDI);
    }

    public function scopeGeneratingCfdi($query)
    {
        return $query->where('key', self::GENERATING_CFDI);
    }

    public function scopeNewInvoice($query)
    {
        return $query->where('key', self::NNEW);
    }
    
}
