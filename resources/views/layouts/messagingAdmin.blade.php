<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messaging</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fw/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/messaging.css') }}">
</head>
<body>

<div id="vueApp">
<div class="listChat">
    <div class="header">
        <i class="fas fa-angle-left"></i> Kembali ke dashboard
    </div>
    <div class="list" v-for="list in chatList">
        <div class="wrap">
            <h3>@{{ list.users.nama }}</h3>
            <p>@{{ list.message }} </p>
            <div class="time teks-transparan">@{{ timeDifference(list.created_at) }}</div>
        </div>
    </div>
</div>

<div>
<div class="atas">
    <h1>Riyan Satria</h1>
</div>

<div class="contentMessage">
    <div class="boxMessage">
        <div class="wrap">
            hehe
        </div>
    </div>
    @for ($i = 0; $i < 5; $i++)
        
    <div class="boxMessage saya">
        <div class="wrap">
            hehe
        </div>
    </div>
    @endfor
</div>

<div class="typingArea">
    <form v-on:submit.prevent="test">
        {{ csrf_field() }}
        <input type="hidden" name="user_id">
        <input type="text" class="box" placeholder="Ketik pesan...">
        <button class="kirim"><i class="fas fa-paper-plane"></i></button>
    </form>
</div>
</div>

<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

@yield('javascript')

<script>
    let app = new Vue({
        el: '#vueApp',
        data: {
            openedUserId: '',
            chatList: [],
        },
        methods: {
            test(value) {
                alert(value)
            },
            getChatList() {
                axios.get("{{ route('api.message.admin.getChatList') }}")
                .then(res => {
                    const data = res.data
                    this.chatList = data
                })
            },
            timeDifference(previous) {

                let current = new Date()
                previous = new Date(previous)

                var msPerMinute = 60 * 1000;
                var msPerHour = msPerMinute * 60;
                var msPerDay = msPerHour * 24;
                var msPerMonth = msPerDay * 30;
                var msPerYear = msPerDay * 365;
                var elapsed = current - previous;
                
                if (elapsed < msPerMinute) {
                    return Math.round(elapsed/1000) + ' seconds ago';   
                }else if (elapsed < msPerHour) {
                    return Math.round(elapsed/msPerMinute) + ' minutes ago';   
                }else if (elapsed < msPerDay ) {
                    return Math.round(elapsed/msPerHour ) + ' hours ago';   
                }else if (elapsed < msPerMonth) {
                    return Math.round(elapsed/msPerDay) + ' days ago';   
                }else if (elapsed < msPerYear) {
                    return Math.round(elapsed/msPerMonth) + ' months ago';   
                }else {
                    return Math.round(elapsed/msPerYear ) + ' years ago';   
                }
            }
        },
        created() {
            setInterval(function() {
                app.getChatList()
            }, 1500)
        }
    })
</script>

</body>
</html>