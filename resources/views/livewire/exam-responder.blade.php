<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="lead"><strong>Duración</strong></h1>
                <p id="tiempoRestante" class="color-general" style="font-size: 30px">
                    <strong>{{ $exam->duracion }} minutos</strong>
                </p>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="lead"><strong>Preguntas</strong></h1>
                <p class="color-general" style="font-size: 30px">
                    <strong>({{ $totalQuestions }})</strong>
                </p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="submitExam">
                <div>
                    <h2 class="mb-3">{!! $currentQuestion->question->titulo !!}</h2>
                    <ul>
                        @foreach ($currentQuestion->question->answers as $respuesta)
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="marcar_{{ $currentQuestion->question->id }}"
                                        id="marcar_{{ $currentQuestion->question->id }}_{{ $respuesta->id }}"
                                        wire:model="respuestasSeleccionadas.{{ $currentQuestion->question->id }}"
                                        value="{{ $respuesta->id }}">

                                    <label class="form-check-label"
                                        for="marcar_{{ $currentQuestion->question->id }}_{{ $respuesta->id }}">
                                        {{ $respuesta->titulo }}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    @error("respuestasSeleccionadas.{$currentQuestion->question->id}")
                        <span class="text-danger">Elija una respuesta</span>
                    @enderror
                </div>

                <div class="d-flex mt-4">
                    @if ($currentQuestionIndex > 0)
                        <button type="button" class="btn btn-primary mr-2" wire:click="previousQuestion">Anterior</button>
                    @endif

                    @if ($currentQuestionIndex < $totalQuestions - 1)
                        <button type="button" class="btn btn-danger" wire:click="nextQuestion">Siguiente</button>
                    @else
                        <button type="submit" class="btn btn-success">Culminar Examen</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @section('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                var tiempoRestante = {{ $exam->duracion * 60 }};
                var tiempoMostrar = document.getElementById('tiempoRestante');

                function actualizarTiempo() {
                    var minutos = Math.floor(tiempoRestante / 60);
                    var segundos = tiempoRestante % 60;
                    tiempoMostrar.innerHTML = "<strong>" + minutos + "m " + segundos + "s</strong>";

                    if (tiempoRestante <= 0) {
                        Livewire.emit('tiempoFuera');
                    } else {
                        tiempoRestante--;
                        setTimeout(actualizarTiempo, 1000);
                    }
                }

                actualizarTiempo();
            });
        </script>
    @endsection
</div>
