<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/title.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/title.css') }}" rel="stylesheet">

</head>
<body>
    @auth
    <header class="paddingBlock">
        <div class="logoWrap">
            <a href="{{ route('home') }}">
                <img src="image/logo/logo.png" class="logo" alt="Логотип КГАПОУ Пермский Авиационный техникум">
            </a>
        </div>
        <h1>
            СДО КГАПОУ Пермский Авиационный техникум
        </h1>
        <div class="exit">
            <a href="{{ url('/logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                <img src="image/icons/logout_icon.svg" alt="Выход">
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </header>
    <main class="main d-flex">
        <div class="d-flex flex-column flex-shrink-0 bg-color sideboard">
            <a href="{{ route('home') }}" class="homeLink p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right">
                <img src="image/icons/home.svg" class="" alt="Главная">
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item ">
                    <a href="{{ route('home') }}" class="nav-link calendar py-3 border-bottom border-top rounded-0" aria-current="page" data-bs-toggle="tooltip" data-bs-placement="right">
                        Календарь
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('myApplacation')}}" class="nav-link myApplic py-3 border-bottom rounded-0" aria-current="page" data-bs-toggle="tooltip" data-bs-placement="right">
                        Исходящие заявки
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('incApplacation')}}" class="nav-link applicInProc py-3 border-bottom rounded-0" aria-current="page" data-bs-toggle="tooltip" data-bs-placement="right">
                        Входящие заявки
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('allApplacation')}}" class="nav-link personArea py-3 border-bottom rounded-0" aria-current="page" data-bs-toggle="tooltip" data-bs-placement="right">
                        Все заявки
                    </a>
                </li>
            </ul>
        </div>    
        @yield('content');
    </main>
    @endauth
    <footer class="d-flex align-items-center paddingBlock">
        &copy; КГАПОУ Пермский Авиационный техникум
    </footer>
</body>
</html>