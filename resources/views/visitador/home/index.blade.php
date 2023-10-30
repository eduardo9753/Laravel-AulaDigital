@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-home-fondo" id="header-home">
        <div class="">
            <h1 class="header-titulo">Plataforma de educación dirigida a estudiantes de todas las edades</h1>
            <p class="header-parrafo">A través de MiAulaDigital, puedes acceder a una amplia gama de cursos a un costo muy
                asequible, con la posibilidad de explorar el contenido de manera ilimitada.</p>

            <a href="{{ route('admin.register.index') }}" class="mi-boton general mt-3">Registrarme</a>
        </div>
    </header>
@endsection


@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Videos!</h2>
                                <div class="text-center">
                                    <img class="imagen" src="https://cdn-icons-png.flaticon.com/512/2703/2703920.png"
                                        alt="">
                                </div>
                                <p class="contenido-bloques-parrafo">Cada curso incluye una lista de videos necesarios para
                                    cada
                                    lección, permitiendo una mayor exploración de los temas presentados.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Recursos!</h2>
                                <div class="text-center">
                                    <img class="imagen" src="https://cdn-icons-png.flaticon.com/512/3315/3315581.png"
                                        alt="">
                                </div>
                                <p class="contenido-bloques-parrafo">Dispondrás de material educativo en formato PDF que
                                    podrás descargar y llevar contigo en todo momento. Este recurso estará disponible al
                                    concluir cada lección aprendida.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Cotinuidad!</h2>
                                <div class="text-center">
                                    <img class="imagen" src="https://cdn-icons-png.flaticon.com/512/11421/11421424.png"
                                        alt="">
                                </div>
                                <p class="contenido-bloques-parrafo">Puedes avanzar a tu propio ritmo en el curso, y tendrás
                                    la
                                    opción de hacer clic al finalizar cada tema aprendido.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Acceso a lectura!</h2>
                                <div class="text-center">
                                    <img class="imagen" src="https://cdn-icons-png.flaticon.com/512/3574/3574808.png"
                                        alt="">
                                </div>
                                <p class="contenido-bloques-parrafo">Dispondrás de una sección donde podrás acceder a
                                    lecturas
                                    interesantes y resumidas para evitar el aburrimiento.</p>
                            </div>
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


    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                @foreach ($contenidos as $contenido)
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">{{ $contenido->title }}</h2>
                                <div class="text-center">
                                    @if ($contenido->image)
                                        <img class="imagen" src="{{ $contenido->image->url }}" class=""
                                            alt="Imagen del curso">
                                    @else
                                        <img class="imagen" src="https://cdn-icons-png.flaticon.com/512/2436/2436648.png"
                                            class="" alt="...">
                                    @endif
                                </div>
                                <p class="contenido-bloques-parrafo mt-3">
                                    {{ Str::limit($contenido->url, 80) }}
                                </p>

                                <a href="{{ route('visitador.contenido', ['resource' => $contenido]) }}"
                                    class="mi-boton general mt-2 w-100">Detalles</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section>
        <!--  OWLCOURRESL Demos -->
        <div id="owl-demo" class="owl-carousel owl-theme fondo-general">

            <div class="item text-center">
                <p class="owl-parrafo">El éxito es la suma de pequeños esfuerzos repetidos día tras día.</p>
            </div>
            <div class="item text-center">
                <p class="owl-parrafo">No te preocupes por los errores y fracasos. Son parte del viaje hacia el éxito.</p>
            </div>

            <div class="item text-center">
                <p class="owl-parrafo">Cada día es una nueva oportunidad para aprender y crecer.</p>
            </div>

            <div class="item text-center">
                <p class="owl-parrafo">Cada logro comienza con la decisión de intentarlo.</p>
            </div>

            <div class="item text-center">
                <p class="owl-parrafo">La mente es como un paracaídas, solo funciona cuando está abierta.</p>
            </div>

            <div class="item text-center">
                <p class="owl-parrafo">No hay atajos para ningún lugar que valga la pena.</p>
            </div>

        </div>
        <!--OWLCOURRESL-->
    </section>


    <section id="ultimos-cursos" class="text-center">
        <h3 class="ultimos-cursos-titulo color-general">Ultimos cursos</h3>
        <p class="ultimos-cursos-parrafo color-general">no hay limites para aprender, eso está en ti</p>
        <div>
            {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
            <x-course-card :courses="$courses"></x-course-card>
        </div>
    </section>
@endsection
