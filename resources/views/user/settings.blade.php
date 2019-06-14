@extends('layouts.user')

@section('title', 'Pengaturan Profil')


@section('content')
<div class="container rata-tengah" style="top: 120px;">
    <div class="bag-6 d-inline-block rata-tengah">
        <h2 class="rata-kiri">Data Pribadi</h2>
        <div class="bag bag-10 bg-putih rounded bayangan-5 rata-kiri">
            <div class="wrap">
                @if($notif != "")
                    <div class="notif bg-hijau pt-2 pb-2 pl-4 pl-4 mb-4">
                        {{ $notif }}
                    </div>
                @endif
                <form action="{{ route('user.settings.save') }}" method="post">
                    {{ csrf_field() }}
                    <div>Nama :</div>
                    <input type="text" class="box mt-1 mb-3" name="nama" value="{{ $myData->nama }}" required>
                    <div>Alamat :</div>
                    <textarea name="alamat" class="box mt-2 mb-3" required>{{ $myData->alamat }}</textarea>
                    <div class="bag bag-5">
                        Provinsi :
                        <select name="provinsi" id="prov" class="box" onchange="showCity(this.value)" required>
                            {{--  --}}
                        </select>
                    </div>
                    <div class="bag bag-5">
                        Kota :
                        <select name="kota" id="city" class="box" required>
                            {{--  --}}
                        </select>
                    </div>
                    <button class="biru-alt">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    function getProvince() {
        axios.get('{{ env("APP_URL") }}:8000/api/ongkir/provinsi/')
        .then(res => {
            const data = res.data.rajaongkir.results
            data.forEach(res => {
                let optProv = document.createElement('option')
                optProv.innerHTML = res.province
                optProv.setAttribute('value', res.province_id)

                if({{ $myData->provinsi }} == res.province_id ) {
                    optProv.setAttribute('selected', 'selected')
                }

                document.querySelector("#prov").appendChild(optProv)
            })
        })
    }
    function showCity(idProvince) {
        $("#city").tulis("")
        axios.get('{{ env("APP_URL") }}:8000/api/ongkir/kota/'+idProvince)
        .then(res => {
            const data = res.data.rajaongkir.results
            data.forEach(res => {
                let optCity = document.createElement('option')
                optCity.innerHTML = res.city_name
                optCity.setAttribute('value', res.city_id)

                if({{ $myData->kota }} == res.city_id) {
                    optCity.setAttribute('selected', 'selected')
                }

                document.querySelector("#city").appendChild(optCity)
            })
        })
    }
    getProvince()
    if({{ $myData->provinsi }} != "") {
        showCity({{ $myData->provinsi }})
    }
</script>
@endsection