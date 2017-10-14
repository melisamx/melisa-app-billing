<table class="table">    
    <tr>
        <th width="120">Nombre</th>
        <th width="20%">Activo</th>
        <th width="20%">Fecha creación</th>
    </tr>
    @foreach($commissionAgents as $r)
    <tr>
        <td>{{ $r->commission_agent->name }}</td>
        <td>{{ $r->commission_agent->active ? 'Si' : 'No' }}</td>
        <td>{{ $r->commission_agent->createdAt }}</td>
    </tr>
    @endforeach
</table>