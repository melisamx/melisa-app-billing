<table class="table">    
    <tr>
        <th width="120">Código postal</th>
        <th width="20%">Estado</th>
        <th width="20%">Municipio</th>
        <th width="20%">Domicilio</th>
        <th>Colonia</th>
    </tr>
    @foreach($addresses as $address)
    <tr>
        <td>{{ $address->postalCode }}</td>
        <td>{{ $address->state->name }}</td>
        <td>{{ $address->municipality->name }}</td>
        <td>{{ $address->address }}</td>
        <td>{{ $address->colony }}</td>
    </tr>
    @endforeach
</table>