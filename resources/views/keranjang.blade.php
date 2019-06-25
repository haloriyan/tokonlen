@extends('layouts.user')

@section('title', 'Keranjang')

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
                                    <form action="{{ route('cart.delete', $item->iddetail) }}" method="post">
                                        {{ csrf_field() }}
                                        <button class="merah-alt"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">Shipping</td>
                            <td colspan="2">
                                <form action="{{ route('order.checkout', $myCart[0]->order_id) }}" method="get" class="d-inline-block" id="formCheckout">
                                <select name="shipping" id="shipping" class="box" required>
                                    <option value="">Pilih shipping...</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{ $myCart->sum('qty') }}</td>
                            <td colspan="2">{{ toIdr($myCart->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="rata-tengah mt-4">
                    <a href="{{ route('user.index') }}"><button type="button" class="hijau-alt">Belanja lainnya</button></a>
                        {{ csrf_field() }}
                        <button class="biru-alt">Lanjut checkout</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    let shopCity = "{{ $config->kota }}"
    let myCity = "{{ $myData->kota }}"
    function magicElement(properties) {
        let dom = document.createElement(properties.type)
        properties.attr.forEach(res => {
            // console.log(Object.keys(res))
            let key = Object.keys(res)
            let val = Object.values(res)
            dom.setAttribute(key, val)
        })
        if(properties.html !== undefined) {
            dom.innerHTML = properties.html
        }
        document.querySelector(properties.parent).appendChild(dom)
    }
    function getOngkirData() {
        let data = new FormData()
        data.append('origin', shopCity)
        data.append('destination', myCity)
        data.append('weight', 100)
        data.append('courier', 'pos')

        axios.post("{{ route('ro.getCost') }}", data)
        .then(res => {
            const data = res.data.rajaongkir.results[0]
            data.costs.forEach(res => {
                magicElement({
                    type: 'option',
                    attr: [
                        {"value": "POS " + res.service + " (" + res.cost[0].value + ")"}
                    ],
                    html: "POS " + res.service + " (" + res.cost[0].value + ")",
                    parent: '#shipping'
                })
            })
        })
    }
    getOngkirData()
</script>
@endsection