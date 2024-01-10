@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-home-fondo" id="header-home">
        <div class="">
            <h1 class="header-titulo">Plataforma de aprendizaje en línea</h1>
            <p class="header-parrafo">Descubre el poder del conocimiento preuniversitario en un solo lugar. Exploramos cada
                rincón de tu temario con lecciones en video y materiales PDF, porque <strong>En Académico,cada sección es
                    una
                    oportunidad para aprender y crecer</strong>.</p>
            @guest
                <a href="{{ route('admin.register.index') }}" class="btn-solid-sm mt-3">Registrarme</a>
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
                                    por
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
                                <p class="contenido-bloques-parrafo mt-2">Dispondrás de material educativo en formato PDF.
                                    Este recurso estará disponible al
                                    final de cada Sección aprendida.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Continuidad!</h2>
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


    <!--  OWLCOURRESL Demos -->
    <section id="demos" class="container-fluid">
        <div class="row">
            <div class="large-12 columns">
                <div class="owl-carousel owl-theme">
                    @foreach ($courses as $course)
                        <div class="item">
                            <div class="text-center">
                                <h2 class="color-general lead mb-3">{{ $course->title }}</h2>
                                <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                    <img class="imagen imagen-owl-centrar" src="{{ $course->image->url }}" alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- <a class="boton secondary play">Play</a>
                                                                                                                                                <a class="boton secondary stop">Stop</a>-->
            </div>
        </div>
    </section>
    <!--OWLCOURRESL-->

    <section>
        <div class="py-5" id="">
            <div class="contenedor">
                <div class="row mt-5">
                    <div class="col-md-9 my-2">
                        <img style="width: 100%;" src="https://i.postimg.cc/jS9HHBdk/union.png" alt="">
                    </div>

                    <div class="col-md-3 my-2">
                        <div class="card">
                            <div class="card-body" style="text-align: justify">
                                <p>Serás capaz de proseguir con tu proceso de aprendizaje de manera continua, ya sea en tu
                                    dispositivo móvil o desde la comodidad de tu hogar.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-9 my-2">
                        <img style="width: 100%;" src="https://i.postimg.cc/FsrVNjBG/union-dos.png" alt="">
                    </div>

                    <div class="col-md-3 my-2">
                        <div class="card">
                            <div class="card-body" style="text-align: justify">
                                <p>
                                    Podrás llevar tu avance y retomar tu continuidad en el momento que desees. Además de
                                    ello,
                                    tendrás acceso a ejercicios para repasar lo aprendido en formato PDF en el último
                                    capitulo
                                    de
                                    cada lección
                                </p>
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


    <section>
        <div class="contenedor">
            <div class="row mt-5">
                <div class="col-md-3 my-2">
                    <div class="card">
                        <div class="card-body" style="text-align: justify">
                            <p>
                                Tendrás acceso a una serie de exámenes con preguntas y respuestas provenientes de
                                evaluaciones anteriores. Estos podrás completarlos en un tiempo establecido con el
                                objetivo
                                de fortalecer tus conocimientos.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 my-2">
                    <img style="width: 100%;" src="https://i.postimg.cc/bJSF0Qh1/image.png" alt="">
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-3 my-2">
                    <div class="card">
                        <div class="card-body" style="text-align: justify">
                            <p> Una vez que hayas finalizado tu examen, tendrás la oportunidad de visualizar tu
                                calificación
                                junto con la lista de respuestas y los resultados que seleccionaste.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 my-2">
                    <img style="width: 100%;" src="https://i.postimg.cc/JnkC7sp4/image.png" alt="">
                </div>
            </div>
        </div>
    </section>




    <section id="ultimos-cursos" class="text-center">
        <h3 class="ultimos-cursos-titulo color-general">Ultimos cursos</h3>
        <p class="ultimos-cursos-parrafo color-general">Inscríbete y accede a una amplia variedad de recursos educativos
        </p>
        <div>
            {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
            <x-course-card :courses="$courses"></x-course-card>
        </div>
    </section>


    <section>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner fondo-general">
                <div class="carousel-item active">
                    <p class="text-center p-3" style="font-size: 20px">La educación no es preparación para la vida, es
                        vida en sí misma. Aprovéchala al máximo.</p>
                </div>

                <div class="carousel-item">
                    <p class="text-center p-3" style="font-size: 20px">El éxito es la suma de pequeños esfuerzos repetidos
                        día tras día.</p>
                </div>

                <div class="carousel-item">
                    <p class="text-center p-3" style="font-size: 20px">No te preocupes por los errores y fracasos. Son
                        parte del viaje hacia el éxito.
                    </p>
                </div>

                <div class="carousel-item">
                    <p class="text-center p-3" style="font-size: 20px">El conocimiento es el mejor activo que puedes
                        poseer. Invierte en ti mismo.</p>
                </div>

                <div class="carousel-item">
                    <p class="text-center p-3" style="font-size: 20px">La perseverancia no es un sprint, es un maratón.
                        Sigue adelante paso a paso.
                    </p>
                </div>

                <div class="carousel-item">
                    <p class="text-center p-3" style="font-size: 20px">La mente es como un paracaídas, solo funciona
                        cuando está abierta.</p>
                </div>

                <div class="carousel-item">
                    <p class="text-center p-3" style="font-size: 20px">No hay atajos para ningún lugar que valga la pena.
                    </p>
                </div>

                <div class="carousel-item">
                    <p class="text-center p-3" style="font-size: 20px">No te compares con los demás. Compara tu hoy con tu
                        ayer y trabaja para un mejor mañana.
                    </p>
                </div>

                <div class="carousel-item">
                    <p class="text-center p-3" style="font-size: 20px">La educación es el pasaporte para el futuro; el
                        mañana pertenece a aquellos que se preparan hoy. - Malcolm X
                    </p>
                </div>

                <div class="carousel-item">
                    <p class="text-center p-3" style="font-size: 20px">Cada error es una oportunidad de aprendizaje. No
                        temas equivocarte, teme no aprender de ello.
                    </p>
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
