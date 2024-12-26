@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <!-- Ahora incluimos la vista suscripcion.blade.php -->
    @include('helpers.suscripcion')

    <div class="container mt-4">
        <div class="col-md-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>¡Importante!</strong> ¡Una vez completado el pago de tu suscripción, asegúrate de hacer clic en el
                botón 'Volver al sitio' para finalizar el proceso y así acceder a todos los beneficios de nuestra
                plataforma. ¡Gracias!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>

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
