@extends('layouts.user')

@section('title', 'Keranjang Belanja')

@php
function toIdr($angka) {
    return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}
@endphp

@section('content')

<div class="container rata-tengah" style="top: 150px;">
    <div class="bag bag-8 d-inline-block bg-putih rounded bayangan-5 rata-kiri">
        <div class="wrap">
            @if($myCart->count() == 0)
                <h3>Keranjang kosong :)</h3>
            @else
                <table>
                    <thead>
                        <tr>
                            <th style="width: 60%;">Produk</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th style="width: 10%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($myCart as $item)
                            <tr>
                                <td><a href="{{ route('product.view', $item->idproduct) }}" class="teks-gelap">{{ $item->title }}</a></td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ toIdr($item->total) }}</td>
                                <td>
                                    <form action="{{ route('cart.delete', $item->idcart) }}" method="post">
                                        {{ csrf_field() }}
                                        <button class="merah-alt"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
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
                    <button class="biru-alt">Lanjut checkout</button>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection