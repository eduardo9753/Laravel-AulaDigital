@can('viewSubscriptionEscolar', auth()->user())
    <li class="item">
        <a href="{{ route('visitador.course.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-slideshow'></i>
                <span>Cursos</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.course.list') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-mouse-alt'></i>
                <span>Mis cursos</span>
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
                <i class='bx bxs-book-bookmark'></i>
                <span>publicaciones</span>
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
                <span> Mi plan</span>
            </div>
        </a>
    </li>
    <li class="item">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <input type="submit" class="btn btn-danger w-100" value="Salir">
        </form>
    </li>
@endcan
