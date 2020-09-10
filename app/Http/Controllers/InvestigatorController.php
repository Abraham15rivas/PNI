<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    Investigator, 
    Interest, 
    Profesion, 
    State, 
    InstitutionType, 
    ActualInvestigation, 
    InvestigatorProfile,
    ProfileInvestigation, 
    InvestigationType,
    InvestigationLine,
    InvestigationTime,
    Academic,
    Phase
};
use Carbon\Carbon;

class InvestigatorController extends Controller {
    
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
            $total_male = $investigators->where('id_profesion',$key)->where('id_genero',2)->count();
            $total_female = $investigators->where('id_profesion',$key)->where('id_genero',1)->count();
            $similar = $profesion->filter(function ($item) use ($name) {
                return false !== stristr($item->profesion, substr($name, 0, -1)) && $item->profesion !== $name;
            });
            if(count($similar) > 0){
                foreach($similar as $val2){
                    $total += $investigators->where('id_profesion',$val2["id_profesion"])->count();
                    $total_male += $investigators->where('id_profesion',$val2["id_profesion"])->where('id_genero',2)->count();
                    $total_female += $investigators->where('id_profesion',$val2["id_profesion"])->where('id_genero',1)->count();
                }
                $groupByPro = $groupByPro->filter(function ($f) use($similar){
                    $id = 0;
                    foreach($similar as $val2){
                        $id = $val2->id_profesion;
                    }
                    foreach($f as $investigator){
                        if($investigator->id_profesion != $id){
                            return true;
                        }else{
                            return false;
                        }
                    }
                });
            }
            $test=null;
            if(count($groupProfesion) > 0){
                $test = $groupProfesion->filter(function ($item) use ($name) {
                    return false !== stristr($item["profesion"], substr($name, 0, -1)) && $item["profesion"] !== $name;
                });
            }
            if(!$test){
                $groupProfesion->push(["profesion"=>$name,"id"=>$key,"total"=>$total,"male"=>$total_male,"female"=>$total_female]);
            }elseif($test && count($test) == 0){
                $groupProfesion->push(["profesion"=>$name,"id"=>$key,"total"=>$total,"male"=>$total_male,"female"=>$total_female]);
            }
        }
        
        // Ordenar descendente las profesiones y mostrar solo 10 primeros
        $grauprofesionArray = $this->orderDescUnkey($groupProfesion);

        if (count($grauprofesionArray) > 10) {
            $grauprofesionArray = array_slice($grauprofesionArray, 0, 10);
        } else {
            $grauprofesionArray = array_slice($grauprofesionArray, 0, count($grauprofesionArray));
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

        // Ordenar descendente los estados
        $groupStateArray = $this->orderDescUnkey($groupState);
        
        // Investigadores por rango de edad, edad minima, maxima y promedios por genero
        $calculations = self::rangeAge($investigators);
        $groupRangeAge = $calculations["ranges"];
        $groupAverageAge = $calculations["averages"];

        $data = collect([
            "total_investigators"=>$total_investigators,
            "investigators_mens"=>$investigators_mens,
            "investigators_womens"=>$investigators_womens,
            "groupProfesion"=>$grauprofesionArray,
            "groupStates"=>$groupStateArray,
            "groupRangeAge"=>$groupRangeAge,
            "groupAverageAge"=>$groupAverageAge
        ]);
        
        return $data->toJson();
    }

    public function rangeAge ($investigators) {

        $ages = collect();
        // Calcula las edades en base a la fecha de nacimiento
        foreach ($investigators as $data) {
            $ages->push(["age"=>Carbon::parse($data->fecha_nac)->age,"genero"=>$data->id_genero]);
        }

        $ranges = collect();
        for ($i = 0; $i < 9; $i++) {
            $ranges->push(["titulo"=>$i."0 - ".$i."9", "total"=> 0]);
        }

        $famela = array();
        $male = array();

        // Asigna valor a cada rango
        foreach ($ranges as $value) {
            $comparar1 = (int) substr($value["titulo"], 0, 2);
            $comparar2 = (int) substr($value["titulo"], -2, 2);
            $titulo = $value["titulo"];
            foreach ($ages as $age) 
            {
                if ($comparar1 <= $age['age'] && $age['age'] <= $comparar2) {
                    $search = $ranges->where('titulo', $titulo);
                    if($search) {
                        $ranges = $ranges->map(function ($rango) use($titulo) {
                            if ($rango["titulo"] == $titulo) {
                                $rango["total"]++;
                            }
                            return $rango;
                        });
                    }
                    $age['genero'] == '1' ? $famela[] = $age['age'] : $male[] = $age['age'];
                }
            }
        }

        // Edad minima, maxima y promedios
        $averages = self::averageAge($male, $famela);

        return ["ranges"=>$ranges, "averages"=>$averages];
    }

    public function averageAge ($male, $famela) {

        $min_famela = min($famela);
        $max_famela = max($famela);
        $average_famela = (array_sum($famela) / count($famela));

        $min_male = min($male);
        $max_male = max($male);
        $average_male = (array_sum($male) / count($male));

        $total_averages = (array_sum($famela) + array_sum($male)) / (count($famela) + count($male));

        $groupAverageAge = collect([
            "promedio"=> [
                "femenino"=> round($average_famela, 1),
                "masculino"=> round($average_male, 1),
                "total"=> round($total_averages, 1)
            ],
            "minima"=> [
                "femenino"=> $min_famela,
                "masculino"=> $min_male,
                "total"=> $min_famela < $min_male ? $min_famela : $min_male
            ],
            "maxima"=> [
                "femenino"=> $max_famela,
                "masculino"=> $max_male,
                "total"=> $max_famela > $max_male ? $max_famela : $max_male
            ]
        ]);

        return $groupAverageAge;
    }

    public function interest ()
    {
        //obtener datos masivos
        $investigators = Investigator::get(['interes_inv', 'id_genero', 'id_tipo_institucion', 'inv_actual']);
        $interests = Interest::orderBy('id_lineas_presidenciales', 'asc')->get(['nombre_lineas_presidenciales', 'id_lineas_presidenciales']);
        $actualInvestigations = $interests;
        $interests->push(["name"=> "TOTALES"]);

        // Numero de instituciones
        $groupInstitution = self::institutionType($investigators);
        
        //Numero total de investigadores
        $total_investigators = $investigators->count();
        
        // Separar intereses por genero (femenino, masculino) 
        $genero = array();

        // Obtener "id" de los intereses de investigación
        $interests_inv = array();
        foreach ($investigators as $key => $investigator) {
            // Quitar las llaves "{}" de los datos
            $remove_key = substr($investigator->interes_inv, 1, strlen($investigator->interes_inv) - 2);
            $remove_comma = explode(",", $remove_key);
            if ($remove_comma > 1) {
                foreach ($remove_comma as $item) {
                    $interests_inv[] = $item;
                    $genero[] = $item."-".$investigator->id_genero;
                }
            } else {
                $interests_inv[] = $remove_comma;
                $genero[] = $remove_comma."-".$investigator->id_genero;
            }
        }

        // contar valores repetidos
        $count_values_repeat = array_count_values($interests_inv); // intereses
        $count_generos_repeat = array_count_values($genero); // generos
        
        // Ordenar ascendente
        ksort($count_values_repeat); // intereses
        ksort($count_generos_repeat); // generos

        // Intereses de los investigadores
        $groupInterest = array();
        // Contadores de totales
        $count_total_inv = 0;
        $count_total_famela = 0;
        $count_total_male = 0;
        $j = 1;
        for ($i = 0; $i < $interests->count(); $i++) 
        {
            $length = $interests->count();
            $name = $i == ($length - 1) ? $interests[$i]['name'] : $interests[$i]->nombre_lineas_presidenciales;
            $id = $i == ($length - 1) ? $length : $interests[$i]->id_lineas_presidenciales;
            $id_interest = $i == ($length - 1) ? 'Abi' : $interests[$i]->id_lineas_presidenciales;
            $value = isset($count_values_repeat[$j]) ? $count_values_repeat[$j] : 0;
            // Suma de totales
            $count_total_inv += $value;

            $groupInterest[$i]["titulo"] = $name;
            $groupInterest[$i]["id"] = $id;
            $groupInterest[$i]["total"] = $i == ($length - 1) ? $count_total_inv : $value;
            $groupInterest[$i]['femenino'] = 0;
            $groupInterest[$i]['masculino'] = 0;

            foreach ($count_generos_repeat as $key => $generos) {
                $id = explode("-", $key);
                if ((int)$id[0] == $id_interest) {
                    if ((int)$id[1] == 1) {
                        $count_total_famela += $generos;
                        $groupInterest[$i]["femenino"] = $generos;
                    } else {
                        $count_total_male += $generos;
                        $groupInterest[$i]["masculino"] = $generos;
                    }
                } else if ($id_interest == 'Abi') {
                    $groupInterest[$i]['femenino'] = $count_total_famela;
                    $groupInterest[$i]['masculino'] = $count_total_male;
                }
            }
            $j++;
        }

        //investigaciones actuales
        $investigators_actual = $investigators->where('inv_actual','!=',null);

        $arrActual = collect();
        foreach($investigators_actual as $inv){
            $ids_inv = explode(",",substr($inv->inv_actual,1,-1));

            foreach($ids_inv as $id){
                $selected = $actualInvestigations->where('id_lineas_presidenciales',$id);

                foreach($selected as $pro){
                    $name = $pro->nombre_lineas_presidenciales;
                    $id = $pro->id_lineas_presidenciales;
                }
                $search = $arrActual->where('titulo',$name);
                if($search->count() > 0){
                    $arrActual = $arrActual->map(function ($investigation, $key) use($name) {
                        if ($investigation["titulo"] == $name) {
                            $investigation["total"]++;
                        }
                        return $investigation;
                    });
                }else{
                    $arrActual->push(["titulo"=>$name, "id"=>$id ,"total"=>1]);
                }
            }

        }

        $data = collect([
            "total_investigators"=>$total_investigators,
            "groupInstitution"=>$groupInstitution,
            "groupInterest"=>$groupInterest,
            "actualInvestigation"=>$arrActual
        ]);

        return $data->toJson();
    }

    public function institutionType ($investigators) {
        // Obtener datos de institucion
        $institutions = InstitutionType::get();

        // Generar Objeto 
        $groupByInstitution = $investigators->groupBy('id_tipo_institucion');
        $type_institution = collect();
        foreach ($groupByInstitution as $key => $val) {
            if ($key != 0) {
                $selected = $institutions->where('id_tipo_institucion',$key);
                foreach($selected as $pro){
                    $name = $pro->tipo_institucion;
                }            
                $total = count($val);
                $type_institution->push(["titulo"=>$name, "id" => $key, "total"=>$total]);
            } else {
                $type_institution->prepend(["titulo" => 'NO CONTESTARON', "id" => $key,"total" => count($val)]);
            }
        }

        return $type_institution;
    }

    public function orderDescUnkey ($collection)
    {
        $newArray = $collection->toArray();
        usort($newArray, function($a, $b) {
            return $b['total'] <=> $a['total'];
        });

        return $newArray;
    }

    public function profile(){
        $profiles = InvestigatorProfile::get();
        $profileInvestigations = ProfileInvestigation::get();
        $line = InvestigationLine::get();
        $times = InvestigationTime::get();
        $types = InvestigationType::get();
        $academic = Academic::get();
        $institutionsType = InstitutionType::get();

        $total_profiles = $profiles->count();
        $totalInvestigations = $profileInvestigations->count();

        //Perfiles por nivel academico
        $groupByAcademic = $profiles->groupBy('id_nivel_academico');
        $groupAcademic = collect();
        foreach ($groupByAcademic as $key => $val) {
            $selected = $academic->where('id_nivel_academico',$key);

            foreach($selected as $pro){
                $name = $pro->nivel_academico;
            }

            $total = count($val);
            $groupAcademic->push(["academic_level"=>$name,"id"=>$key,"total"=>$total]);
        }

        //tipo investigacion
        $groupByType = $profileInvestigations->groupBy('id_tipo_investigacion');
        $groupType = collect();
        foreach ($groupByType as $key => $val) {
            $selected = $types->where('id_tipo_investigacion',$key);

            foreach($selected as $pro){
                $name = $pro->tipo_investigacion;
            }

            $total = count($val);
            $groupType->push(["type_investigation"=>$name,"id"=>$key,"total"=>$total]);
        }

        //linea investigacion
        $groupByLine = $profileInvestigations->groupBy('id_linea_investigacion');
        $groupLine = collect();
        foreach ($groupByLine as $key => $val) {
            $selected = $line->where('id_linea_investigacion',$key);

            foreach($selected as $pro){
                $name = $pro->linea_investigacion;
            }

            $total = count($val);
            $groupLine->push(["line_investigation"=>$name,"id"=>$key,"total"=>$total]);
        }

        //tipo institucion
        $groupByInstitution = $profileInvestigations->groupBy('id_tipo_institucion');
        $groupInstitution = collect();
        foreach ($groupByInstitution as $key => $val) {
            $selected = $institutionsType->where('id_tipo_institucion',$key);

            foreach($selected as $pro){
                $name = $pro->tipo_institucion;
            }

            $total = count($val);
            $groupInstitution->push(["institution_type"=>$name,"id"=>$key,"total"=>$total]);
        }

        //tiempo investigacion
        $groupByTime = $profileInvestigations->groupBy('tiempo_investigacion');
        $groupTime = collect();
        foreach ($groupByTime as $key => $val) {
            $selected = $times->where('id_tiempo_investigacion',$key);

            foreach($selected as $pro){
                $name = $pro->tiempo_investigacion;
            }

            $total = count($val);
            $groupTime->push(["investigation_time"=>$name,"id"=>$key,"total"=>$total]);
        }

        $data = collect([
            "total_profiles"=>$total_profiles,
            "total_profiles_investigations"=>$totalInvestigations,
            "academic_levels"=>$groupAcademic,
            "investigations_line"=>$groupLine,
            "investigations_type"=>$groupType,
            "institutions_type"=>$groupInstitution,
            "investigations_time"=>$groupTime
        ]);
        
        return $data->toJson();
    }

    public function current () {
        $investigation_current = ActualInvestigation::get();
        $institutionsType = InstitutionType::get();
        $types = InvestigationType::get();
        $line = InvestigationLine::get();
        $times = InvestigationTime::get();
        $phase = Phase::get();

        // Total investigación actual
        $total_investigation = $investigation_current->count();
        
        // Tipo de institución actual
        $groupByInstitution = $investigation_current->groupBy('id_tipo_institucion');
        $groupInstitution = collect();
        foreach ($groupByInstitution as $key => $val) {
            $selected = $institutionsType->where('id_tipo_institucion',$key);

            foreach($selected as $pro){
                $name = $pro->tipo_institucion;
            }

            $total = count($val);
            $groupInstitution->push(["institution_type"=>$name,"id"=>$key,"total"=>$total]);
        }

        // Tipo de investigación actual
        $groupByType = $investigation_current->groupBy('id_tipo_investigacion');
        $groupType = collect();
        foreach ($groupByType as $key => $val) {
            $selected = $types->where('id_tipo_investigacion',$key);

            foreach($selected as $pro){
                $name = $pro->tipo_investigacion;
            }

            $total = count($val);
            $groupType->push(["type_investigation"=>$name,"id"=>$key,"total"=>$total]);
        }

        // Lineas de investigación actual
        $groupByLine = $investigation_current->groupBy('id_tipo_investigacion');
        $groupLine = collect();
        foreach ($groupByLine as $key => $val) {
            $selected = $line->where('id_linea_investigacion',$key);

            foreach($selected as $pro){
                $name = $pro->linea_investigacion;
            }

            $total = count($val);
            $groupLine->push(["line_investigation"=>$name,"id"=>$key,"total"=>$total]);
        }

        // Tiempo de investigacion actual
        $groupByTime = $investigation_current->groupBy('tiempo_investigacion');
        $groupTime = collect();
        foreach ($groupByTime as $key => $val) {
            if ($key == "") {
                $not_response = count($val);
            }
            if ($key == 1 || $key == 2) {
                $selected = $times->where('id_tiempo_investigacion',$key);
                foreach($selected as $pro){
                    $name = $pro->tiempo_investigacion;
                }
                $total = count($val);
                $groupTime->push(["investigation_time"=>$name,"id"=>$key,"total"=>$total]);
            }
        }
        $groupTime->push(["investigation_time" => 'NO CONTESTARON',"id"=>0,"total" => $not_response]);

        // Fases de investigación actual
        $groupByPhase = $investigation_current->groupBy('id_fase');
        $groupPhase = collect();
        foreach ($groupByPhase as $key => $val) {
            $selected = $phase->where('id_fase',$key);

            foreach($selected as $pro){
                $name = $pro->fase;
            }

            $total = count($val);
            $groupPhase->push(["phase_investigation"=>$name,"id"=>$key,"total"=>$total]);
        }

        $data = collect([
            "total_investigation" => $total_investigation,
            "groupInstitution" => $groupInstitution,
            "investigations_type" =>$groupType,
            "investigations_line" =>$groupLine,
            "investigations_phase" => $groupPhase,
            "investigations_time" =>$groupTime
        ]);

        return $data->toJson();
    }

}