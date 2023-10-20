@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">Lo que aprendere {{ $course->title }}</h3>
            <p class="ultimos-cursos-parrafo text-white">no hay limites para aprender, eso está en ti</p>
        </div>
    </header>
@endsection


@section('main')
    <section id="ultimos-cursos" id="pago-curso">
        <div class="contenedor">
            {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
            <div class="row mt-4">
                <div class="col-md-8 mx-auto">
                    <div class="card sombra">
                        <div class="card-body">
                            <p style="font-size: 30px; color: #1a1915;font-weight: bold">Detalles de la Compra:
                                {{ $course->price->value }} S/.</p>
                        </div>
                    </div>

                    <div class="card sombra mt-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex gap-2">
                                    <figure>
                                        <img style="width: 44px;height: 45px; border-radius: 50%"
                                            src="{{ $course->image->url }}" class="" alt="...">
                                    </figure>
                                    <p class="curso-show-titulo mt-2">{{ $course->title }}</p>
                                </div>

                                <div>
                                    <form id="form-cart-venta"
                                        action="{{ route('mercadopago.checkout') }}" method="POST">
                                        @csrf
                                        <input type="text" name="course_id" value="{{ $course->id }}" hidden>
                                        <button type="submit" class="mi-boton rojo" id="checkout-btn">Pagar</button>
                                    </form>
                                </div>
                            </div>

                            <div>Terminos y Condiciones</div>
                        </div>
                    </div>

                    <div class="card sombra mt-3">
                        <div class="card-body">
                            <div id="wallet_container"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/mercadopago.js') }}"></script>
@endsection
