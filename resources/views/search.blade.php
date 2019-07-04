@extends('layouts.user')

@php
function toIdr($angka) {
    $angka = (int)$angka;
    return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}
@endphp

@section('title', $config->nama_toko)

@section('head.dependencies')
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endsection

@section('content')
<div id="vueApp">
<div class="pencarian">
    <div class="wrap">
        <form action="{{ route('user.cari') }}" method="get">
            <input type="text" class="box" name="q" v-model="q" v-on:input="cari" placeholder="Anda butuh apa?" value="{{ $q }}">
            <button><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>

<div class="boxKiri">
    <div class="wrap">
        <div>Hehe :</div>
        <input type="text" class="box" id="hehe">
        <div>Urutkan :</div>
        <select name="filter" id="filter" class="box mt-1">
            <option value="desc">Terbaru</option>
            <option value="desc">Termurah</option>
        </select>
    </div>
</div>

<div class="container">
    <div v-if="products.length != 0">
        <div class="list-product" v-for="product in products">
            <div class="wrapper">
                <img v-bind:src=" '{{ route('user.index') }}/storage/uploaded/' + product.image" class="cover">
                <div class="wrap">
                    <h3><a :href="'{{ url('/produk') }}/' + product.idproduct">@{{ product.title }}</a></h3>
                    <p>
                        @{{ app.convertToRupiah(product.price) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="bag bag-10 bg-putih bayangan-5 rounded">
            <div class="wrap">
                <h3>Produk tidak ada :(</h3>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    let app = new Vue({
        el: '#vueApp',
        data: {
            products: [],
            endpoint: "{{ route('api.product.search') }}",
            q: '',
        },
        methods: {
            loads(q) {
                axios.post(this.endpoint, {
                    q: q
                })
                .then(res => {
                    const data = res.data
                    this.products = data.result
                })
            },
            convertToRupiah(angka) {
                var rupiah = '';		
                var angkarev = angka.toString().split('').reverse().join('');
                for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
                return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
            },
            cari(e) {
                let typed = e.currentTarget.value
                this.loads(typed)
            }
        },
        beforeMount() {
            this.q = this.$el.querySelector('[name=q').value
        },
        mounted() {
            this.loads(this.q)
        },
    })
</script>
@endsection