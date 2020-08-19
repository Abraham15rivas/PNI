<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investigator;
use App\Profesion;
use App\State;
use Carbon\Carbon;

class InvestigatorController extends Controller
{
    public function index(){
        //obtener datos masivos
        $investigators = Investigator::get();
        $profesion = Profesion::get();
        $states = State::get();

        //Numero total de investigadores
        $total_investigators = $investigators->count();

        //Numero de investigadores separados por genero
        $investigators_mens = $investigators->where('id_genero',2)->count();
        $investigators_womens = $investigators->where('id_genero',1)->count();

        //Numero de investigadores agrupados por carreras
        $groupByPro = $investigators->groupBy('id_profesion');

        $groupProfesion = collect();

        foreach($groupByPro as $key => $val){
            $selected = $profesion->where('id_profesion',$key);

            //destructurar el objeto para obtener el nombre de la profesion
            foreach($selected as $pro){
                $name = $pro->profesion;
            }

            $total = count($val);
            $groupProfesion->push(["profesion"=>$name,"total"=>$total]);
        }

        //Numero de investigadores por estados
        $groupBySta = $investigators->groupBy('id_estado');

        $groupState = collect();

        foreach($groupBySta as $key => $val){
            $selected = $states->where('id_estado',$key);

            //destructurar el objeto para obtener el nombre del estado
            foreach($selected as $pro){
                $name = $pro->estado;
            }

            $total = count($val);
            $groupState->push(["estado"=>$name,"total"=>$total]);
        }
        
        // Investigadores por rango de edad
        $birthDate =  $investigators;
        $groupRangeAge = self::rangeAge($birthDate);
      
        // Edad minima, maxima y promedio
        $groupAge = collect();

        $data = collect([
            "total_investigators"=>$total_investigators,
            "investigators_mens"=>$investigators_mens,
            "investigators_womens"=>$investigators_womens,
            "groupProfesion"=>$groupProfesion,
            "groupStates"=>$groupState,
            "groupRangeAge"=>$groupRangeAge,
            "groupAge"=>$groupAge
        ]);

        return $data->toJson();
    }

    public function rangeAge ($birthDate) {

        $ages = collect();
        
        foreach ($birthDate as $date) {
            $ages->push(Carbon::parse($date->fecha_nac)->age);
        }

        $rangos = collect([
            "00 - 09" => 0,
            "10 - 19" => 0,
            "20 - 29" => 0,
            "30 - 39" => 0,
            "40 - 49" => 0,
            "50 - 59" => 0,
            "60 - 69" => 0,
            "70 - 79" => 0,
            "80 - 89" => 0,
        ]);

        foreach ($ages as $age) 
        {
            if (0 <= $age && $age <= 9) {
                $rangos["00 - 09"] += 1;
            } else if (10 <= $age && $age <= 19) {
                $rangos["10 - 19"] += 1;
            } else if (20 <= $age && $age <= 29) {
                $rangos["20 - 29"] += 1;
            } else if (30 <= $age && $age <= 39) {
                $rangos["30 - 39"] += 1;
            } else if (40 <= $age && $age <= 49) {
                $rangos["40 - 49"] += 1;
            } else if (50 <= $age && $age <= 59) {
                $rangos["50 - 59"] += 1;
            } else if (60 <= $age && $age <= 69) {
                $rangos["60 - 69"] += 1;
            } else if (70 <= $age && $age <= 79) {
                $rangos["70 - 79"] += 1;
            } else if (80 <= $age && $age <= 89) {
                $rangos["80 - 89"] += 1;
            } 
        }
        return $rangos;
    }
}
