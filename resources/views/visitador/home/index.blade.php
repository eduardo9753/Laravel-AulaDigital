@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection



@section('main')

    <body data-spy="scroll" data-target=".navbar" data-offset="50">
        <div id="mobile-menu-overlay"></div>

        <div class="page-body-wrapper">

            <section id="home" class="home section-home">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="main-banner">
                                <div class="d-sm-flex justify-content-between">
                                    <div data-aos="zoom-in-up">
                                        <div class="banner-title">
                                            <h3 class="font-weight-medium">🚀 ¡Prepárate para tu ingreso a la UNFV!</h3>
                                        </div>
                                        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
                                            Únete a <strong>PreuniCursos</strong>, la plataforma educativa <span
                                                class="text-warning">hecha para futuros ingresantes</span>.
                                        </p>
                                        <p class="my-3 animate__animated animate__fadeInUp animate__delay-2s">
                                            Aprende con clases en video, material en PDF y exámenes por lección, todo basado
                                            en el temario oficial para el <strong>Examen de Admisión UNFV</strong>.
                                        </p>


                                        @guest
                                            <div class="d-flex mt-1">
                                                <a href="{{ route('admin.register.index') }}"
                                                    class="btn btn-primary mt-3 ml-2 text-white mt-3">Registrarme</a>

                                                <a href="#plans" class="btn btn-primary mt-3 ml-2 text-white">Suscribirse</a>
                                            </div>
                                        @endguest

                                        @auth
                                            @can('viewSubscription', auth()->user())
                                                <div class="d-flex mt-1">
                                                    <div>
                                                        <a class="btn btn-primary mt-3">EresPremium</a>
                                                    </div>

                                                    <form action="{{ route('admin.logout') }}" method="POST">
                                                        @csrf
                                                        <input type="submit" class="btn btn-primary mt-3 ml-2" value="Salir">
                                                    </form>
                                                </div>
                                            @else
                                                <div class="d-flex mt-1">
                                                    <div>
                                                        <a href="#plans" class="btn btn-primary mt-3">Suscribirse</a>
                                                    </div>

                                                    <form action="{{ route('admin.logout') }}" method="POST">
                                                        @csrf
                                                        <input type="submit" class="btn btn-primary mt-3 ml-2" value="Salir">
                                                    </form>
                                                </div>
                                            @endcan
                                        @endauth
                                    </div>
                                    <div class="mt-5 mt-lg-0">
                                        <img src="{{ asset('img/home/group.png') }}" alt="marsmello" class="img-fluid"
                                            data-aos="zoom-in-up">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="ultimos-cursos" class="text-center">
                <h3 class="ultimos-cursos-titulo color-general">Cursos gratis</h3>
                <p class="ultimos-cursos-parrafo color-general"></p>

                {{-- MENSAJE DE ALERTA CUANDO TE SUSCRIBES --}}
                <div class="contenedor">
                    @if (session('mensaje'))
                        <div class="alert alert-info mt-2 alert-dismissible fade show" role="alert">
                            <strong>Importante!:</strong> {{ session('mensaje') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <div class="">
                    {{-- LLAMADA DEL COMPONENTE COURSE CARD FREE --}}
                    @if (auth()->check())
                        <x-course-card :courses="$coursesFree" url="gratis"></x-course-card>
                    @else
                        <x-course-card :courses="$courses" url="premium"></x-course-card>
                    @endif
                </div>
            </section>


            <section class="our-services section-home" id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="text-dark color-general" >Beneficios</h5>
                            <h3 class="font-weight mb-5 color-general" >en PreuniCursos</h3>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-sm-4 text-lg-left">
                            <div class="services-box" data-aos="fade-down" data-aos-easing="linear"
                                data-aos-duration="1500">
                                <div class="text-center">
                                    <img src="{{ asset('img/home/ilimitado.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Acceso Ilimitado</h6>
                                <p>Como usuario premium, disfrutarás de acceso ilimitado a nuestra plataforma y podrás
                                    cancelar tu suscripción en cualquier momento que desees.</p>
                            </div>
                        </div>

                        <div class="col-sm-4 text-lg-left">
                            <div class="services-box pb-lg-0" data-aos="fade-down" data-aos-easing="linear"
                                data-aos-duration="1500">
                                <div class="text-center">
                                    <img src="{{ asset('img/home/pdf.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Recursos en PDF</h6>
                                <p>Accederás de manera ilimitada a material de estudio en formato PDF y podrás descargarlo
                                    en cualquier momento.</p>
                            </div>
                        </div>


                        <div class="col-sm-4 text-lg-left">
                            <div class="services-box" data-aos="fade-down" data-aos-easing="linear"
                                data-aos-duration="1500">
                                <div class="text-center">
                                    <img src="{{ asset('img/home/examen.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Exámenes por área</h6>
                                <p>Contarás con acceso a una lista de exámenes por área para complementar tu proceso de
                                    aprendizaje.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row" data-aos="fade-up">
                        <div class="col-sm-4 text-lg-left">
                            <div class="services-box  pb-lg-0" data-aos="fade-down" data-aos-easing="linear"
                                data-aos-duration="1500">
                                <div class="text-center">
                                    <img src="{{ asset('img/home/libros.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Material educativo</h6>
                                <p>Dispondrás de material educativo al finalizar cada lección, correspondiente a la unidad
                                    aprendida.</p>
                            </div>
                        </div>

                        <div class="col-sm-4 text-lg-left">
                            <div class="services-box" data-aos="fade-down" data-aos-easing="linear"
                                data-aos-duration="1500">
                                <div class="text-center">
                                    <img src="{{ asset('img/home/videos.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Lista de Videos</h6>
                                <p>Una lista de 16 secciones con videos asociados al temario para el examen de la UNFV.</p>
                            </div>
                        </div>

                        <div class="col-sm-4 text-lg-left">
                            <div class="services-box pb-0" data-aos="fade-down" data-aos-easing="linear"
                                data-aos-duration="1500">
                                <div class="text-center">
                                    <img src="{{ asset('img/home/pago.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Suscripción(Mercadopago)</h6>
                                <p>Las suscripciones se procesan de forma segura a través de la pasarela de pagos de Mercado
                                    Pago.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!--video con contenidos de la plataforma-->
            <section class="our-process section-home">
                <div class="container">
                    <div class="row mb-3" data-aos="fade-up" data-aos-offset="-500">
                        <div class="col-sm-12">
                            <div class="d-sm-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h3 class="font-weight-medium color-general mb-3">Con
                                        temario para el examen de admisión
                                        UNFV</h3>
                                    <h5 class="text-dark">Acceso ilimitado a cursos, exámenes y material educativo
                                        las 24 horas del día</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center" data-aos="fade-up" data-aos-offset="-300">
                        @include('helpers.video', [
                            'video' => asset('videos/Contenido.mp4'),
                        ])
                    </div>
                </div>
            </section>
            <!--video con contenidos de la plataforma-->



            <!--video para contenido 04 de plataforma -->
            <section class="our-process section-home" id="contenido-bloques">
                <div class="container">
                    <div class="row mb-3" data-aos="fade-up" data-aos-offset="-500">
                        <div class="col-sm-12">
                            <div class="d-sm-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h3 class="font-weight-medium color-general mb-3">
                                        Suscríbete ahora y ten</h3>
                                    <h5 class="text-dark">Acceso ilimitado a cursos, exámenes y material educativo
                                        las 24 horas del día</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center" data-aos="fade-up" data-aos-offset="-300">
                        <div class="col-md-3 text-center"> {{-- Más pequeño que col-md-4 --}}
                            <div class="ratio ratio-16x9">
                                @include('helpers.video', [
                                    'video' => asset('videos/contenido_04.mp4'),
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--video para contenido 04 de plataforma -->



            <!--video con los pasos de suscripcion-->
            <section class="our-process section-home" id="">
                <div class="container">
                    <div class="row mb-3" data-aos="fade-up" data-aos-offset="-500">
                        <div class="col-sm-12">
                            <div class="d-sm-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h3 class="font-weight-medium color-general mb-3">Pasos
                                        para tu Suscripción</h3>
                                    <h5 class="text-dark ">Acceso ilimitado a cursos, exámenes y material educativo
                                        las 24 horas del día</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center" data-aos="fade-up" data-aos-offset="-300">
                        @include('helpers.video', [
                            'video' => asset('videos/suscripción_preunicursos.mp4'),
                        ])
                    </div>
                </div>
            </section>
            <!--video con los pasos de suscripcion-->



            <!-- Ahora incluimos la vista suscripcion.blade.php -->
            @include('helpers.suscripcion')


            <section class="our-process section-home" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6" data-aos="fade-up">
                            <h5 class="text-dark">Únete a nuestra comunidad estudiantil</h5>
                            <h3 class="font-weight-medium color-general">¡Descubre
                                PreuniCursos!</h3>
                            <h5 class="text-dark mb-3">y diviertete</h5>
                            <p class="font-weight-medium mb-4 text-dark"> Aprende en tus tiempos libres, <br>
                                de una forma diferente en nuestra plataforma
                            </p>
                            <div class="d-flex justify-content-start mb-3">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="mb-0 text-dark" >Material de estudio y exámenes</p>
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="mb-0 text-dark">Acceso de por vida con soporte las 24 horas</p>
                            </div>
                            <div class="d-flex justify-content-start">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="mb-0 text-dark">Actualización constante de la plataforma para mejorar tus estudios.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right" data-aos="flip-left" data-aos-easing="ease-out-cubic"
                            data-aos-duration="2000">
                            <img src="{{ asset('img/home/idea.png') }}" alt="idea" class="img-fluid">
                        </div>
                    </div>
                </div>
            </section>


            <section class="our-projects section-home" id="projects">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-sm-12">
                            <div class="d-sm-flex justify-content-between align-items-center mb-2">
                                <h3 class="font-weight-medium color-general">Lista de
                                    Cursos</h3>
                                <div><a href="{{ route('visitador.course.index') }}" class="btn btn-outline-primary">Ver
                                        todos los cursos</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5" data-aos="fade-up">
                    <div class="owl-carousel-projects owl-carousel owl-theme">
                        @foreach ($courses as $course)
                            <div class="item">
                                <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                    <img class="imagen" src="{{ $course->image->url }}" alt="slider">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="container">
                    <div class="row pt-5 mt-5 pb-5 mb-5">
                        <div class="col-sm-3">
                            <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-down">
                                <img src="{{ asset('img/home/usuarios.png') }}" alt="satisfied-client" class="mr-3">
                                <div>
                                    <h4 class="font-weight-bold text-dark mb-0"><span class="scVal">0</span>+</h4>
                                    <h5 class="text-dark mb-0">Estudiantes</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-up">
                                <img src="{{ asset('img/home/pruebas.png') }}" alt="satisfied-client" class="mr-3">
                                <div>
                                    <h4 class="font-weight-bold text-dark mb-0"><span class="fpVal">0</span>+</h4>
                                    <h5 class="text-dark mb-0">Exámenes</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-down">
                                <img src="{{ asset('img/home/videos.png') }}" alt="Team Members" class="mr-3">
                                <div>
                                    <h4 class="font-weight-bold text-dark mb-0"><span class="tMVal">0</span>+</h4>
                                    <h5 class="text-dark mb-0">Lista de Videos</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-up">
                                <img src="{{ asset('img/home/recursos.png') }}" alt="Our Blog Posts" class="mr-3">
                                <div>
                                    <h4 class="font-weight-bold text-dark mb-0"><span class="bPVal">0</span>+</h4>
                                    <h5 class="text-dark mb-0">Recursos PDF</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>


        @include('template.footer')

    </body>
@endsection
