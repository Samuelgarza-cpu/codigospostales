<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CodigoPostal;
use App\Models\Colony;
use App\Models\Community;
use App\Models\ObjResponse;
use App\Models\Perimeter;
use Faker\Provider\sv_SE\Municipality;
use Illuminate\Support\Facades\DB;

class CodigoPostalController extends Controller
{
    public function index(Response $response,$id){
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = CodigoPostal::where('codigopostal', $id)->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de comunidades.';
            $response->data["result"] = $list;
        
        }catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function indexCommunities(Response $response, Int $municipio_id=null){
        try {
            $response->data = ObjResponse::DefaultResponse();
            if ($municipio_id > 0) $list = CodigoPostal::select('Colonia')->where('MunicipioId', $municipio_id)->get();
            else $list = CodigoPostal::all();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de comunidades.';
            $response->data["result"] = $list;
        
        }catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function showCommunity(Response $response, $id){
        try {
            $response->data = ObjResponse::DefaultResponse();
            $community = Community::where('id', $id)->first();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Comunidad encontrada.';
            $response->data["result"] = $community;
        
        }catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function colonia(Response $response, $id){
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = CodigoPostal::where('id', $id)->first();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Comunidad encontrada.';
            $response->data["result"] = $list;
        
        }catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function perimeters(Response $response, Request $request){
        try {
            $response->data = ObjResponse::DefaultResponse();
            $list = $request->id > 0 ? Perimeter::find($request->id) : Perimeter::all();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = $request->id > 0 ? 'Peticion satisfactoria | Perimetro encontrado.' : 'Peticion satisfactoria | Perimetros encontrados.';
            $response->data["result"] = $list;
        
        }catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    /**
     * Mostrar listado para un selector.
     *
     * @return \Illuminate\Http\Response $response
     */
    public function selectIndexPerimeters(Response $response)
    {
        $response->data = ObjResponse::DefaultResponse();
        try {
            $list = Perimeter::where('active', true)
                ->select('perimeters.id as id', 'perimeters.perimeter as label')
                ->orderBy('perimeters.perimeter', 'asc')->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Lista de perimetros';
            $response->data["result"] = $list;
        } catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function createOrUpdatePerimeter(Response $response, Request $request){
        try {
            $response->data = ObjResponse::DefaultResponse();
            $perimeter = Perimeter::where('id', $request->id)->first();
            if (!$perimeter) $perimeter = new Perimeter();

            $perimeter->perimeter = $request->perimeter;
            if ($request->active != "") $perimeter->active = (bool)$request->active; 

            $perimeter->save();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = $request->id > 0 ? 'Peticion satisfactoria | Perímetro actualizdo.' : 'Peticion satisfactoria | Perímetro creado.';
            $response->data["alert_title"] = $request->id > 0 ? 'Perímetro actualizdo.' : 'Perímetro creado.';
            $response->data["alert_text"] = $request->id > 0 ? 'Perímetro actualizdo.' : 'Perímetro creado.';
            // $response->data["result"] = $perimeter;
            
        }catch (\Exception $ex) {
            $msg =  "Error al crear o actualizar perimetro: " . $ex->getMessage();
            error_log($msg);

            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function communitiesByPerimeter(Response $response, Int $perimeter_id){
        try {
            $response->data= ObjResponse::DefaultResponse();
            $list = CodigoPostal::where('perimetroId', $perimeter_id)->get();
            $response->data = ObjResponse::CorrectResponse();
            $response->data["message"] = 'Peticion satisfactoria | Comunidades por perimetro encontrados.';
            $response->data["result"] = $list;
        
        }catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }

    public function assignPerimeterToCommunity(Response $response, Int $perimeter_id, Int $community_id){
        try {
            $response->data= ObjResponse::DefaultResponse();
            $community = Community::where('id', $community_id)->first();
            if ($community) {
                $community->perimeter_id = $perimeter_id;
                $community->save();
                
                $response->data = ObjResponse::CorrectResponse();
                $response->data["message"] = 'Peticion satisfactoria | Perimetro asignado.';
                $response->data["alert_title"] = 'Perímetro asignado.';
                $response->data["alert_text"] = 'Perímetro asignado.';
                // $response->data["result"] = $list;
            } else {
                $response->data["message"] = 'Peticion no satisfactoria | No se encontro communidad.';
                $response->data["alert_title"] = 'No se encontro communidad.';
                $response->data["alert_text"] = 'No se encontro communidad.';
            }
            
        
        }catch (\Exception $ex) {
            $response->data = ObjResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response->data["status_code"]);
    }
}
