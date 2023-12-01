@extends('layouts.app')


@section('navegador')
    @include('template.nav-instructor')
@endsection




@section('main')
    {{-- COMPONENTE LIVEWIRE --}}
    @livewire('instructor.topics')
@endsection
