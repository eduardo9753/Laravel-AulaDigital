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
                <strong>¡Importante!</strong> ¡Una vez completado el pago de tu suscripción, recuerda pulsar el botón
                'Volver al sitio' para finalizar el proceso de suscripción en nuestra plataforma. ¡Gracias!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    
    @include('template.footer')
@endsection
