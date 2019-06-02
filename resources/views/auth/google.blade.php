@extends('layouts.auth')

@section('title', 'Login |'. $config->nama_toko)

@section('content')
<h1>Login</h1>
<div class="container">
    <div class="wrap">
        <div id="status"><i class="fas fa-spinnner"></i> Sedang login...</div>
        <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
    </div>
</div>

@endsection

@section('javascript')
<script src="https://apis.google.com/js/platform.js"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    // Client ID : 1008141661550-1l5581hjohq97lj33rubc7e1k1qthv3v.apps.googleusercontent.com
    // Secret ID : ViYRq4ZHo8zvkEte734rXxRo

    let nama,email

    function onSignIn(googleUser) {
        let profile = googleUser.getBasicProfile()

        console.log("Name : " + profile.getName())
        console.log("Email : " + profile.getEmail())

        nama = profile.getName()
        email = profile.getEmail()

        cekUser(email)
    }

    function cekUser(email) {
        console.log('requesting cekUser...')
        let endpoint = "{{ env('APP_URL') }}:8000/api/user/"+btoa(email)
        axios.get(endpoint)
        .then(res => {
            const data = res.data
            if(data.status == 0) {
                // belum register
                document.location = '../register/google/' + btoa(email) + '/' + btoa(nama)
            }else {
                // sudah register
                loginToApp(email)
            }
        })
    }

    function loginToApp(email) {
        let toPost = new FormData()
        toPost.append('email', email)
        toPost.append('pwd', 'google')
        console.log('requesting login...')
        axios.post("{{ env('APP_URL') }}:8000/login", toPost)
        .then(res => {
            const data = res.data
            // console.log(data)
            document.location = "{{ route('user.index') }}"
        })
    }
</script>
@endsection