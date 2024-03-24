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
                                            <h3 class="font-weight-medium">Únete y forma parte de ACADÉMICO</h3>
                                        </div>
                                        <p class="my-2">Plataforma educativa diseñado para jóvenes académicos
                                        </p>
                                        <p class="my-3">Descubre una forma diferente de aprender en tus tiempos libres,
                                        </p>

                                        @guest
                                            <div class="d-flex mt-5">
                                                <a href="{{ route('admin.register.index') }}"
                                                    class="btn btn-outline-light">Quiero
                                                    Registrarme</a>

                                                <a href="#plans" class="btn btn-warning ml-4">Suscribirse</a>
                                            </div>
                                        @endguest

                                        @auth
                                            @can('viewSubscription', auth()->user())
                                                <div class="d-flex align-items-center mt-5 gap-3">
                                                    <div>
                                                        <a class="btn btn-outline-light">EresPremium</a>
                                                    </div>

                                                    <form action="{{ route('admin.logout') }}" method="POST">
                                                        @csrf
                                                        <input type="submit" class="btn btn-warning " value="Cerrar Aplicativo">
                                                    </form>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center mt-5 gap-3">
                                                    <div>
                                                        <a href="#plans" class="btn btn-outline-light">Suscribirse</a>
                                                    </div>

                                                    <form action="{{ route('admin.logout') }}" method="POST">
                                                        @csrf
                                                        <input type="submit" class="btn btn-warning ml-4"
                                                            value="Cerrar Aplicativo">
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
            </section>


            <section class="our-services section-home" id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="text-dark">Beneficios</h5>
                            <h3 class="font-weight text-dark mb-5">en Académico</h3>
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
                                <p>Disfrutarás de acceso ilimitado en la plataforma.</p>
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
                                    <img src="{{ asset('img/home/pago.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Pago único o Suscripción</h6>
                                <p>Paga por un solo curso con acceso de por vida, o suscríbete y tendrás acceso ilimitado a
                                    todos los cursos, incluyendo exámenes, material educativo y mucho más.</p>
                            </div>
                        </div>

                        <div class="col-sm-4 text-lg-left">
                            <div class="services-box pb-0" data-aos="fade-down" data-aos-easing="linear"
                                data-aos-duration="1500">
                                <div class="text-center">
                                    <img src="{{ asset('img/home/soporte.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Soporte las 24 horas</h6>
                                <p>La plataforma cuenta con soporte las 24 horas, permitiéndote acceder en cualquier momento
                                    de tus tiempos libres.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <section class="our-process section-home" id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6" data-aos="fade-up">
                            <h5 class="text-dark">Únete a nuestra comunidad estudiantil</h5>
                            <h3 class="font-weight-medium text-dark">¡Descubre Académico!</h3>
                            <h5 class="text-dark mb-3">y diviertete</h5>
                            <p class="font-weight-medium mb-4"> Aprende en tus tiempos libres, <br>
                                de una forma diferente en nuestra plataforma
                            </p>
                            <div class="d-flex justify-content-start mb-3">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="mb-0">Material de estudio y exámenes</p>
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="mb-0">Acceso de por vida con soporte las 24 horas</p>
                            </div>
                            <div class="d-flex justify-content-start">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="mb-0">Actualización constante de la plataforma para mejorar tus estudios.</p>
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
                                <h3 class="font-weight-medium text-dark ">Lista de Cursos</h3>
                                <div><a href="{{ route('visitador.course.index') }}"
                                        class="btn-solid-sm p-4">Ver
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


            <section class="our-process section-home" id="plans">
                <div class="container">
                    <div class="row" data-aos="fade-up" data-aos-offset="-500">
                        <div class="col-sm-12">
                            <div class="d-sm-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h3 class="font-weight-medium text-dark mb-3">Plan de precios</h3>
                                    <h5 class="text-dark ">Acceso ilimitado a cursos, exámenes y material educativo
                                        las 24 horas del día</h5>
                                </div>
                                <div class="mb-5 mb-lg-0 mt-3 mt-lg-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mr-2 font-weight-medium monthly text-active check-box-label">Aca</p>
                                        <label class="toggle-switch toggle-switch">
                                            <input type="checkbox" checked id="toggle-switch">
                                            <span class="toggle-slider round"></span>
                                        </label>
                                        <p class="ml-2 font-weight-medium yearly check-box-label">démico</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-offset="-300">
                        <div class="col-sm-4">
                            <div class="pricing-box">
                                <img src="https://cdn-icons-png.flaticon.com/512/1010/1010711.png"
                                    style="width: 80px;height: 80px;" alt="starter">
                                <h6 class="font-weight-medium title-text">Plan Escolar</h6>
                                <h1 class="text-amount mb-4 mt-2">S/.15</h1>
                                <ul class="pricing-list">
                                    <li>Acceso Ilimitado</li>
                                    <li>Acceso a todos los cursos</li>
                                    <li>Acceso a material educativo</li>
                                    <li><strong>Cobro cada 02 de cada mes</strong></li>
                                </ul>
                                <a href="#" class="mi-boton general mt-3 w-100">Proximamente</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="pricing-box selected" id="curso-show">
                                <div class="cube"></div>
                                <div class="cube"></div>
                                <div class="cube"></div>
                                <div class="cube"></div>
                                <div class="cube"></div>
                                <div class="cube"></div>
                                <img src="https://cdn-icons-png.flaticon.com/512/4207/4207253.png"
                                    style="width: 80px;height: 80px;" alt="starter">
                                <h6 class="font-weight-medium title-text text-white">Plan Pre Universitario</h6>
                                <h1 class="text-amount mb-4 mt-2">S/.25</h1>
                                <ul class="pricing-list">
                                    <li class="text-white">Acceso Ilimitado</li>
                                    <li class="text-white">Acceso a todos los cursos</li>
                                    <li class="text-white">Acceso a material educativo</li>
                                    <li class="text-white">Acceso a examenes</li>
                                    <li class="text-white"><strong>Cobro cada 02 de cada mes</strong></li>
                                </ul>
                                @auth
                                    @can('viewSubscription', auth()->user())
                                        <input type="submit" class="button-login" value="Eres Usuario Premium">
                                    @else
                                        <form action="{{ route('mercadopago.suscription.index') }}" id="form-suscription"
                                            method="POST">
                                            @csrf
                                            <input type="submit" class="button-login" value="Suscribirme">
                                        </form>
                                    @endcan

                                @endauth

                                @guest
                                    <a href="{{ route('admin.register.index') }}"
                                        class="button-login text-white">Suscribirme</a>
                                @endguest
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="pricing-box">
                                <img src="https://cdn-icons-png.flaticon.com/512/13215/13215926.png"
                                    style="width: 80px;height: 80px;" alt="starter">
                                <h6 class="font-weight-medium title-text">Universitario</h6>
                                <h1 class="text-amount mb-4 mt-2">S/.35</h1>
                                <ul class="pricing-list">
                                    <li>Acceso Ilimitado</li>
                                    <li>Acceso a todos los cursos</li>
                                    <li>Acceso a material educativo</li>
                                    <li>Acceso a examenes</li>
                                    <li>Acceso a libros(PDF)</li>
                                    <li><strong>Cobro cada 02 de cada mes</strong></li>
                                </ul>
                                <a href="#" class="mi-boton general mt-3 w-100">Proximamente</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <footer class="footer mt-5">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <address>
                                <p>Académico</p>
                                <p class="mb-4">Plataforma de Educación</p>
                                <div class="d-flex align-items-center">
                                    <p class="mr-4 mb-0">+51 924 080 517</p>
                                    <a href="#" class="footer-link d-block">academico2023edu@gmail.com</a>
                                </div>
                            </address>
                            <div class="social-icons">
                                <h6 class="footer-title font-weight-bold">
                                    Redes Sociales
                                </h6>
                                <div class="d-flex">
                                    <a target="_blank"
                                        href="https://www.linkedin.com/in/anthony-eduardo-nu%C3%B1ez-canchari-05b1371a0/"><i
                                            class='bx bxl-linkedin-square'></i></a>
                                    <a target="_blank" href="https://www.facebook.com/profile.php?id=61553432355046"><i
                                            class='bx bxl-facebook-circle'></i></a>
                                    <a target="_blank" href="https://www.tiktok.com/@academico2023edu"><i
                                            class='bx bxl-tiktok'></i></a>
                                    <a target="_blank" href="https://www.instagram.com/academico2023edu/"><i
                                            class='bx bxl-instagram-alt'></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="footer-title">Matemáticas</h6>
                                    <ul class="list-footer">
                                        <li><a href="https://academico.familc.com/course/show/aritmetica"
                                                class="footer-link">Aritmética</a></li>
                                        <li><a href="https://academico.familc.com/course/show/geometria"
                                                class="footer-link">Geometría</a></li>
                                        <li><a href="https://academico.familc.com/course/show/algebra"
                                                class="footer-link">Álgebra</a></li>
                                        <li><a href="https://academico.familc.com/course/show/trigonometria"
                                                class="footer-link">Trigonometría</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="footer-title">Ciencias Sociales</h6>
                                    <ul class="list-footer">
                                        <li><a href="https://academico.familc.com/course/show/historia-del-peru"
                                                class="footer-link">Historia del Perú</a></li>
                                        <li><a href="https://academico.familc.com/course/show/literatura"
                                                class="footer-link">Literatura</a></li>
                                        <li><a href="https://academico.familc.com/course/show/lenguaje"
                                                class="footer-link">Lenguaje</a></li>
                                        <li><a href="https://academico.familc.com/course/show/razonamiento-verbal"
                                                class="footer-link">Razonamiento Verbal
                                            </a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="footer-title">Ciencias Naturales</h6>
                                    <ul class="list-footer">
                                        <li><a href="https://academico.familc.com/course/show/quimica"
                                                class="footer-link">Química</a></li>
                                        <li><a href="https://academico.familc.com/course/show/fisica"
                                                class="footer-link">Física</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-small pt-1">Copyright © <a href="https://academico.familc.com/"
                                    class="text-white" target="_blank">Academico</a> @php
                                        echo date('Y');
                                    @endphp </p>
                        </div>
                        <div>
                            <div class="d-flex justify-content-start">
                                <p class="font-weight-medium text-center text-small">
                                    <a href="https://academico.familc.com/" target="_blank"
                                        class="text-white">Plataformna de Educación</a> Unete a la Cominudad
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </body>
@endsection
