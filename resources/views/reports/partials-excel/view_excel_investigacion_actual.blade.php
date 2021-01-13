<h4>Indicador del Módulo de la Investigación Actual</h4>
<div>
    <h6>Rangos de fechas</h6>
    <span>Desdes: {{ $dates['since'] }}</span>
    <span>Hasta: {{ $dates['until'] }}</span>
</div>
<table border="1" class="table table-bordered">
    <tr>
        <th>Total Registrados en el Módulo de la Investigación</th>
    </tr>
    <tr>        
        <td>{{ $data['total_investigation'] }}</td>
    </tr>
</table>
<!-- tabla 1 -->
@if(!empty($data['groupInstitution']))
    <table border="1" class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Tipo de Institución</th>
            <th>Total</th>
        </tr>
        @foreach($data['groupInstitution'] as $key => $value)
        <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $value['institution_type'] }}</td>       
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif
<!-- tabla 2 -->
@if(!empty($data['investigations_type']))
    <table border="1" class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Tipo de Investigación</th>
            <th>Total</th>
        </tr>
        @foreach($data['investigations_type'] as $key => $value)
        <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $value['type_investigation'] }}</td>       
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif
<!-- tabla 3 -->
@if(!empty($data['investigations_line']))
    <table border="1" class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Línea de Investigación</th>
            <th>Total</th>
        </tr>
        @foreach($data['investigations_line'] as $key => $value)
        <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $value['line_investigation'] }}</td>       
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif
<!-- tabla 4 -->
@if(!empty($data['institutions_type']))
    <table border="1" class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Fase de la Investigación</th>
            <th>Total</th>
        </tr>
        @foreach($data['institutions_type'] as $key => $value)
        <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $value['institution_type'] }}</td>       
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif
<!-- tabla 5 -->
@if(!empty($data['investigations_time']))
    <table border="1" class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Tiempo de la Investigación</th>
            <th>Total</th>
        </tr>
        @foreach($data['investigations_time'] as $key => $value)
        <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $value['investigation_time'] }}</td>       
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif