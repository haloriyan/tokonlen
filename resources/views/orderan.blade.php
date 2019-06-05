@extends('layouts.user')

@section('title', 'Orderan')

@php
function toIdr($angka) {
    return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}
if($myOrder->status == 0) {
    $statusDisplay = "Belum dibayar";
}else if($myOrder->status == 2) {
    $statusDisplay = "Sudah dibayar, menunggu konfirmasi";
}
@endphp

@section('content')

<div class="container rata-tengah" style="top: 150px;">
    <div class="bag bag-8 d-inline-block bg-putih rounded bayangan-5 rata-kiri">
        <div class="wrap">
            @if($myCart == "null" || $myCart->count() == 0)
                <h3>Kamu belum order sama sekali :)</h3>
                <div class="rata-tengah">
                    <a href="{{ route('user.index') }}"><button class="biru-alt">Belanja sesuatu</button></a>
                </div>
            @else
                <h3>Status : {{ $statusDisplay }}</h3>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 60%;">Produk</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($myCart as $item)
                            <tr>
                                <td><a href="{{ route('product.view', $item->idproduct) }}" class="teks-gelap">{{ $item->title }}</a></td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ toIdr($item->total) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Sub total</td>
                            <td>{{ $myCart->sum('qty') }}</td>
                            <td colspan="2">{{ toIdr($myCart->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="rata-tengah mt-4">
                    <a href="{{ route('user.index') }}"><button class="hijau-alt">Belanja lainnya</button></a>
                    <a href="{{ route('payment.page') }}"><button class="biru-alt">Lihat cara membayar</button></a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection