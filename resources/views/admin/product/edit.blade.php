@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('nama_toko', $config->nama_toko)

@section('head.dependencies')
<style>
    .imgPreview {
        display: inline-block;
        width: 33.25%;
        height: 250px;
        position: relative;
    }
    .imgPreview img {
        width: 100%;
        height: 100%;
    }
    .imgPreview .keterangan {
        position: absolute;
        top: 202px;left: 0px;right: 0px;
        opacity: 0.01;
        transition: 0.4s;
    }
    .imgPreview:hover .keterangan { opacity: 1; }
    .listCategory {
        background-color: #0a5e6a;
        color: #fff;
        display: inline-block;
        padding: 12px 20px;
    }
</style>
@endsection

@section('content')
<div id="app">
    <h2>Informasi Produk</h2>
<div class="bag bag-10">
    <div class="wrap">
        <form action="{{ route('product.update', $data->idproduct) }}" method="POST">
            {{ csrf_field() }}
            <div>Nama Produk :</div>
            <input type="text" class="box" name="title" value="{{ $data->title }}">
            <div>Deskripsi :</div>
            <textarea name="description" class="box">{{ $data->description }}</textarea>
            <div class="bag bag-5">
                <div>Harga</div>
                <input type="number" class="box" name="price" value="{{ $data->price }}">
            </div>
            <div class="bag bag-5">
                <div>Stok</div>
                <input type="number" class="box" name="stock" value="{{ $data->stock }}">
            </div>
            <div class="mb-1">Category :</div>
            <div class="listCategory rounded-circle" v-for="item in categories" @click="selectCategory">@{{ item.category }}</div>
            <input name="category" id="category" class="box" @input="searchCategory" v-model="category">
            <button class="biru">Submit</button>
        </form>
    </div>
</div>
<h2>Gambar Produk</h2>
<div class="bag bag-10">
    <div class="wrap">
        <div id="formGaleri">
            {{ csrf_field() }}
            <input type="file" id="toUpload" class="box mb-3" @change="uploadImage()">
            <div v-for="(img, index) in images" class="imgPreview">
                <img :src="'/storage/uploaded/' + img.image" />
                <div class="keterangan rata-tengah">
                    <button class="lebar-100 merah" v-on:click="hapus" v-bind:value="img.idimage">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
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
        el: '#app',
        data: {
            product_id: '{{ $data->idproduct }}',
            images: [],
            categories: [],
            category: '',
            storedCategory: ''
        },
        mounted() {
            this.loadImages()
        },
        methods: {
            loadImages() {
                let endpoint = "{{ route('api.getProductImages', $data->idproduct) }}"
                axios.get(endpoint)
                .then(res => {
                    const data = res.data
                    this.images = data
                })
            },
            uploadImage() {
                let file = document.querySelector("#toUpload")
                let data = new FormData()
                data.append('image', file.files[0])
                data.append('product_id', this.product_id)
                axios.post('{{ route("api.addProductImage") }}', data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(res => {
                    const data = res.data
                    if(data.status == "ok") {
                        this.loadImages()
                        file.value = ''
                    }
                })
            },
            hapus(e) {
                let id = e.currentTarget.value
                let data = new FormData()
                data.append('idimage', id)
                axios.post("{{ route('api.deleteProductImage') }}", data)
                .then(res => {
                    const data = res.data
                    if(data.status == "ok") {
                        this.loadImages()
                    }
                })
            },
            getCurrentTyped(typed) {
                let a = typed.split(',')
                let ret = a[a.length - 1]
                return ret
            },
            searchCategory(e) {
                let typed = e.currentTarget.value
                typed = this.getCurrentTyped(typed)
                if(typed == "") {
                    this.categories = ''
                    return false
                }
                axios.post("{{ route('api.searchCategory') }}", {
                    q: typed
                })
                .then(res => {
                    const data = res.data
                    this.categories = data
                })
            },
            selectCategory(e) {
                let targeted = e.currentTarget.innerHTML
                this.storedCategory += targeted + ', '
                this.category = '' + this.storedCategory
                
                this.categories = ''
            }
        }
    })
</script>
@endsection