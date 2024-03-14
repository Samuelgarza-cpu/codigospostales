<?php

namespace App\Http\Controllers\Becas;

use App\Http\Controllers\Controller;
use App\Models\becas\Beca1TutorData;
use App\Models\ObjResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class Beca1TutorDataController extends Controller
{
    /**
     * Crear o Actualizar estudiante desde formulario beca.
     *
     * @return \Illuminate\Http\Response $response
     */
    public function createOrUpdateByBeca($request)
    {
        try {
            $tutor_data = Beca1TutorData::where('curp', $request->curp)->first();
            if (!$tutor_data) $tutor_data = new Beca();
            $isTutor = true;

            $tutor_data->tutor_relationship_id = $request->tutor_relationship_id;
            $tutor_data->tutor_curp = $request->tutor_curp;
            $tutor_data->tutor_name = $request->tutor_name;
            $tutor_data->tutor_paternal_last_name = $request->tutor_paternal_last_name;
            $tutor_data->tutor_maternal_last_name = $request->tutor_maternal_last_name;

            if ($request->tutor_relationship_id === 1 || $request->tutor_relationship_id === 2) $isTutor = false;

            if ($isTutor) {
                $tutor_data->tutor_img_ine = $request->tutor_img_ine;
                $tutor_data->tutor_img_power_letter = $request->tutor_img_power_letter;
            }

            $tutor_data->save();
            return $tutor_data;
        } catch (\Exception $ex) {
            $msg =  "Error al crear o actualizar tutor por medio de la beca: " . $ex->getMessage();

            echo "$msg";
            return $msg;
        }
    }

    /**
     * Mostrar lista de estudiantes activos.
     *
     * @return \Illuminate\Http\Response $response
     */
    public function index(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = Beca::where('beca_1_tutor_data.active', true)
                ->join('relationships', 'beca_1_tutor_data.tutor_relationship_id', '=', 'relationships.id')
                ->select('beca_1_tutor_data.*', 'relationships.relationship')
                ->orderBy('beca_1_tutor_data.id', 'desc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de estudiantes.';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
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
            $list = Beca::where('active', true)
                ->select('tutor_data.id as id', 'tutor_data.name as label')
                ->orderBy('tutor_data.name', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de estudiantes';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Crear estudiante.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response $response
     */
    public function create(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $new_estudent_data = Beca::create([
                'curp' => $request->curp,
                'name' => $request->name,
                'paternal_last_name' => $request->paternal_last_name,
                'maternal_last_name' => $request->maternal_last_name,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'community_id' => $request->community_id,
                'street' => $request->street,
                'num_ext' => $request->num_ext,
                'num_int' => $request->num_int,
                'disability_id' => $request->disability_id,
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | estudiante registrado.';
            $response->data["alert_text"] = 'Estudiante registrado';
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Mostrar estudiante.
     *
     * @param   int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response $response
     */
    public function show(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $field = 'tutor_data.id';
            $value = $request->id;
            if ($request->curp) {
                $field = 'tutor_data.curp';
                $value = $request->curp;
            }
            // $tutor_data = Beca1TutorData::where('tutor_data.id', $request->id)
            $tutor_data = Beca1TutorData::where("$field", "$value")
                ->join('disabilities', 'tutor_data.disability_id', '=', 'disabilities.id')
                ->select('tutor_data.*', 'disabilities.disability', 'disabilities.description')
                ->first();

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | estudiante encontrada.';
            $response->data["result"] = $tutor_data;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Actualizar estudiante.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $tutor_data = Beca1TutorData::find($request->id)
                ->update([
                    'curp' => $request->curp,
                    'name' => $request->name,
                    'paternal_last_name' => $request->paternal_last_name,
                    'maternal_last_name' => $request->maternal_last_name,
                    'birthdate' => $request->birthdate,
                    'gender' => $request->gender,
                    'community_id' => $request->community_id,
                    'street' => $request->street,
                    'num_ext' => $request->num_ext,
                    'num_int' => $request->num_int,
                    'disability_id' => $request->disability_id,
                ]);

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | estudiante actualizado.';
            $response->data["alert_text"] = 'Estudiante actualizado';
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Eliminar (cambiar estado activo=false) estudiante.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response $response
     */
    public function destroy(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            Beca1TutorData::find($request->id)
                ->update([
                    'active' => false,
                    'deleted_at' => date('Y-m-d H:i:s'),
                ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | estudiante eliminado.';
            $response->data["alert_text"] = 'Estudiante eliminado';
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}
