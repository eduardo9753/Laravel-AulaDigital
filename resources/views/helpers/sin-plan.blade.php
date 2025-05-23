@can('notSubscription', auth()->user())
    <li class="item">
        <a href="{{ route('visitador.course.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-slideshow'></i>
                <span>Cursos Premium</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.course.free.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-slideshow'></i>
                <span>Cursos Gratis</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.course.free.list') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-mouse-alt'></i>
                <span>Mis Cursos Gratis</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.examenes.free.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-book-reader'></i>
                <span>Exámenes Gratis</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.read.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-book-add'></i>
                <span>Mis recursos</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.compendio.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-book-bookmark'></i>
                <span>Mis Compendios</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.post.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bx-message-dots bx-burst'></i>
                <span>Publicaciones</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('mercadopago.suscription.subscribe') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-label bx-fade-left'></i>
                <span>Suscribete</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('profile.index', ['user' => auth()->user()]) }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-user-rectangle'></i>
                <span> {{ auth()->user()->name }}</span>
            </div>
        </a>
    </li>
    <li class="item">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <input type="submit" class="mi-boton general mt-2 w-100 btn-rounded" value="Salir">
        </form>
    </li>
@endcan
