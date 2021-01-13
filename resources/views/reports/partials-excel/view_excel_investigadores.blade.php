<h4>Indicador de Investigadoras e Investigadores registrados en el Programa Nacional de Investigadores</h4>
<div>
    <h6>Rangos de fechas</h6>
    <span>Desdes: {{ $dates['since'] }}</span>
    <span>Hasta: {{ $dates['until'] }}</span>
</div>
<table border="1" class="table table-bordered">
    <tr>
        <th>Total de investigadores registrados</th>
        <th>Hombres</th>
        <th>Mujeres</th>
    </tr>
    <tr>        
        <td>{{ $data['total_investigators'] }}</td>
        <td>{{ $data['investigators_mens'] }}</td>
        <td>{{ $data['investigators_womens'] }}</td>
    </tr>
</table>
<!-- tabla 1 -->
@if(!empty($data['groupRangeAge']))
    <table border="1" class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Investigadores por rango de edad</th>
            <th>Total</th>
        </tr>
        @foreach($data['groupRangeAge'] as $key => $value)
        <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $value['titulo'] }}</td>       
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif
<!-- tabla 2 -->
@if(!empty($data['groupMonth']))
    <table border="1" class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Investigadores registrados por meses</th>
            <th>Total</th>
        </tr>
        @foreach($data['groupMonth'] as $key => $value)
        <tr>
            <td>{{ $loop->interation }}</td>
            <td>{{ $key }}</td>
            <td>{{ $value }}</td>
        </tr>
        @endforeach
    </table>
@endif
<!-- tabla 3 -->
@if(!empty($data['groupProfesion']))
    <table border="1" class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Investigadores por Profesión</th>
            <th>Masculino</th>
            <th>Femenino</th>
            <th>Total</th>
        </tr>
        @foreach($data['groupProfesion'] as $key => $value)
        <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $value['profesion'] }}</td>       
            <td>{{ $value['male'] }}</td>
            <td>{{ $value['female'] }}</td>
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif
<!-- tabla 4 -->
@if(!empty($data['groupStates']))
    <table border="1" class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Investigadores por estados</th>
            <th>Total</th>
        </tr>
        @foreach($data['groupStates'] as $key => $value)
        <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $value['estado'] }}</td>       
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif
<!-- tabla 5 -->
@if(!empty($data['groupAverageAge']))
    <h4>Promedio de edades</h4>
    <table border="1" class="table table-bordered">
        <tr>
            <th>Edades</th>
            <th>Promedio</th>
            <th>minima</th>
            <th>maxima</th>
        </tr>
        <tr>
            <td>Masculino</td>
            <td>{{ $data['groupAverageAge']->promedio->masculino }}</td>       
            <td>{{ $data['groupAverageAge']->minima->masculino }}</td>
            <td>{{ $data['groupAverageAge']->maximo->masculino }}</td>
        </tr>
        <tr>
            <td>Femenino</td>
            <td>{{ $data['groupAverageAge']->promedio->femenino }}</td>       
            <td>{{ $data['groupAverageAge']->minima->femenino }}</td>
            <td>{{ $data['groupAverageAge']->maximo->femenino }}</td>
        </tr>
        <tr>
            <td>Totales</td>
            <td>{{ $data['groupAverageAge']->promedio->total }}</td>       
            <td>{{ $data['groupAverageAge']->minima->total }}</td>
            <td>{{ $data['groupAverageAge']->maximo->total }}</td>
        </tr>
    </table>
@endif