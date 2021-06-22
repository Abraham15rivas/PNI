<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Reporte | PNI</title>

        <style>
            * {
                font-family: "Noto Sans" !important;
            }
            table {
                border-collapse: collapse;
                width: 100%
            }

            h3 {
                text-align: center;
            }
            
            .text-center {
                text-align: center;
                font-weight: bold;
            }
            table,
            th,
            td {
                border: 1px solid black;
            }
            th {
                background: #1b7ec5;
                color: white
            }
            th,
            td {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    @if ($typeReport == 'pdf')
                	    @yield('content-pdf')
                    @elseif ($typeReport == 'xlsx')
                        @yield('content-excel')
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>