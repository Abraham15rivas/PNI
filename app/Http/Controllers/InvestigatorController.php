<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Investigator, Interest, Profesion, State, InstitutionType, ActualInvestigation};
use Carbon\Carbon;

class InvestigatorController extends Controller {
    
    public function index(){
        if (!isset($_GET['interest'])) {
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
                $similar = $profesion->filter(function ($item) use ($name) {
                    return false !== stristr($item->profesion, substr($name, 0, -1)) && $item->profesion !== $name;
                });
                if(count($similar) > 0){
                    foreach($similar as $val){
                        $total += $investigators->where('id_profesion',$val["id_profesion"])->count();
                    }
                    $groupByPro = $groupByPro->filter(function ($f) use($similar){
                        $id = 0;
                        foreach($similar as $val){
                            $id = $val->id_profesion;
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
                    $groupProfesion->push(["profesion"=>$name,"id"=>$key,"total"=>$total]);
                }elseif($test && count($test) == 0){
                    $groupProfesion->push(["profesion"=>$name,"id"=>$key,"total"=>$total]);
                }
            }
            // ->orderBy('total', 'desc')->take(10)->get();
            $groupProfesion = $groupProfesion->sortByDesc('total')->take(10);
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
            
            // Investigadores por rango de edad, edad minima, maxima y promedios por genero
            $calculations = self::rangeAge($investigators);
            $groupRangeAge = $calculations["ranges"];
            $groupAverageAge = $calculations["averages"];


            $data = collect([
                "total_investigators"=>$total_investigators,
                "investigators_mens"=>$investigators_mens,
                "investigators_womens"=>$investigators_womens,
                "groupProfesion"=>$groupProfesion,
                "groupStates"=>$groupState,
                "groupRangeAge"=>$groupRangeAge,
                "groupAverageAge"=>$groupAverageAge
            ]);
        } elseif($_GET['interest'] == 'true') {
            //obtener datos masivos
            $investigators = Investigator::get(['interes_inv', 'id_genero', 'id_tipo_institucion', 'inv_actual']);
            $interests = Interest::orderBy('id_lineas_presidenciales', 'asc')->get(['nombre_lineas_presidenciales', 'id_lineas_presidenciales']);
            $interests->push(["name"=> "TOTALES"]);
            $actualInvestigations = ActualInvestigation::get();

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
                $id_interest = $i == ($length - 1) ? 'No' : $interests[$i]->id_lineas_presidenciales;
                $value = isset($count_values_repeat[$j]) ? $count_values_repeat[$j] : 0;
                // Suma de totales
                $count_total_inv += $value;

                $groupInterest[$i]["$name"]["total"] = $i == ($length - 1) ? $count_total_inv : $value;
                $groupInterest[$i]["$name"]["femenino"] = 0;
                $groupInterest[$i]["$name"]["masculino"] = 0;

                foreach ($count_generos_repeat as $key => $generos) {
                    $id = explode("-", $key);
                    if ((int)$id[0] == $id_interest) {
                        if ((int)$id[1] == 1) {
                            $count_total_famela += $generos;
                            $groupInterest[$i]["$name"]["femenino"] = $generos;
                        } else {
                            $count_total_male += $generos;
                            $groupInterest[$i]["$name"]["masculino"] = $generos;
                        }
                    } else {
                        $groupInterest[$i]["$name"]['femenino'] = $count_total_famela;
                        $groupInterest[$i]["$name"]['masculino'] = $count_total_male;
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
                    $selected = $actualInvestigations->where('id_investigacion_actual',$id);

                    foreach($selected as $pro){
                        $name = $pro->titulo_investigacion;
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
                        $arrActual->push(["titulo"=>$name,"total"=>1]);
                    }
                }

            }

            $data = collect([
                "total_investigators"=>$total_investigators,
                "groupInstitution"=>$groupInstitution,
                "groupInterest"=>$groupInterest,
                "actualInvestigation"=>$arrActual
            ]);
        }
        
        return $data->toJson();
    }

    public function rangeAge ($investigators) {

        $ages = collect();
        // Calcula las edades en base a la fecha de nacimiento
        foreach ($investigators as $data) {
            $ages->push(["age"=>Carbon::parse($data->fecha_nac)->age,"genero"=>$data->id_genero]);
        }

        $ranges = array();
        for ($i = 0; $i < 9; $i++) {
            $ranges["$i"."0 - $i"."9"] = 0;
        }

        $famela = array();
        $male = array();

        // Asigna valor a cada rango
        foreach ($ages as $age) 
        {
            if (0 <= $age['age'] && $age['age'] <= 9) {
                $ranges["00 - 09"] += 1;
                $age['genero'] == '1' ? $famela[] = $age['age'] : $male[] = $age['age'];
            } else if (10 <= $age['age'] && $age['age'] <= 19) {
                $ranges["10 - 19"] += 1;
                $age['genero'] == '1' ? $famela[] = $age['age'] : $male[] = $age['age'];
            } else if (20 <= $age['age'] && $age['age'] <= 29) {
                $ranges["20 - 29"] += 1;
                $age['genero'] == '1' ? $famela[] = $age['age'] : $male[] = $age['age'];
            } else if (30 <= $age['age'] && $age['age'] <= 39) {
                $ranges["30 - 39"] += 1;
                $age['genero'] == '1' ? $famela[] = $age['age'] : $male[] = $age['age'];
            } else if (40 <= $age['age'] && $age['age'] <= 49) {
                $ranges["40 - 49"] += 1;
                $age['genero'] == '1' ? $famela[] = $age['age'] : $male[] = $age['age'];
            } else if (50 <= $age['age'] && $age['age'] <= 59) {
                $ranges["50 - 59"] += 1;
                $age['genero'] == '1' ? $famela[] = $age['age'] : $male[] = $age['age'];
            } else if (60 <= $age['age'] && $age['age'] <= 69) {
                $ranges["60 - 69"] += 1;
                $age['genero'] == '1' ? $famela[] = $age['age'] : $male[] = $age['age'];
            } else if (70 <= $age['age'] && $age['age'] <= 79) {
                $ranges["70 - 79"] += 1;
                $age['genero'] == '1' ? $famela[] = $age['age'] : $male[] = $age['age'];
            } else if (80 <= $age['age'] && $age['age'] <= 89) {
                $ranges["80 - 89"] += 1;
                $age['genero'] == '1' ? $famela[] = $age['age'] : $male[] = $age['age'];
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
                "total"=> $min_famela > $min_male ? $min_famela : $min_male
            ],
            "maxima"=> [
                "femenino"=> $max_famela,
                "masculino"=> $max_male,
                "total"=> $max_famela > $max_male ? $max_famela : $max_male
            ]
        ]);

        return $groupAverageAge;
    }

    public function institutionType ($investigators) {
        // Obtener datos de institucion
        $institutions = InstitutionType::orderBy('id_tipo_institucion', 'asc')->get(['tipo_institucion']);
        $institutions->prepend(["tipo_institucion" => "NO CONTESTARON"]);

        // Generar Objeto 
        $type_institution = array();
        for ($i = 0; $i < $institutions->count(); $i++) {
            $name = $i == 0 ? $institutions[$i]['tipo_institucion'] : $institutions[$i]->tipo_institucion;
            $value = $investigators->where('id_tipo_institucion', $i)->count();
            $type_institution["$name"] = $value;
        }
        return $type_institution;
    }
}
