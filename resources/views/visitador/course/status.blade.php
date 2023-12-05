@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection




@section('main')
    <section id="" class="">
        <div class="container-fluid pt-5">
            @if (session('mensaje'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>IMPORTANTE!</strong>
                    <p style="text-align: justify"> {{ session('mensaje') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- COMPONENTE LIVEWIRE PARA SEGUIMIENTO DE CURSO --}}
            @livewire('course-status', ['course' => $course])
        </div>
    </section>
@endsection
