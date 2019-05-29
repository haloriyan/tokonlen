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
                    <input type="text" class="box mt-1 mb-3" name="nama" value="{{ $myData->nama }}">
                    <div>Alamat :</div>
                    <textarea name="alamat" class="box mt-3 mb-3">{{ $myData->alamat }}</textarea>
                    <button class="biru-alt">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection