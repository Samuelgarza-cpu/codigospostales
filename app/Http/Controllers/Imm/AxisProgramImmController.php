<?php

namespace App\Http\Controllers\imm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ObjResponse;
use App\Models\imm\AxisProgram;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AxisProgramImmController extends Controller
{
    public function index(Response $response)
    {
        /**
         * Mostrar lista de todos los programa de ejes  activos.
         *
         * @return \Illuminate\Http\Response $response
         */
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = AxisProgram::where('axisprograms.active', true)
            ->join('axis', 'axisprograms.id_axi', '=', 'axis.id')
            ->select('axisprograms.*' , 'axis.axi as axi')
            ->orderBy('axisprograms.axisprogram', 'asc')->get();

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de programa de ejes.';
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
            $list = AxisProgram::where('active', true)
            ->select('axisprograms.id as value', 'axisprograms.axisprogram as text')
            ->orderBy('axisprograms.axisprogram', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de programa de ejes ';
            $response->data["result"] = $list;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
    public function axisProgram(int $id,Response $response)
    {   
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = AxisProgram::where('active', true)->where('axisprograms.id_axi',$id)
            ->select('axisprograms.id as value', 'axisprograms.axisprogram as text')
            ->orderBy('axisprograms.axisprogram', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de programa de ejes ';
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
            $new_gender = AxisProgram::create([
                'id_axi'=> $request->id_axi,
                'axisprogram' => $request->axisprogram,
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | programa de ejes registrada.';
            $response->data["alert_text"] = 'Programa de eje registrada';
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Mostrar un programa de ejes especifico.
     *
     * @param   int $id
     * @return \Illuminate\Http\Response $response
     */
    public function show(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try{
            $axisprograms = AxisProgram::where('id', $id)
            ->select('axisprograms.id', 'axisprograms.axisprogram', 'axisprograms.axisprogram')
            ->first();
            
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | programa de ejes encontrada.';
            $response->data["result"] = $axisprograms;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Actualizar un programa de ejes especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $axisprograms = AxisProgram::where('id', $request->id)
            ->update([
                'id_axi'=> $request->id_axi,
                'axisprogram' => $request->axisprogram,
            ]);

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | programa de ejes actualizada.';
            $response->data["alert_text"] = 'Programa de eje actualizado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Eliminar (cambiar programa de ejes activo=false) un programa de ejes especidifco.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response $response
     */
    public function destroy(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            AxisProgram::where('id', $id)
            ->update([
                'active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | Programa de eje eliminada.';
            $response->data["alert_text"] ='Programa de eje eliminado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}
