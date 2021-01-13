@extends('reports.app')

@section('content-excel')

    @includeWhen($view == 1, 'reports.partials-excel.view_excel_investigadores')
    @includeWhen($view == 2, 'reports.partials-excel.view_excel_intereses')
    @includeWhen($view == 3, 'reports.partials-excel.view_excel_perfil')
    @includeWhen($view == 4, 'reports.partials-excel.view_excel_investigacion_actual')
   
@endsection