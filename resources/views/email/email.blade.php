@component('mail::message')
    {{-- Greeting --}}
    @if (! empty($greeting))
    # {{ $greeting }}
    @else
    @if ($level == 'error')
    # Whoops!
    @else
    # Hello!
    @endif
    @endif
    {{-- Intro Lines --}}
    @foreach ($introLines as $line)
    {{ $line }}
    @endforeach
    {{-- Action Button --}}
    @isset($actionText)
    @component('mail::button', ['url' => $actionUrl, 'color' => $color])
    {{ $actionText }}
    @endcomponent
    @endisset
    {{-- Outro Lines --}}
    @foreach ($outroLines as $line)
    {{ $line }}
    @endforeach
    {{-- Salutation --}}
    @if (! empty($salutation))
    {{ $salutation }}
    @else
    Regards,
    {{ config('app.name') }}
    @endif
    {{-- Subcopy --}}
    @isset($actionText)
    @component('mail::subcopy')
    If you’re having trouble clicking the "{{ $actionText }}" button, copy and paste the URL below
    into your web browser: [{{ $actionUrl }}]({{ $actionUrl }})
    @endcomponent
    @endisset
@endcomponent
<div>
    <header class="paddingBlock">
        <div class="logoWrap">
            <img src="{{url('image/logo/logo.png')}}" class="logo" alt="Логотип КГАПОУ Пермский Авиационный техникум">
        </div>
    </header>
    <main class="main d-flex ">
        <div class="content">
            <h1>Ответы на заявку <u>{{$title}}</u></h1>
            <p>Все ответы на заявку в статусе: <b>готово</b></p>
            <p>Ссылка на заявку: <a href="{{url('/myAppl')}}">{{url('/myAppl')}}</a></p>
        </div>
    </main>
    <footer class="d-flex paddingBlock">
        &copy; СДО КГАПОУ "Авиатехникум"
    </footer>
</div>
<style>
    header{
        height: 13%;
        background: #fff;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    body{
        height: 100vh;
    }
    main{
        min-height: 77%;
    }
    .paddingBlock{
        padding: 0 10%;
    }
    footer{
        background: #fff;
        min-height: 150px;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
        font-size: x-large;
        height: 10%;
    }
    a {
        color:#fff !important;
    }
    p{
        margin: auto !important;
    }
    @media screen and (max-width:720px) {
        .container h1{
            margin-top: 50px;
            font-size: 1.2rem !important;
            text-align: center;
        }
    }
    @media screen and (max-width:1080px) {
        .paddingBlock{
            padding: 0 3%;
        }
        .paddingBlock h1{
            font-size: 2rem;
        }
        .container h1{
            font-size: 1.5rem !important;
            text-align: center;
        }
    }
    
</style>