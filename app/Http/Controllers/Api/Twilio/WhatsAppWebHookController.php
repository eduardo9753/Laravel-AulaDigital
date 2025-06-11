<?php

namespace App\Http\Controllers\Api\Twilio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class WhatsAppWebHookController extends Controller
{
    //

    public function handle(Request $request)
    {
        Log::info("WebHook de WhatsAppm recibido:", $request->all());

        $from = $request->input('From');  //numero del usuario
        $body = strtolower(trim($request->input('Body'))); //mensaje ej: hola

        //solo si dice hola, responder con bienvenida
        if ($body === 'hola') {
            $sid = env('TWILIO_SID');
            $token = env('TWILIO_AUTH_TOKEN');
            $fromTwilio  = env('TWILIO_WHATSAPP_FROM');

            $twilio = new Client($sid, $token);

            $mensaje = "👋 ¡Hola! Bienvenido/a al entrenamiento médico. 
                            Por favor responde con un *día de la semana* 
                            (ej: martes) en que desees recibir tus preguntas.";

            $twilio->messages->create($from, [
                'from' => $fromTwilio,
                'body' => $mensaje
            ]);

            Log::info("Mensaje de bienvenida enviado a $from");
        }
    }
}
