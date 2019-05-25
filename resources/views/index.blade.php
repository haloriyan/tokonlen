@extends('layouts.user')

@php
function toIdr($angka) {
    return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}
@endphp

@section('title', $config->nama_toko.' | ')

@section('content')
<div class="pencarian">
    <div class="wrap">
        <form action="{{ route('user.cari') }}" method="get">
            <input type="text" class="box" name="q" placeholder="Anda butuh apa?" value="{{ $q }}">
            <button><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>

<div class="container">
    @if($products->count() == 0)
        <div class="bag bag-10 bg-putih bayangan-5 rounded">
            <div class="wrap">
                <h3>Produk tidak ada :(</h3>
            </div>
        </div>
    @else
        @foreach ($products as $item)
            <div class="list-product">
                <img src="{{ asset('storage/uploaded/'.$item->image) }}" class="cover">
                <div class="wrap">
                    <h3><a href="{{ route('product.view', $item->idproduct) }}">{{ $item->title }}</a></h3>
                    <p>
                        @php
                            echo toIdr($item->price)
                        @endphp
                    </p>
                    <button class="biru-alt"><i class="fas fa-shopping-cart"></i></button>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection