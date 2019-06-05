@extends('layouts.admin')

@section('title', 'Ubah Pembayaran '.$data->account_name)
@section('nama_toko', $config->nama_toko)

@section('content')
<div class="bag bag-10">
    <div class="wrap">
        <form action="{{ route('payment.update', $data->idpayment) }}" method="post">
            {{ csrf_field() }}
            <div class="bag bag-10">
                <div>No. Rekening</div>
                <input type="number" class="box" name="bank_number" value="{{ $data->bank_number }}">
            </div>
            <div class="bag bag-5">
                <div>Nama Bank</div>
                <input type="text" class="box" name="bank_name" value="{{ $data->bank_name }}">
            </div>
            <div class="bag bag-5">
                <div>Atas Nama</div>
                <input type="text" class="box" name="account_name" value="{{ $data->account_name }}">
            </div>
            <button class="biru">Ubah</button>
            <button type="button" onclick="history.back(-1)" class="ml-2">Kembali</button>
        </form>
    </div>
</div>
@endsection