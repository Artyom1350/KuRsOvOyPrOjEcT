<div style="display:flex; justify-content:center; align-items: center; flex-direction: column;"> 
    <header class="paddingBlock">
        <div class="logoWrap">
            <img style="margin-right: -30px; width: 150px;" src="https://upload.wikimedia.org/wikipedia/ru/1/13/%D0%9B%D0%BE%D0%B3%D0%BE%D1%82%D0%B8%D0%BF_%D0%9F%D0%B5%D1%80%D0%BC%D1%81%D0%BA%D0%B8%D0%B9_%D0%B0%D0%B2%D0%B8%D0%B0%D1%86%D0%B8%D0%BE%D0%BD%D0%BD%D1%8B%D0%B9_%D1%82%D0%B5%D1%85%D0%BD%D0%B8%D0%BA%D1%83%D0%BC.png" class="logo" alt="Логотип КГАПОУ Пермский Авиационный техникум">
        </div>
    </header>
    <main class="main d-flex ">
        <div class="content"
        style="text-align:center">
            <h1>Вам пришла новая заявка: <br> <u>{{$title}}</u></h1>
            <p>Ссылка на заявку: <a href="{{url('/incAppl/'.$id)}}">{{url('/incAppl')}}</a></p>
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