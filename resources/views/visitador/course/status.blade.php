@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection




@section('main')
    <section id="" class="">
        <div class="container pt-5">
            {{-- COMPONENTE LIVEWIRE PARA SEGUIMIENTO DE CURSO --}}
            @livewire('course-status', ['course' => $course])
        </div>
    </section>
@endsection
