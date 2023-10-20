@extends('layouts.app')


@section('navegador')
    @include('template.nav-instructor')
@endsection




@section('main')
    {{-- COMPONENTE LIVEWIRE --}}
    @livewire('instructor.goals', ['course' => $course], key($course->id))
@endsection
