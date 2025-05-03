<section class="our-process section-home" id="plans">
    <div class="container">
        <div class="row" data-aos="fade-up" data-aos-offset="-500">
            <div class="col-sm-12">
                <div class="d-sm-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h3 class="font-weight-medium text-dark mb-3" style="color: #da920f !important;">Nuestro Plan</h3>
                        <h5 class="text-dark ">Acceso ilimitado a cursos, exámenes y material educativo
                            las 24 horas del día</h5>
                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center" data-aos="fade-up" data-aos-offset="-300">
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
                    <h1 class="text-amount mb-4 mt-2 text-white">
                        S/<strong>14</strong>.<small style="font-size: 0.6em; vertical-align: super;">99</small>
                    </h1>

                    <ul class="pricing-list">
                        <li class="text-white">
                            <div class="d-flex">
                                <i class='bx bx-check-circle' style="padding-top: 4px"></i>
                                <span>Acceso Ilimitado</span>
                            </div>
                        </li>
                        <li class="text-white">
                            <div class="d-flex">
                                <i class='bx bx-check-circle' style="padding-top: 4px"></i>
                                <span>Acceso a todos los cursos</span>
                            </div>
                        </li>
                        <li class="text-white">
                            <div class="d-flex">
                                <i class='bx bx-check-circle' style="padding-top: 4px"></i>
                                <span>Acceso a material educativo</span>
                            </div>
                        </li>
                        <li class="text-white">
                            <div class="d-flex">
                                <i class='bx bx-check-circle' style="padding-top: 4px"></i>
                                <span>Acceso a compendios</span>
                            </div>
                        </li>
                        <li class="text-white">
                            <div class="d-flex">
                                <i class='bx bx-check-circle' style="padding-top: 4px; color:yellow"></i>
                                <span style="color:yellow">Acceso a exámenes</span>
                            </div>
                        </li>
                        <li class="text-white">
                            <div class="d-flex">
                                <i class='bx bxs-check-circle' style="padding-top: 4px"></i>
                                <span><strong>Renovación automática 02 de cada mes</strong></span>
                            </div>
                        </li>
                    </ul>
                    @auth
                        @can('viewSubscription', auth()->user())
                            <i class='bx bx-star bx-tada mt-3' style="font-size: 38px;color: #ffffff"></i>
                        @else
                            <form action="{{ route('mercadopago.suscription.index') }}" id="form-suscription" method="POST">
                                @csrf
                                <input type="submit" class="btn-solid-sm p-4 mt-3 w-100 text-white" value="Quiero estudiar ya">
                            </form>
                        @endcan
                    @endauth

                    @guest
                        <a href="{{ route('admin.register.index') }}" class="btn-solid-sm p-4 mt-3 w-100 text-white">Quiero
                            estudiar ya</a>
                    @endguest
                </div>
            </div>

        </div>

    </div>
</section>
