@extends('layouts.user')

@php
function toIdr($angka) {
    return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}
@endphp

@section('title', $product->title)

@section('head.dependencies')
    <link rel="stylesheet" href="{{ asset('libraries/ImageDisplayer/ImageDisplayer.css') }}">
    <style>
        .carousel {
            background-color: #fff;
            box-shadow: 1px 1px 5px 1px #ddd;
            white-space: nowrap;
            overflow: auto;
        }
        .carousel img {
            height: 200px;
            cursor: pointer;
            filter: blur(2px);
        }
        .carousel img:hover{ filter: blur(0px); }

        .carousel::-webkit-scrollbar {
            height: 1px;
        }
    </style>
@endsection

@section('content')
<div class="container" style="top: 150px;">
    @if($product == "")
        <div class="bag bag-10 bg-putih bayangan-5 rounded">
            <div class="wrap">
                <h3>Produk tidak ada :(</h3>
            </div>
        </div>
    @else
        <div class="bag bag-6 carousel">
            @foreach ($images as $item)
            <img src="{{ asset('/storage/uploaded/'. $item->image) }}" class="display">
            @endforeach
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
        <div class="bag bag-10 bg-putih bayangan-5 rounded">
            <div class="wrap">
                <h2>{{ $product->title }}</h2>
                <p>{{ $product->description }}</p>
            </div>
        </div>
        <div class="bag bag-10 bg-putih bayangan-5 rounded mt-4">
            <div class="wrap">
                <h2>Ulasan</h2>
            </div>
        </div>
        <div class="wrapperImageDisplayer">
            <div class="containerImageDisplayer">
                <div class="header">
                    <h4 id="fileName">s</h4>
                    <div id="close">X</div>
                </div>
                <div class="content">
                    <img src="#" id="displayedImage">
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('javascript')
<script src="{{ asset('libraries/ImageDisplayer/display.js') }}"></script>
<script>
    let price = {{ $product->price }}
    function getQty() {
        return ($("#qty").isi() == 0) ? 0 : $("#qty").isi()
    }
    function toIdr(angka) {
        var rupiah = '';		
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
    }
    function calcPrice(qty) {
        let calc = price * qty
        if(calc < price) {
            return false
        }
        $("#totalPrice").tulis(toIdr(calc))
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

    let ImgDsplyr = new ImageDisplayer({
        selector: '.carousel'
    })
    
</script>
{{-- @foreach ($images as $item)
<img src="{{ asset('/storage/uploaded/'. $item->image) }}" class="display">
@endforeach --}}
@endsection