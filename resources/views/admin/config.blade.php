@extends('layouts.admin')

@section('title', 'Konfigurasi Toko')
@section('nama_toko', $config->nama_toko)

@php
    $configProvince = ($config->provinsi == "") ? "" : $config->provinsi;
    $configCity = ($config->kota == "") ? "" : $config->kota;
@endphp

@section('content')
<div class="bag bag-10">
    <div class="wrap">
        <form action="{{ route('admin.config.set') }}" method="post">
            {{ csrf_field() }}
            <h3>Detail Toko</h3>
            <input type="hidden" name="_method" value="put">
            <div>Nama Toko :</div>
            <input type="text" class="box" name="nama_toko" value="{{ $config->nama_toko }}">
            <div>Slogan :</div>
            <input type="text" class="box" name="motto" value="{{ $config->motto }}">
            <div>Alamat Toko :</div>
            <textarea name="alamat" class="box">{{ $config->alamat }}</textarea>
            <div class="bag bag-5">
                <div>Provinsi</div>
                <select name="provinsi" id="prov" class="box" required onchange="getCity(this.value)">
                    @if ($configProvince == "")
                        <option value="">Pilih provinsi...</option>
                    @endif
                </select>
            </div>
            <div class="bag bag-5">
                <div>Kota</div>
                <select name="kota" id="city" class="box" required>
                    <option value="">Pilih provinsi dahulu</option>
                </select>
            </div>
            @if($notif !== "")
                <h3>{{ $notif }}</h3>
            @endif
            <button class="biru">Simpan</button>
        </form>
    </div>
</div>

<div class="bag bag-10">
    <div class="wrap">
        <form action="{{ route('admin.config.setBrand') }}" method="post">
            {{ csrf_field() }}
            <h3>Branding Toko</h3>
            <div>Icon :</div>
            <input type="file" class="box" name="icon">
            <div>Logo :</div>
            <input type="file" class="box" name="logo">
            <button class="biru">Simpan</button>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    let configProvince = "{{ $configProvince }}"
    let configCity = "{{ $configCity }}"

    function getProvince() {
        axios.get('{{ env("APP_URL") }}:8000/api/ongkir/provinsi/')
        .then(res => {
            const data = res.data.rajaongkir.results
            data.forEach(res => {
                let optProv = document.createElement('option')
                optProv.innerHTML = res.province
                optProv.setAttribute('value', res.province_id)

                if(configProvince != "") {
                    if(configProvince == res.province_id ) {
                        optProv.setAttribute('selected', 'selected')
                    }
                }
                
                document.querySelector("#prov").appendChild(optProv)
            })
        })
    }
    function getCity(idProvince) {
        $("#city").tulis("<option>Loading...</option>")
        axios.get('{{ env("APP_URL") }}:8000/api/ongkir/kota/'+idProvince)
        .then(res => {
            $("#city").tulis("")
            const data = res.data.rajaongkir.results
            data.forEach(res => {
                let optCity = document.createElement('option')
                optCity.innerHTML = res.city_name
                optCity.setAttribute('value', res.city_id)

                if(configCity == res.city_id) {
                    optCity.setAttribute('selected', 'selected')
                }

                document.querySelector("#city").appendChild(optCity)
            })
        })
    }

    getProvince()
    if(configProvince != "") {
        getCity(configProvince)
    }
</script>
@endsection