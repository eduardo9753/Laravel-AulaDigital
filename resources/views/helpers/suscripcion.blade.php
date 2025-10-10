 <section class="our-services section-home" id="services">
     <div class="container">
         <div class="row">
             <div class="col-sm-12">
                 <h5 class="text-dark font-weight-bold">cursos, exámenes y material educativo las 24 horas del día</h5>
                 <h3 class="font-weight mb-5 color-general">Nuestros Planes</h3>
             </div>
         </div>
         <div class="row" data-aos="fade-up">
             {{-- PLAN MENSUAL --}}
             <div class="col-sm-4">
                 <div class="pricing-box selected" id="curso-show">
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <img src="https://cdn-icons-png.flaticon.com/512/10017/10017625.png"
                         style="width: 80px;height: 80px;" alt="starter">
                     <h6 class="font-weight-medium title-text text-white">Plan Mensual</h6>
                     <h1 class="text-amount mb-4 mt-2 text-white">
                         S/<strong> {{ env('PLAN_MENSUAL') }} </strong><small
                             style="font-size: 0.6em; vertical-align: super;"></small>
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
                                 <i class='bx bx-brain bx-burst' style="padding-top: 4px; color:yellow"></i>
                                 <span style="color:yellow">
                                     Recomendación IA tras cada examen con videos de refuerzo.
                                 </span>
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
                         @canany(['viewSubscription', 'viewSubscriptionSixMonth', 'viewSubscriptionYear'], auth()->user())
                             <i class='bx bx-star bx-tada mt-3' style="font-size: 38px;color: #ffffff"></i>
                         @else
                             <form action="{{ route('mercadopago.suscription.index') }}" id="form-suscription" method="POST">
                                 @csrf
                                 <input type="submit" class="btn-solid-sm p-4 mt-3 w-100 text-white"
                                     value="Quiero estudiar ya">
                             </form>
                         @endcanany
                     @endauth

                     @guest
                         <a href="{{ route('admin.register.index') }}" class="btn-solid-sm p-4 mt-3 w-100 text-white">Quiero
                             estudiar ya</a>
                     @endguest
                 </div>
             </div>


             {{-- PLAN SEIS MESES --}}
             <div class="col-sm-4">
                 <div class="pricing-box selected" id="curso-show">
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <img src="https://cdn-icons-png.flaticon.com/512/1921/1921604.png"
                         style="width: 80px;height: 80px;" alt="starter">
                     <span class="ahorro-suscripcion">
                         💰 Ahorra S/ 30
                     </span>
                     <h6 class="font-weight-medium title-text text-white">Plan Semestral</h6>
                     <h1 class="text-amount mb-4 mt-2 text-white">
                         S/<strong> {{ env('PLAN_SEIS_MES') }} </strong><small
                             style="font-size: 0.6em; vertical-align: super;"></small>
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
                                 <i class='bx bx-check-circle bx-burst' style="padding-top: 4px; color:yellow"></i>
                                 <span style="color:yellow">Acceso a exámenes</span>
                             </div>
                         </li>
                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-brain bx-burst' style="padding-top: 4px; color:yellow"></i>
                                 <span style="color:yellow">
                                     Recomendación IA tras cada examen con videos de refuerzo.
                                 </span>
                             </div>
                         </li>
                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bxs-check-circle' style="padding-top: 4px"></i>
                                 <span><strong>6 meses de acceso total</strong></span>
                             </div>
                         </li>
                     </ul>
                     @auth
                         @canany(['viewSubscription', 'viewSubscriptionSixMonth', 'viewSubscriptionYear'], auth()->user())
                             <i class='bx bx-star bx-tada mt-3' style="font-size: 38px; color: #ffffff"></i>
                         @else
                             <form action="{{ route('mercadopago.suscription.six.index') }}" id="form-suscription-seis-meses"
                                 method="POST">
                                 @csrf
                                 <input type="submit" class="btn-solid-sm p-4 mt-3 w-100 text-white"
                                     value="Quiero estudiar ya">
                             </form>
                         @endcanany
                     @endauth


                     @guest
                         <a href="{{ route('admin.register.index') }}"
                             class="btn-solid-sm p-4 mt-3 w-100 text-white">Quiero
                             estudiar ya</a>
                     @endguest
                 </div>
             </div>

             {{-- PLAN 12 MESES --}}
             <div class="col-sm-4">
                 <div class="pricing-box selected" id="curso-show">
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <img src="https://cdn-icons-png.flaticon.com/512/6807/6807175.png"
                         style="width: 80px;height: 80px;" alt="starter">
                     <span class="ahorro-suscripcion">
                         💰 Ahorra S/ 60
                     </span>
                     <h6 class="font-weight-medium title-text text-white">Plan Anual</h6>
                     <h1 class="text-amount mb-4 mt-2 text-white">
                         S/<strong> {{ env('PLAN_ANUAL') }} </strong><small
                             style="font-size: 0.6em; vertical-align: super;"></small>
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
                                 <i class='bx bx-news' style="padding-top: 4px"></i>
                                 <span>Acceso a Publicaciones Educativas</span>
                             </div>
                         </li>
                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-check-circle bx-burst' style="padding-top: 4px; color:yellow"></i>
                                 <span style="color:yellow">Acceso a exámenes</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-bot bx-burst' style="padding-top: 4px; color:yellow"></i>
                                 <span style="color:yellow">Acceso a Bot PreuniCursos</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-edit bx-burst'style="padding-top: 4px; color:yellow"></i>
                                 <span style="color:yellow">Acceso a simulacros</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-brain bx-burst' style="padding-top: 4px; color:yellow"></i>
                                 <span style="color:yellow">
                                     Recomendación IA tras cada examen con videos de refuerzo.
                                 </span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex align-items-center">
                                 <i class='bx bx-chip bx-tada bx-burst' style="padding-top: 4px; color:yellow"></i>
                                 <span style="color:yellow" class="ms-2">
                                     Contenido educativo generado con IA para reforzar tus conocimientos.
                                 </span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bxs-check-circle' style="padding-top: 4px"></i>
                                 <span><strong>12 meses de acceso total</strong></span>
                             </div>
                         </li>
                     </ul>
                     @auth
                         @canany(['viewSubscription', 'viewSubscriptionSixMonth', 'viewSubscriptionYear'], auth()->user())
                             <i class='bx bx-star bx-tada mt-3' style="font-size: 38px; color: #ffffff"></i>
                         @else
                             <form action="{{ route('mercadopago.suscription.year.index') }}" id="form-suscription-doce-meses"
                                 method="POST">
                                 @csrf
                                 <input type="submit" class="btn-solid-sm p-4 mt-3 w-100 text-white"
                                     value="Quiero estudiar ya">
                             </form>
                         @endcanany
                     @endauth


                     @guest
                         <a href="{{ route('admin.register.index') }}"
                             class="btn-solid-sm p-4 mt-3 w-100 text-white">Quiero
                             estudiar ya</a>
                     @endguest
                 </div>
             </div>
         </div>

         {{-- QR PARA PODER INTERACTUAR CON EL BOT --}}
         <div class="container">
             <div class="row">
                 @include('helpers.qr-bot')
             </div>
         </div>
     </div>
 </section>
