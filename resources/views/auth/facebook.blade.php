@extends('layouts.auth')

@section('title', 'Login |'. $config->nama_toko)

@section('content')
<h1>Login</h1>
<div class="container">
    <div class="wrap">
        <div id="status"><i class="fas fa-spinnner"></i> Sedang login...</div>
    </div>
</div>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=385141895313614&autoLogAppEvents=1"></script>

@endsection

@section('javascript')
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    let nama,email
    window.fbAsyncInit = () => {
        FB.init({
            appId: '675507806229337',
            cookie: true,
            xfbml: true,
            version: 'v3.0'
        })

        FB.getLoginStatus(res => {
            statusChangeCallback(res)
        })
    }

    function statusChangeCallback(response) {
        if(response.status == 'connected') {
            testAPI()
        }else {
            FB.login(res => {
                // 
            }, {scope: 'email'})
        }
    }

    function checkLoginState() {
        FB.getLoginStatus(res => {
            statusChangeCallback(res)
        })
    }

    (function(d, s, id) {
        let js, fjs = d.getElementsByTagName(s)[0]
        if(d.getElementById(id)) return
        js = d.createElement(s)
        js.id = id
        js.src = "https://connect.facebook.net/en_US/sdk.js"
        fjs.parentNode.insertBefore(js, fjs)
    }, (document, 'script', 'facebook-jssdk'))

    function testAPI() {
        console.log('Welcome! Mengambil data...')
        FB.api('/me', {fields: 'email,name'}, (res) => {
            nama = res.name
            email = res.email
            cekUser(res.email)
        })
    }

    function cekUser(email) {
        let endpoint = "{{ env('APP_URL') }}:8000/api/user/"+btoa(email)
        console.log('requesting cekUser...')
        axios.get(endpoint)
        .then(res => {
            const data = res.data
            document.querySelector("#status").innerHTML = "<i class='fas fa-check'></i> berhasil login! Mengarahkan..."
            if(data.status == 0) {
                document.location = '../register/facebook/'+btoa(email)+'/'+btoa(nama)
            }else if(data.status == 2) {
                console.log('alamat kosong')
            }else {
                loginToApp(email)
            }
        })
    }

    function loginToApp(email) {
        let toPost = new FormData()
        toPost.append('email', email)
        toPost.append('pwd', 'facebook')
        console.log('requesting login...')
        axios.post("{{ env('APP_URL') }}:8000/login", toPost)
        .then(res => {
            const data = res.data
            // console.log(data)
            document.location = "{{ route('user.index') }}"
        })
    }

    // checkLoginState()

    
</script>
@endsection