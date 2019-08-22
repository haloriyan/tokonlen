@extends('layouts.admin')

@section('title', 'Ubah Kategori')
@section('nama_toko', $config->nama_toko)

@section('content')
<div class="bag bag-10">
    <div class="wrap">
        <form action="{{ route('category.update', $category->idcategory) }}" method="post">
            {{ csrf_field() }}
            <div>Nama kategori :</div>
            <input type="text" class="box" name="nama" value="{{ $category->category }}">
            <button class="biru">Buat</button>
        </form>
    </div>
</div>
@endsection