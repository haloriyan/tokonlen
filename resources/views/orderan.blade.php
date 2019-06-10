@extends('layouts.user')

@section('title', 'Orderan')

@php
function toIdr($angka) {
    return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}
@endphp

@section('content')

<div class="container rata-tengah" style="top: 150px;">
    <div class="bag bag-8 d-inline-block bg-putih rounded bayangan-5 rata-kiri">
        <div class="wrap">
            @if($myOrder == "null" || $myOrder->count() == 0)
                <h3>Kamu belum order sama sekali :)</h3>
                <div class="rata-tengah">
                    <a href="{{ route('user.index') }}"><button class="biru-alt">Belanja sesuatu</button></a>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th style="width: 40%;">No. Invoice</th>
                            <th>Total</th>
                            <td>Status</td>
                            <th style="width: 25%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($myOrder as $item)
                            @php
                                $payButton = "";
                                if($item->status == 2) {
                                    $displayedStatus = "Dikirim";
                                }else if($item->status == 3) {
                                    $displayedStatus = "Dibayar";
                                }else if($item->status == 0 ) {
                                    $displayedStatus = "Belum dibayar";
                                    $payButton = "<a href='". route('confirmation.page', $item->idorder)."'>
                                        <button class='hijau-alt'>Bayar</button>
                                    </a>";
                                }
                            @endphp
                            <tr>
                                <td>INV{{ $item->idorder }}</td>
                                <td>{{ toIdr($item->total) }}</td>
                                <td>{{ $displayedStatus }}</td>
                                <td>
                                    <a href="{{ route('order.detail', $item->idorder) }}">
                                        <button class="biru-alt">Detail</button>
                                    </a>
                                    {!! $payButton !!}
                                </td>
                            </tr>
                        @endforeach
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