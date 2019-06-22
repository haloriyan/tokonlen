@extends('layouts.user')

@inject('UserController', 'App\Http\Controllers\UserController')

@section('title', 'Detail Order')

@php
function toIdr($angka) {
    return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}
@endphp

@section('content')

<div class="container rata-tengah" style="top: 150px;">
    <div class="bag bag-8 d-inline-block bg-putih rounded bayangan-5 rata-kiri">
        <div class="wrap">
            @if($myCart == "null" || $myCart->count() == 0)
                <h3>Keranjang kosong :)</h3>
                <div class="rata-tengah">
                    <a href="{{ route('user.orderan') }}"><button class="biru-alt">Cek orderan</button></a>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th style="width: 60%;">Produk</th>
                            <th>Qty</th>
                            <th>Total</th>
                            @if ($myOrder->status == 1)
                                <th></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($myCart as $item)
                            <tr>
                                <td><a href="{{ route('product.view', $item->idproduct) }}" class="teks-gelap">{{ $item->title }}</a></td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ toIdr($item->total) }}</td>
                                @if ($UserController::ableToReview($item->idproduct, $myData->iduser))
                                    <td>
                                        <a href="{{ route('review.write', $item->idproduct) }}">
                                            <button class="hijau-alt"><i class="fas fa-edit"></i> Ulas</button>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">Shipping fee</td>
                            <td colspan="2">
                                {{ toIdr($myOrder->shipping_price) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{ $myCart->sum('qty') }}</td>
                            <td colspan="2">{{ toIdr($myCart->sum('total') + $myOrder->shipping_price ) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="rata-tengah mt-4">
                    @if ($myOrder->status == 0)
                        <a href="{{ route('confirmation.page', $item->order_id) }}">
                            <button class="biru-alt">Bayar</button>
                        </a>
                    @else
                        <a href="#" onclick="history.back(-1)">
                            <button>Kembali</button>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection