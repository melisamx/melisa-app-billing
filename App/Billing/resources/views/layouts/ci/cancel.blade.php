<?xml version="1.0" encoding="utf-8"?>
<Cancelacion rfcEmisor="{{ $cancel->rfc }}" certificado="{!! $cancel->certificate !!}" llaveCertificado="{!! $cancel->keyCertificate !!}">
    <Folios>
        <Folio UUID="{{ $cancel->uuid }}" />
    </Folios>
</Cancelacion>