<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | @yield('nama_toko')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fw/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    
<div class="atas">
    <div id="tblMenu"><i class="fas fa-bars"></i></div>
    <h1>@yield('title')</h1>
    @yield('cta')
</div>

<div class="kiri">
    <div class="wrap">
        hehe
    </div>
</div>

<div class="container">
    @yield('content')
</div>

<script src="{{ asset('js/embo.js') }}"></script>
@yield('javascript')

</body>
</html>