@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Compendios Descargables</p>
        </div>
    </header>
@endsection



@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                <div class="row">

                    @foreach ($courses as $course)
                        @foreach ($course->archives as $archive)
                            <div class="col-md-3 my-2">
                                <div class="mi-card">
                                    <div class="mi-card-content">
                                        <h2 class="contenido-bloques-titulo">{{ $archive->name }}</h2>
                                        <div class="text-center">
                                            <img style="width: 100px;height: 100px;"
                                                src="https://cdn-icons-png.flaticon.com/512/207/207114.png" alt="">
                                        </div>

                                        <a href="{{ route('visitador.compendio.show', ['archive' => $archive]) }}"
                                            class="mi-boton general mt-2 w-100">Acceder</a>
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
