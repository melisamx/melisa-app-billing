<table class="table">    
    <tr>
        <th width="120">Nombre</th>
        <th width="20%">Activo</th>
        <th width="20%">Fecha creación</th>
    </tr>
    @foreach($commissionDealers as $r)
    <tr>
        <td>{{ $r->dealer->name }}</td>
        <td>{{ $r->active ? 'Si' : 'No' }}</td>
        <td>{{ $r->createdAt }}</td>
    </tr>
    @endforeach
</table>