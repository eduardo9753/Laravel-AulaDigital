<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use App\Models\Resource;
use App\Models\Section;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ContentIA extends Component
{
    public $tema = '';                // Texto del input
    public $recomendacion = null;     // Resultado generado
    public $loading = false;          // Estado de carga
    public $sugerencias = [];         // Lista de sugerencias

    // Actualizar sugerencias al escribir
    public function updatedTema()
    {
        // No borrar la info si limpia el input
        if (strlen($this->tema) < 2) {
            $this->sugerencias = [];
            return;
        }

        // Buscar sugerencias
        $this->sugerencias = Section::where('name', 'like', "%{$this->tema}%")
            ->limit(5)
            ->get();
    }

    // ✅ Método que Livewire no encontraba antes
    public function seleccionarTema($id)
    {
        $seccion = Section::find($id);

        if (!$seccion) return;

        // Mostrar el nombre en el input
        $this->tema = $seccion->name;

        // Ocultar sugerencias
        $this->sugerencias = [];

        // Ejecutar automáticamente la generación
        $this->dispatchBrowserEvent('runGenerar', ['id' => $id]);

        // Quitar el foco del input
        $this->dispatchBrowserEvent('blurInput');
    }

    // Generar contenido
    public function generar($seccionId = null)
    {
        $this->loading = true;

        if ($seccionId) {
            $seccion = Section::find($seccionId);
            if ($seccion) {
                $this->tema = $seccion->name;
            }
            $this->sugerencias = [];
        } else {
            $seccion = Section::where('name', 'like', "%{$this->tema}%")->first();
        }

        if (!$seccion) {
            $this->recomendacion = ['error' => "No se encontró una sección relacionada con '{$this->tema}' 😢"];
            $this->loading = false;
            return;
        }

        // Obtener datos relacionados
        $videos = $seccion->lessons()->limit(5)->get();
        $pdfs = Resource::where('resourceable_type', 'App\\Models\\Lesson')
            ->whereIn('resourceable_id', $videos->pluck('id'))
            ->limit(5)
            ->get();
        $preguntas = $seccion->questions()->limit(5)->get();

        $descripcion = $seccion->description ?? 'Sin descripción disponible';

        // Prompt IA
        $prompt = "
Eres un tutor educativo experto de la plataforma PreuniCursos.
Genera un resumen motivador y didáctico con emojis y listas claras.

Tema: {$seccion->name}
Descripción: {$descripcion}

Videos: " . implode(', ', $videos->pluck('name')->toArray()) . "
PDFs: " . implode(', ', $pdfs->pluck('titulo')->toArray()) . "
Preguntas: " . implode(', ', $preguntas->pluck('titulo')->toArray()) . "
";

        // Llamada a OpenAI
        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un tutor educativo experto de PreuniCursos.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $textoIA = $response->json('choices.0.message.content') ?? 'No se pudo generar la recomendación.';

        // Guardar todo
        $this->recomendacion = [
            'texto' => $textoIA,
            'seccion' => $seccion,
            'videos' => $videos,
            'pdfs' => $pdfs,
            'preguntas' => $preguntas,
        ];

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.content-i-a');
    }
}
