@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-home-fondo" id="header-home">
        <div class="">
            <h1 class="header-titulo">Plataforma de educación dirigida a estudiantes de todas las edades</h1>
            <p class="header-parrafo">A través de Aula Digital, puedes acceder a una amplia gama de cursos a un costo muy
                asequible, con la posibilidad de explorar el contenido de manera ilimitada.</p>
        </div>
    </header>
@endsection


@section('main')
    <section class="" id="contenido">
        <h2 class="contenido-titulo text-center color-general">Contenido</h2>
        <div class="contenedor">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card sombra" style="width: 100%;">
                        <img src="https://media.istockphoto.com/id/1430005833/es/foto/juego-de-%C3%BAtiles-para-matem%C3%A1ticas-y-para-la-escuela-fracciones-reglas-l%C3%A1pices-bloc-de-notas.webp?s=1024x1024&w=is&k=20&c=_-Et2qYN_rIItpm5xLDbSiSkr2iPGK4r0DCG-wd4HDk="
                            class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h3 class="card-title color-general">Geometria</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="mi-boton general mt-2 w-100">Detalles</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card sombra" style="width: 100%;">
                        <img src="https://media.istockphoto.com/id/1430005833/es/foto/juego-de-%C3%BAtiles-para-matem%C3%A1ticas-y-para-la-escuela-fracciones-reglas-l%C3%A1pices-bloc-de-notas.webp?s=1024x1024&w=is&k=20&c=_-Et2qYN_rIItpm5xLDbSiSkr2iPGK4r0DCG-wd4HDk="
                            class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h3 class="card-title color-general">Trogonometria</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="mi-boton general mt-2 w-100">Detalles</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card sombra" style="width: 100%;">
                        <img src="https://media.istockphoto.com/id/1430005833/es/foto/juego-de-%C3%BAtiles-para-matem%C3%A1ticas-y-para-la-escuela-fracciones-reglas-l%C3%A1pices-bloc-de-notas.webp?s=1024x1024&w=is&k=20&c=_-Et2qYN_rIItpm5xLDbSiSkr2iPGK4r0DCG-wd4HDk="
                            class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h3 class="card-title color-general">Algebra</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="mi-boton general mt-2 w-100">Detalles</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 mb-3">
                    <div class="card sombra" style="width: 100%;">
                        <img src="https://media.istockphoto.com/id/1430005833/es/foto/juego-de-%C3%BAtiles-para-matem%C3%A1ticas-y-para-la-escuela-fracciones-reglas-l%C3%A1pices-bloc-de-notas.webp?s=1024x1024&w=is&k=20&c=_-Et2qYN_rIItpm5xLDbSiSkr2iPGK4r0DCG-wd4HDk="
                            class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <h3 class="card-title color-general">Aritmetica</h3>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="mi-boton general mt-2 w-100">Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="curso-elegir" class="p-5">
        <div class="centrar-div">
            <h3 class="curso-elegir-titulo">¿No sabes que curso elegir?</h3>
            <p class="curso-elegir-parrafo">Tenemos diferentes temas para ti</p>
        </div>

        {{-- COMPONENTE LIVEWIRE BUSCADOR --}}
        @livewire('search')
    </section>


    <section id="ultimos-cursos" class="text-center">
        <h3 class="ultimos-cursos-titulo color-general">Ultimos cursos</h3>
        <p class="ultimos-cursos-parrafo color-general">no hay limites para aprender, eso está en ti</p>
        <div class="contenedor">
            {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
            <x-course-card :courses="$courses"></x-course-card>
        </div>
    </section>
@endsection
