<table class="table">
    <tr>
        <th>Moneda</th>
        <th>Fecha</th>
        <th>Tipo de cambio</th>
    </tr>
    <tr>
        <td>{{ $report->coin->name }}</td>
        <td>{{ $report->date }}</td>
        <td>{{ $report->rate }}</td>
    </tr>
</table>