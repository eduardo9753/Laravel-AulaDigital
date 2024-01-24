@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Mis Cursos</p>
        </div>
    </header>
@endsection


@section('main')

    @if ($courseUsers->count())
        <section id="contenido-bloques">
            <div class="row">
                @foreach ($courseUsers as $course)
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <div class="text-center">
                                    <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                        <img class="imagen" src="{{ $course->image->url }}" alt="">
                                    </a>
                                </div>
                                <h4 class="contenido-bloques-titulo">{{ $course->title }}</h4>
                                <p class="contenido-bloques-parrafo mt-3 mt-3">Colaborador: {{ $course->teacher->name }}
                                </p>
                                @can('enrolled', $course)
                                    <a href="{{ route('visitador.course.status', ['course' => $course]) }}"
                                        class="mi-boton rojo mt-3 w-100">Continuar con el curso</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @else
        {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
        <section id="ultimos-cursos" class="text-center">
            <h3 class="ultimos-cursos-titulo color-general">Aún no tienes cursos. Matricúlate ahora!</h3>
            <p class="ultimos-cursos-parrafo color-general"></p>
            <div class="">
                {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
                <x-course-card :courses="$courses"></x-course-card>
            </div>
        </section>
    @endif




@endsection
