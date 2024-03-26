@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <section class="our-process section-home" id="plans">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-offset="-500">

                <div class="col-md-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Pago Pendiente!</strong> Tu pago está pendiente de procesamiento. Por favor, ten en cuenta
                        lo siguiente:
                        <ol>
                            <li>Verifica si la opción de compra está activa en tu tarjeta.</li>
                            <li>Verifica si tienes saldo disponible.</li>
                            <li>Si ya realizaste estos pasos y aún persiste el problema, contacta a soporte técnico.</li>
                        </ol>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                

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
                        <img src="https://cdn-icons-png.flaticon.com/512/1010/1010711.png" style="width: 80px;height: 80px;"
                            alt="starter">
                        <h6 class="font-weight-medium title-text">Plan Escolar</h6>
                        <h1 class="text-amount mb-4 mt-2">S/.25</h1>
                        <ul class="pricing-list">
                            <li>Acceso Ilimitado</li>
                            <li>Acceso a todos los cursos</li>
                            <li>Acceso a material educativo</li>
                            <li><strong>Cobro cada 02 de cada mes</strong></li>
                        </ul>
                        <input type="submit" class="mi-boton general mt-3 w-100" value="Proximamente">
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
                        <img src="https://cdn-icons-png.flaticon.com/512/4207/4207253.png" style="width: 80px;height: 80px;"
                            alt="starter">
                        <h6 class="font-weight-medium title-text text-white">Plan Pre Universitario</h6>
                        <h1 class="text-amount mb-4 mt-2">S/.30</h1>
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
                                <form action="{{ route('mercadopago.suscription.index') }}" id="form-suscription" method="POST">
                                    @csrf
                                    <input type="submit" class="button-login" value="Suscribirme">
                                </form>
                            @endcan

                        @endauth

                        @guest
                            <a href="{{ route('admin.register.index') }}" class="button-login text-white">Suscribirme</a>
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
                        <input type="submit" class="mi-boton general mt-3 w-100" value="Proximamente">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
