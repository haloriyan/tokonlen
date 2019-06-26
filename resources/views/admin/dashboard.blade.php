@extends('layouts.admin')

@section('title', 'Dashboard')
@section('nama_toko', $config->nama_toko)

@section('head.dependencies')
<style>
    .card { width: 32.5%; }
    .card h2 {
        display: inline-block;
        font-size: 40px;
        margin: 10px 10px;
        margin-left: 0px;
    }
</style>
@endsection

@section('content')
<div class="bag bag-3 card">
    <div class="wrap">
        <h2>5</h2>
        <span>orderan</span>
        <p class="teks-transparan teks-kecil">Hari ini</p>
    </div>
</div>
<div class="bag bag-3 card">
    <div class="wrap">
        <h2>5</h2>
        <span>orderan</span>
        <p class="teks-transparan teks-kecil">Hari ini</p>
    </div>
</div>
<div class="bag bag-3 card">
    <div class="wrap">
        <h2>5</h2>
        <span>orderan</span>
        <p class="teks-transparan teks-kecil">Hari ini</p>
    </div>
</div>

<div class="bag bag-5">
    <div class="wrap">
        eep
    </div>
</div>
<div class="bag bag-5">
    <div class="wrap">
        eep
    </div>
</div>
@endsection