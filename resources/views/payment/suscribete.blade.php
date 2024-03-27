@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <div class="container">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>¡Suscríbete!</strong> ¡Únete ahora para obtener acceso exclusivo a nuestro contenido!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>

    </div>

    <!-- Ahora incluimos la vista suscripcion.blade.php -->
    @include('helpers.suscripcion')

    @include('template.footer')
@endsection
