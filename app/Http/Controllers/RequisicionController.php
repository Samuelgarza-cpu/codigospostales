<?php

namespace App\Http\Controllers;

use App\Models\Requisicion;
use App\Models\Notificacion;
use Illuminate\Http\Request;
// use Carbon\Carbon;
use App\Mail\Correos;
use Illuminate\Support\Facades\Mail;

class RequisicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Requisicion::join('Cat_Departamentos', 'Requisiciones.IDDepartamento', '=', 'Cat_Departamentos.IDDepartamento')
            ->leftjoin('Det_Notificaciones', 'Requisiciones.IDRequisicion', '=', 'Det_Notificaciones.idRequisicion')
            ->where("ejercicio", 2023)->where("Status", "OC")->orderBy('Requisiciones.IDRequisicion', 'desc')->get(['Requisiciones.IDRequisicion', 'Ejercicio', 'Status', 'Nombre_Departamento', 'Solicitante', 'Observaciones', 'Requisitor', 'FechaCotizacion', 'Det_Notificaciones.notificacion']);
    }

    public function store(Request $request)
    {
        $idDepartamento = $request->idDep;
        $notificacion = new Notificacion;
        $notificacion->idRequisicion = $request->idRequi;
        $notificacion->notificacion = 1;
        $notificacion->fechaNotificacion = $request->fechaRegistro;
        $notificacion->usuarioNotificacion = $request->usuario;
        $notificacion->activo = 1;
        $notificacion->save();
        // $array = ['nestorpuentesin@gmail.com','samuelgarza1029@gmail.com', 'rocior@hotmail.com'];

        // foreach ( $array as $value) {

        //     Mail::to($value)->send(new Correos($request));
        // }

        Mail::to('samuel.garza29@hotmail.com')->send(new Correos($request));


        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requisicion  $requisicion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $requi)
    {
        function consulta($idD){

            return Requisicion::join('Cat_Departamentos', 'Requisiciones.IDDepartamento', '=', 'Cat_Departamentos.IDDepartamento')
            ->leftjoin('Det_Notificaciones', 'Requisiciones.IDRequisicion', '=', 'Det_Notificaciones.idRequisicion')
            ->where("ejercicio", 2023)
            ->where("Status", "OC")
            ->where("Requisiciones.IDDepartamento", "$idD")
            ->orderBy('Requisiciones.IDRequisicion', 'desc')
            ->get(['Requisiciones.IDDepartamento','Requisiciones.IDRequisicion', 'Ejercicio', 'Status', 'Nombre_Departamento', 'Solicitante', 'Observaciones', 'Requisitor', 'FechaCotizacion', 'Det_Notificaciones.notificacion']);

        }
        switch ($requi) {
            case 35:

                return consulta("54");
                break;
            case 36:

                return consulta("53");
                break;
            case 37:

                return consulta("64");

                break;
            case 38:

                return consulta("83");

                break;

            default:
            return Requisicion::join('Cat_Departamentos', 'Requisiciones.IDDepartamento', '=', 'Cat_Departamentos.IDDepartamento')
            ->leftjoin('Det_Notificaciones', 'Requisiciones.IDRequisicion', '=', 'Det_Notificaciones.idRequisicion')
            ->where("ejercicio", 2023)
            ->where("Status", "OC")
            ->orderBy('Requisiciones.IDRequisicion', 'desc')
            ->get(['Requisiciones.IDDepartamento','Requisiciones.IDRequisicion', 'Ejercicio', 'Status', 'Nombre_Departamento', 'Solicitante', 'Observaciones', 'Requisitor', 'FechaCotizacion', 'Det_Notificaciones.notificacion']);
                break;

        }



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Requisicion  $requisicion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requisicion  $requisicion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
