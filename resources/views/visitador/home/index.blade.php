@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-home-fondo" id="header-home">
        <div class="">
            <h1 class="header-titulo">Plataforma de educación dirigida a estudiantes de todas las edades</h1>
            <p class="header-parrafo">A través de Aula Digital, puedes acceder a una amplia gama de cursos a un costo muy
                asequible, con la posibilidad de explorar el contenido de manera ilimitada.</p>
        </div>
    </header>
@endsection


@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Videos!</h2>
                                <div class="text-center">
                                    <img class="imagen" src="https://cdn-icons-png.flaticon.com/512/2703/2703920.png"
                                        alt="">
                                </div>
                                <p class="contenido-bloques-parrafo">Cada curso incluye una lista de videos necesarios para
                                    cada
                                    lección, permitiendo una mayor exploración de los temas presentados.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Recursos!</h2>
                                <div class="text-center">
                                    <img class="imagen" src="https://cdn-icons-png.flaticon.com/512/3315/3315581.png"
                                        alt="">
                                </div>
                                <p class="contenido-bloques-parrafo">Contarás con acceso a material educativo en formato PDF
                                    para descargarlo y tenerlo contigo en todo momento.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Cotinuidad!</h2>
                                <div class="text-center">
                                    <img class="imagen" src="https://cdn-icons-png.flaticon.com/512/11421/11421424.png"
                                        alt="">
                                </div>
                                <p class="contenido-bloques-parrafo">Puedes avanzar a tu propio ritmo en el curso, y tendrás
                                    la
                                    opción de hacer clic al finalizar cada tema aprendido.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Acceso a lectura!</h2>
                                <div class="text-center">
                                    <img class="imagen" src="https://cdn-icons-png.flaticon.com/512/3574/3574808.png"
                                        alt="">
                                </div>
                                <p class="contenido-bloques-parrafo">Dispondrás de una sección donde podrás acceder a
                                    lecturas
                                    interesantes y resumidas para evitar el aburrimiento.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="curso-elegir" class="p-5">
        <div class="centrar-div">
            <h3 class="curso-elegir-titulo">¿No sabes que curso elegir?</h3>
            <p class="curso-elegir-parrafo">Tenemos diferentes temas para ti</p>
        </div>

        {{-- COMPONENTE LIVEWIRE BUSCADOR --}}
        @livewire('search')
    </section>


    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Geometría</h2>
                            <div class="text-center">
                                <img src="https://media.istockphoto.com/id/1430005833/es/foto/juego-de-%C3%BAtiles-para-matem%C3%A1ticas-y-para-la-escuela-fracciones-reglas-l%C3%A1pices-bloc-de-notas.webp?s=1024x1024&w=is&k=20&c=_-Et2qYN_rIItpm5xLDbSiSkr2iPGK4r0DCG-wd4HDk="
                                    class="card-img-top" alt="...">
                            </div>
                            <p class="contenido-bloques-parrafo mt-3">
                                {{ Str::limit(
                                    ' La geometría es una rama de las matemáticas que se ocupa del estudio de las propiedades, las dimensiones, las relaciones y las medidas de los objetos y las figuras en el espacio. En otras palabras, la geometría se centra en la descripción y el análisis de las formas y las estructuras que se encuentran en el espacio bidimensional y tridimensional.',
                                    80,
                                ) }}
                            </p>

                            <a href="#" class="mi-boton general mt-2 w-100">Detalles</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Trigonometría</h2>
                            <div class="text-center">
                                <img src="https://media.istockphoto.com/id/1430005833/es/foto/juego-de-%C3%BAtiles-para-matem%C3%A1ticas-y-para-la-escuela-fracciones-reglas-l%C3%A1pices-bloc-de-notas.webp?s=1024x1024&w=is&k=20&c=_-Et2qYN_rIItpm5xLDbSiSkr2iPGK4r0DCG-wd4HDk="
                                    class="card-img-top" alt="...">
                            </div>
                            <p class="contenido-bloques-parrafo mt-3">
                                {{ Str::limit(
                                    ' La trigonometría es una rama de las matemáticas que se ocupa de las relaciones y propiedades de los triángulos, así como de las funciones trigonométricas, que son funciones matemáticas asociadas con ángulos. Su estudio abarca las medidas de los ángulos, las razones trigonométricas (seno, coseno, tangente, cotangente, secante y cosecante) y las aplicaciones prácticas de estas funciones en diversas áreas.',
                                    80,
                                ) }}
                            </p>

                            <a href="#" class="mi-boton general mt-2 w-100">Detalles</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Álgebra</h2>
                            <div class="text-center">
                                <img src="https://media.istockphoto.com/id/1430005833/es/foto/juego-de-%C3%BAtiles-para-matem%C3%A1ticas-y-para-la-escuela-fracciones-reglas-l%C3%A1pices-bloc-de-notas.webp?s=1024x1024&w=is&k=20&c=_-Et2qYN_rIItpm5xLDbSiSkr2iPGK4r0DCG-wd4HDk="
                                    class="card-img-top" alt="...">
                            </div>
                            <p class="contenido-bloques-parrafo mt-3">
                                {{ Str::limit(
                                    ' El álgebra es una rama de las matemáticas que estudia las estructuras, las relaciones y las cantidades, y la manera en que se expresan mediante símbolos y letras. A diferencia de la aritmética, que se ocupa principalmente de las operaciones básicas y propiedades numéricas, el álgebra generaliza estas operaciones para trabajar con variables y expresiones algebraicas.',
                                    80,
                                ) }}
                            </p>

                            <a href="#" class="mi-boton general mt-2 w-100">Detalles</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Aritmética</h2>
                            <div class="text-center">
                                <img src="https://media.istockphoto.com/id/1430005833/es/foto/juego-de-%C3%BAtiles-para-matem%C3%A1ticas-y-para-la-escuela-fracciones-reglas-l%C3%A1pices-bloc-de-notas.webp?s=1024x1024&w=is&k=20&c=_-Et2qYN_rIItpm5xLDbSiSkr2iPGK4r0DCG-wd4HDk="
                                    class="card-img-top" alt="...">
                            </div>
                            <p class="contenido-bloques-parrafo mt-3">
                                {{ Str::limit(
                                    ' La aritmética es una rama de las matemáticas que se
                                                                                                                                                                ocupa de las propiedades y las relaciones de los números, especialmente en lo que respecta a
                                                                                                                                                                las operaciones fundamentales como la adición, la sustracción, la multiplicación y la
                                                                                                                                                                división. La aritmética es fundamental para el estudio y la comprensión de conceptos
                                                                                                                                                                matemático.',
                                    80,
                                ) }}
                            </p>

                            <a href="#" class="mi-boton general mt-2 w-100">Detalles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="ultimos-cursos" class="text-center">
        <h3 class="ultimos-cursos-titulo color-general">Ultimos cursos</h3>
        <p class="ultimos-cursos-parrafo color-general">no hay limites para aprender, eso está en ti</p>
        <div class="contenedor">
            {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
            <x-course-card :courses="$courses"></x-course-card>
        </div>
    </section>
@endsection
