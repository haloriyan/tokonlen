@extends('layouts.auth')

@section('title', 'Login |'. $config->nama_toko)

@section('content')
<h1>Login</h1>
<div class="container">
    <div class="wrap">
        <div id="status"><i class="fas fa-spinnner"></i> Sedang login...</div>
        <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
    </div>
</div>

@endsection

@section('javascript')
<script src="https://apis.google.com/js/platform.js"></script>
<script>
    // Client ID : 1008141661550-1l5581hjohq97lj33rubc7e1k1qthv3v.apps.googleusercontent.com
    // Secret ID : ViYRq4ZHo8zvkEte734rXxRo
    function onSignIn(googleUser) {
        let profile = googleUser.getBasicProfile()

        console.log("Name : " + profile.getName())
        console.log("Email : " + profile.getEmail())
    }
</script>
@endsection