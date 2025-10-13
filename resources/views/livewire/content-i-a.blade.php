<div class="card shadow-lg border-0 rounded-4 p-4">
    <div class="d-flex align-items-center mb-3">
        <div class="bg-opacity-10 p-3 rounded-circle me-3">
            <i class="bx bx-brain text-primary fs-3" style="font-size: 75px"></i>
        </div>
        <h4 class="fw-bold text-primary mb-0">Creador de Contenido con IA</h4>
    </div>

    <p class="text-muted mb-4">
        Potencia tu aprendizaje con nuestra <strong>IA Educativa de PreuniCursos</strong> 🤖.
        Escribe un tema y genera automáticamente <strong>material explicativo, videos, PDFs y preguntas de
            práctica</strong>.
    </p>

    {{-- Input con autocompletado --}}
    <div class="input-group input-group-lg mb-4 position-relative">
        <input type="text" wire:model.debounce.500ms="tema" wire:keydown.enter="generar"
            class="form-control border-primary-subtle" placeholder="Ejemplo: Ecología, Triángulos, Reacciones químicas">

        {{-- Lista de sugerencias --}}
        @if (!empty($sugerencias))
            <ul class="list-group position-absolute w-100 shadow" style="z-index: 999; top: 100%;">
                @foreach ($sugerencias as $s)
                    <li class="list-group-item list-group-item-action" wire:click="seleccionarTema({{ $s->id }})"
                        style="cursor:pointer;">
                        {{ $s->name }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Indicador de carga --}}
    <div wire:loading wire:target="generar" class="text-center py-4">
        <div class="spinner-border text-primary mb-2" role="status"></div>
        <p class="text-muted fw-semibold">Generando contenido educativo...</p>
    </div>

    {{-- Resultados --}}
    @if (isset($recomendacion['error']))
        <div class="alert alert-warning mt-3 rounded-3">
            <i class="bx bx-error-circle me-2"></i> {{ $recomendacion['error'] }}
        </div>
    @elseif(!empty($recomendacion))
        <div class="mt-4">
            {{-- Resumen IA --}}
            <h5 class="fw-bold text-primary mb-3 d-flex align-items-center">
                <i class="bx bx-book-content me-2"></i> Resumen del tema
            </h5>
            <div class="border rounded-3 p-3 mb-4">
                <p class="mb-0" style="white-space: pre-line;">{{ $recomendacion['texto'] }}</p>
            </div>

            {{-- VIDEOS --}}
            @if (!empty($recomendacion['videos']) && count($recomendacion['videos']) > 0)
                <h6 class="fw-bold text-dark d-flex align-items-center mb-2">
                    <i class="bx bx-play-circle text-danger me-2"></i> Videos recomendados
                    <span class="badge bg-danger-subtle text-danger ms-2">{{ $recomendacion['videos']->count() }}</span>
                </h6>
                <div class="row">
                    @foreach ($recomendacion['videos'] as $video)
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm rounded-3 h-100">
                                @php
                                    preg_match('/embed\/([a-zA-Z0-9_-]+)/', $video->iframe, $matches);
                                    $youtubeId = $matches[1] ?? null;
                                @endphp
                                @if ($youtubeId)
                                    <div class="plyr__video-embed">
                                        <iframe
                                            src="https://www.youtube.com/embed/{{ $youtubeId }}?rel=0&modestbranding=1"
                                            allowfullscreen allow="autoplay" style="width: 100%; height: 400px;">
                                        </iframe>
                                    </div>
                                @else
                                    <small class="text-muted">Video no disponible.</small>
                                @endif
                                <div class="card-body">
                                    <h6 class="fw-semibold text-dark">{{ $video->name }} - {{ $video->section->name }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- PDFs --}}
            @if (!empty($recomendacion['pdfs']) && count($recomendacion['pdfs']) > 0)
                <h6 class="fw-bold text-dark d-flex align-items-center mt-4 mb-2">
                    <i class="bx bx-file text-success me-2"></i> Material en PDF
                    <span class="badge bg-success-subtle text-success ms-2">{{ $recomendacion['pdfs']->count() }}</span>
                </h6>
                <div class="list-group mb-3">
                    @foreach ($recomendacion['pdfs'] as $pdf)
                        <a href="{{ $pdf->url }}" target="_blank"
                            class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bx bx-file-blank fs-4 text-success me-2"></i>
                            <span>{{ $pdf->titulo ?? 'Ver PDF' }}</span>
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- PREGUNTAS --}}
            @if (!empty($recomendacion['preguntas']) && count($recomendacion['preguntas']) > 0)
                <h6 class="fw-bold text-dark d-flex align-items-center mt-4 mb-2">
                    <i class="bx bx-help-circle text-info me-2"></i> Preguntas de práctica
                    <span class="badge bg-info-subtle text-info ms-2">{{ $recomendacion['preguntas']->count() }}</span>
                </h6>
                <ul class="list-group">
                    @foreach ($recomendacion['preguntas'] as $pregunta)
                        <div class="mb-4 p-3 border rounded shadow-sm bg-white">
                            <div class="fw-semibold text-dark mb-2">🧩 Pregunta</div>
                            <div class="fs-5" style="line-height: 1.6;">{!! $pregunta->titulo !!}</div>
                            @if ($pregunta->comentario)
                                <div class="mt-2 text-muted fst-italic small">
                                    💬 {{ $pregunta->comentario }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif

    @section('scripts')
        <script src="{{ asset('js/visitador/plyr/plyr-content-i-a.js') }}"></script>

        <script>
            // Quitar foco del input
            window.addEventListener('blurInput', () => {
                const input = document.querySelector('input[wire\\:model]');
                if (input) input.blur();
            });

            // Ejecutar generación en segundo plano SIN esperar a Livewire
            window.addEventListener('runGenerar', e => {
                Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id'))
                    .call('generar', e.detail.id);
            });
        </script>
    @endsection
</div>
