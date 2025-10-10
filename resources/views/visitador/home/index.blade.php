@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection



@section('main')

    <body data-spy="scroll" data-target=".navbar" data-offset="50">
        <div id="mobile-menu-overlay"></div>

        <div class="page-body-wrapper">

            <section id="home" class="home">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8" data-aos="fade-up">
                            <h1 class="fw-bold text-white mb-3 mt-5">
                                🚀 ¡Prepárate para tu ingreso a la <span class="text-warning">UNFV</span> y más!
                            </h1>

                            <p class="lead mb-3 text-white">
                                Únete a <strong class="text-warning">PreuniCursos</strong>, la plataforma educativa
                                impulsada por
                                <span class="text-info">Inteligencia Artificial</span> que analiza tu rendimiento y te
                                recomienda clases, materiales y videos ideales para ti.
                            </p>

                            <p class="text-white mb-4">
                                Aprende con clases en video, material PDF, simulacros y exámenes personalizados.
                                ¡Todo diseñado para llevarte al siguiente nivel académico! 🎓
                            </p>
                            <div class="d-flex flex-wrap mt-4">
                                @guest
                                    <a href="{{ route('admin.register.index') }}" class="btn btn-accent btn-lg fw-bold mr-3">
                                        🚀 Registrarme Gratis
                                    </a>

                                    <a href="#plans" class="btn btn-glass btn-lg fw-bold text-white mt-2 mt-sm-0">
                                        💎 Ver Planes Premium
                                    </a>
                                @endguest

                                @auth
                                    @can('viewSubscription', auth()->user())
                                        <div class="d-flex flex-wrap">
                                            <a class="btn btn-gradient btn-lg fw-bold mr-3 mt-2 mt-sm-0">
                                                🌟 Eres Premium
                                            </a>

                                            <form action="{{ route('admin.logout') }}" method="POST">
                                                @csrf
                                                <input type="submit" class="btn btn-glass btn-lg fw-bold text-white mt-2 mt-sm-0"
                                                    value="🚪 Salir">
                                            </form>
                                        </div>
                                    @else
                                        <div class="d-flex flex-wrap">
                                            <a href="#plans" class="btn btn-gradient btn-lg fw-bold mr-3 mt-2 mt-sm-0">
                                                💎 Suscribirme
                                            </a>

                                            <form action="{{ route('admin.logout') }}" method="POST">
                                                @csrf
                                                <input type="submit" class="btn btn-glass btn-lg fw-bold text-white mt-2 mt-sm-0"
                                                    value="🚪 Salir">
                                            </form>
                                        </div>
                                    @endcan
                                @endauth
                            </div>

                        </div>
                    </div>
                </div>
            </section>




            <section class="our-services section-home" id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="text-dark font-weight-bold">Inscríbete en nuestros cursos gratuitos</h5>
                            <h3 class="font-weight-bold mb-5 color-general">PreuniCursos</h3>
                        </div>

                        {{-- MENSAJE DE ALERTA CUANDO TE SUSCRIBES --}}
                        <div class="contenedor">
                            @if (session('mensaje'))
                                <div class="alert alert-info mt-2 alert-dismissible fade show" role="alert">
                                    <strong>Importante!:</strong> {{ session('mensaje') }}.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- LLAMADA DEL COMPONENTE COURSE CARD FREE --}}
                <x-course-card :courses="$coursesFree" url="gratis"></x-course-card>
            </section>

            <!-- Ahora incluimos la vista suscripcion.blade.php -->
            @include('helpers.suscripcion')


            <section class="our-services section-home" id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="text-dark font-weight-bold">Beneficios en</h5>
                            <h3 class="font-weight mb-5 color-general">PreuniCursos</h3>
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
                </div>
            </section>


            <!--video con contenidos de la plataforma-->
            <section class="our-services section-home" id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="text-dark font-weight-bold">Temario UNFV</h5>
                            <h3 class="font-weight mb-5 color-general">Aprendizaje continuo con IA</h3>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-md-6">
                            @include('helpers.video', [
                                'video' => asset('videos/Contenido.mp4'),
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('helpers.video', [
                                'video' => asset('videos/IA.mp4'),
                            ])
                        </div>
                        <div class="col-md-6 mt-3">
                            @include('helpers.video', [
                                'video' => asset('videos/suscripción_preunicursos.mp4'),
                            ])
                        </div>
                    </div>
                </div>
            </section>
            <!--video con contenidos de la plataforma-->



            {{-- video con los pasos de suscripcion
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
            video con los pasos de suscripcion --}}






            <section class="our-process section-home" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6" data-aos="fade-up">
                            <h5 class="text-dark font-weight-bold">Únete a nuestra comunidad estudiantil</h5>
                            <h3 class="font-weight-medium color-general">¡Descubre
                                PreuniCursos!</h3>
                            <h5 class="text-dark mb-3 font-weight-bold">y diviertete</h5>
                            <p class="font-weight-medium mb-4 text-dark"> Aprende en tus tiempos libres, <br>
                                de una forma diferente en nuestra plataforma
                            </p>
                            <div class="d-flex justify-content-start mb-3">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="text-dark font-weight-bold">Material de estudio y exámenes</p>
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="mb-0 text-dark font-weight-bold">Acceso de por vida con soporte las 24 horas</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img/home/item.png') }}" alt="ícono de IA" class="mr-3 tick-icon">
                                <p class="mb-0 text-dark font-weight-bold">
                                    Integración con <span class="text-primary"><strong>Ineligencia
                                            Artificial</strong></span> para
                                    ofrecerte lo mejor en tus estudios.
                                </p>
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
                                <h3 class="text-dark mb-3 mt-4 font-weight-medium">Lista de
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
