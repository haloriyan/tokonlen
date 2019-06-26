<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messaging</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fw/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/messaging.css') }}">
</head>
<body>

<div class="listChat">
    <div class="header">
        <i class="fas fa-angle-left"></i> Kembali ke dashboard
    </div>
    <div class="list">
        <div class="wrap">
            <h3>Riyan Satria</h3>
            <p>Halo kak</p>
            <div class="time teks-transparan">3 menit</div>
        </div>
    </div>
    <div class="list">
        <div class="wrap">
            <h3>Riyan Satria</h3>
            <p>Halo kak</p>
            <div class="time teks-transparan">3 menit</div>
        </div>
    </div>
    <div class="list">
        <div class="wrap">
            <h3>Riyan Satria</h3>
            <p>Halo kak</p>
            <div class="time teks-transparan">3 menit</div>
        </div>
    </div>
    <div class="list">
        <div class="wrap">
            <h3>Riyan Satria</h3>
            <p>Halo kak</p>
            <div class="time teks-transparan">3 menit</div>
        </div>
    </div>
    <div class="list">
        <div class="wrap">
            <h3>Riyan Satria</h3>
            <p>Halo kak</p>
            <div class="time teks-transparan">3 menit</div>
        </div>
    </div>
    <div class="list">
        <div class="wrap">
            <h3>Riyan Satria</h3>
            <p>Halo kak</p>
            <div class="time teks-transparan">3 menit</div>
        </div>
    </div>
</div>

<div class="atas">
    <h1>Riyan Satria</h1>
</div>

<div class="contentMessage">
    <div class="boxMessage">
        <div class="wrap">
            hehe
        </div>
    </div>
    @for ($i = 0; $i < 5; $i++)
        
    <div class="boxMessage saya">
        <div class="wrap">
            hehe
        </div>
    </div>
    @endfor
</div>

<div class="typingArea">
    <form action="#">
        {{ csrf_field() }}
        <input type="hidden" name="user_id">
        <input type="text" class="box" placeholder="Ketik pesan...">
        <button class="kirim"><i class="fas fa-paper-plane"></i></button>
    </form>
</div>

<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

@yield('javascript')

</body>
</html>