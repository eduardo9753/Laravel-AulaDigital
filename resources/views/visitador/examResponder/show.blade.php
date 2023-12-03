@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Tu Record de : {{ $exam->nombre }}</p>
        </div>
    </header>
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                <div class="col-md-3 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">{{ $exam->nombre }}</h2>

                            <div class="card">
                                <div class="card-body">
                                    <p class="contenido-bloques-parrafo mt-2">Duración:
                                        <strong>{{ $exam->duracion }} minutos</strong>
                                    </p>
                                    <p class="contenido-bloques-parrafo mt-2">Estado: <strong>{{ $exam->estado }}</strong>
                                    </p>
                                    <p class="contenido-bloques-parrafo mt-2">
                                        Creación: <strong>{{ $exam->created_at->diffForHumans() }}</strong>
                                    </p>

                                    {{-- <p class="contenido-bloques-parrafo mt-2">
                                    Publicación: {{ \Carbon\Carbon::parse($exam->publicacion)->diffForHumans() }}
                                </p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Calificación!</h2>

                            <div class="card">
                                <div class="card-body">
                                    <p class="contenido-bloques-parrafo mt-2">Puntos Obtenidos:
                                        <strong>{{ $examUser->calificacion }} puntos</strong>
                                    </p>
                                    <p class="contenido-bloques-parrafo mt-2">Estado:
                                        <strong>{{ $examUser->status }}</strong>
                                    </p>
                                    <p class="contenido-bloques-parrafo mt-2">
                                        Inscrito: <strong>{{ $examUser->created_at->diffForHumans() }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Tus Respuestas!</h2>

                            @foreach ($questions as $question)
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading{{ $question->id }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $question->id }}" aria-expanded="false"
                                                aria-controls="flush-collapse{{ $question->id }}">
                                                {{ $question->titulo }}
                                            </button>
                                        </h2>

                                        <div id="flush-collapse{{ $question->id }}" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading{{ $question->id }}"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                @foreach ($answers->where('question_id', $question->id) as $answer)
                                                    <div class="d-flex justify-content-between align-items-center">

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <i class='bx bx-registered'
                                                                style='color:#4b22f4 ; font-size: 22px'></i>
                                                            <p> {{ $answer->titulo }}</p>
                                                        </div>

                                                        <div>
                                                            @if ($answer->es_correcta == 1)
                                                                <strong class="text-primary">Respuesta Correcta</strong>
                                                            @else
                                                                <strong class="text-danger">Respuesta Incorrecta</strong>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
