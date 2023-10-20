@extends('layouts.app')


@section('navegador')
    @include('template.nav-instructor')
@endsection




@section('main')
    {{-- COMPONENTE LIVEWIRE --}}
    @livewire('instructor.sections', ['course' => $course], key($course->id))
@endsection
