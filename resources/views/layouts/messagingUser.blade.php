<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Support</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fw/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/messaging.user.css') }}">
</head>
<body>

<div id="vueApp">
<div class="atas">
    <h1>Customer Support</h1>
</div>

<div class="messageArea">
    <span v-for="msg in messages">
        <div v-bind:class="{'message': true, 'mine' : (msg.sender == 1)}">
            <div class="wrap">
                @{{ msg.message }}
            </div>
        </div>
    </span>
</div>

<div class="typingArea" id="typing">
    <form>
        {{ csrf_field() }}
        <input type="hidden" v-model="csrf">
        <input type="hidden" v-model="endpointSend" />
        <input type="hidden" v-model="user_id" />
        <input type="text" class="box" placeholder="Ketik pesan..." v-model="message">
        <button id="kirim" v-on:click="send" type="button"><i class="fas fa-paper-plane"></i></button>
    </form>
</div>
</div>

<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

<script>
    let app = new Vue({
        el: '#vueApp',
        data: {
            messages: [],
            message: '',
            endpointSend: '{{ route("api.message.user.send") }}',
            endpointGrab: '{{ route("api.message.user.mine") }}',
            user_id: '{{ $myData->iduser }}',
            csrf: '{{ csrf_token() }}'
        },
        methods: {
            send() {
                axios.post(this.endpointSend, {
                    message: this.message,
                    user_id: this.user_id,
                    token: this.csrf,
                })
                .then(res => {
                    const data = res.data
                    this.grab()
                })
            },
            grab() {
                axios.post(this.endpointGrab, {
                    user_id: this.user_id
                })
                .then(res => {
                    const data = res.data.data
                    this.messages = data
                })
            }
        },
        created() {
            // alert('hehe')
            this.grab()
            setInterval(function() {
                app.grab()
            }, 2000)
        }
    })
</script>

</body>
</html>