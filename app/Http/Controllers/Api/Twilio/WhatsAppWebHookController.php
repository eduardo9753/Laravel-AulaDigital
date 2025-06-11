<?php

namespace App\Http\Controllers\Api\Twilio;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppsSchedule;
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
        $fromNumber = str_replace("whatsapp:+", "", $from);

        //solo si dice hola, responder con bienvenida

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $fromTwilio  = env('TWILIO_WHATSAPP_FROM');

        $twilio = new Client($sid, $token);

        //detectar si ya tenemos registro
        $schedule = WhatsAppsSchedule::firstOrCreate(['phone' => $fromNumber]);

        //si dice "hola" le respondemos esto
        if (preg_match('/^hola+$/', $body)) {
            $mensaje = "👋 ¡Hola! Bienvenido/a al entrenamiento médico. 
                            Por favor responde con un *día de la semana* 
                            (ej: martes) en que desees recibir tus preguntas.";

            //pasa al siguiente validamos que no tenga dia registrada , cuando el usuario pone el dia validamos y guardamos                
        } elseif (!$schedule->day && in_array($body, ['lunes', 'martes', 'miércoles', 'miercoles', 'jueves', 'viernes', 'sábado', 'sabado', 'domingo'])) {
            $schedule->day = $body === 'miercoles' ? 'miércoles' : ($body === 'sabado' ? 'sábado' : $body);
            $schedule->save();

            //enviamos el mensaje para la siguiente condicional
            $mensaje = "📅 Perfecto. Ahora por favor responde con una *hora* en formato 24h (ej: 14:30) en que deseas recibir las preguntas.";
        } elseif ($schedule->day && !$schedule->time && preg_match('/^\d{1,2}:\d{2}$/', $body)) {
            $schedule->time = $body;
            $schedule->save();

            //enviamos el mesaje con los datos ya guardados en la base de datos
            $mensaje = "✅ Listo. Te enviaremos tu formulario cada *{$schedule->day}* a las *{$schedule->time}*. ¡Gracias!";
        } else {
            //si no le mandamos todo los pasos devuelta
            $mensaje = "⚠️ Por favor escribe 'hola' para comenzar, o sigue las instrucciones.";
        }

        $twilio->messages->create($from, [
            'from' => $fromTwilio,
            'body' => $mensaje
        ]);

        Log::info("Mensaje de bienvenida enviado a $from");
    }
}
