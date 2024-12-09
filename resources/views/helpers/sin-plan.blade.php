@can('notSubscription', auth()->user())
    <li class="item">
        <a href="{{ route('visitador.home.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-home'></i>
                <span>Casa</span>
            </div>
        </a>
    </li>
    <li class="item">
        <a href="{{ route('visitador.course.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-slideshow'></i>
                <span>Cursos</span>
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
        <a href="{{ route('visitador.contact.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-contact'></i>
                <span>Contacto</span>
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
            <input type="submit" class="btn btn-danger mt-2 w-100" value="Salir">
        </form>
    </li>
@endcan
