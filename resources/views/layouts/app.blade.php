<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Eshop') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                            <a href="{{url("/produkt/kategoria/1")}}" class="btn btn-link nav-link">Proteíny</a>
                            <a href="{{url("/produkt/kategoria/2")}}" class="btn btn-link nav-link">Aminokyseliny</a>
                            <a href="{{url("/produkt/kategoria/3")}}" class="btn btn-link nav-link">Kreatin</a>
                        @guest
                        @else
                            @if(Auth::user()->isAdmin())
                        <div class="btn-group dropright">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Admin
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/admin/produkty">Produkty</a>
                                <a href="{{url("/produkt/create")}}" class="dropdown-item">Vytvor produkt</a>
                                <!-- Dropdown menu links -->
                            </div>
                        </div>
                            @endif
                        @endguest
                    </ul>
                    <a href="{{url("/kosik")}}" class="btn btn-link nav-link">Košík</a>
                    <a href="{{url("/objednavky")}}" class="btn btn-link nav-link">Objednávky</a>



                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="min-height: 100vh;">
            @yield('content')
        </main>
        <footer>
            <div class="podakovanie">Ďakujem za navštívenie mojej stránky</div>
            <ul class="footer-wrap">
                <li>Richard Vráblik</li>
                <li>2021</li>
            </ul>
        </footer>
    </div>
</body>
<script>
    $(document).ready(function (){
        $('.addtocart').submit( function(event) {
            event.preventDefault();
           let produktid = $(event.target).find('input[name="produktid"]').val();
            let formData = new FormData();
            formData.append("produktid" , produktid);
            axios.post("/kosik",formData)
                .then(result => {
                    console.log(result);
                    alert(result.data);
                })
                .catch(error => {
                    console.log(error);
                });
        });
        $('.removeFromCart').submit( function(event) {
            event.preventDefault();
            let produktid = $(event.target).find('input[name="produktid"]').val();
            console.log(produktid);
            let formData = new FormData();
            formData.append("_method" , "DELETE");
            formData.append("produktid" , produktid);
            axios.post("/kosik",formData)
                .then(result => {
                    //console.log(result);
                    alert(result.data);
                    location.reload();
                })
                .catch(error => {
                    console.log(error);
                });
        });
        $('.update').submit( function(event) {
            event.preventDefault();
            let produktid = $(event.target).find('input[name="produktid"]').val();
            let mnozstvo = $(event.target).parent().find('input[name="mnozstvo"]').val();
            console.log(produktid);
            console.log(mnozstvo);
            let formData = new FormData();
            formData.append("_method" , "PUT");
            formData.append("produktid" , produktid);
            formData.append("mnozstvo" , mnozstvo);
            axios.post("/kosik",formData)
                .then(result => {
                    //console.log(result);
                    alert(result.data);
                    location.reload();
                })
                .catch(error => {
                    console.log(error);
                });
        });
    })
</script>
</html>
