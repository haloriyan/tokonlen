@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('nama_toko', $config->nama_toko)

@section('content')
<div class="bag bag-10">
    <div class="wrap">
        <form action="{{ route('product.update', $data->idproduct) }}" method="POST">
            {{ csrf_field() }}
            <div>Nama Produk :</div>
            <input type="text" class="box" name="title" value="{{ $data->title }}">
            <div>Deskripsi :</div>
            <textarea name="description" class="box">{{ $data->description }}</textarea>
            <div>Harga</div>
            <input type="number" class="box" name="price" value="{{ $data->price }}">
            <div>Stok</div>
            <input type="number" class="box" name="stock" value="{{ $data->stock }}">
            <button class="biru">hehe</button>
        </form>
    </div>
</div>
@endsection