<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use App\Models\Resource;
use App\Models\Section;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ContentIA extends Component
{
    public $tema = '';                // Lo que escribe el usuario
    public $recomendacion = null;     // Resultado final con IA
    public $loading = false;          // Indicador de carga
    public $sugerencias = [];         // Autocompletado de secciones

    // Se ejecuta automáticamente al actualizar $tema
    public function updatedTema()
    {
        // Limpiar resultados anteriores cuando el usuario borra o escribe
        $this->recomendacion = null;

        if (strlen($this->tema) < 2) {
            $this->sugerencias = [];
            return;
        }

        $this->sugerencias = Section::where('name', 'like', "%{$this->tema}%")
            ->limit(5)
            ->get();
    }

    // Generar recomendación al hacer click
    public function generar($seccionId = null)
    {
        $this->loading = true;

        // Si se pasa un ID, se busca esa sección; si no, se busca por el texto
        if ($seccionId) {
            $seccion = Section::find($seccionId);
        } else {
            $seccion = Section::where('name', 'like', "%{$this->tema}%")->first();
        }

        if (!$seccion) {
            $this->recomendacion = ['error' => "No se encontró una sección relacionada con '{$this->tema}' 😢"];
            $this->loading = false;
            return;
        }

        // Traer lecciones (videos)
        $videos = $seccion->lessons()->limit(5)->get();

        // Traer PDFs
        $pdfs = Resource::where('resourceable_type', 'App\Models\Lesson')
            ->whereIn('resourceable_id', $videos->pluck('id'))
            ->limit(5)
            ->get();

        // Traer preguntas
        $preguntas = $seccion->questions()->limit(5)->get();

        // Preparar prompt para IA
        $descripcion = $seccion->description ?? 'Sin descripción disponible';

        $prompt = "
Eres un tutor educativo experto en preparación preuniversitaria usando la plataforma PreuniCursos. 
Todo el material es auténtico de CEPREVI, para el examen de admisión de la UNFV.

Genera un resumen y recomendaciones para el estudiante de forma clara, didáctica y motivadora.

Por favor:
- Usa emojis en títulos, subtítulos y listas.
- Mantén bloques de texto separados por saltos de línea.
- Usa guiones '-' para listas.
- Usa números '1., 2., 3.' para listas ordenadas.
- No uses Markdown con #, **, _, etc.
- Mantén los párrafos y bloques legibles.

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

        // Guardar todo para la vista
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
