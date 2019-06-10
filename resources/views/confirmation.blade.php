@extends('layouts.user')

@section('title', 'Konfirmasi Pembayaran')

@php
function toIdr($angka) {
    return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}
@endphp

@section('content')

<div class="container rata-tengah" style="top: 150px;">
    <div class="bag bag-6 bg-putih bayangan-5 rounded rata-kiri">
        <div class="wrap">
            {{-- <p>Pembayaran bisa dikirimkan melalui rekening berikut ini :</p> --}}
            @if($myOrder->count() == 0)
                <h3>Tidak ada orderan yang perlu dibayar</h3>
                <a href="{{ route('user.orderan') }}">
                    <button class="biru-alt lebar-100">Lihat orderan saya</button>
                </a>
            @else
                <form action="{{ route('confirmation.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div>Pilih Invoice :</div>
                    <select name="invoice" class="box mt-1">
                        @foreach ($myOrder as $item)
                            @php
                                $selected = "";
                                if($item->idorder == $toPay) {
                                    $selected = "selected";
                                }
                            @endphp
                            <option value="{{ $item->idorder }}" {{ $selected }}>INV{{ $item->idorder }}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">Bukti Pembayaran :</div>
                    <input type="file" class="box mt-1" name="bukti" required>
                    <button class="biru-alt lebar-100 mt-2">Bayar</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection