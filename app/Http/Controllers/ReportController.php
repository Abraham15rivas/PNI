<?php

namespace App\Http\Controllers;
use App\Http\Controllers\InvestigatorController;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index ()
    {
        //definir aqui consulta para saber la fecha minima de consulta
    }

    public function pdf (Request $request)
    {
        $clase = new InvestigatorController();
        $dateNow =  Carbon::now();

        switch ($request->typeQuery):
            case 1:
                $value = $clase->index();
                $name = "Investigadores_$dateNow.pdf";
                break;
            case 2:
                $value = $clase->interest();
                $name = "Intereses_investigadores_$dateNow.pdf";
                break;
            case 3:
                $value = $clase->profile();
                $name = "Perfil_investigadores_$dateNow.pdf";
                break;
            case 4:
                $value = $clase->current();
                $name = "Investigacion_actual_$dateNow.pdf";
                break;
            default:
                $name = "no hay documento";
                $value = false;
                break;
        endswitch;

        if (!$value == false) {
            $this->download($name, $value, $request->typeQuery);
        }
       
        return response()->json($name);
    }

    public function download($name, $value, $view)
    {
        $data = [
            'data' => $value,
            'view' => $view
        ];
        $content = PDF::loadView('reports.partials-pdf.main', $data)->output();
        Storage::disk('public')->put("pdf/$name", $content);
    }

    public function deleteReport ($name)
    {
        Storage::disk('public')->delete("pdf/$name");
        return "true";
    }
}
