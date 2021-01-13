<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reporte | PNI</title>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    @if ($request->typeReport == 'PDF')
                	    @yield('content-pdf')
                    @elseif ($request->typeReport == 'EXCEL')
                        @yield('content-excel')
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>