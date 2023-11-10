@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-home-fondo" id="header-home">
        <div class="">
            <h1 class="header-titulo">Plataforma de educación dirigida a estudiantes de todas las edades</h1>
            <p class="header-parrafo">A través de Académico, puedes acceder a una amplia gama de cursos a un costo muy
                asequible, con la posibilidad de explorar el contenido de manera ilimitada.</p>

            @guest
                <a href="{{ route('admin.register.index') }}" class="mi-boton general mt-3">Registrarme</a>
            @endguest
        </div>
    </header>

    <div class="contenedor">
        @if (session('mensaje'))
            <div class="alert alert-info mt-2 alert-dismissible fade show" role="alert">
                <strong>Importante!:</strong> {{ session('mensaje') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
@endsection


@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                <div class="row">
                    @if (session('mensaje'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>IMPORTANTE!</strong>
                            <p style="text-align: justify"> {{ session('mensaje') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="col-md-3 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Videos!</h2>
                                <div class="text-center">
                                    <img style="width: 100px;height: 100px;"
                                        src="https://cdn-icons-png.flaticon.com/512/2703/2703920.png" alt="">
                                </div>
                                <p class="contenido-bloques-parrafo mt-2">Cada curso incluye una lista de videos necesarios
                                    para
                                    cada
                                    lección, permitiendo una mayor exploración de los temas presentados.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Recursos!</h2>
                                <div class="text-center">
                                    <img style="width: 100px;height: 100px;"
                                        src="https://cdn-icons-png.flaticon.com/512/3315/3315581.png" alt="">
                                </div>
                                <p class="contenido-bloques-parrafo mt-2">Dispondrás de material educativo en formato PDF
                                    que
                                    podrás descargar y llevar contigo en todo momento. Este recurso estará disponible al
                                    concluir cada lección aprendida.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Cotinuidad!</h2>
                                <div class="text-center">
                                    <img style="width: 100px;height: 100px;"
                                        src="https://cdn-icons-png.flaticon.com/512/11421/11421424.png" alt="">
                                </div>
                                <p class="contenido-bloques-parrafo mt-2">Puedes avanzar a tu propio ritmo en el curso, y
                                    tendrás
                                    la
                                    opción de hacer clic al finalizar cada tema aprendido.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Acceso a lectura!</h2>
                                <div class="text-center">
                                    <img style="width: 100px;height: 100px;"
                                        src="https://cdn-icons-png.flaticon.com/512/3574/3574808.png" alt="">
                                </div>
                                <p class="contenido-bloques-parrafo mt-2">Dispondrás de una sección donde podrás acceder a
                                    lecturas
                                    interesantes y resumidas para evitar el aburrimiento.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="py-5" id="">
            <div class="contenedor">
                <div class="row">
                    <div class="col-md-9 my-2">
                        <img style="width: 100%;" src="{{ asset('img/home/union.png') }}" alt="">
                    </div>

                    <div class="col-md-3 my-2">
                        <div class="card">
                            <div class="card-body" style="text-align: justify">
                                La plataforma se adapta a una variedad de dispositivos, como teléfonos celulares, laptops y
                                computadoras, permitiéndote continuar tu proceso de aprendizaje de manera suave y cómoda
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


    <section id="ultimos-cursos" class="text-center">
        <h3 class="ultimos-cursos-titulo color-general">Ultimos cursos</h3>
        <p class="ultimos-cursos-parrafo color-general">no hay limites para aprender, eso está en ti</p>
        <div>
            {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
            <x-course-card :courses="$courses"></x-course-card>
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


    <section>
        <div class="py-5" id="">
            <div class="contenedor">
                <div class="row">
                    <div class="col-md-9 my-2">
                        <img style="width: 100%;" src="{{ asset('img/home/union_dos.png') }}" alt="">
                    </div>

                    <div class="col-md-3 my-2">
                        <div class="card">
                            <div class="card-body" style="text-align: justify">
                                Podrás llevar tu avance y retomar tu continuidad en el momento que desees. Además de ello,
                                tendrás acceso a ejercicios para repasar lo aprendido en formato PDF en la última parte de
                                cada lección
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                @foreach ($contenidos as $contenido)
                    <div class="col-md-3 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">{{ $contenido->title }}</h2>
                                <div class="text-center">
                                    @if ($contenido->url)
                                        <a href="{{ route('visitador.contenido', ['resource' => $contenido]) }}">
                                            <img class="imagen" src="{{ $contenido->url }}" class=""
                                                alt="Imagen del curso"></a>
                                    @else
                                        <a href="{{ route('visitador.contenido', ['resource' => $contenido]) }}">
                                            <img class="imagen"
                                                src="https://cdn-icons-png.flaticon.com/512/2436/2436648.png"
                                                class="" alt="..."></a>
                                    @endif
                                </div>
                                <p class="contenido-bloques-parrafo mt-3">
                                    {{ Str::limit($contenido->subtitle, 40) }}
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
@endsection
