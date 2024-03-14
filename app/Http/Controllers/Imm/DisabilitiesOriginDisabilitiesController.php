<?php

namespace App\Http\Controllers\imm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjResponse;
use App\Models\imm\DisabilitiesOriginDisabilities;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
class DisabilitiesOriginDisabilitiesController extends Controller
{
    public function index(Response $response)
    {
        /**
         * Mostrar lista de todos los origenes de la discapacidad activos.
         *
         * @return \Illuminate\Http\Response $response
         */
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = DisabilitiesOriginDisabilities::where('active', true)
            ->select('disabilitiesorigindisabilities.*')
            ->orderBy('disabilitiesorigindisabilities.id_disabilities', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de origenes de la discapacidad.';
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
            $list = DisabilitiesOriginDisabilities::where('active', true)
            ->select('disabilitiesorigindisabilities.id as value', 'disabilitiesorigindisabilities.id_disabilities as text')
            ->orderBy('disabilitiesorigindisabilities.id_disabilities', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de origenes de la discapacidad';
            $response->data["result"] = $list;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Crear un nuevo origenes de la discapacidad.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function create(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $new_medicalservice = DisabilitiesOriginDisabilities::create([
                'id_disabilities' => $request->id_disabilities,
                'id_disabilityorigins' => $request->id_disabilityorigins,

            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | origenes de la discapacidad registrado.';
            $response->data["alert_text"] = 'Origen de la discapacidad registrada';
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Mostrar un origenes de la discapacidad especifico.
     *
     * @param   int $id
     * @return \Illuminate\Http\Response $response
     */
    public function show(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try{
            $id_disabilities = DisabilitiesOriginDisabilities::where('id', $id)
            ->select('disabilitiesorigindisabilities.id', 'disabilitiesorigindisabilities.id_disabilities', 'disabilitiesorigindisabilities.id_disabilities')
            ->first();
            
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | origenes de la discapacidad encontrado.';
            $response->data["result"] = $id_disabilities;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Actualizar un origenes de la discapacidad especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $id_disabilities = DisabilitiesOriginDisabilities::where('id', $request->id)
            ->update([
                'id_disabilities' => $request->id_disabilities,
                'id_disabilityorigins' => $request->id_disabilityorigins,
            ]);

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | origenes de la discapacidad actualizado.';
            $response->data["alert_text"] = 'Origen de la discapacidad actualizado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Eliminar (cambiar estado activo=false) un origenes de la discapacidad especidifco.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response $response
     */
    public function destroy(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            DisabilitiesOriginDisabilities::where('id', $id)
            ->update([
                'active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | origenes de la discapacidad eliminada.';
            $response->data["alert_text"] ='Origen de la discapacidad eliminada';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}
