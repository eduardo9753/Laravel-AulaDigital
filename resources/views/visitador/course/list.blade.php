@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Mi Cursos</p>
        </div>
    </header>
@endsection


@section('main')
    <section id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                @foreach ($courses as $course)
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
        </div>
    </section>
@endsection
