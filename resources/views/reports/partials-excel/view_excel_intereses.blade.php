<h4>Indicador del tipo de institución e interés de investigación de las investigadoras e investigadores</h4>
<div>
    <h6>Rangos de fechas</h6>
    <span>Desdes: {{ $dates['since'] }}</span>
    <span>Hasta: {{ $dates['until'] }}</span>
</div>
<table border="1" class="table table-bordered">
    <tr>
        <th>Total de investigadores</th>
    </tr>
    <tr>        
        <td>{{ $data['total_investigators'] }}</td>
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
            <td>{{ $value['titulo'] }}</td>       
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif
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
            <td>{{ $value['total'] }}</td>
            <td>{{ $value['femenino'] }}</td>       
            <td>{{ $value['masculino'] }}</td>
        </tr>
        @endforeach
    </table>
@endif
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
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif
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
            <td>{{ $value['total'] }}</td>
        </tr>
        @endforeach
    </table>
@endif