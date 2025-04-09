<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="PreuniCursos: Plataforma educativa para preuniversitarios que aspiran a la UNFV. Cursos completos, recursos PDF, compendios, exámenes y videos alineados con la malla curricular del examen.">
    <meta name="keywords"
        content="PreuniCursos, preunicursos, plataforma educativa, UNFV, ceprevi ,cursos preuniversitarios, álgebra, geometría, trigonometría, física, química, biología, literatura, razonamiento verbal, historia del Perú, malla curricular, exámenes, recursos PDF, compendios, publicaciones educativas, educación online, preparación universitaria, aprendizaje virtual">
    <meta name="author" content="PreuniCursos">

    {{-- CON ESTE COMANDO SE ARREGLO ERROR: 419 --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PreuniCursos</title>

    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    {{-- links css mapa leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />


    {{-- links css generales --}}
    <link rel="stylesheet" href="{{ asset('css/generales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colores.css') }}">

    {{-- links css nav --}}
    <link rel="stylesheet" href="{{ asset('css/nav/nav.css') }}">


    {{-- links css responsive --}}
    <link rel="stylesheet" href="{{ asset('css/responsive/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive/course.css') }}">

    {{-- links css visitador --}}
    <link rel="stylesheet" href="{{ asset('css/visitador/home/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/jquery.flipster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/visitador/course.css') }}">

    <!-- DATATABLES CSS -->
    <link rel="stylesheet" href="{{ asset('lib/datatable/dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/datatable/dataTables.min.css') }}">

    <!-- ICONO DEL PROYECTO -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo/logo.png') }}">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS -->
    @yield('bosstrap.css')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400&display=swap" rel="stylesheet">

    <link href="{{ asset('css/login/login.css') }}" rel="stylesheet">
    <!-- Plyr CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />

    <!-- Plyr JS -->
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>

    <!--CSS SWEEALERT2-->
    <link rel="stylesheet" href="{{ asset('lib/sweetalert2/sweetalert2.min.css') }}">

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
        @yield('scripts')
        <!-- SCRIPT LIVEWIRE -->
        @livewireScripts
    </main>



    <!--SDK MERCADOPAGO-->
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <!--API YOUTUBE
    <script src="https://www.youtube.com/iframe_api"></script>-->

    @yield('bosstrap.js')

    {{-- links js mapa leaflet --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


    {{-- ALPINEJS --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- DATATABLES JS LIB-->
    <script src="{{ asset('lib/datatable/dataTables.js') }}"></script>
    <script src="{{ asset('lib/datatable/dataTables.min.js') }}"></script>


    <!--SCCRIPT GENERALES-->
    <script src="{{ asset('js/dataTables.js') }}"></script>


    <script src="{{ asset('js/login/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/login/main.js') }}"></script>

    <!--JS SWEEALERT2-->
    <script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('js/home/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('js/home/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/home/aos.js') }}"></script>
    <script src="{{ asset('js/home/jquery.flipster.min.js') }}"></script>
    <script src="{{ asset('js/home/template.js') }}"></script>

    <script src="{{ asset('js/mercadopagoSuscripcion.js') }}"></script> 
    <!--<script src="{{ asset('js/mercadopagoSuscripcionSchool.js') }}"></script> -->
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
