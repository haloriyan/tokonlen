@extends('layouts.admin')

@section('title', 'Konfirmasi Pembayaran')
@section('nama_toko', $config->nama_toko)

@section('content')
<div class="bag bag-10">
    <div class="wrap">
        @if($datas->count() == 0)
            <h3>Tidak ada orderan yang perlu dikirim</h3>
        @else
            <table>
                <thead>
                    <tr>
                        <th>No. Invoice</th>
                        <th style="width: 40%;">Kirim ke</th>
                        <th style="width: 15%;">Bukti</th>
                        <th style="width: 20%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $item)
                        <tr>
                            <td>INV{{$item->idorder}}</td>
                            <td>{{ $item->alamat }} ({{ $item->nama }})</td>
                            <td>
                                <a href="{{ route('evidence', $item->idorder) }}">
                                    <img src="{{ asset('storage/evidence/'.$item->bukti) }}" class="lebar-25">;
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('payment.confirmation', $item->idorder) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="biru">Kirim</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection