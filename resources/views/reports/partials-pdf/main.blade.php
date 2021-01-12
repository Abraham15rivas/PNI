@extends('reports.app')

@section('content')

    @includeWhen($view == 1, 'reports.partials-pdf.view_pdf_investigadores')
    @includeWhen($view == 2, 'reports.partials-pdf.view_pdf_intereses')
    @includeWhen($view == 3, 'reports.partials-pdf.view_pdf_perfil')
    @includeWhen($view == 4, 'reports.partials-pdf.view_pdf_investigacion_actual')
   
@endsection