@extends('layouts.admin')

@section('title', 'Kategori')
@section('nama_toko', $config->nama_toko)

@section('cta')
    <a href="{{ route('category.create') }}">
        <button class="biru">Tambah</button>
    </a>
@endsection

@section('content')
<div class="bag bag-10">
    <div class="wrap">
        <div id="app">
            <table>
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th style="width: 25%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cat in categories">
                        <td>@{{ cat.category }}</td>
                        <td>
                            {{-- <a href="{{ route('category.edit', 1) }}"><button class="hijau"><i class="fas fa-edit"></i></button></a> --}}
                            <button class="hijau" v-on:click="edit" :value="`${cat.idcategory}`"><i class="fas fa-edit"></i></button>
                            <button class="merah" v-on:click="hapus" :value="`${cat.idcategory}`"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/vue.js') }}"></script>
<script>
    let app = new Vue({
        el: '#app',
        data() {
            return {
                categories: []
            }
        },
        mounted() {
            this.load()
        },
        methods: {
            load() {
                axios.get('{{ route("category.all") }}')
                .then(res => {
                    const data = res.data
                    this.categories = data
                })
            },
            hapus(e) {
                let id = e.currentTarget.value
                let data = new FormData()
                data.append('id', id)

                axios.post('{{ route("category.delete") }}', data)
                .then(res => {
                    this.load()
                })
            },
            edit(e) {
                let id = e.currentTarget.value
                document.location = './kategori/'+id+'/ubah'
            }
        }
    })
</script>
@endsection