<div>
    <h3>Indicador de Investigadoras e Investigadores registrados en el Programa Nacional de Investigadores</h3>
    <p>
        <b>Desdes: </b> {{ $dates['since'] }} -- <b>Hasta: </b>{{ $dates['until'] }}
    </p>
    <br>
    <table border="1" class="table table-bordered">
        <tr>
            <th>Total de investigadores registrados</th>
            <th>Hombres</th>
            <th>Mujeres</th>
        </tr>
        <tr>        
            <td class="text-center">{{ $data['total_investigators'] }}</td>
            <td class="text-center">{{ $data['investigators_mens'] }}</td>
            <td class="text-center">{{ $data['investigators_womens'] }}</td>
        </tr>
    </table>
    <br>
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
                <td class="text-center">{{ $value['total'] }}</td>
            </tr>
            @endforeach
        </table>
    @endif
    <br>
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
                <td>{{ ($key + 1) }}</td>
                <td>{{ $value['Month'] }}</td>
                <td class="text-center">{{ $value['Total'] }}</td>
            </tr>
            @endforeach
                
        </table>
    @endif
    <br>
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
                <td class="text-center">{{ $value['total'] }}</td>
            </tr>
            @endforeach
        </table>
    @endif
    <br>
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
                <td class="text-center">{{ $value['total'] }}</td>
            </tr>
            @endforeach
        </table>
    @endif
    <br>
    <!-- tabla 5 -->
    @if(!empty($data['groupAverageAge']))
        <h4>Promedio de edades</h4>
        <table border="1" class="table table-bordered">
            <tr>
                <th>Edades</th>
                <th>Masculino</th>
                <th>Femenino</th>
                <th>Total</th>
            </tr>
            <tr>
                <th>Promedio</th>
                <td class="text-center">{{ $data['groupAverageAge']['promedio']['masculino'] }}</td>
                <td class="text-center">{{ $data['groupAverageAge']['promedio']['femenino'] }}</td>
                <td class="text-center">{{ $data['groupAverageAge']['promedio']['total'] }}</td>
            </tr>
            <tr>
                <th>Maxima</th>
                <td class="text-center">{{ $data['groupAverageAge']['maxima']['masculino'] }}</td>
                <td class="text-center">{{ $data['groupAverageAge']['maxima']['femenino'] }}</td>
                <td class="text-center">{{ $data['groupAverageAge']['maxima']['total'] }}</td>
            </tr>
            <tr>
                <th>Minima</th>
                <td class="text-center">{{ $data['groupAverageAge']['minima']['masculino'] }}</td>
                <td class="text-center">{{ $data['groupAverageAge']['minima']['femenino'] }}</td>
                <td class="text-center">{{ $data['groupAverageAge']['minima']['total'] }}</td>
            </tr>
        </table>
    @endif
</div>