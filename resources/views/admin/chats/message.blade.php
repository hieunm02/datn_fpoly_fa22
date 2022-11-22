@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="app">
    <div class="layout">
            <!-- Content Wrapper START -->
            <div class="main-content">
                <div class="container-fluid p-h-0">
                    <div class="chat chat-app row">
                        <div class="chat-list">
                            <div class="chat-user-tool">
                                <i class="anticon anticon-search search-icon p-r-10 font-size-20"></i>
                                <input placeholder="Search...">
                            </div>
                            <div class="chat-user-list" id="room_chat">
                                @foreach($rooms as $room)
                                <input type="hidden" name="room_id" id="room_id" value="{{ $room->room_id }}">
                                <a class="chat-list-item p-h-25" href="/admin/chats/message/{{$room->room_id}}">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-image">
                                            <img src="{{ $room->avatar }}" alt="">
                                        </div>
                                        <div class="p-l-15">
                                            <h5 class="m-b-0">{{$room->name}}</h5>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>   
                        </div>
                        @if ($room_id)
                        {{-- <div class="chat-content">
                            <div class="conversation">
                                <div class="conversation-wrapper">
                                    <div class="conversation-header justify-content-between">
                                        <div class="media align-items-center">
                                            <a href="javascript:void(0);" class="chat-close m-r-20 d-md-none d-block text-dark font-size-18 m-t-5" >
                                                <i class="anticon anticon-left-circle"></i>
                                            </a>
                                            <div class="avatar avatar-image">
                                                <img src="{{ $room_avatar ? $room_avatar->avatar : "" }}" alt="">
                                            </div>
                                        </a>
                                </div>
                            </div> --}}
                            <div class="chat-content">
                                <div class="conversation">
                                    <div class="conversation-wrapper">
                                        <div class="conversation-header justify-content-between">
                                            <div class="media align-items-center">
                                                <a href="javascript:void(0);"
                                                   class="chat-close m-r-20 d-md-none d-block text-dark font-size-18 m-t-5">
                                                    <i class="anticon anticon-left-circle"></i>
                                                </a>
                                                <div class="avatar avatar-image">
                                                    <img src="{{ $room_avatar ? $room_avatar->avatar : "" }}" alt="">
                                                </div>
                                                <div class="p-l-15">
                                                    <h6 class="m-b-0">
                                                        {{ $room_name ? $room_name->name : "Bot" }}
                                                    </h6>
                                                    <p class="m-b-0 text-muted font-size-13 m-b-0">
                                                        <span class="badge badge-success badge-dot m-r-5"></span>
                                                        <span>Online</span>
                                                    </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-body" id="chat-content">
                                    @foreach ($messages as $message)
                                        {{-- <div class="msg justify-content-center">
                                            <div class="font-weight-semibold font-size-12"> 7:57PM </div>
                                        </div> --}}
                                        @if ($message->user_id == Auth::user()->id)
                                            <div class="msg msg-sent">
                                                <div class="bubble">
                                                    <div class="bubble-wrapper">
                                                        <span>{{ $message->message }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="msg msg-recipient">
                                                <div class="m-r-10">
                                                    <div class="avatar avatar-image">
                                                        <img src="{{$message->avatar}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="bubble">
                                                    <div class="bubble-wrapper">
                                                        <span>{{ $message->message }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div> 
                                    <div id="is-typing" style="height: 50px; width: 100%; margin-bottom: 50px; margin-left: 30px;">

                                    </div>
                                    <div class="conversation-footer">
                                        <input type="hidden" id="room_chat_id" value="{{ $room_id }}">
                                        <input type="hidden" id="avatar" value="{{ Auth::user()->avatar }}">
                                        <input type="hidden" id="user_name" value="{{ Auth::user()->name }}">
                                        <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">

                                            <div class="chat-input" id="chatInput" type="text"
                                                 placeholder="Type a message..." contenteditable=""></div>
                                            <ul class="list-inline d-flex align-items-center m-b-0">
                                                <li class="list-inline-item m-r-15">
                                                    <a class="text-gray font-size-20" href="javascript:void(0);"
                                                       data-toggle="tooltip" title="Emoji">
                                                        <i class="anticon anticon-smile"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item m-r-15">
                                                    <a class="text-gray font-size-20" href="javascript:void(0);"
                                                       data-toggle="tooltip" title="Attachment">
                                                        <i class="anticon anticon-paper-clip"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <button class="d-none d-md-block btn btn-primary">
                                                        <span class="m-r-10">Send</span>
                                                        <i class="far fa-paper-plane"></i>
                                                    </button>
                                                    <a href="javascript:void(0);"
                                                       class="text-gray font-size-20 d-md-none d-block">
                                                        <i class="far fa-paper-plane"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="conversation-body" style="background-color:white; width: 70%">
                            <div style="margin-top: 50px; text-align: center">
                                <span style="font-size: 30px;">Chào mừng đến với <b>Bee Chat</b> !</span>
                                <img src="{{asset('assets/images/logo/ChatApp.png')}}" style="margin-left:230px ;" alt="">
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
            <!-- Content Wrapper END -->


        </div>
        <!-- Page Container END -->

    </div>
    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js"
            integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU"
            crossorigin="anonymous"></script>
    <script>
        $(function () {
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);

        let chatInput = $('#chatInput');
        chatInput.keypress(function(e) {
            let message = $(this).html();
            let user_id = $('#user_id').val();
            let avatar = $('#avatar').val()
            let user_name = $('#user_name').val()
            let room_id = $('#room_chat_id').val()

            if(e.which === 13 && !e.shiftKey) {
                $('#chat-content').append(`
                <div class="msg msg-sent">
                    <div class="bubble">
                        <div class="bubble-wrapper">
                            <span>${message}</span>
                        </div>
                    </div>
                </div>
                `);
                //Gửi dữ liệu lên server
                socket.emit('sendChatToServer', message, user_id, user_name, avatar, room_id);
                chatInput.html('');
                // Kéo thanh scroll xuống xuối
                var messageBody = document.getElementById('chat-content');
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                // không đang nhập 
                    let noTyping = ''
                    socket.emit('isTyping' , noTyping);
                sendMessage(message, user_id, avatar, room_id)
                return false;
            }
        });
            // Hiệu ứng đang nhập
            chatInput.keypress(function(e) {
                let name = $('#user_name').val()
                let room_id = $('#id').val()
                if(e.which != 13 && !e.shiftKey){
                    let typing = `
                    <span style="float: left;margin-right: 5px; margin-bottom:10px">${name} đang soạn tin</span> 
                    <img src="https://static.wixstatic.com/media/c29e02_814402a86a544d12a0ffb478f5c338e9~mv2.gif" width="25px" alt="">
                    `
                    socket.emit('isTyping' , typing, room_id);
                }
            })
        function sendMessage(message, user_id, avatar, room_id) {
                let url = "{{ route('rep') }}"
                let form = $(this)
                let formData = new FormData()
                let token = "{{ csrf_token() }}"

                formData.append('user_id', user_id)
                formData.append('message', message)
                formData.append('room_id', room_id)
                formData.append('avatar', avatar)
                formData.append('_token', token)

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function(response) {
                        if(response.success){
                            console.log(response.data);
                        }
                    }
                })
            }
        // Đang nhập
        socket.on('isTyping', (typing, room_id) => {
            $('#is-typing').html(
                room_id == $('#room_chat_id').val() ? `${typing}` : ``
            )
        });
        // Nhận vào tin nhắn
        socket.on('sendChatToClient', (message, id, name, avatar, room_id) => {
            $('#chat-content').append(
                room_id == $('#room_chat_id').val() && id != $('#user_id').val() ? `
                    <div class="msg msg-recipient">
                        <div class="m-r-10">
                            <div class="avatar avatar-image">
                                <img src="${avatar}" alt="">
                            </div>
                        </div>
                        <div class="bubble">
                            <div class="bubble-wrapper">
                                <span>${message}</span>
                            </div>
                        </div>
                    </div>
                    `
                    : 
                    ``
            );
            $('#room_chat').append(
                id != $('#room_id').val() ? `
                    <a class="chat-list-item p-h-25" href="/admin/chats/message/${id}">
                        <div class="media align-items-center">
                            <div class="avatar avatar-image">
                                <img src="${avatar}" alt="">
                            </div>
                            <div class="p-l-15">
                                <h5 class="m-b-0">${name}</h5>
                            </div>
                        </div>
                    </a>
                `
                :
                ``
            )
        });
    });
</script>
<script>
    var messageBody = document.getElementById('chat-content');
    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
</script>
@endsection

