<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class enviarwaController extends Controller
{
    public function index(){

    }
     public function store(){

        try{
            $token = 'EAAK62RGI82sBAAjmNl1LZCueONETo4MD09UUtXll82gcRw4uTZBjgQqvQ3oblu8s18WtMTgbQT62GZCF5wiKhIkqO37ZA4pLrfw9dZAfBWXqsCFlZC0fDRiSytm80s5orBmWiNdc0OJD40KceQIDY7xx0jDqWpZBLBESfuzMZBqORa7f6WiW0jFZBlAXXXxOK7ZCR3rbuwLYEvFgZDZD';
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer EAAK62RGI82sBAAjmNl1LZCueONETo4MD09UUtXll82gcRw4uTZBjgQqvQ3oblu8s18WtMTgbQT62GZCF5wiKhIkqO37ZA4pLrfw9dZAfBWXqsCFlZC0fDRiSytm80s5orBmWiNdc0OJD40KceQIDY7xx0jDqWpZBLBESfuzMZBqORa7f6WiW0jFZBlAXXXxOK7ZCR3rbuwLYEvFgZDZD'
                ];
                $body = '{
                "messaging_product": "whatsapp",
                "to": "528713307800",
                "type": "template",
                "template": {
                    "name": "hello_world",
                    "language": {
                    "code": "en_US"
                    }
                }
                }';
 
            $payload = [
            'messaging_product' =>'whatsapp',
            'to'=>'528713307800',
            'type'=>'template',
            'template'=> [
                'name'=>'hello_world',
                'language'=> [
                    'code'=>'en_US'
                                ]
                          ]

                ];

      
                $response = Http::timeout(10)->post("https://graph.facebook.com/v17.0/115027494955174/messages",$headers,$payload);
     

                return response()->json([
                    'Mensaje' => true,
                    'data' => $response
                ],200);


        }catch(Exception $err){

            return response()->json([
                'Mensaje' => false,
                'data' => $err->getMessage()
            ],500);




        }
             
              
     }

     public function notificacion(){

                }
}
