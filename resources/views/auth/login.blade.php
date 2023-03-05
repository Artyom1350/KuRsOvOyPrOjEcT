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
    <script src="{{ asset('js/title.js') }}" defer></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center row-main">
                    <div class="col-md-8 d-block m-auto">
                        <div class="card">
                            <div class="card-body">
                                <img src="image/logo/logo.png" class="logo" alt="Логотип КГАПОУ Пермский Авиационный техникум">
                                <form method="POST" action="{{ route('login') }}" id="logIn">
                                    @csrf
                                    <div class="form-group row row-form">
                                            <input autofocus placeholder="Логин или адрес электронной почты" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group row row-form">
                                            <input placeholder="Пароль" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="form-group row row-form form-check">
                                        <input class="form-check-input" type="checkbox"  id="watchPassword">
                                        <label class="form-check-label" for="watchPassword">
                                            Показать пароль
                                        </label>
                                    </div>
                                </form>
                                <div class="form-group row mb-0 submit_link">
                                    <button type="submit" class="btn btn-primary" form="logIn">
                                        {{ __('Вход') }}
                                    </button>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
