<?php

namespace App\Http\Controllers\Facturaciones;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\Facturacion;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Support\Facades\DB;

class FactuacionController extends Controller
{
    public function index() {
       try {
        return json_encode(array(
            "status" => true, 
            "message" => "API ONLINE", 
            "log" => NULL
        ));
       } catch (\Exception $e) {
        return json_encode(array(
            "status" => true, 
            "message" => "API ONLINE", 
            "log" => $e
        ));
       }
    }

    public function GetDataFacturacionPOST(Request $receive){
        $result = array(
            "result" => true,
            "message" => "Mensaje Default",
            "log" => NULL,
            "data" => NULL,
            "receive" => NULL
        );
        try {
            $dataSend = json_decode($receive->getContent(), true);
            if (isset($dataSend)) {
                try {
                    $op = $dataSend["op"];
                    $dataRec = $dataSend["data"];
                    if($op === 1){
                        //BUSQUEDA POR FOLIO
                        if(isset($dataRec["folio"])){
                            $dpaFolio = $dataRec["folio"];
                            $data = Facturacion::where("dpa_folio", $dpaFolio)->get();
                            $result["result"] = true;
                            $result["message"] = "Busqueda por folio realizada con exito";
                            $result["data"] = $data;
                            $result["receive"] = $dataSend;
                        }else{
                            $data = NULL;
                            $result["result"] = false;
                            $result["message"] = "No se recibio el folio de busqueda";
                            $result["data"] = $data;
                            $result["receive"] = $dataSend;
                        }
                    }else if($op === 2){
                        //BUSQUEDA POR CLAVE CATASTRAL
                        if(isset($dataRec["claveCat"])){
                            $dpaClave = $dataRec["claveCat"];
                            $data = Facturacion::where("dpa_referencia", $dpaClave)->get();
                            $result["result"] = true;
                            $result["message"] = "Busqueda por Clave Catastral realizada con exito";
                            $result["data"] = $data;
                            $result["receive"] = $dataSend;
                        }else{
                            $data = NULL;
                            $result["result"] = false;
                            $result["message"] = "No se recibio la clave catastral de busqueda";
                            $result["data"] = $data;
                            $result["receive"] = $dataSend;
                        }
                    }else if($op === 3){
                        // BUSQUEDA POR MARGEN DE FECHAS
                        if(isset($dataRec["initialDate"])){
                            if(isset($dataRec["endlessDate"])){
                                if ($this->ValidarFecha($dataRec["initialDate"])) {
                                    $FechaInicio = $dataRec["initialDate"];
                                    if($this->ValidarFecha($dataRec["endlessDate"])){
                                        $FechaFin = $dataRec["endlessDate"];
                                        try{

                                  
                                            // $data = Facturacion::where('dpa_folio', 10253193)->where('dpa_fecha_doc', "2023-01-11 00:00:00.000")->get();
                                            $data = Facturacion::whereBetween('dpa_fecha_doc', [$FechaInicio, $FechaFin])->get();

                                            //   $data = DB::connection('sqlsrv_ingresos')->table('vwPagosFacElectronica')
                                            //   ->where('dpa_fecha_doc', '>=', $FechaInicio)
                                            //   ->where('dpa_fecha_doc', '<', $FechaFin)
                                            //   ->orderBy('dpa_fecha_doc','asc')
                                            //   ->get();

                                            // $data = DB::connection('sqlsrv_ingresos')->table('vwPagosFacElectronica')
                                                        // ->whereBetween('dpa_fecha_doc', ["'$FechaInicio'", "'$FechaFin'"])->get();

                                            // $data = Facturacion::where('dpa_fecha_doc', '>=', $FechaInicio)
                                            // ->where('dpa_fecha_doc', '<=', $FechaFin)
                                            // ->get();

                                            $result["result"] = true;
                                            $result["message"] = "Se buscaron los registros dentro del margen de fechas solicitado";
                                            $result["data"] = $data;
                                            $result["receive"] = $dataSend;
                                        } catch (\Exception $es){
                                            $result["result"] = false;
                                            $result["message"] = "Introduce un par de fechas validas. Formato correcto: AAAA-DD-MM HH:MM:SS.sss";
                                            $result["receive"] = $dataSend;
                                            $result["log"] = $es->getMessage().", ".$es->getLine().", ".$es->getFile();
                                        }
                                    }else{
                                        $data = NULL;
                                        $result["result"] = false;
                                        $result["message"] = "El formato de la fecha final que se recibio es incorrecto";
                                        $result["data"] = $data;
                                        $result["log"] = "Formato correcto: AAAA-DD-MM HH:MM:SS.sss";
                                        $result["receive"] = $dataSend;
                                    }
                                } else {
                                    $data = NULL;
                                    $result["result"] = false;
                                    $result["message"] = "El formato de la fecha inicial que se recibio es incorrecto";
                                    $result["data"] = $data;
                                    $result["log"] = "Formato correcto: AAAA-DD-MM HH:MM:SS.sss";
                                    $result["receive"] = $dataSend;
                                }
                            }else{
                                $data = NULL;
                                $result["result"] = false;
                                $result["message"] = "No se recibio una fecha de fin";
                                $result["data"] = $data;
                                $result["receive"] = $dataSend;
                            }
                        }else{
                            $data = NULL;
                            $result["result"] = false;
                            $result["message"] = "No se recibio ninguna Fecha Inicial";
                            $result["data"] = $data;
                            $result["receive"] = $dataSend;
                        }
                    }else{
                        $data = NULL;
                        $result["result"] = false;
                        $result["message"] = "Opcion introducida Inexistente";
                        $result["data"] = $data;
                        $result["receive"] = $dataSend;
                    }
                } catch (\Exception $ex) {
                    $data = NULL;
                    $result["result"] = false;
                    $result["message"] = "Ocurrio un error durante el procesamiento de la solicitud";
                    $result["data"] = $data;
                    $result["log"] = $ex->getMessage().", ".$ex->getLine().", ".$ex->getFile();
                    $result["receive"] = $dataSend;
                }
            }
            else{
                $data = NULL;
                $result["result"] = false;
                $result["message"] = "No se recivio ningun dato";
                $result["data"] = $data;
                $result["receive"] = $dataSend;
            }
           
        } catch (\Exception $e) {
            $data = NULL;
            $result["result"] = false;
            $result["message"] = "ERROR 500";
            $result["data"] = $data;
            $result["receive"] = $dataSend;
            $resul["log"] =  $e->getMessage().", ".$e->getLine().", ".$e->getFile();
        }
        return json_encode($result);
    }

    public function SetDataFacturacionPOST(){
        return json_encode(array(
            "status" => true, 
            "message" => "Metodo accesible no disponible", 
            "log" => NULL
        ));
    }

    public function ErrorReturn(){
        return json_encode(array(
            "status" => false, 
            "message" => "Funcion Inaccesible por este metodo", 
            "log" => NULL
        ));
    }

    private function ValidarFecha($fecha){
        try{
            $expresion = "/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d{3}$/";
            if(preg_match($expresion, $fecha)){
                return true;
            }else{
                return false;
            }

           
        }catch(\Exception){
            return false;
        }
    }
}
