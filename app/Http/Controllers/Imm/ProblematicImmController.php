<?php

namespace App\Http\Controllers\imm;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjResponse;
use App\Models\imm\Problematic;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProblematicImmController extends Controller
{
    public function index(Response $response)
    {
        /**
         * Mostrar lista de todos los problemas de enfermedades activos.
         *
         * @return \Illuminate\Http\Response $response
         */
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = Problematic::where('active', true)
            ->select('problematics.*')
            ->orderBy('problematics.problem', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de problemas.';
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
            $list = Problematic::where('active', true)
            ->select('problematics.id as value', 'problematics.problem as text')
            ->orderBy('problematics.problem', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de problemas';
            $response->data["result"] = $list;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Crear un nuevo problemas de enfermedades.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function create(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $new_medicalservice = Problematic::create([
                'problem' => $request->problem,
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | problemas.';
            $response->data["alert_text"] = 'Problema registrada';
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Mostrar un problemas de enfermedades especifico.
     *
     * @param   int $id
     * @return \Illuminate\Http\Response $response
     */
    public function show(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try{
            $problem = Problematic::where('id', $id)
            ->select('problematics.id', 'problematics.problem', 'problematics.problem')
            ->first();
            
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | problema encontrado.';
            $response->data["result"] = $problem;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Actualizar un problemas de enfermedades especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $problem = Problematic::where('id', $request->id)
            ->update([
                'problem' => $request->problem,
            ]);

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | problema actualizado.';
            $response->data["alert_text"] = 'Problema actualizado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Eliminar (cambiar estado activo=false) un problemas de enfermedades especidifco.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response $response
     */
    public function destroy(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            Problematic::where('id', $id)
            ->update([
                'active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | problemas.';
            $response->data["alert_text"] ='Problema eliminado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}