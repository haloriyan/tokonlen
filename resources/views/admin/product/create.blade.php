@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')
@section('nama_toko', $config->nama_toko)

@section('content')
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
            <div>Stok</div>
            <input type="number" class="box" name="stock" required>
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
@endsection

@section('javascript')
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
</script>
@endsection