@extends('layouts.auth')

@section('title', 'Register |'. $config->nama_toko)

@section('content')
<h1>Register</h1>
<div class="container">
    <div class="wrap">
        <form action="{{ route('register') }}" method="post">
            {{ csrf_field() }}
            <div>Nama :</div>
            <input type="text" class="box" name="nama" value="{{ $data['nama'] }}">
            <div>Email :</div>
            <input type="email" class="box" name="email" value="{{ $data['email'] }}">
            <div>Password :</div>
            <input type="password" name="password" class="box">
            <div>Ulangi Password :</div>
            <input type="password" name="rePassword" class="box">
            <button class="biru">Register</button>
        </form>
    </div>
</div>
@endsection