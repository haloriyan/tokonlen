@extends('layouts.user')

@php
function toIdr($angka) {
    return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}
@endphp

@section('title', $product->title)

@section('content')
<div class="container" style="top: 150px;">
    @if($product == "")
        <div class="bag bag-10 bg-putih bayangan-5 rounded">
            <div class="wrap">
                <h3>Produk tidak ada :(</h3>
            </div>
        </div>
    @else
        <div class="bag bag-10">
            {{--  --}}
        </div>
        <div class="bag bag-6 bg-putih bayangan-5 rounded">
            <div class="wrap">
                <h2>{{ $product->title }}</h2>
                <p>{{ $product->description }}</p>
            </div>
        </div>
        <div class="bag bag-1"></div>
        <div class="bag bag-3 bg-putih bayangan-5 rounded">
            <div class="wrap">
                @if($myData != "")
                    <form action="{{ route('cart.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="rata-tengah">
                            <input type="hidden" name="product_id" value="{{ $product->idproduct }}">
                            <button type="button" class="biru-alt" onclick="decreaseQty()">-</button>
                            <input type="number" class="box bag-2 rata-tengah" id="qty" name="qty" min="1" value="1">
                            <button type="button" class="biru-alt" onclick="increaseQty()">+</button>

                            <h3>Total : <span id="totalPrice"></span></h3>

                            <button class="mt-1 biru-alt">Tambah ke Keranjang</button>
                        </div>
                    </form>
                @else
                    <p>Login dulu untuk menambahkan produk ini ke keranjang</p>
                @endif
            </div>
        </div>
        <div class="bag bag-10 bg-putih bayangan-5 rounded mt-4">
            <div class="wrap">
                <h2>Ulasan</h2>
            </div>
        </div>
    @endif
</div>
@endsection

@section('javascript')
<script>
    let price = {{ $product->price }}
    function getQty() {
        return ($("#qty").isi() == 0) ? 0 : $("#qty").isi()
    }
    function calcPrice(qty) {
        let calc = price * qty
        if(calc < price) {
            return false
        }
        $("#totalPrice").tulis(calc)
        return calc
    }
    function increaseQty() {
        let qty = getQty()
        let increase = parseInt(qty) + parseInt(1)
        $("#qty").isi(increase)
        calcPrice(increase)
    }
    function decreaseQty() {
        let qty = getQty()
        let decrease = parseInt(qty) - parseInt(1)
        $("#qty").isi(decrease)
        calcPrice(decrease)
    }

    calcPrice(1)
</script>
@endsection