<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investigator;
use App\Profesion;
use App\State;

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
        
        $data = collect([
            "total_investigators"=>$total_investigators,
            "investigators_mens"=>$investigators_mens,
            "investigators_womens"=>$investigators_womens,
            "groupProfesion"=>$groupProfesion,
            "groupStates"=>$groupState
        ]);

        return $data->toJson();
    }
}
