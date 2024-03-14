<?php


namespace App\Http\Controllers\imm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjResponse;
use App\Models\imm\Diseases;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
class DiseasesImmController extends Controller
{
    public function index(Response $response)
    {
        /**
         * Mostrar lista de todos los enfermedades activos.
         *
         * @return \Illuminate\Http\Response $response
         */
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = Diseases::where('active', true)
            ->select('diseases.*')
            ->orderBy('diseases.diseas', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de enfermedades.';
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
            $list = Diseases::where('active', true)
            ->select('diseases.id as value', 'diseases.diseas as text')
            ->orderBy('diseases.diseas', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de enfermedades';
            $response->data["result"] = $list;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Crear un nuevo enfermedades.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function create(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $new_medicalservice = Diseases::create([
                'diseas' => $request->diseas,
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | enfermedades registrado.';
            $response->data["alert_text"] = 'Enfermedad registrada';
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Mostrar un enfermedades especifico.
     *
     * @param   int $id
     * @return \Illuminate\Http\Response $response
     */
    public function show(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try{
            $diseas = Diseases::where('id', $id)
            ->select('diseases.id', 'diseases.diseas', 'diseases.diseas')
            ->first();
            
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | enfermedades encontrado.';
            $response->data["result"] = $diseas;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Actualizar un enfermedades especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $diseas = Diseases::where('id', $request->id)
            ->update([
                'diseas' => $request->diseas,
            ]);

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | enfermedades actualizado.';
            $response->data["alert_text"] = 'Enfermedad actualizado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Eliminar (cambiar estado activo=false) un enfermedades especidifco.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response $response
     */
    public function destroy(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            Diseases::where('id', $id)
            ->update([
                'active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | enfermedades eliminada.';
            $response->data["alert_text"] ='Enfermedad eliminada';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}
