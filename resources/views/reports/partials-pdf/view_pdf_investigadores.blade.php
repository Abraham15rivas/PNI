<h4>Indicador de Investigadoras e Investigadores registrados en el Programa Nacional de Investigadores</h4>
<div>
    <h6>Rangos de fechas</h6>
    <span>Desdes: {{ $dates['since'] }}</span>
    <span>Hasta: {{ $dates['until'] }}</span>
</div>
<table border="1" class="table table-bordered">
    <tr>
        <th>Indicador del tipo de institución e interés de investigación de las investigadoras e investigadores</th>
    </tr>
    <tr>        
        <td>{{ $data['total_investigators'] }}</td>
    </tr>
</table>