<?php

namespace App\Http\Controllers\PagosEnLinea;

use App\Http\Controllers\Controller;

use App\Models\PagoEnLinea\PREDIAL_MOVS;
use App\Models\PagoEnLinea\PREDIAL;
use App\Models\PagoEnLinea\Predial_Pagado;
use App\Models\PagoEnLinea\Predial_PagosEnLinea;
use App\Models\PagoEnLinea\Predial_Afiliacion;
use App\Models\PagoEnLinea\Impuestos;
use App\Models\PagoEnLinea\predial_estadoscuenta;
use App\Models\PagoEnLinea\PAGPREDIAL;

use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\DB;

class PagoEnLineaController extends Controller
{
    public function getPMS_CVECATWhCveCat(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $claveCat = $dataRec["claveCat"];
                $list = PREDIAL::where('PRE_CVECATASTRAL', $claveCat)
                    ->get();
                $resArr['status'] = true;
                $resArr['message'] = 'Se encontraron un total de: ' . count($list) . "datos";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function GetPREDIALWhCveCat(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $claveCat = $dataRec["claveCat"];
                $list = PREDIAL_MOVS::where('PMS_CVECAT', $claveCat)
                    ->get();
                $resArr['status'] = true;
                $resArr['message'] = 'Se encontraron un total de: ' . count($list) . "datos";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function spPredial_Calculo3(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $CVECat = $dataRec["claveCat"];
                $FechaHOYV = $dataRec["fecha"];
                $list = DB::connection('sql_pagos_en_linea')->select("EXEC [dbo].[spPredial_Calculo3] @CVECat = ?, @FechaHOYV = ?", array($CVECat, $FechaHOYV));
                $resArr['status'] = true;
                $resArr['message'] = "Se ejecuto el procedimiento almacenado";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function spPredial_GuardaInfConsultaInternet(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $claveCat = $dataRec["claveCat"];
                $nombre = $dataRec["nombre"];
                $correo = $dataRec["correo"];
                $telefono = $dataRec["telefono"];
                $list =  DB::connection('sql_pagos_en_linea')->statement("EXEC [dbo].[spPredial_GuardaInfConsultaInternet] @cve_catastral = ?, @nombre = ?, @correo = ?, @telefono = ?", array($claveCat, $nombre, $correo, $telefono));
                $resArr['status'] = true;
                $resArr['message'] = "Se jecuto el procedimiento almacenado";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function spPredial_EdoCta(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $claveCat = $dataRec["claveCat"];
                $fecha = $dataRec["fecha"];
                $usuario = $dataRec["usuario"];
                $folio = $dataRec["folio"];
                $list =  DB::connection('sql_pagos_en_linea')->select("EXEC [dbo].[spPredial_EdoCta] @cvecat = ?, @fechahoy = ?, @usuario = ?, @vfolio = ?", [$claveCat, $fecha, $usuario, $folio]);
                $resArr['status'] = true;
                $resArr['message'] = "Se ejecuto el procedimiento alamacenado";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function GetPredPagWhCveCatDate(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $claveCat = $dataRec["claveCat"];
                $year = $dataRec["year"];
                $list = Predial_Pagado::where('cvecat', $claveCat)
                    ->whereYear('fecha', $year)
                    ->get();
                $resArr['status'] = true;
                $resArr['message'] = 'Se encontraron un total de: ' . count($list) . "datos";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function GetPagoEnLineaCveCatTrans(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $claveCat = $dataRec["claveCat"];
                $id_trans = $dataRec["id_trans"];
                $list = Predial_PagosEnLinea::where('cve_catastral', $claveCat)
                    ->where('id_trans', $id_trans)
                    ->get();
                $resArr['status'] = true;
                $resArr['message'] = 'Se encontraron un total de: ' . count($list) . "datos";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function GetPredialAfiliacionAfi(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $afiliacion = $dataRec["afiliacion"];
                $list = Predial_Afiliacion::where('afiliacion', $afiliacion)
                    ->where('afiliacion', $afiliacion)
                    ->get();
                $resArr['status'] = true;
                $resArr['message'] = 'Se encontraron un total de: ' . count($list) . "datos";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function insertPagosEnLinea(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $tempItem = [
                    'id_trans' => $dataRec['id_trans'],
                    'cve_catastral' => $dataRec['cve_catastral'],
                    'folio_edocta' => $dataRec['folio_edocta'],
                    'fecha_envio' => $dataRec['fecha_envio'],
                    'fecha_pago' => $dataRec['fecha_pago'],
                    'estatus' => $dataRec['estatus'],
                    'importe' => $dataRec['importe'],
                    'servicio' => $dataRec['servicio'],
                    'referencia' => $dataRec['referencia'],
                    'tc' => $dataRec['tc'],
                    'tipo_tc' => $dataRec['tipo_tc'],
                    'expira' => $dataRec["expira"],
                    'Cod_Seg' => $dataRec['Cod_Seg'],
                ];
                Predial_PagosEnLinea::insert($tempItem);
                $resArr['status'] = true;
                $resArr['message'] = "Se realizo el insert";
                $resArr["data"] = $tempItem;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function UpdateEdoCuentaEstatus(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $edocta_folio = $dataRec["edocta_folio"];
                $tempItem = [
                    'edocta_estatus' => $dataRec['edocta_estatus'],
                ];
                predial_estadoscuenta::where('edocta_folio', $edocta_folio)
                    ->update($tempItem);
                $resArr['status'] = true;
                $resArr['message'] = "Se realizo el update";
                $resArr["data"] = $tempItem;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function GetImpuestosCveCat(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $imp_cveCat = $dataRec["imp_cveCat"];
                $list = Impuestos::where('imp_cveCat', $imp_cveCat)
                    ->get();
                $resArr['status'] = true;
                $resArr['message'] = 'Se encontraron un total de: ' . count($list) . "datos";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function GetPredEdCFolio(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $edocta_folio = $dataRec["edocta_folio"];
                $list = predial_estadoscuenta::where('edocta_folio', $edocta_folio)
                    ->get();
                $resArr['status'] = true;
                $resArr['message'] = 'Se encontraron un total de: ' . count($list) . "datos";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function GetPagoEnLineaFolio(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $folio_edocta = $dataRec["folio_edocta"];
                $list = Predial_PagosEnLinea::where('folio_edocta', $folio_edocta)
                    ->get();
                $resArr['status'] = true;
                $resArr['message'] = 'Se encontraron un total de: ' . count($list) . "datos";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    public function GetPAGPREDIALCveCat(Request $request, Response $response)
    {
        $resArr = array(
            "status" => false,
            "message" => "Default Message",
            "log" => "",
            "data" => array(),
            "recive" => array(),
        );
        try {
            $dataSend = json_decode($request->getContent(), true);
            if (isset($dataSend)) {
                $dataRec = $dataSend["data"];
                $resArr["recive"] = $dataRec;
                $CVECATASTRAL = $dataRec["CVECATASTRAL"];
                $list = PAGPREDIAL::where('CVECATASTRAL', $CVECATASTRAL)
                    ->get();
                $resArr['status'] = true;
                $resArr['message'] = 'Se encontraron un total de: ' . count($list) . "datos";
                $resArr["data"] = $list;
            } else {
                $resArr['message'] = "No se recibio la informacion necesaria para los datos";
            }
        } catch (Exception $e) {
            $resArr['message'] = "Ha ocurrido un error imesperado";
            $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
        }
        return json_encode($resArr);
    }

    // public function spObtenFolioPagoe(Request $request, Response $response)
    // {
    //     $resArr = array(
    //         "status" => false,
    //         "message" => "Default Message",
    //         "log" => "",
    //         "data" => array(),
    //         "recive" => array(),
    //     );
    //     try {
    //         $dataSend = json_decode($request->getContent(), true);
    //         if (isset($dataSend)) {
    //             $dataRec = $dataSend["data"];
    //             $resArr["recive"] = $dataRec;
    //             $Foliopago = $dataRec["Foliopago"];
    //             $list = DB::connection('sql_pagos_en_linea')->statement("EXEC [dbo].[spObtenFolioPagoe] @Foliopago = ?", array($Foliopago));
    //             $resArr['status'] = true;
    //             $resArr['message'] = "Se ejecuto el procedimiento almacenado";
    //             $resArr["data"] = $list;
    //         } else {
    //             $resArr['message'] = "No se recibio la informacion necesaria para los datos";
    //         }
    //     } catch (Exception $e) {
    //         $resArr['message'] = "Ha ocurrido un error imesperado";
    //         $resArr["log"] = "Mensaje de error: " . $e->getMessage() . "; Linea; " . $e->getLine() . "; Archivo: " . $e->getFile() . ".";
    //     }
    //     return json_encode($resArr);
    // }
}
