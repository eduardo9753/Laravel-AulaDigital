<div class="mt-5">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-2">
                {{-- CON ESTA SINTAXIS PODEMOS ACCEDER AL IFRAME EN BLADE --}}
                <div class="embed-responsive">{!! $current->iframe !!}</div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h1 class="color-general">{{ $current->name }}</h1>


                        {{-- MARCAR COMO CULMINADA LA LECCION --}}
                        <div class="d-flex align-items-center cursor" wire:click="completed">
                            @if ($current->completed)
                                <i class='bx bxs-toggle-right' style='color:rgb(52, 152, 219);  font-size: 28px'></i>
                                <p class="cursor-status">lección culminada</p>
                            @else
                                <i class='bx bx-toggle-left' style="font-size: 28px"></i>
                                <p class="cursor-status">culminar lección</p>
                            @endif
                        </div>
                        {{-- MARCAR COMO CULMINADA LA LECCION --}}


                        {{-- NAVEGACONDE LECCIONES --}}
                        <div class="card mt-3">
                            <div class="card-body d-flex justify-content-between">
                                @if ($this->previous)
                                    <a class="mi-boton general"
                                        wire:click="changeLesson({{ $this->previous }})">anterior</a>
                                @else
                                    <button disabled class="mi-boton rojo">Primero</button>
                                @endif

                                @if ($this->next)
                                    <a class="mi-boton general"
                                        wire:click="changeLesson({{ $this->next }})">siguiente</a>
                                @else
                                    <button disabled class="mi-boton rojo">Ultimo</button>
                                @endif
                            </div>
                        </div>
                        {{-- NAVEGACONDE LECCIONES --}}


                        {{-- DESCRIPCION DE LA LECCION --}}
                        <div class="card">
                            <div class="card-body">
                                @if ($current->description)
                                    <p>Material extraído. Fuente: <cite><a target="_blank"
                                                href="{{ $current->description->name }}">{{ $current->description->name }}</a></cite>
                                    </p>
                                @else
                                    sin datos por ahora
                                @endif
                            </div>
                        </div>
                        {{-- DESCRIPCION DE LA LECCION --}}


                        {{-- RECURSOS DE LA LECCION --}}
                        <div class="card">
                            <div class="card-body">
                                @if ($current->resource)
                                    <iframe style="width: 100%;height: 550px;" src="{{ $current->resource->url }}"
                                        title="W3Schools Free Online Web Tutorials">
                                    </iframe>
                                @endif
                            </div>
                        </div>
                        {{-- RECURSOS DE LA LECCION --}}
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body">
                        <h1 class="lead">{{ $course->title }}</h1>

                        {{-- DESCRICCION DEL COLABORADOR "profesor" --}}
                        <div class="d-flex align-items-center">
                            <figure>
                                <img src="{{ $course->teacher->profile_photo_url }}" alt="">
                            </figure>
                            <div>
                                <p class="font-sans">{{ $course->teacher->name }}</p>
                                <a href=""
                                    class="text-primary">{{ '@' . Str::slug($course->teacher->name, '') }}</a>
                            </div>
                        </div>
                        {{-- DESCRICCION DEL COLABORADOR "profesor" --}}


                        {{-- BARRA DE PROGRESO --}}
                        <p class="mt-3">{{ $this->advance . '%' }} Completado</p>
                        <div class="progress mt-2" style="width: 100% !important;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $this->advance . '%' }}"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        {{-- BARRA DE PROGRESO --}}


                        {{-- SECCIONES DEL CURSO --}}
                        <ul>
                            @foreach ($course->sections as $section)
                                <div class="card sombra my-3">
                                    <div class="card-body">
                                        <li>
                                            <h2 class="color-general" style="font-size: 18px; font-weight: bold">
                                                {{ $section->name }}</h2>

                                            {{-- LECCIONES DE LA SECCION --}}
                                            <ul class="">
                                                @foreach ($section->lessons as $lesson)
                                                    <li class="d-flex my-1">
                                                        {{-- ver si esta completada la leccion --}}
                                                        <div>
                                                            @if ($lesson->completed)
                                                                {{-- SI EL CURSO ESTA COMPLETO Y ESTAMOS EN ESA POSICION BORDEAMOS EL CIRCULO --}}
                                                                @if ($current->id == $lesson->id)
                                                                    <i class='bx bx-circle'
                                                                        style='color:rgb(52, 152, 219); font-size: 22px'></i>
                                                                @else
                                                                    {{-- DE LO CONTRARIO QUE  ME PINTE DE VERDE --}}
                                                                    <i class='bx bxs-circle'
                                                                        style='color:rgb(52, 152, 219); font-size: 22px'></i>
                                                                @endif
                                                            @else
                                                                @if ($current->id == $lesson->id)
                                                                    <i class='bx bx-circle'
                                                                        style='color:#99a29b ; font-size: 22px'></i>
                                                                @else
                                                                    <i class='bx bxs-circle'
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
                                        </li>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                        {{-- SECCIONES DEL CURSO --}}

                        <script src="{{ asset('js/youtube.js') }}"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
