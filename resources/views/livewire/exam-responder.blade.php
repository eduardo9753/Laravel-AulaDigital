<div>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="lead"><strong>Duración Estimada</strong></h1>
        <p id="tiempoRestante" class="color-general"><strong>{{ $exam->duracion }} minutos</strong></p>
    </div>


    <form wire:submit.prevent="culminarExamen">
        <div id="accordionExample">
            <div class="row">
                @foreach ($examenes as $index => $examen)
                    <div class="col-md-12 my-2">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $examen->question->id }}">
                                <div class="d-flex justify-content-between align-items-center gap-1">
                                    <button
                                        class="accordion-button {{ in_array($examen->question->id, $openedAccordions) ? '' : 'collapsed' }}"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $examen->question->id }}"
                                        aria-expanded="{{ in_array($examen->question->id, $openedAccordions) ? 'true' : 'false' }}"
                                        aria-controls="collapse{{ $examen->question->id }}"
                                        wire:click.prevent="toggleAccordion({{ $examen->question->id }})">
                                        {{ $examen->question->titulo }}
                                    </button>

                                    <div>
                                        <button class="mi-boton general btn-sm"> <strong>({{ $examen->question->puntos }})</strong></button>
                                    </div>
                                </div>
                            </h2>

                            <div id="collapse{{ $examen->question->id }}"
                                class="accordion-collapse collapse {{ in_array($examen->question->id, $openedAccordions) ? 'show' : '' }}"
                                aria-labelledby="heading{{ $examen->question->id }}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul>
                                        @foreach ($examen->question->answers as $respuesta)
                                            <input type="text" value="{{ $respuesta->id }}" hidden>

                                            <li class="d-flex justify-content-between align-items-center my-1">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <i class='bx bx-registered'
                                                        style='color:#4b22f4 ; font-size: 22px'></i>
                                                    <p class="temario-parrafo">{{ $respuesta->titulo }}</p>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="marcar_{{ $examen->question->id }}"
                                                        id="marcar_{{ $examen->question->id }}_{{ $respuesta->id }}"
                                                        wire:model="respuestasSeleccionadas.{{ $examen->question->id }}"
                                                        value="{{ $respuesta->id }}">

                                                    <label class="form-check-label"
                                                        for="marcar_{{ $examen->question->id }}_{{ $respuesta->id }}">
                                                        Marcar
                                                    </label>

                                                    @error("respuestasSeleccionadas.{$examen->question->id}")
                                                        <span class="text-danger">elija una respuesta</span>
                                                    @enderror
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <button class="mi-boton rojo mt-5 w-100" wire:click="culminarExamen" wire:loading.attr="disabled"
                :disabled="$botonDesactivado">
                Culminar Examen
            </button>
        </div>
    </form>

    @section('scripts')
        <script>
            document.addEventListener('livewire:load', function() {
                var tiempoRestante = {{ $exam->duracion * 60 }}; // Convertir minutos a segundos
                var tiempoMostrar = document.getElementById('tiempoRestante');

                function actualizarTiempo() {
                    var minutos = Math.floor(tiempoRestante / 60);
                    var segundos = tiempoRestante % 60;
                    tiempoMostrar.innerHTML = "<strong>" + minutos + "m " + segundos + "s</strong>";

                    if (tiempoRestante <= 0) {
                        console.log("Tiempo llegó a cero. Emitiendo evento tiempoFuera...");
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
