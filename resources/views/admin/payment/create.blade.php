@extends('layouts.admin')

@section('title', 'Tambah Pembayaran Baru')
@section('nama_toko', $config->nama_toko)

@section('content')
<div class="bag bag-10">
    <div class="wrap">
        <form action="{{ route('payment.store') }}" method="post">
            {{ csrf_field() }}
            <div class="bag bag-10">
                <div>No. Rekening</div>
                <input type="number" class="box" name="bank_number">
            </div>
            <div class="bag bag-5">
                <div>Nama Bank</div>
                <input type="text" class="box" name="bank_name">
            </div>
            <div class="bag bag-5">
                <div>Atas Nama</div>
                <input type="text" class="box" name="account_name">
            </div>
            <button class="biru">Buat</button>
            <button type="button" onclick="history.back(-1)" class="ml-2">Kembali</button>
        </form>
    </div>
</div>
@endsection