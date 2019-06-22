@extends('layouts.user')

@section('title', 'Notifikasi')

@section('content')
<div class="container lebar-50 ml-20" style="top: 135px">
    @foreach ($notif as $item)
        <div class="konten rata-kiri bg-putih rounded d-block p-1 bayangan-5 mb-2">
            <div class="wrap">
                <p>{{ $item->message }}</p>
                <p class="teks-transparan">{{ $item->created_at }}</p>
            </div>
        </div>
    @endforeach
</div>
@endsection