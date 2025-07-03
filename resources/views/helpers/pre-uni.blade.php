@canany(['viewSubscription', 'viewSubscriptionSixMonth', 'viewSubscriptionYear'], auth()->user())
    <li class="item">
        <a href="{{ route('visitador.course.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-slideshow'></i>
                <span>Cursos Premium</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.course.list') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-mouse-alt'></i>
                <span>Mis Cursos Premium</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.examenes.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-book-reader'></i>
                <span>Mis Exámenes</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.read.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-book-add'></i>
                <span>Mis Recursos</span>
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
        <a href="{{ route('visitador.graficos.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bx-bar-chart-alt-2 bx-tada'></i>
                <span>Mi Seguimiento</span>
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
        <a href="{{ route('visitador.bot.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bx-bot bx-burst'></i>
                <span>Bot PreuniCursos</span>
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
        <a href="{{ route('visitador.plan.index', ['user' => auth()->user()]) }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-cool'></i>
                <span>Mi plan</span>
            </div>
        </a>
    </li>
    <li class="item">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <input type="submit" class="mi-boton general mt-2 w-100 btn-rounded" value="Salir">
        </form>
    </li>
@endcanany
