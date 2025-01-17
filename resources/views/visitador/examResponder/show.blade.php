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
                    @if ($examUser->status == 'Culminado')
                        <div class="mi-card mt-2">
                            <div class="mi-card-content">
                                @if (auth()->user()->userSuscriptionUrl()->exists())
                                    <form
                                        action="{{ route('visitador.examenes.reset', ['exam' => $exam, 'examUser' => $examUser]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="submit" class="mi-boton rojo w-100" value="Retomar">
                                    </form>
                                @else
                                    <form
                                        action="{{ route('visitador.examenes.free.reset', ['exam' => $exam, 'examUser' => $examUser]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="submit" class="mi-boton rojo w-100" value="Retomar">
                                    </form>
                                @endif
                            </div>
                        </div>
                    @else
                        <a href="{{ route('visitador.examenes.index') }}" class="btn btn-outline-danger mt-2 w-100">Mis
                            exámenes</a>
                    @endif

                </div>

                <div class="col-md-9 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Tus Respuestas!</h2>

                            @foreach ($userExamAnswers as $index => $userExamAnswer)
                                <div class="card-block">
                                    <div class="message-box contact-box">
                                        <div class="message-widget contact-widget">
                                            <div class="accordion" id="accordionExample">
                                                <div class="card">
                                                    <div class="card-header" id="heading{{ $index }}">
                                                        <h2 class="mb-0 d-flex align-items-center">
                                                            <div>
                                                                <button class="btn btn-outline-info btn-rounded"
                                                                    type="button" data-toggle="collapse"
                                                                    data-target="#collapse{{ $index }}"
                                                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                                    aria-controls="collapse{{ $index }}">
                                                                    Pregunta {{ $index + 1 }}:
                                                                </button>
                                                            </div>

                                                            <div class="ml-2">
                                                                <p class="">{!! $userExamAnswer->examQuestion->question->titulo !!}</p>
                                                            </div>
                                                        </h2>
                                                    </div>

                                                    <div id="collapse{{ $index }}"
                                                        class="collapse {{ $index == 0 ? 'show' : '' }}"
                                                        aria-labelledby="heading{{ $index }}"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <strong>Respuestas:</strong>
                                                                    <ul>
                                                                        @foreach ($userExamAnswer->examQuestion->question->answers as $answer)
                                                                            <li>
                                                                                <strong>{{ $answer->titulo }}</strong>
                                                                                @if ($answer->es_correcta)
                                                                                    <span
                                                                                        class="text-success"><small>(Correcta)</small></span>
                                                                                @endif

                                                                                @if ($userExamAnswer->answer->id == $answer->id)
                                                                                    <span
                                                                                        class="{{ $answer->es_correcta ? 'text-success' : 'text-danger' }}">
                                                                                        <small>(Seleccionada)</small>
                                                                                    </span>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
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
