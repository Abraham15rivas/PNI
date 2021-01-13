<?php

namespace App\Http\Controllers;
use App\Http\Controllers\InvestigatorController;
use App\{Investigator, InvestigatorProfile, ActualInvestigation};
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index (Request $request)
    {
        if ($request->value == 1 || $request->value == 2) {
            $date = Investigator::orderBy('fecha_creacion')->first(['fecha_creacion'])->fecha_creacion;
        } else if ($request->value == 3) {
            $date = InvestigatorProfile::orderBy('fecha_creacion')->first(['fecha_creacion'])->fecha_creacion;
        } else if ($request->value == 4) {
            $date = ActualInvestigation::orderBy('fecha_registro')->first(['fecha_registro'])->fecha_registro;
        } else {
            $date = Carbon::now();
        }
        $date_min = Carbon::parse($date)->format('Y-m-d');
        return response()->json($date_min);
    }

    public function report (Request $request)
    {
        $clase = new InvestigatorController();
        $dateNow =  Carbon::now();

        switch ($request->typeQuery):
            case 1:
                $value = $clase->index($request->since, $request->until);
                $name = "Investigadores_$dateNow.$request->typeReport";
                break;
            case 2:
                $value = $clase->interest($request->since, $request->until);
                $name = "Intereses_investigadores_$dateNow.$request->typeReport";
                break;
            case 3:
                $value = $clase->profile($request->since, $request->until);
                $name = "Perfil_investigadores_$dateNow.$request->typeReport";
                break;
            case 4:
                $value = $clase->current($request->since, $request->until);
                $name = "Investigacion_actual_$dateNow.$request->typeReport";
                break;
            default:
                $name = "no hay documento";
                $value = false;
                break;
        endswitch;

        if (!$value == false) {
            $this->dataStructure($name, $value, $request);
        }
        
        return response()->json($name);
    }

    public function dataStructure ($name, $value, $request) {
        $data = [
            'data' => $value,
            'view' => $request->typeQuery,
            'typeReport' => $request->typeReport,
            'dates' => [
                'since' => $request->since,
                'until' => $request->until
            ]
        ];

        if ($request->typeReport == 'pdf') {
            $content = $this->downloadPdf($name, $data);
        } else if ($request->typeReport == 'xlsx') {
            $content = $this->downloadExcel($name, $data);
        }

        Storage::disk('public')->put("$request->typeReport/$name", $content);
    }

    public function downloadPdf($name, $data)
    {
        return $content = PDF::loadView('reports.partials-pdf.main', $data)->output();
    }

    public function downloadExcel($name, $data)
    {
        return $content = new ReportExport($data);
    }

    public function deleteReport ($typeReport, $name)
    {
        Storage::disk('public')->delete("$typeReport/$name");
        return "true";
    }
}
