@extends('layouts.auth')

@section('title', 'Login |'. $config->nama_toko)

@section('content')
<h1>Login</h1>
<div class="container">
    <div class="wrap">
        <div class="rata-tengah">
            <button class="biru" onclick="facebook()">Login via Facebook</button>
            <br />
            <button class="merah mt-2" onclick="google()">Login via Google</button>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    function facebook() {
        document.location = "./login/facebook"
    }
    function google() {
        document.location = "./login/google"
    }
</script>
@endsection