@extends('layouts.user')

@section('title', 'Cara Membayar')

@section('content')

<div class="container rata-tengah" style="top: 150px;">
    <div class="bag bag-6 bg-putih bayangan-5 rounded">
        <div class="wrap">
            <p>Pembayaran bisa dikirimkan melalui rekening berikut ini :</p>
        </div>
    </div>
    <br />
    @foreach ($data as $item)
        <div class="bag bag-3 bg-putih bayangan-5 rata-kiri rounded m-1">
            <div class="wrap">
                <h3>{{ $item->bank_name }}</h3>
                <p>{{ $item->bank_number }}</p>
                <p class="teks-transparan">a/n {{ $item->account_name }}</p>
            </div>
        </div>
    @endforeach
    <br />
    <div class="bag bag-6 mt-4">
        <a href="{{ route('confirmation.page') }}">
            <button class="biru lebar-100">Konfirmasi Pembayaran</button>
        </a>
    </div>
</div>
@endsection