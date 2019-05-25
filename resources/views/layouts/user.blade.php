<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') {{ $config->nama_toko }}</title>
    <link rel="stylesheet" href="{{ asset('fw/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>

<div class="atas">
    <div class="title">@yield('title')</div>
    <nav>
        @if($myData == "")
            <li><a href="{{ route('login') }}"><button class="biru-alt">Login</button></a></li>
        @else
            <li menu="ada">
                <a href="#"><button class="biru-alt">Halo, {{ $myData->nama }}</button></a>
                <ul class="sub-menu">
                    <a href="{{ route('cart') }}"><li>Keranjang</li></a>
                    <a href="#"><li>Pesanan</li></a>
                    <a href="#"><li>Akun</li></a>
                    <li>
                        <form action="{{ route('logout') }}" method="get">
                            {{ csrf_field() }}
                            <button class="no-style">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        @endif
    </nav>
</div>

@yield('content')

<script src="{{ asset('js/embo.js') }}"></script>
@yield('javascript')

</body>
</html>