<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use App\Models\Question;
use App\Models\Resource;
use App\Models\Section;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ContentIA extends Component
{
    public $tema = '';       // texto que escribe el usuario
    public $resultado = [];  // donde se guardan los resultados

    public function buscar()
    {
        // Buscar la sección que coincida con el tema ingresado
        $seccion = Section::where('name', 'like', "%{$this->tema}%")->first();

        if (!$seccion) {
            $this->resultado = [
                'error' => "No se encontró una sección relacionada con '{$this->tema}' 😢"
            ];
            return;
        }

        // Traer las lecciones (videos)
        $videos = $seccion->lessons()->limit(5)->get();

        // Traer los PDFs relacionados con esas lecciones
        $pdfs = Resource::where('resourceable_type', 'App\Models\Lesson')
            ->whereIn('resourceable_id', $videos->pluck('id'))
            ->limit(5)
            ->get();

        // Traer las preguntas relacionadas
        $preguntas = $seccion->questions()->limit(5)->get();

        // (Luego aquí puedes integrar una llamada a la IA real)
        $textoIA = "🧠 **Resumen generado por IA**
        El tema *{$seccion->name}* aborda conceptos clave y ejemplos prácticos.
        A continuación te presentamos videos, PDFs y preguntas para reforzar tu aprendizaje.";

        // Guardar todo en resultado
        $this->resultado = [
            'texto' => $textoIA,
            'seccion' => $seccion,
            'videos' => $videos,
            'pdfs' => $pdfs,
            'preguntas' => $preguntas,
        ];
    }

    public function render()
    {
        return view('livewire.content-i-a');
    }
}
