@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    @can('notSubscription', auth()->user())
        <!--Cupones de descuento-->
        @include('helpers.plan-descuento')
    @endcan

    <!-- Ahora incluimos la vista suscripcion.blade.php -->
    @include('helpers.suscripcion')

    <!--video con los pasos de suscripcion-->
    <section class="our-process" id="plans">
        <div class="container">

            <div class="row justify-content-center" data-aos="fade-up" data-aos-offset="-300">
                @include('helpers.video', [
                    'video' => asset('videos/Contenido.mp4'),
                ])
            </div>

        </div>
    </section>

    @include('template.footer')
@endsection
