<?php

namespace App\Http\Controllers\Becas;

use App\Http\Controllers\Controller;
use App\Models\becas\Beca1StudentData;
use App\Models\ObjResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class Beca1StudentDataController extends Controller
{
    /**
     * Crear o Actualizar estudiante desde formulario beca.
     *
     * @return \Illuminate\Http\Response $response
     */
    public function createOrUpdateByBeca($request)
    {
        try {
            $student_data = Beca1StudentData::where('curp', $request->curp)->first();
            if (!$student_data) $student_data = new Beca();

            $student_data->curp = $request->curp;
            $student_data->name = $request->name;
            $student_data->paternal_last_name = $request->paternal_last_name;
            $student_data->maternal_last_name = $request->maternal_last_name;
            $student_data->birthdate = $request->birthdate;
            $student_data->gender = $request->gender;
            $student_data->community_id = $request->community_id;
            $student_data->street = $request->street;
            $student_data->num_ext = $request->num_ext;
            $student_data->num_int = $request->num_int;
            $student_data->disability_id = $request->disability_id;

            $student_data->save();
            return $student_data;
        } catch (\Exception $ex) {
            $msg =  "Error al crear o actualizar estudiante por medio de la beca: " . $ex->getMessage();

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
            $list = Beca::where('student_data.active', true)
                ->join('disabilities', 'student_data.disability_id', '=', 'disabilities.id')
                ->select('student_data.*', 'disabilities.disability', 'disabilities.description')
                ->orderBy('student_data.id', 'desc')->get();
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
                ->select('student_data.id as id', 'student_data.name as label')
                ->orderBy('student_data.name', 'asc')->get();
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
            $field = 'student_data.id';
            $value = $request->id;
            if ($request->curp) {
                $field = 'student_data.curp';
                $value = $request->curp;
            }
            // $student_data = Beca1StudentData::where('student_data.id', $request->id)
            $student_data = Beca1StudentData::where("$field", "$value")
                ->join('disabilities', 'student_data.disability_id', '=', 'disabilities.id')
                ->select('student_data.*', 'disabilities.disability', 'disabilities.description')
                ->first();

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | estudiante encontrada.';
            $response->data["result"] = $student_data;
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
            $student_data = Beca1StudentData::find($request->id)
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
            Beca1StudentData::find($request->id)
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