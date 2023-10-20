@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-list-fondo" id="header-list">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">Mi aprendizaje</h3>
            <p class="ultimos-cursos-parrafo text-white">no hay limites para aprender, eso está en ti</p>
        </div>
    </header>
@endsection


@section('main')
    <section id="ultimos-cursos" class="text-center">
        <div class="contenedor">
            {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-3 mt-4">
                        <div class="card sombra" style="width: 100%;">
                            <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                <img src="{{ $course->image->url }}" class="card-img-top" alt="...">
                            </a>

                            <div class="card-body">
                                <h4 class="ultimos-cursos-card-titulo">{{ $course->title }}</h4>
                                <p class="ultimos-cursos-card-parrafo">{{ Str::limit($course->description, 40) }}</p>
                                <p class="ultimos-cursos-card-parrafo mt-3">Colaborador: {{ $course->teacher->name }}</p>

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
