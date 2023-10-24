<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CON ESTE COMANDO SE ARREGLO ERROR: 419 --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AULADIGITAL</title>

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    {{-- links css mapa leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{ asset('lib/owl/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/owl/dist/assets/owl.theme.default.min.css') }}">


    {{-- links css generales --}}
    <link rel="stylesheet" href="{{ asset('css/generales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colores.css') }}">

    {{-- links css nav --}}
    <link rel="stylesheet" href="{{ asset('css/nav/nav.css') }}">


    {{-- links css responsive --}}
    <link rel="stylesheet" href="{{ asset('css/responsive/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive/course.css') }}">

    {{-- links css visitador --}}
    <link rel="stylesheet" href="{{ asset('css/visitador/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/course.css') }}">

    <!-- DATATABLES CSS -->
    <link rel="stylesheet" href="{{ asset('lib/datatable/dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/datatable/dataTables.min.css') }}">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">



    <!-- ESTILOS LIVEWIRE -->
    @livewireStyles
</head>

<body>

    {{-- navegador --}}
    @yield('navegador')


    {{-- header --}}
    @yield('header')


    {{-- cuerpo --}}
    <main>
        @yield('main')

        <!-- SCRIPT LIVEWIRE -->
        @livewireScripts
    </main>



    {{-- footer --}}
    @yield('footer')


    <!--SDK MERCADOPAGO-->
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <!--API YOUTUBE-->
    <script src="https://www.youtube.com/iframe_api"></script>

    <!-- CDN JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    {{-- links js mapa leaflet --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


    {{-- ALPINEJS --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- DATATABLES JS LIB-->
    <script src="{{ asset('lib/datatable/dataTables.js') }}"></script>
    <script src="{{ asset('lib/datatable/dataTables.min.js') }}"></script>


    <!-- javascript OWL CAROUSEL LIB-->
    <script src="{{ asset('lib/owl/dist/owl.carousel.js') }}"></script>
    <script src="{{ asset('lib/owl/dist/owl.carousel.min.js') }}"></script>

    <!--SCCRIPT GENERALES-->
    <script src="{{ asset('js/dataTables.js') }}"></script>

    <script src="{{ asset('js/owl.js') }}"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->


</body>

</html>
