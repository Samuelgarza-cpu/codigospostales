<?php

namespace App\Http\Controllers\imm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjResponse;
use App\Models\imm\Expendent;
use App\Models\imm\ExpendentSessions;
use App\Models\imm\ExpendentProblem;
use App\Models\imm\ExpendentMotiveClosed;
use App\Models\imm\ExpendentTypeViolence;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
class ExpendentImmController extends Controller
{
    public function selectIndexProblem(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = ExpendentProblem::where('active', true)
            ->select('expendent_problems.id as value', 'expendent_problems.problem as text')
            ->orderBy('expendent_problems.id', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de problemas';
            $response->data["result"] = $list;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function selectIndexMotiveClosed(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = ExpendentMotiveClosed::where('active', true)
            ->select('expendent_motive_closeds.id as value', 'expendent_motive_closeds.motive_closed as text')
            ->orderBy('expendent_motive_closeds.id', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de motivos de cierre';
            $response->data["result"] = $list;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function selectIndexTypeViolece(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = ExpendentTypeViolence::where('active', true)
            ->select('expendent_type_violences.id as value', 'expendent_type_violences.type_violence as text')
            ->orderBy('expendent_type_violences.id', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de problemas';
            $response->data["result"] = $list;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function create(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $expedent = new Expendent();
            $expedent->date = date('Y-m-d', strtotime($request->date));
            $expedent->procceding_id = intval($request->procceding_id);
            $expedent->procceding = intval($request->procceding);
            $expedent->psicology = $request->psicology;
            $expedent->status_case = $request->status_case;
            $expedent->name = $request->name;
            $expedent->age = intval($request->age);
            $expedent->street = $request->street;
            $expedent->number = intval($request->number);
            $expedent->colonie = $request->colonie;
            $expedent->telephone = $request->telephone;
            $expedent->type_violences_id = intval($request->type_violences_id);
            $expedent->problems_id = intval($request->problems_id);
            $expedent->diagnostic = $request->diagnostic;
            
            // Verifica si motive_closed_id está presente en la solicitud
            if ($request->dateclosed) {
                $expedent->dateclosed = date('Y-m-d', strtotime($request->dateclosed));
            } 
            if ($request->motive_closed_id) {
                $expedent->motive_closed_id = intval($request->motive_closed_id);
            } 
            
            $expedent->save();
            


             
            for ($i = 1; $i <= 18; $i++) { 
                if ($request->{"date$i"} !== null && $request->{"came$i"} !== null && $request->{"comment$i"} !== null) {
                    ExpendentSessions::create([
                        'expendents_id' => $expedent->id,
                        'date' => date('Y-m-d', strtotime($request->{"date$i"})),
                        'came' => intval($request->{"came$i"}),
                        'comment' => $request->{"comment$i"}
                    ]);
                }
            }
            
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | expediente registrado.';
            $response->data["alert_text"] = 'expediente registrada';
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function update(Request $request, Response $response,int $id)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            ExpendentSessions::where("expendents_id",$id)->delete();
            
            $expedent = Expendent::where('id', $id)->first(); // Obtén una instancia del modelo

            if ($expedent) {
                $expedent->date = date('Y-m-d', strtotime($request->date));
                $expedent->procceding_id = intval($request->procceding_id);
                $expedent->procceding = intval($request->procceding);
                $expedent->psicology = $request->psicology;
                $expedent->status_case = $request->status_case;
                $expedent->name = $request->name;
                $expedent->age = intval($request->age);
                $expedent->street = $request->street;
                $expedent->number = intval($request->number);
                $expedent->colonie = $request->colonie;
                $expedent->telephone = $request->telephone;
                $expedent->type_violences_id = intval($request->type_violences_id);
                $expedent->problems_id = intval($request->problems_id);
                $expedent->diagnostic = $request->diagnostic;
                
                // Verifica si motive_closed_id está presente en la solicitud
                if ($request->dateclosed) {
                    $expedent->dateclosed = date('Y-m-d', strtotime($request->dateclosed));
                } 
                if ($request->motive_closed_id) {
                    $expedent->motive_closed_id = intval($request->motive_closed_id);
                } 
                
                $expedent->update();
                

            }
            
            for ($i = 1; $i <= 18; $i++) { 
                if ($request->{"date$i"} !== null && $request->{"came$i"} !== null && $request->{"comment$i"} !== null) {
                    ExpendentSessions::create([
                        'expendents_id' => $id,
                        'date' => date('Y-m-d', strtotime($request->{"date$i"})),
                        'came' => intval($request->{"came$i"}),
                        'comment' => $request->{"comment$i"}
                    ]);
                }
            }
            
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | expediente actualizado.';
            $response->data["alert_text"] = 'expediente actualizada';
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }


     public function index(Response $response)
     {
         /**
          * Mostrar lista de todos los programa de ejes  activos.
          *
          * @return \Illuminate\Http\Response $response
          */
         $response->data = ObjResponse::DefaultResponse();
         try {
            $list = Expendent::where('expendents.active', true)
            ->select('expendents.id', 
            'expendents.name as Nombre',
            'expendents.psicology as Psicologia responsable',
            'expendent_problems.problem as Problema',
                DB::raw("DATE_FORMAT(expendents.date, '%m/%d/%Y') AS Fecha"),
                DB::raw("DATE_FORMAT(expendents.dateclosed, '%m/%d/%Y') AS 'Fecha de cierre'"),
            )
            ->leftjoin('expendent_problems', 'expendent_problems.id', '=', 'expendents.problems_id')
            ->leftjoin('expendent_motive_closeds', 'expendent_motive_closeds.id', '=', 'expendents.motive_closed_id')
            ->leftjoin('expendent_type_violences', 'expendent_type_violences.id', '=', 'expendents.type_violences_id')
            ->orderBy('expendents.id', 'asc')
            ->get();

        $response->data = ObjResponse::CorrectResponse();
        $response->data["message"] = 'Petición satisfactoria | Lista de problemas';
        $response->data["result"] = $list;


         
         }
         catch (\Exception $ex) {
             $response->data = ObjResponse::CatchResponse($ex->getMessage());
         }
         return response()->json($response, $response->data["status_code"]);
     }
     public function show(Response $response,int $id)
     {
         /**
          * Mostrar lista de todos los programa de ejes  activos.
          *
          * @return \Illuminate\Http\Response $response
          */
         $response->data = ObjResponse::DefaultResponse();
         try {
            $list = Expendent::where('expendents.active', true)->where('expendents.id',$id)
            ->select('expendents.id', 
                "expendents.procceding",
                "expendents.date",
                "expendents.psicology",
                "expendents.status_case",
                "expendents.name",
                "expendents.age",
                "expendents.street",
                "expendents.number",
                "expendents.colonie",
                "expendents.telephone",
                'expendents.problems_id',
                'expendents.type_violences_id',
                'expendents.motive_closed_id',
                'expendents.diagnostic',
                'expendents.dateclosed',
            )
            ->orderBy('expendents.id', 'asc')
            ->get();

                $sessions = ExpendentSessions::where('expendents_id', $id)
                ->select('expendent_sessions.date', 
                        'expendent_sessions.came',
                        'expendent_sessions.comment'
                )
                ->orderBy('expendent_sessions.id', 'asc')
                ->orderBy('expendent_sessions.expendents_id', 'asc')
                ->get();

            $groupedSessions = [];
            foreach ($list as $key => $item) {
                $groupedSessions['procceding_id'] = $item['procceding'];
                $groupedSessions['procceding'] = $item['procceding'];
                $groupedSessions['date'] = $item['date'];
                $groupedSessions['psicology'] = $item['psicology'];
                $groupedSessions['status_case'] = $item['status_case'];
                $groupedSessions['name'] = $item['name'];
                $groupedSessions['age'] = $item['age'];
                $groupedSessions['street'] = $item['street'];
                $groupedSessions['number'] = $item['number'];
                $groupedSessions['colonie'] = $item['colonie'];
                $groupedSessions['telephone'] = $item['telephone'];
                $groupedSessions['problems_id'] = $item['problems_id'];
                $groupedSessions['type_violences_id'] = $item['type_violences_id'];
                $groupedSessions['motive_closed_id'] = $item['motive_closed_id'];
                $groupedSessions['diagnostic'] = $item['diagnostic'];
                $groupedSessions['dateclosed'] = $item['dateclosed'];

            }
            foreach ($sessions as $key => $session) {
                $index = $key + 1;
                $groupedSessions["date$index"] = $session['date'];
                $groupedSessions["came$index"] = $session['came'];
                $groupedSessions["comment$index"] = $session['comment'];
            }

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Petición satisfactoria | Lista de sesiones agrupadas';
            $response->data["result"] = [$groupedSessions];



         
         }
         catch (\Exception $ex) {
             $response->data = ObjResponse::CatchResponse($ex->getMessage());
         }
         return response()->json($response, $response->data["status_code"]);
     }
     public function pdf(Response $response,int $id)
     {
         /**
          * Mostrar lista de todos los programa de ejes  activos.
          *
          * @return \Illuminate\Http\Response $response
          */
         $response->data = ObjResponse::DefaultResponse();
         try {
            $list = Expendent::where('expendents.active', true)->where('expendents.id',$id)
            ->select( 
                "expendents.procceding",
                DB::raw("DATE_FORMAT(expendents.date, '%d/%m/%Y') as date"),
                "expendents.psicology",
                "expendents.status_case",
                DB::raw("IF(expendents.status_case = 0, 'Inactivo', 'Activo') as status_case"),
                "expendents.name",
                "expendents.age",
                "expendents.street",
                "expendents.number",
                "expendents.colonie",
                "expendents.telephone",
                'expendent_problems.problem',
                'expendent_type_violences.type_violence',
                'expendent_motive_closeds.motive_closed',
                'expendents.diagnostic',
                DB::raw("DATE_FORMAT(expendents.dateclosed, '%d/%m/%Y') as dateclosed"),
            ) ->join('expendent_problems', 'expendent_problems.id', '=', 'expendents.problems_id')
            ->join('expendent_motive_closeds', 'expendent_motive_closeds.id', '=', 'expendents.motive_closed_id')
            ->join('expendent_type_violences', 'expendent_type_violences.id', '=', 'expendents.type_violences_id')
            ->orderBy('expendents.id', 'asc')
            ->get();

                $sessions = ExpendentSessions::where('expendents_id', $id)
                ->select(
                DB::raw("DATE_FORMAT(expendent_sessions.date, '%d/%m/%Y') as date"),
                DB::raw("IF(expendent_sessions.came = 0, 'No', 'Si') as came"),
                        'expendent_sessions.comment'
                )
                ->orderBy('expendent_sessions.id', 'asc')
                ->orderBy('expendent_sessions.expendents_id', 'asc')
                ->get();
            $psicology = null;
            $groupedSessions = [];
            foreach ($list as $key => $item) {
                $groupedSessions['Folio'] = $item['procceding'];
                $groupedSessions['Fecha'] = $item['date'];
                
                $groupedSessions['Psicologia responsable'] = $item['psicology'];
                $groupedSessions['Status del caso'] = $item['status_case'];
                $groupedSessions['Nombre'] = $item['name'];
                $groupedSessions['Edad'] = $item['age'];
                $groupedSessions['Calle'] = $item['street'];
                $groupedSessions['Numero'] = $item['number'];
                $groupedSessions['Colonia/Ejido'] = $item['colonie'];
                $groupedSessions['Telefono'] = $item['telephone'];
                $groupedSessions['Problematica abordada'] = $item['problem'];
                $groupedSessions['Tipo de violencia'] = $item['type_violence'];
                $groupedSessions['Motivo de cierre'] = $item['motive_closed'];
                $groupedSessions['Diagnostico de cierre'] = $item['diagnostic'];
                $groupedSessions['Fecha de cierre'] = $item['dateclosed'];
                $groupedSessions[''] = $item[''];

            }
            foreach ($sessions as $key => $session) {
                $index = $key + 1;
                $groupedSessions["Sesión $index"] = "$index";
                $groupedSessions["Sesión $index"] = "$index";
                $groupedSessions["Fecha de sesión $index"] = $session['date'];
                $groupedSessions["Acudio $index"] = $session['came'];
                $groupedSessions["Comentario $index"] = $session['comment'];
            }

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Petición satisfactoria | Lista de sesiones agrupadas';
            $response->data["result"] = [$groupedSessions];



         
         }
         catch (\Exception $ex) {
             $response->data = ObjResponse::CatchResponse($ex->getMessage());
         }
         return response()->json($response, $response->data["status_code"]);
     }
     public function destroy(int $id, Response $response)
     {
         $response->data = ObjResponse::DefaultResponse();
         try {
            Expendent::where('id', $id)
             ->update([
                 'active' => false,
                 'deleted_at' => date('Y-m-d H:i:s'),
             ]);
             $response->data = ObjResponse::CorrectResponse();
             $response->data["message"] = 'peticion satisfactoria | Motivos de cierre eliminada.';
             $response->data["alert_text"] ='Motivos de cierre eliminado';
 
         } catch (\Exception $ex) {
             $response->data = ObjResponse::CatchResponse($ex->getMessage());
         }
         return response()->json($response, $response->data["status_code"]);
     }
}
    
