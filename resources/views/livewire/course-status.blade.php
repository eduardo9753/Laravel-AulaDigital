<div class="mt-5">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="" id="curso-status">
        <div class="row">
            <div class="col-md-8 mb-2">
                <!-- Plyr Video Embed -->
                <div class="plyr__video-embed" id="player">
                    <iframe src="https://www.youtube.com/embed/{{ $current->iframe }}" allowfullscreen allowtransparency
                        allow="autoplay"></iframe>
                </div>

                <h1 class="color-general curso-status-title">{{ $current->name }}</h1>




                {{-- NAVEGACiON DE LECCIONES --}}
                <div class="mt-3 d-flex justify-content-between">
                    @if ($this->index == 0)
                        <a class="mi-boton azul" wire:click="changeLesson({{ $current }})">Primero</a>
                    @else
                        <a class="mi-boton general" wire:click="changeLesson({{ $this->previous }})">Anterior</a>
                    @endif

                    @if ($this->next)
                        <a class="mi-boton general" wire:click="changeLesson({{ $this->next }})">Siguiente</a>
                    @else
                        <a class="mi-boton rojo" wire:click="changeLesson({{ $current }})">Último</a>
                    @endif
                </div>
                {{-- NAVEGACiON DE LECCIONES --}}


                {{-- DESCRIPCION DE LA LECCION --}}
                @if ($current->description)
                    <!-- Button trigger modal -->
                    <button type="button" class="mi-boton azul mt-3" data-bs-toggle="modal"
                        data-bs-target="#ModalMaterialReferencia">
                        Referencia del Material:
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalMaterialReferencia" tabindex="-1"
                        aria-labelledby="ModalMaterialReferenciaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ModalMaterialReferenciaLabel">Referencia del
                                        Material:</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                <strong>Referencia del Material:</strong>
                                                <p>
                                                    Universidad Nacional Federico Villarreal. (2018).
                                                    {{ $course->title }}.
                                                    <strong>Recuperado de:</strong>
                                                    <a target="_blank" href="{{ $current->description->name }}"
                                                        title="{{ $current->description->name }}">
                                                        {{ $current->description->name }}
                                                    </a>
                                                </p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- DESCRIPCION DE LA LECCION --}}


                {{-- RECURSOS DE LA LECCION --}}
                @if ($current->resource)
                    <iframe style="width: 100%;height: 550px;" src="{{ $current->resource->url }}"
                        title="W3Schools Free Online Web Tutorials">
                    </iframe>
                @endif
                {{-- RECURSOS DE LA LECCION --}}

            </div>


            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body">
                        <h1 class="lead mb-3 color-general curso-status-title">Curso de {{ $course->title }}</h1>

                        {{-- BARRA DE PROGRESO --}}
                        <div class="d-flex justify-content-between">
                            <p class="text-success"><strong>{{ $this->advance . '%' }}</strong> Completado</p>

                            {{-- MARCAR COMO CULMINADA LA LECCION --}}
                            <div class="d-flex align-items-center cursor" wire:click="completed">
                                @if ($current->completed)
                                    <i class='bx bxs-toggle-right'
                                        style='color:rgb(52, 152, 219);  font-size: 28px'></i>
                                    <p class="cursor-status" style='font-size: 18px'>culminado</p>
                                @else
                                    <i class='bx bx-toggle-left' style="font-size: 28px"></i>
                                    <p class="cursor-status" style='font-size: 18px'>culminar</p>
                                @endif
                            </div>
                            {{-- MARCAR COMO CULMINADA LA LECCION --}}
                        </div>
                        <div class="progress mt-2" style="width: 100% !important;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $this->advance . '%' }}"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        {{-- BARRA DE PROGRESO --}}


                        {{-- INPRIMIENDO LAS SECCIONES DE LOS CURSOS --}}
                        <div class="accordion accordion-flush" id="accordionFlushExample"
                            style="max-height: 300px; overflow-y: auto;">
                            @foreach ($course->sections as $section)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading{{ $section->id }}">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapse{{ $section->id }}" aria-expanded="false"
                                            aria-controls="flush-collapse{{ $section->id }}">
                                            <p class="color-general">{{ $section->name }}</p>
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{ $section->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="flush-heading{{ $section->id }}"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach ($section->lessons as $lesson)
                                                    <li class="d-flex my-1">
                                                        {{-- ver si esta completada la leccion --}}
                                                        <div>
                                                            @if ($lesson->completed)
                                                                {{-- SI EL CURSO ESTA COMPLETO Y ESTAMOS EN ESA POSICION BORDEAMOS EL CIRCULO --}}
                                                                @if ($current->id == $lesson->id)
                                                                    <i class='bx bx-play-circle bx-burst'
                                                                        style='color:rgb(52, 152, 219); font-size: 22px'></i>
                                                                @else
                                                                    {{-- DE LO CONTRARIO QUE  ME PINTE DE VERDE --}}
                                                                    <i class='bx bx-check-circle'
                                                                        style='color:rgb(52, 152, 219); font-size: 22px'></i>
                                                                @endif
                                                            @else
                                                                @if ($current->id == $lesson->id)
                                                                    <i class='bx bx-play-circle bx-burst'
                                                                        style='color:#1112de; font-size: 22px'></i>
                                                                @else
                                                                    <i class='bx bx-bolt-circle'
                                                                        style='color:#99a29b; font-size: 22px'></i>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        {{-- NOMBRE DE LA LECCION --}}
                                                        <a style="margin-top: 2px" class="cursor-status"
                                                            wire:click="changeLesson({{ $lesson }})">{{ $lesson->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- INPRIMIENDO LAS SECCIONES DE LOS CURSOS --}}



                        {{-- CITA DEL VIDEO --}}
                        <div class="card my-3">
                            <div class="card-body">
                                <!-- Button trigger modal -->
                                <button type="button" class="mi-boton azul" data-bs-toggle="modal"
                                    data-bs-target="#MoldalReferenciaVideo">
                                    Referencia del vídeo:
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="MoldalReferenciaVideo" tabindex="-1"
                                    aria-labelledby="MoldalReferenciaVideoLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="MoldalReferenciaVideoLabel">Modal
                                                    title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @php
                                                    $url = $current->url;
                                                    $urlParts = parse_url($url);
                                                    $channelName = '';
                                                    $videoDate = '';

                                                    if (isset($urlParts['query'])) {
                                                        parse_str($urlParts['query'], $queryArray);
                                                        $channelName = $queryArray['ab_channel'] ?? '';
                                                        $videoDate = $queryArray['t'] ?? '';

                                                        if ($videoDate) {
                                                            $fecha = 'No disponible'; // Agrega el punto y coma aquí
                                                        } else {
                                                            $fecha = $videoDate;
                                                        }
                                                    }
                                                @endphp

                                                <div class="alert alert-info alert-dismissible fade show"
                                                    role="alert">
                                                    <strong>Referencia del vídeo:</strong>
                                                    <p>Material extraído de la Web - {{ $current->name }} [Video].
                                                        YouTube. Publicado
                                                        por el
                                                        canal
                                                        <strong>{{ $channelName }}</strong>. Disponible en: <a
                                                            target="_blank" href="{{ $current->url }}"
                                                            title="{{ $channelName }}">{{ $url }}</a>
                                                    </p>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- link caido para dar aviso --}}
                                <form action="{{ route('visitador.course.alert') }}" id="fromLinkCaido"
                                    method="POST">
                                    @csrf
                                    <input type="text" name="id_lesson" value="{{ $current->id }}" hidden>
                                    <button type="submit" class="mi-boton rojo btn-sm mt-3" id="alertButton">Alertar
                                        Link caido</button>
                                </form>

                            </div>
                        </div>
                        {{-- CITA DEL VIDEO --}}


                        @section('scripts')
                            <script src="{{ asset('js/link-caido.js') }}"></script>

                            <!-- Plyr Initialization Script -->
                            <script>
                                document.addEventListener('livewire:load', function() {
                                    // Inicializa Plyr al cargar la página
                                    initPlyr();

                                    // Escucha el evento 'lessonChanged' para reinicializar Plyr
                                    Livewire.on('lessonChanged', function() {
                                        initPlyr();
                                    });
                                });

                                function initPlyr() {
                                    const player = new Plyr('#player', {
                                        controls: [
                                            'play-large',
                                            'play',
                                            'progress',
                                            'current-time',
                                            'duration',
                                            'mute',
                                            'volume',
                                            'captions',
                                            'settings',
                                            'pip',
                                            'airplay',
                                            'fullscreen'
                                        ],
                                        settings: ['captions', 'quality', 'speed', 'loop'],
                                        speed: {
                                            selected: 1,
                                            options: [0.5, 1, 1.5, 2]
                                        },
                                        quality: {
                                            default: 720,
                                            options: [4320, 2880, 2160, 1440, 1080, 720, 576, 480, 360]
                                        },
                                        youtube: {
                                            noCookie: true,
                                            rel: 0,
                                            showinfo: 0
                                        }
                                    });
                                }
                            </script>

                            <script>
                                document.addEventListener('livewire:load', function() {
                                    Livewire.on('lessonChanged', function(sectionId) {
                                        // Ocultar todos los acordeones
                                        document.querySelectorAll('.accordion-item').forEach(function(item) {
                                            item.classList.remove('show');
                                        });

                                        // Mostrar solo el acordeón correspondiente a la lección seleccionada
                                        var targetId = "#flush-collapse" + sectionId;
                                        var targetItem = document.querySelector(targetId);

                                        if (targetItem && !targetItem.classList.contains('show')) {
                                            targetItem.classList.add('show');
                                            // Ajustar la posición del scroll al inicio de la página
                                            window.scrollTo({
                                                top: 0,
                                                behavior: 'smooth' // Puedes cambiar a 'auto' si no quieres un desplazamiento suave
                                            });
                                        }
                                    });

                                    // Mostrar el acordeón al cargar la página
                                    var currentSectionId = "{{ $current->section_id }}";
                                    var initialTargetId = "#flush-collapse" + currentSectionId;
                                    var initialTargetItem = document.querySelector(initialTargetId);

                                    if (initialTargetItem && !initialTargetItem.classList.contains('show')) {
                                        initialTargetItem.classList.add('show');
                                        // Ajustar la posición del scroll al inicio de la página
                                        window.scrollTo({
                                            top: 0,
                                            behavior: 'smooth' // Puedes cambiar a 'auto' si no quieres un desplazamiento suave
                                        });
                                    }
                                });
                            </script>
                        @endsection
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
