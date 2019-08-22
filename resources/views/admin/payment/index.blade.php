@extends('layouts.admin')

@section('title', 'Payments')
@section('nama_toko', $config->nama_toko)

@section('cta')
    <a href="{{ route('payment.create') }}">
        <button class="biru">Tambah</button>
    </a>
@endsection

@section('content')
<div class="bag bag-10">
    <div class="wrap">
        <div id="app">
            <div v-if="payments.length == 0">
                <h3>Tidak ada data pembayaran</h3>
                <a href="{{ route('payment.create') }}"><button class="biru">Buat yang pertama</button></a>
            </div>
            <div v-else>
                <table>
                    <thead>
                        <tr>
                            <th>No. Rekening</th>
                            <th>Bank</th>
                            <th>a/n</th>
                            <th style="width: 25%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="pay in payments">
                            <td>@{{ pay.bank_number }}</td>
                            <td>@{{ pay.bank_name }}</td>
                            <td>@{{ pay.account_name }}</td>
                            <td>
                                <button class="hijau" v-on:click="edit" :value="`${pay.idpayment}`"><i class="fas fa-edit"></i></button>
                                <button class="merah" v-on:click="hapus" :value="`${pay.idpayment}`"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                payments: []
            }
        },
        mounted() {
            this.load()
        },
        methods: {
            load() {
                axios.get('{{ route("payment.all") }}')
                .then(res => {
                    const data = res.data
                    this.payments = data
                })
            },
            hapus(e) {
                let id = e.currentTarget.value
                let data = new FormData()
                data.append('id', id)

                axios.post('{{ route("payment.delete") }}', data)
                .then(res => {
                    this.load()
                })
            },
            edit(e) {
                let id = e.currentTarget.value
                document.location = './pembayaran/'+id+'/ubah'
            }
        }
    })
</script>
@endsection