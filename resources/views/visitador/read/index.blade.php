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

                    @foreach ($courses as $course)
                        <div class="col-md-12 mb-2">
                            <div class="mi-card">
                                <div class="mi-card-content">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class='bx bx-link-alt color-general'></i>
                                        <h1 class="lead color-general">Recurso del curso de {{ $course->title }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($course->archives as $archive)
                            <div class="col-md-4 my-1">
                                <div class="mi-card">
                                    <div class="mi-card-content">
                                        <a href="{{ route('visitador.read.show', ['archive' => $archive]) }}">
                                            <li class="d-flex align-items-center my-1">
                                                <i class='bx bxs-file-pdf' style='color:#310fc7'></i>
                                                <p class="temario-parrafo">{{ $archive->name }}</p>
                                            </li>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
