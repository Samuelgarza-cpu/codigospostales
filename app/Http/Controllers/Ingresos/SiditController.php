<?php

namespace App\Http\Controllers\ingresos;

use App\Http\Controllers\Controller;
use App\Models\ingresos\tramitesSidit;
use App\Models\ingresos\detalleTramitesSidit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\ingresos\ClavesCat;
// use Carbon\Carbon;

class SiditController extends Controller
{
    public function index(Response $response){

        try {

            $tramites = tramitesSidit::all()->first();
            
            return response()->json($tramites);

        }
        catch (\Exception $ex) {

            return response()->json("Error: ".$ex->getMessage());
        }

    }

    public function create ( Request $request ) {
        $response = array(
            "Result" => false,
            "Message" => "No se realizo ninguna accion",
            "PV" => NULL,
            "VPG" => NULL,
            "ClaveCat" => NULL
        );
        try {
            $jsonDecode = json_decode($request->getContent(), true);
            if (isset($jsonDecode)) {
                $objeto = $jsonDecode[0];
                if (isset($objeto)) {
                    $opcion = $objeto["option"];
                    if(isset($opcion)) {
                        if ($opcion === 1) {
                            //PROCEDIMIENTO ALMACENADO DE ISERCION DE DATOS
                            $response["Result"] = true;
                            $response["Message"] = "Se ejecuto el procedimiento almacenado sin errores";
                            $PVGI = $objeto["PVGI"];
                            $PVI = $objeto["PVI"];
                            if (isset($PVGI)) {
                                if (isset($PVI)) {
                                    DB::beginTransaction();
                                    try {
                                        foreach ($PVGI as $item) {
                                            $tempItem = [
                                                'id' => $item['id'],
                                                'FolioSIDIT' => $item['FolioSIDIT'],
                                                'RFC' => $item['RFC'],
                                                'NombrePropietario' => $item['NombrePropietario'],
                                                'idTramite' => $item['idTramite'],
                                                'Direccion' => $item['Direccion'],
                                                'ClaveCatastral' => $item['ClaveCatastral'],
                                                'Descuento' => $item['Descuento'],
                                                'TipoDescuento' => $item['TipoDescuento'],
                                                'AutorizaDesc' => $item['AutorizaDesc'],
                                                'MontoFinal' => $item['MontoFinal'],
                                                'FechaGeneracion' => $item["FechaGeneracionF"],
                                                'FechaPago' => $item['FechaPago'],
                                                'UsuarioSolicita' => $item['UsuarioSolicita'],
                                                'Estatus' => $item['Estatus'],
                                                'ReciboOficial' => $item['ReciboOficial'],
                                                'Observaciones' => $item['Observaciones'],
                                            ];
                                            tramitesSidit::insert($tempItem);
                                        }
                                        foreach ($PVI as $item) {
                                            $tempItem = [
                                                'id' => $item['id'],
                                                'idTramite' => $item['idTramite'],
                                                'NombreTramite' => $item['NombreTramite'],
                                                'CveCobro' => $item['CveCobro'],
                                                'MontoTotal' => $item['MontoTotal'],
                                                'FechaGeneracion' => $item["FechaGeneracionF"],
                                                'UsuarioSolicita' => $item['UsuarioSolicita'],
                                                'Estatus' => $item['Estatus'],
                                                'PVGeneralID' => $item["PVGeneralID"],
                                                'Unidades1' => $item["Unidades1"],
                                                'Unidades2' => $item["Unidades2"],
                                            ];
                                            detalleTramitesSidit::insert($tempItem);
                                        }
                                        $response["Result"] = true;
                                        $response["Message"] = "Datos insertados con exito";
                                        DB::commit();
                                    } catch (\Exception $e) {
                                        DB::rollBack();
                                        $response["Result"] = false;
                                        $response["Message"] = "El procedimiento almacenado fallo con errores";
                                        $response["data"] = $e->getMessage();
                                        // Manejo de excepciones
                                    }
                                } else {
                                    $response["Result"] = false;
                                    $response["Message"] = "No se recibio la tabla detalle";
                                }
                            } else {
                                $response["Result"] = false;
                                $response["Message"] = "No se recibio la tabla general";
                            }
                            // $detalle = detalleTramitesSidit::where("id", (int)$objeto["Age"])->get();
                            // $response["data"] = $detalle;
                        } else if ($opcion === 2) {
                            //CONSULTA DE CLAVEZ CATASTRALES
                            $response["Result"] = true;
                            $response["Message"] = "Se consulto la clave catastral";
                            $detalle = ClavesCat::where("PRE_CVECATASTRAL", $objeto["ClaveCat"])->get();
                            $response["ClaveCat"] = $detalle[0];
                        } else if ($opcion === 3){
                            //CONSULTA DE DATOS A LA TABLA DE DETALLE DE PAGOS
                            $response["Result"] = true;
                            $response["Message"] = "Consulta a la tabla detalle de pagos concluida con exito";
                            $id = $objeto["idFolio"];

                            $detalle = detalleTramitesSidit::all();
                            $response["PV"] = $detalle;
                        } else if($opcion === 4){
                            //CONSULTA DE DATOS A LA TABLA DE PAGOS
                            $response["Result"] = true;
                            $response["Message"] = "Consulta Tabla General de pagos concluida con exito";
                            $id = $objeto["idFolio"];
                            
                            $detalle = tramitesSidit::all();
                            $response["VPG"] = $detalle;
                        } else if($opcion === 5){
                            //CONSULTA DE DATOS A LAS TABLAS DE PAGOS
                            $response["Result"] = true;
                            $response["Message"] = "Consulta completa de pagos concluida con exito";
                            $detalle1 = tramitesSidit::all();
                            $detalle2 = detalleTramitesSidit::all();
                            $response["VPG"] = $detalle1;
                            $response["PV"] = $detalle2;
                        } else if($opcion === 6){
                            // Consulta individual a tabla general por id del tramite
                            $response["Result"] = true;
                            $response["Message"] = "Consulta de pago general individual";
                            $detalle = tramitesSidit::where("idTramite", $objeto["id"])->get();
                            $response["VPG"] = $detalle;
                        } else if($opcion === 7){
                            // Consulta individual a tabla detalle por id del tramite
                            $response["Result"] = true;
                            $response["Message"] = "Consulta de pago general individual";
                            $detalle = detalleTramitesSidit::where("idTramite", $objeto["id"])->get();
                            $response["PV"] = $detalle;
                        } else if($opcion === 8){
                            DB::beginTransaction();
                            try {
                                $response["Result"] = true;
                                $response["Message"] = "Actualizacion a la tabla general exitosa";
                                $filasAct = tramitesSidit::where("id", $objeto["id"])->update([ "Estatus" => $objeto["Estatus"]]);
                                if ($filasAct > 0) {
                                    $response["Result"] = true;
                                    $response["Message"] = "Se actualizaron un total de: ".$filasAct;
                                    DB::commit();
                                } else {
                                    $response["Result"] = true;
                                    $response["Message"] = "No se actualizo ningun registro";
                                    DB::rollBack();
                                }
                            } catch (\Exception $e) {
                                DB::rollBack();
                                $response["Result"] = false;
                                $response["Message"] = $e->getMessage();
                            }
                        } else {
                            //RESPUESTA POR DEFECTO EN CASO DE NO ENCAJAR CON LAS OPCIONES
                            $response["Result"] = false;
                            $response["Message"] = "La opcion recibida es invalida";
                        }
                    } else {
                            $response["Result"] = false;
                            $response["Message"] = "No se recibio la opcion";
                    }
                } else {
                    $response["Result"] = false;
                    $response["Message"] = "La informacion recibida es ilegible";
                }
            } else {
                $response["Result"] = false;
                $response["Message"] = "La informacion recibida es invalida";
            }
        }
        catch (\Exception $ex) {
            $response["Result"] = false;
            $response["Message"] = "ERROR: 500";
            $response["data"] = $ex->getMessage().", ".$ex->getLine().", ".$ex->getFile();
        }
        return response()->json( $response );
    }
}