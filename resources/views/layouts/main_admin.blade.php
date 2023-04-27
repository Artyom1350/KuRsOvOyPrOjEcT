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
            <a href="{{ route('home_admin') }}">
                <img src="{{asset('image/logo/logo.png')}}" class="logo" alt="Логотип КГАПОУ Пермский Авиационный техникум">
            </a>
        </div>
        <h1>
            СДО КГАПОУ "Авиатехникум"
        </h1>
        <div class="exit">
            <a href="{{ url('/userLogou') }}"
            onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <img src="{{asset('image/icons/logout_icon.svg')}}" alt="Выход">
            </a>
            <form id="logout-form" action="{{ url('/userLogout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </header>
    <main class="main d-flex">
        <div class="burger bg-color">
            <img class="svg open" src="{{asset('image/icons/menu.svg')}}" alt="Список">
            <img class="svg close" src="{{asset('image/icons/x.svg')}}" alt="Крест">
        </div>
        <div class="posRel">
            <div class="d-flex flex-column flex-shrink-0 bg-color sideboard">
                <a href="{{ route('home_admin') }}" class="homeLink p-3 link-dark text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right">
                    <img src="{{asset('image/icons/home.svg')}}" class="" alt="Главная">
                </a>
                <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                    <li class="nav-item ">
                        <a href="{{ route('user_admin') }}" class="nav-link users py-3 border-bottom border-top rounded-0" aria-current="page" data-bs-toggle="tooltip" data-bs-placement="right">
                            Пользователи
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('group_admin') }}" class="nav-link groups py-3 border-bottom border-top rounded-0" aria-current="page" data-bs-toggle="tooltip" data-bs-placement="right">
                            Структурные подразделения
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('download_template_user')}}" class="nav-link groups py-3 border-bottom border-top rounded-0" aria-current="page" data-bs-toggle="tooltip" data-bs-placement="right">
                            Скачать шаблон для импорта пользователей
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{ route('download_template_departments_and_parts')}}" class="nav-link groups py-3 border-bottom border-top rounded-0" aria-current="page" data-bs-toggle="tooltip" data-bs-placement="right">
                            Скачать шаблон для импорта подразделений
                        </a>
                    </li>
                </ul>
            </div>  
        </div>  
        @yield('content')
        
    </main>
    @endauth
    <footer class="text-center d-flex align-items-center paddingBlock">
        &copy; СДО КГАПОУ "Авиатехникум"
    </footer>
</body>
</html>