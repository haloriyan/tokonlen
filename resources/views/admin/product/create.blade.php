@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')
@section('nama_toko', $config->nama_toko)

@section('head.dependencies')
<style>
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
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
    <h2>Informasi Produk</h2>
    <div class="bag bag-10">
        <div class="wrap">
            {{ csrf_field() }}
            <div>Nama Produk :</div>
            <input type="text" class="box" name="title" required>
            <div>Deskripsi :</div>
            <textarea name="description" class="box" required></textarea>
            <div>Harga</div>
            <input type="number" class="box" name="price" required>
            <div class="bag bag-5">
                <div>Harga</div>
                <input type="number" class="box" name="price">
            </div>
            <div class="bag bag-5">
                <div>Stok</div>
                <input type="number" class="box" name="stock">
            </div>
            <div class="mb-1">Category :</div>
            <div class="listCategory rounded-circle" v-for="item in categories" @click="selectCategory">@{{ item.category }}</div>
            <input name="category" id="category" class="box" @input="searchCategory" v-model="category">
        </div>
    </div>
    <h2>Gambar Produk</h2>
    <div class="bag bag-10">
        <div class="wrap">
            <input type="file" name="gambar[]" onchange="changeInputFile(this)" class="box">
            <div id="appearInput"></div>
        </div>
    </div>
    <button class="biru">Buat Produk</button>
</form>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
function getExtension(file) {
    let explode = file.split(".")
    let length = explode.length
    return explode[length - 1]
}

function changeInputFile(that) {
    let allowedExtension = ['jpg','png','jpeg','gif']
    let extension = getExtension(that.value).toLowerCase()
    if(!inArray(extension, allowedExtension)) {
        alert('Format file tidak didukung')
        that.value = ''
        return false
    }

    let input = document.createElement('input')
    input.setAttribute('type', 'file')
    input.setAttribute('class', 'box')
    input.setAttribute('onchange', 'changeInputFile(this)')
    input.setAttribute('name', 'gambar[]')
    $("#appearInput").append(input)
}
let app = new Vue({
    el: '#app',
    data: {
        images: [],
        categories: [],
        category: '',
        storedCategory: ''
    },
    methods: {
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