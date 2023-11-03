@extends('layouts.app')


@section('navegador')
    @include('template.nav-admin')
@endsection




@section('main')
    {{-- COMPONENTE LIVEWIRE --}}
    @livewire('admin.reads')
@endsection
