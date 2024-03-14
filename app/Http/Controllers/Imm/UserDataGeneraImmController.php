<?php

namespace App\Http\Controllers\imm;
use App\Http\Controllers\Controller;
use App\Http\Controllers\imm\UserProceedingsImmController;
use App\Http\Controllers\imm\UserComunityImmController;
use Illuminate\Http\Request;
use App\Models\ObjResponse;
use App\Models\imm\UserData;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

class UserDataGeneralImmController extends Controller
{
    public function index(Response $response)
    {
        /**
         * Mostrar lista de todos los user_profiles  activos.
         *
         * @return \Illuminate\Http\Response $response
         */
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = UserData::where('active', true)
            ->select('user_profiles.pregnant')
            ->orderBy('user_profiles.lastName', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de Perfiles de usuarios.';
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
            $list = UserData::where('active', true)
            ->select('user_profiles.id as value', 'user_profiles.name as text')
            ->orderBy('user_profiles.lastName', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de perfiles de usuaria ';
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
    

    /**
     * Mostrar un user_profiles especifico.
     *
     * @param   int $id
     * @return \Illuminate\Http\Response $response
     */
    public function show(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try{
            $user_profiles = UserData::where('id', $id)
            ->select('user_profiles.*')
            ->first();
            
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | Usuario de perfil encontrado.';
            $response->data["result"] = $user_profiles;
        }
        catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Actualizar un user_profiles especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $user_profiles = UserData::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'lastName' => $request->lastName,
                'secondName' => $request->secondName,
                'gender_id' => $request->gender_id,
                'birthdate' => $request->birthdate,
                'age' => $request->age,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'civil_status_id' => $request->civil_status_id,
                'numberchildrens' => $request->numberchildrens,
                'numberdaughters' => $request->numberdaughters,
                'pregnant' => $request->pregnant,

            ]);

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | Pefil de usuaria actualizada.';
            $response->data["alert_text"] = 'UserData actualizado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Eliminar (cambiar user_profiles activo=false) un user_profiles especidifco.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response $response
     */
    public function destroy(int $id, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            UserData::where('id', $id)
            ->update([
                'active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | Perfil de usuario eliminado.';
            $response->data["alert_text"] ='UserData eliminado';

        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}
