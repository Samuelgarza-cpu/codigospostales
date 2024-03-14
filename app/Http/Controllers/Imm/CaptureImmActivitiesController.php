<?php
namespace App\Http\Controllers\imm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjResponse;
use App\Models\imm\CaptureActivities;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
class CaptureImmActivitiesController extends Controller
{
    public function index(Response $response)
    {
        /**
         * Mostrar lista de todos los captura de actividades  activos.
         *
         * @return \Illuminate\Http\Response $response
         */
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = CaptureActivities::where('active', true)
            ->select('capture_activities.id', 'capture_activities.activities as Actividad'
            , 'capture_activities.organization as Organización',
             'capture_activities.colaboration as Colaboración', 
             'capture_activities.comunity as Comunidad',
              DB::raw("DATE_FORMAT(capture_activities.date, '%d/%m/%Y') as Fecha"))
            ->orderBy('capture_activities.id', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de captura de actividades.';
            $response->data["result"] = $list;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Mostrar listado para un selector.
     *
     * @return \Illuminate\Http\Response $response
     */
    public function selectIndex(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = CaptureActivities::where('active', true)
            ->select('capture_activities.id as value', 'capture_activities.id as text')
            ->orderBy('capture_activities.id', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de captura de actividades ';
            $response->data["result"] = $list;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Crear un nuevo genero.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function create(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $new_gender = CaptureActivities::create([
                'date' =>date('Y-m-d', strtotime($request->date)),
                'location' => $request->location,
                'activities' => $request->activities,
                'organization' => $request->organization,
                'colaboration' => $request->colaboration,
                'comunity' => $request->comunity,
                'axi_id' =>intval($request->axi_id),
                'axi_program_id' => intval($request->axi_program_id),
                'description' => $request->description,
                'observations' => $request->observations,
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | captura de actividades registrada.';
            $response->data["alert_text"] = 'Actividad registrada';
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Mostrar un captura de actividades especifico.
     *
     * @param   int $id
     * @return \Illuminate\Http\Response $response
     */
    public function show(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try{
            $capture_activities = CaptureActivities::where('id', $id)
            ->select(
            'capture_activities.date',
            'capture_activities.location',
            'capture_activities.activities',
            'capture_activities.organization',
            'capture_activities.colaboration',
            'capture_activities.comunity',
            'capture_activities.axi_id' ,
            'capture_activities.axi_program_id',
            'capture_activities.description',
            'capture_activities.observations'  
            )
            ->first();
            
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | captura de actividades encontrada.';
            $response->data["result"] = $capture_activities;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function getDataModule3(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try{
            $capture_activities = CaptureActivities::where('capture_activities.id', $id)
            ->select(
                DB::raw("DATE_FORMAT(capture_activities.date, '%d/%m/%Y') as Fecha"),
                'capture_activities.location as Lugar',
                'capture_activities.activities as Actividad',
                'capture_activities.organization as Organización',
                'capture_activities.colaboration as Colaboración',
                'capture_activities.comunity as Población beneficiada',
                'ax.axi as Eje',
                'axp.axisprogram as Programa',
                'capture_activities.description as Descripción',
                'capture_activities.observations as Observación'
            )->join('axis as ax', 'ax.id', '=', 'capture_activities.axi_id')
            ->join('axisprograms as axp', 'axp.id', '=', 'capture_activities.axi_program_id')
            ->get();
            
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | captura de actividades encontrada.';
            $response->data["result"] = $capture_activities;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    /**
     * Actualizar un captura de actividades especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request, Response $response,int $id)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $capture_activities = CaptureActivities::where('id', $id)
            ->update([
                'date' =>date('Y-m-d', strtotime($request->date)),
                'location' => $request->location,
                'activities' => $request->activities,
                'organization' => $request->organization,
                'colaboration' => $request->colaboration,
                'comunity' => $request->comunity,
                'axi_id' =>intval($request->axi_id),
                'axi_program_id' => intval($request->axi_program_id),
                'description' => $request->description,
                'observations' => $request->observations,
            ]);

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | captura de actividades actualizada.';
            $response->data["alert_text"] = 'Eje actualizado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Eliminar (cambiar captura de actividades activo=false) un captura de actividades especidifco.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response $response
     */
    public function destroy(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            CaptureActivities::where('id', $id)
            ->update([
                'active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | Eje eliminada.';
            $response->data["alert_text"] ='Eje eliminado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}
