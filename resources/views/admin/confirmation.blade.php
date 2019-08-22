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
                            <td>{{ $item->users->alamat }} ({{ $item->users->nama }})</td>
                            <td>
                                <a href="{{ route('evidence', $item->idorder) }}">
                                    <img src="{{ asset('storage/evidence/'.$item->bukti) }}" class="lebar-25">;
                                </a>
                            </td>
                            <td>
                                {{-- <form action="{{ route('payment.confirmation', $item->idorder) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="biru">Kirim</button>
                                </form> --}}
                                <button class="biru" onclick="kirim(this.value)" value="{{ $item->idorder }}">Kirim</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="confirm">
    <div class="popup">
        <div class="wrap">
            <h3>Kirim Barang Orderan
                <div class="ke-kanan" onclick="tutup('#confirm')"><i class="fas fa-times"></i></div>
            </h3>
            <form action="{{ route('payment.confirmation') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" class="box" id="orderId" name="orderId">
                <div>No. Resi :</div>
                <input type="text" class="box" name="resi" style="width: 100%;">
                <button class="biru lebar-100">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const kirim = (orderId) => {
        munculPopup("#confirm", $("#confirm").pengaya("top: 120px"))
        $("#orderId").isi(orderId)
    }
    const tutup = (popupId) => {
        hilangPopup(popupId)
    }
</script>
@endsection