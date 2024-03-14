<?php

namespace App\Http\Controllers\Becas;

use App\Http\Controllers\Controller;
use App\Models\becas\Beca;
use App\Models\ObjResponse;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Becas\Beca1StudentDataController;
use App\Models\becas\BecasView;

class BecaController extends Controller
{
    /**
     * Mostrar lista de becas activas.
     *
     * @return \Illuminate\Http\Response $response
     */
    public function index(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {

            // $list = Beca::where('becas.active', true)
            //     // ->join("users", "becas.user_id", "=", "users.id")
            //     ->join('student_data', 'becas.student_data_id', '=', 'student_data.id')
            //     ->join('schools', 'becas.school_id', '=', 'schools.id')
            //     ->select('*')
            //     ->orderBy('becas.id', 'asc')->get();
            $list = BecasView::all();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de becas.';
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
                ->select('becas.id as id', 'becas.folio as label')
                ->orderBy('becas.folio', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de becas';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Crear beca.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response $response
     */
    public function create(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $tutorDataController = new Beca1TutorDataController();
            $studentDataController = new Beca1StudentDataController();
            $tutor_data = $tutorDataController->createOrUpdateByBeca($request);
            $student_data = $studentDataController->createOrUpdateByBeca($request);

            $folio = $this->getLastFolio($response);

            $new_beca = Beca::create([
                'folio' => (int)$folio + 1,
                'user_id' => $request->tutor_id,
                // 'single_mother' => $request->single_mother,
                'tutor_data_id' => $tutor_data->id,
                'student_data_id' => $student_data->id,
                'school_id' => $request->school_id,
                'grade' => $request->grade,
                'average' => $request->average,
                'comments' => $request->comments,
                'socioeconomic_study' => $request->socioeconomic_study,
            ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | beca registrada.';
            $response->data["alert_text"] = 'Beca registrada';
            $response->data["result"] = $new_beca;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Mostrar beca.
     *
     * @param   int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response $response
     */
    public function show(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $beca = Beca::where('id', $request->id)->first();

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | beca encontrada.';
            $response->data["result"] = $beca;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Actualizar beca.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response $response
     */
    public function update(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $beca = Beca::find($request->id)
                ->update([
                    'folio' => $request->folio,
                    'tutor_id' => $request->tutor_id,
                    'tutor_full_name' => $request->tutor_full_name,
                    'tutor_phone' => $request->tutor_phone,
                    // 'single_mother' => $request->single_mother,
                    'student_data_id' => $request->student_data_id,
                    'school_id' => $request->school_id,
                    'grade' => $request->grade,
                    'average' => $request->average,
                    'comments' => $request->comments,
                    'socioeconomic_study' => $request->socioeconomic_study,
                ]);

            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | beca actualizada.';
            $response->data["alert_text"] = 'Beca actualizada';
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Eliminar (cambiar estado activo=false) beca.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response $response
     */
    public function destroy(Request $request, Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            Beca::find($request->id)
                ->update([
                    'active' => false,
                    'deleted_at' => date('Y-m-d H:i:s'),
                ]);
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'peticion satisfactoria | beca eliminada.';
            $response->data["alert_text"] = 'Beca eliminada';
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }


    /**
     * Obtener el ultimo folio.
     *
     * @return \Illuminate\Http\Int $folio
     */
    private function getLastFolio()
    {
        try {
            $folio = Beca::max('folio');
            if ($folio == null) return 0;
            return $folio;
        } catch (\Exception $ex) {
            $msg =  "Error al crear o actualizar estudiante por medio de la beca: " . $ex->getMessage();
            echo "$msg";
            return $msg;
        }
    }
}
