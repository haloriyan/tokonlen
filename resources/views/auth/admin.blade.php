@extends('layouts.auth')

@section('title', 'Login |'. $config->nama_toko)

@section('content')
<h1>Login</h1>
<div class="container">
    <div class="wrap">
        <form action="{{ route('admin.login.action') }}" class="mt-4 mb-4" method="POST">
            {{ csrf_field() }}
            <div>Email :</div>
            <input type="email" class="box" name="email" required>
            <div>Password :</div>
            <input type="password" class="box" name="password" required>
            <button class="tbl biru">Login</button>
        </form>
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