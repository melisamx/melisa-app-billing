<?php

namespace App\Billing\Libraries;

/**
 * Ajust convert to invoice text
 * @author Luis Josafat Heredia Contreras
 *
 */
class NumberToLetterConverter extends NumberToLetterAxia
{
    
    public function getDecimalsLetter($converted, $div_decimales, $decimales, $centimos, $moneda)
    {
        if(empty($decimales)) {
            $valor_convertido = $converted . strtoupper($moneda);
        } else {
            $valor_convertido = $converted . strtoupper($moneda) . ' ' . $div_decimales[1] . '/100 MXN';
        }

        return $valor_convertido;
    }
    
}
