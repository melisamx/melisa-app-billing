<table class="table">
    <tr>
        <th>Razón social</th>
        <th>R. F. C.</th>
        <th>Método de pago</th>
        <th>Correo electrónico</th>
    </tr>
    <tr>
        <td>{{ $report->contributor->name }}</td>
        <td>{{ $report->contributor->rfc }}</td>
        <td>{{ $report->payment_method->name }}</td>
        <td>{{ $report->contributor->email }}</td>
    </tr>
</table>

<table class="table">    
    <tr>
        <th>País</th>
        <th width="120">Código postal</th>
        <th>Estado</th>
        <th>Municipio</th>
    </tr>
    <tr>
        <td>{{ $report->contributor->country->name }}</td>
        <td>{{ $report->contributor->postalCode }}</td>
        <td>{{ $report->contributor->state->name }}</td>
        <td>{{ $report->contributor->municipality->name }}</td>
    </tr>
</table>

<table class="table">
    <tr>
        <th>Dirección</th>
        <th>Número exterior</th>
        <th>Número interior</th>
        <th>Colonia</th>
    </tr>
    <tr>
        <td>{{ $report->contributor->address }}</td>
        <td>{{ $report->contributor->exteriorNumber }}</td>
        <td>{{ $report->contributor->interiorNumber }}</td>
        <td>{{ $report->contributor->colony }}</td>
    </tr>
    <tr>
        <th colspan="4">Activo</th>
    </tr>
    <tr>
        <td colspan="4">{{ $report->active ? 'Si' : 'No' }}</td>
    </tr>
</table>