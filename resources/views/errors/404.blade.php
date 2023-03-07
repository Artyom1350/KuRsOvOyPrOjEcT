<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Вход</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/error.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center row-main">
                    <div class="wrap_card d-block m-auto">
                        <div class="card bg-color">
                            <div class="card-body text-center">
                                <img src="{{ asset('image/logo/logo.png') }}" class="logo" alt="Логотип КГАПОУ Пермский Авиационный техникум">
                                <h2>404</h2>
                                <p>Искомая страница не найдена.</p>
                                <p><small>Перейдите на <a href="{{ route('home') }}">главную страницу.</a> </small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>


