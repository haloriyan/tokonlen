@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru')
@section('nama_toko', $config->nama_toko)

@section('content')
<div class="bag bag-10">
    <div class="wrap">
        <form action="{{ route('category.store') }}" method="post">
            {{ csrf_field() }}
            <div>Nama kategori :</div>
            <input type="text" class="box" name="nama">
            <button class="biru">Buat</button>
        </form>
    </div>
</div>
@endsection