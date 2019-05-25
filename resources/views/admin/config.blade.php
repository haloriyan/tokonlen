@extends('layouts.admin')

@section('title', 'Konfigurasi Toko')
@section('nama_toko', $config->nama_toko)

@section('content')
<div class="bag bag-10">
    <div class="wrap">
        <form action="{{ route('admin.config.set') }}" method="post">
            {{ csrf_field() }}
            <h3>Detail Toko</h3>
            <input type="hidden" name="_method" value="put">
            <div>Nama Toko :</div>
            <input type="text" class="box" name="nama_toko" value="{{ $config->nama_toko }}">
            <div>Slogan :</div>
            <input type="text" class="box" name="motto" value="{{ $config->motto }}">
            <div>Alamat Toko :</div>
            <textarea name="alamat" class="box">{{ $config->alamat }}</textarea>
            @if($notif !== "")
                <h3>{{ $notif }}</h3>
            @endif
            <button class="biru">Simpan</button>
        </form>
    </div>
</div>

<div class="bag bag-10">
    <div class="wrap">
        <form action="{{ route('admin.config.setBrand') }}" method="post">
            {{ csrf_field() }}
            <h3>Branding Toko</h3>
            <div>Icon :</div>
            <input type="file" class="box" name="icon">
            <div>Logo :</div>
            <input type="file" class="box" name="logo">
            <button class="biru">Simpan</button>
        </form>
    </div>
</div>
@endsection