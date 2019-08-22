<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('productName') {{ $config->nama_toko }}</title>
    <link rel="stylesheet" href="{{ asset('fw/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @yield('head.dependencies')
</head>
<body>

<div class="atas">
    <div class="title">@yield('title')</div>
    <nav>
        @if($myData != "public")
            @if($myData == "")
                <li><a href="{{ route('login') }}"><button class="biru-alt">Login</button></a></li>
            @else
                @if($myData == "private")
                    <script>
                        let toLogin = "{{ route('user.login') }}"
                        document.location = toLogin
                    </script>
                @else
                    <li menu="ada">
                        <a href="#"><button class="biru-alt">Halo, {{ $myData->nama }}</button></a>
                        <ul class="sub-menu">
                            @php
                                $myCart = ($myData->keranjang == "") ? "0" : $myData->keranjang;
                                $myOrderan = ($myData->orderan == "") ? "0" : $myData->orderan;
                                $myNotification = ($myData->notifikasi == "") ? "0" : $myData->notifikasi;
                            @endphp
                            <a href="{{ route('cart') }}"><li>Keranjang <b>({{ $myCart }})</b></li></a>
                            <a href="/orderan-saya"><li>Orderan <b>({{ $myOrderan }})</b></li></a>
                            <a href="/notifikasi"><li>Notifikasi <b>({{ $myNotification }})</b></li></a>
                            <a href="/profil/pengaturan"><li>Akun</li></a>
                            <li>
                                <form action="{{ route('logout') }}" method="get">
                                    {{ csrf_field() }}
                                    <button class="no-style">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        @endif
    </nav>
</div>

@yield('content')

<script src="{{ asset('js/embo.js') }}"></script>
@yield('javascript')

</body>
</html>