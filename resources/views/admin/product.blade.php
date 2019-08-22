@extends('layouts.admin')

@section('title', 'Daftar Produk')
@section('nama_toko', $config->nama_toko)

@section('cta')
    <a href="{{ route('product.create') }}">
        <button class="biru">Tambah Baru</button>
    </a>
@endsection

@section('content')
@if ($products->count() == 0)
    <div class="bag bag-10">
        <div class="wrap">
            <h3>Tidak ada produk</h3>
        </div>
    </div>
@else
<div class="bag bag-10">
    <div class="wrap">
        <input type="text" class="box" placeholder="Cari produk...">
    </div>
</div>

<div class="bag bag-10">
    <div class="wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 7%;">No</th>
                    <th>Nama</th>
                    <th style="width: 10%;">Stok</th>
                    <th style="width: 22%;"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($products as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>
                            <a href="{{ route('product.edit', $item->idproduct) }}">
                                <button class="hijau"><i class="fas fa-edit"></i></button>
                            </a>
                            <form action="{{ route('product.delete', $item->idproduct) }}" method="post">
                                {{ csrf_field() }}
                                <button class="merah"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection