@extends('layouts.app')

@section('bosstrap.css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

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
                @if (session('mensaje'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>¡Atención!</strong> {{ session('mensaje') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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

                    <div class="mi-card mt-2">
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

                    {{-- para poder realizar otra vez el examen --}}
                    <div class="mi-card mt-2">
                        <div class="mi-card-content">
                            <form
                                action="{{ route('visitador.examenes.reset', ['exam' => $exam, 'examUser' => $examUser]) }}"
                                method="POST">
                                @csrf
                                <input type="submit" class="mi-boton rojo w-100" value="Retomar">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Tus Respuestas!</h2>

                            @foreach ($questions as $key => $question)
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading{{ $question->id }}">
                                            <button
                                                class="accordion-button @if ($key == 0) {{ 'collapsed' }} @endif"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse{{ $question->id }}"
                                                aria-expanded="@if ($key == 0) {{ 'true' }}@else{{ 'false' }} @endif"
                                                aria-controls="flush-collapse{{ $question->id }}">
                                                {{ $question->titulo }}
                                            </button>
                                        </h2>

                                        <div id="flush-collapse{{ $question->id }}"
                                            class="accordion-collapse collapse @if ($key == 0) {{ 'show' }} @endif"
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
                                                                <strong class="text-primary">correcta</strong>
                                                            @else
                                                                <strong class="text-danger">incorrecta</strong>
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

    @include('template.footer')

@section('bosstrap.js')
    <!-- CDN JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
@endsection
