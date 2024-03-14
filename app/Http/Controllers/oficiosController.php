<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\oficios;
use Illuminate\Support\Facades\Mail;

class oficiosController extends Controller
{
    public function pdf(Request $request){       
        try {
            $nombreArchivo ='/Oficio'.uniqid().time().'.pdf';
            $pdf = Pdf::loadView('oficio',compact('request'))->setPaper('a4', 'portrait')->save(public_path().$nombreArchivo);
            $envio = Mail::to($request->Correo)->send(new oficios($nombreArchivo));

            return 1;
        } catch (Exception $e) {
            return $e;
        }
    }
}
