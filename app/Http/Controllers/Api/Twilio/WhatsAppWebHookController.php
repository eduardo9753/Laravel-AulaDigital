<?php

namespace App\Http\Controllers\Api\Twilio;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\WhatsAppsSchedule;
use App\Models\WhatsAppsUserQuestionSchedule;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class WhatsAppWebHookController extends Controller
{
    //

    public function handle(Request $request)
    {
        Log::info("WebHook de WhatsApp recibido:", $request->all());

        $from = $request->input('From');  // Número del usuario
        $body = strtolower(trim($request->input('Body'))); // mensaje ej: hola
        $fromNumber = str_replace("whatsapp:+", "", $from);

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $fromTwilio  = env('TWILIO_WHATSAPP_FROM');

        $twilio = new Client($sid, $token);

        // Detectar si ya tenemos registro
        $schedule = WhatsAppsSchedule::firstOrCreate(['phone' => $fromNumber]);

        // MENSAJE FINAL
        $mensaje = "";

        // Test para enviar la pregunta
        if ($body === 'pregúntame' || $body === 'preguntame') {

            if ($schedule->day && $schedule->time) {
                $question = Question::inRandomOrder()->first();
                $answers = $question->answers;

                // Guardar la pregunta que se mandó al usuario
                WhatsAppsUserQuestionSchedule::updateOrCreate(
                    ['phone' => $fromNumber],
                    ['question_id' => $question->id]
                );

                $mensaje = "🧠 *Pregunta del día:*\n";
                $mensaje .= $this->formatForWhatsapp($question->titulo) . "\n\n";

                // Lista de respuestas
                foreach ($answers as $index => $answer) {
                    $mensaje .= ($index + 1) . ". " . $this->formatForWhatsapp($answer->titulo) . "\n";
                }
                $mensaje .= "\n📩 Responde con el número de la opción correcta (1-" . count($answers) . ")";

                // Si hay imagen en la pregunta
                preg_match('/<img.*?src=["\'](.*?)["\']/', $question->titulo, $matches);
                if (!empty($matches[1])) {
                    $urlImagen = $matches[1];
                    $twilio->messages->create($from, [
                        'from' => $fromTwilio,
                        'body' => "📷 Imagen asociada a la pregunta:",
                        'mediaUrl' => [$urlImagen]
                    ]);
                }
            } else {
                $mensaje = "⚠️ Antes de comenzar, por favor escribe *hola* para registrar tu día y hora preferidos.";
            }
        } elseif (preg_match('/^[1-5]$/', $body)) {
            $registro = WhatsAppsUserQuestionSchedule::where('phone', $fromNumber)->first();

            if ($registro && $registro->question_id) {
                $question = Question::find($registro->question_id);

                if ($question) {
                    $answers = $question->answers;
                    $respuestaUsuario = intval($body) - 1; // índice del array
                    $respuestaSeleccionada = $answers[$respuestaUsuario] ?? null;

                    if ($respuestaSeleccionada) {
                        if ($respuestaSeleccionada->es_correcta) {
                            $mensaje = "✅ ¡Correcto! 🎉\nHas elegido la opción correcta.";
                        } else {
                            $respuestaCorrecta = $answers->firstWhere('es_correcta', true);
                            $indexCorrecto = $answers->search($respuestaCorrecta) + 1;
                            $mensaje = "❌ Incorrecto.\nLa respuesta correcta era:\n{$indexCorrecto}. " . $this->formatForWhatsapp($respuestaCorrecta->titulo);
                        }

                        // Eliminar registro para que no se reutilice la misma pregunta
                        $registro->delete();
                    } else {
                        $mensaje = "⚠️ Opción no válida. Responde con un número entre 1 y " . count($answers) . ".";
                    }
                } else {
                    $mensaje = "⚠️ No se pudo encontrar la pregunta anterior. Escribe *pregúntame* para recibir una nueva.";
                }
            } else {
                $mensaje = "⚠️ No hay ninguna pregunta activa para ti. Escribe *pregúntame* para comenzar.";
            }
        } elseif ($body === 'hola' && $schedule->day && $schedule->time) {
            $mensaje = "👋 ¡Hola {$schedule->phone}! Bienvenido/a nuevamente al entrenamiento médico.\n\nTus datos ya están guardados. Escribe *pregúntame* para comenzar.";
        } elseif ($body === 'hola') {
            $mensaje = "👋 ¡Hola! Bienvenido/a al entrenamiento médico.\n\nPor favor responde con un *día de la semana* (ej: martes) en que desees recibir tus preguntas.";
        } elseif (!$schedule->day && in_array($body, ['lunes', 'martes', 'miércoles', 'miercoles', 'jueves', 'viernes', 'sábado', 'sabado', 'domingo'])) {
            $schedule->day = $body === 'miercoles' ? 'miércoles' : ($body === 'sabado' ? 'sábado' : $body);
            $schedule->save();

            $mensaje = "📅 Perfecto. Ahora por favor responde con una *hora* en formato 24h (ej: 14:30) en que deseas recibir las preguntas.";
        } elseif ($schedule->day && !$schedule->time && preg_match('/^\d{1,2}:\d{2}$/', $body)) {
            $schedule->time = $body;
            $schedule->save();

            $mensaje = "✅ Listo. Te enviaremos tu formulario cada *{$schedule->day}* a las *{$schedule->time}*. ¡Gracias!";
        } else {
            $mensaje = "⚠️ Por favor escribe 'hola' para comenzar, o sigue las instrucciones.";
        }

        // Enviar mensaje (partido en chunks si es largo)
        if (strlen($mensaje) > 1500) {
            $partes = str_split($mensaje, 1500);
            foreach ($partes as $parte) {
                $twilio->messages->create($from, [
                    'from' => $fromTwilio,
                    'body' => $parte
                ]);
            }
        } else {
            $twilio->messages->create($from, [
                'from' => $fromTwilio,
                'body' => $mensaje
            ]);
        }

        Log::info("Mensaje enviado a $from");
    }

    /**
     * Limpia HTML de CKEditor y lo convierte a formato WhatsApp
     */
    private function formatForWhatsapp($html)
    {
        // Permitimos solo etiquetas básicas
        $clean = strip_tags($html, "<b><strong><i><em><br><ul><li><img>");

        // Negritas y cursivas → WhatsApp
        $clean = str_replace(["<b>", "<strong>"], "*", $clean);
        $clean = str_replace(["</b>", "</strong>"], "*", $clean);
        $clean = str_replace(["<i>", "<em>"], "_", $clean);
        $clean = str_replace(["</i>", "</em>"], "_", $clean);

        // Saltos de línea
        $clean = preg_replace('/<br\s*\/?>/i', "\n", $clean);

        // Listas
        $clean = preg_replace('/<li>(.*?)<\/li>/', "- $1\n", $clean);
        $clean = str_replace(["<ul>", "</ul>"], "", $clean);

        // Quitar dobles espacios
        $clean = preg_replace('/\s+/', ' ', $clean);

        return trim($clean);
    }


    //BUSCANDO LAS PREGUNTAS CON SUS RESPUESTAS
    public function questions()
    {
        $question = Question::inRandomOrder()->first();
        //dd($question);
        $answers = $question->answers;
        //dd($answers);
        $mensaje = "Pregunta del día: \n";
        $mensaje .= $question->titulo . "\n\n";

        //dd('Pregunta: ', $mensaje);
        //lista respuestas
        foreach ($answers as $index => $answer) {
            $mensaje .= ($index + 1) . "." . $answer->titulo . "\n";
        }

        //qui guarda la lista del recorrido
        echo $mensaje .= "\n📩 Responde con el número de la opción correcta (1-5)";
    }
}
