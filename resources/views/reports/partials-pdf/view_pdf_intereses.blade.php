<div>
    <h3>Indicador del tipo de institución e interés de investigación de las investigadoras e investigadores</h3>
    <p>
        <b>Desdes: </b> {{ $dates['since'] }} -- <b>Hasta: </b>{{ $dates['until'] }}
    </p>
    <br>
    <table border="1" class="table table-bordered">
        <tr>
            <th>Total de investigadores</th>
        </tr>
        <tr>        
            <td class="text-center">{{ $data['total_investigators'] }}</td>
        </tr>
    </table>
    <br>
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
                <td>{{ $value['titulo'] }}</td>       
                <td class="text-center">{{ $value['total'] }}</td>
            </tr>
            @endforeach
        </table>
    @endif
    <br>
    <!-- tabla 2 -->
    @if(!empty($data['groupInterest']))
        <table border="1" class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Interés de Investigación por Género</th>
                <th>Total</th>
                <th>Masculino</th>
                <th>Femenino</th>
            </tr>
            @foreach($data['groupInterest'] as $key => $value)
            <tr>
                <td>{{ ($key + 1) }}</td>
                <td>{{ $value['titulo'] }}</td>       
                <td class="text-center">{{ $value['total'] }}</td>
                <td class="text-center">{{ $value['femenino'] }}</td>       
                <td class="text-center">{{ $value['masculino'] }}</td>
            </tr>
            @endforeach
        </table>
    @endif
    <br>
    <!-- tabla 3 -->
    @if(!empty($data['actualInvestigation']))
        <table border="1" class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Investigación Actual</th>
                <th>Total</th>
            </tr>
            @foreach($data['actualInvestigation'] as $key => $value)
            <tr>
                <td>{{ ($key + 1) }}</td>
                <td>{{ $value['titulo'] }}</td>       
                <td class="text-center">{{ $value['total'] }}</td>
            </tr>
            @endforeach
        </table>
    @endif
    <br>
    <!-- tabla 4 -->
    @if(!empty($data['groupModeInvestigation']))
        <table border="1" class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Como Investiga</th>
                <th>Total</th>
            </tr>
            @foreach($data['groupModeInvestigation'] as $key => $value)
            <tr>
                <td>{{ ($key + 1) }}</td>
                <td>{{ $value['titulo'] }}</td>       
                <td class="text-center">{{ $value['total'] }}</td>
            </tr>
            @endforeach
        </table>
    @endif
</div>