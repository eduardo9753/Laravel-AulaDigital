@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Recursos Descargables</p>
        </div>
    </header>
@endsection



@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                <div class="row">
                    <div id="accordion">
                        @foreach ($courses as $course)
                            <div class="card">
                                <div class="card-header" id="heading{{ $course->id }}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse"
                                            data-target="#collapse{{ $course->id }}" aria-expanded="false" 
                                            aria-controls="collapse{{ $course->id }}">
                                            {{ $course->title }} <!-- Mostrar el título del curso -->
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse{{ $course->id }}" class="collapse" 
                                    aria-labelledby="heading{{ $course->id }}" data-parent="#accordion">
                                    <div class="card-body">
                                        <h6>Archivos para el estudio:</h6>
                                        <ul>
                                            @foreach ($course->archives as $archive)
                                                <li><a
                                                        href="{{ route('visitador.read.show', ['archive' => $archive]) }}">{{ $archive->name }}</a>
                                                </li> <!-- Mostrar el nombre del archivo -->
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
