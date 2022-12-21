@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<style>
    /* START TOOLTIP STYLES */
[tooltip] {
  position: relative; /* opinion 1 */
}

/* Applies to all tooltips */
[tooltip]::before,
[tooltip]::after {
  text-transform: none; /* opinion 2 */
  font-size: .9em; /* opinion 3 */
  line-height: 1;
  user-select: none;
  pointer-events: none;
  position: absolute;
  display: none;
  opacity: 0;
}
[tooltip]::before {
  content: '';
  border: 5px solid transparent; /* opinion 4 */
  z-index: 1001; /* absurdity 1 */
}
[tooltip]::after {
  content: attr(tooltip); /* magic! */
  
  /* most of the rest of this is opinion */
  font-family: Helvetica, sans-serif;
  text-align: center;
  
  /* 
    Let the content set the size of the tooltips 
    but this will also keep them from being obnoxious
    */
  min-width: 3em;
  max-width: 21em;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  padding: 1ch 1.5ch;
  border-radius: .3ch;
  box-shadow: 0 1em 2em -.5em rgba(0, 0, 0, 0.35);
  background: #333;
  color: #fff;
  z-index: 1000; /* absurdity 2 */
}

/* Make the tooltips respond to hover */
[tooltip]:hover::before,
[tooltip]:hover::after {
  display: block;
}

/* don't show empty tooltips */
[tooltip='']::before,
[tooltip='']::after {
  display: none !important;
}

/* FLOW: UP */
[tooltip]:not([flow])::before,
[tooltip][flow^="up"]::before {
  bottom: 100%;
  border-bottom-width: 0;
  border-top-color: #333;
}
[tooltip]:not([flow])::after,
[tooltip][flow^="up"]::after {
  bottom: calc(100% + 5px);
}
[tooltip]:not([flow])::before,
[tooltip]:not([flow])::after,
[tooltip][flow^="up"]::before,
[tooltip][flow^="up"]::after {
  left: 50%;
  transform: translate(-50%, -.5em);
}

/* FLOW: DOWN */
[tooltip][flow^="down"]::before {
  top: 100%;
  border-top-width: 0;
  border-bottom-color: #333;
}
[tooltip][flow^="down"]::after {
  top: calc(100% + 5px);
}
[tooltip][flow^="down"]::before,
[tooltip][flow^="down"]::after {
  left: 50%;
  transform: translate(-50%, .5em);
}

/* FLOW: LEFT */
[tooltip][flow^="left"]::before {
  top: 50%;
  border-right-width: 0;
  border-left-color: #333;
  left: calc(0em - 5px);
  transform: translate(-.5em, -50%);
}
[tooltip][flow^="left"]::after {
  top: 50%;
  right: calc(100% + 5px);
  transform: translate(-.5em, -50%);
}

/* FLOW: RIGHT */
[tooltip][flow^="right"]::before {
  top: 50%;
  border-left-width: 0;
  border-right-color: #333;
  right: calc(0em - 5px);
  transform: translate(.5em, -50%);
}
[tooltip][flow^="right"]::after {
  top: 50%;
  left: calc(100% + 5px);
  transform: translate(.5em, -50%);
}

/* KEYFRAMES */
@keyframes tooltips-vert {
  to {
    opacity: .9;
    transform: translate(-50%, 0);
  }
}

@keyframes tooltips-horz {
  to {
    opacity: .9;
    transform: translate(0, -50%);
  }
}

/* FX All The Things */ 
[tooltip]:not([flow]):hover::before,
[tooltip]:not([flow]):hover::after,
[tooltip][flow^="up"]:hover::before,
[tooltip][flow^="up"]:hover::after,
[tooltip][flow^="down"]:hover::before,
[tooltip][flow^="down"]:hover::after {
  animation: tooltips-vert 300ms ease-out forwards;
}

[tooltip][flow^="left"]:hover::before,
[tooltip][flow^="left"]:hover::after,
[tooltip][flow^="right"]:hover::before,
[tooltip][flow^="right"]:hover::after {
  animation: tooltips-horz 300ms ease-out forwards;
}

</style>
    <div class="app">
        <div class="layout">
            <!-- Content Wrapper START -->
            <div class="main-content">
                <div class="container-fluid p-h-0">
                    <div class="chat chat-app row d-flex">
                        <div class="chat-list col-md-4">
                            <div class="chat-user-tool">
                                <i class="anticon anticon-search search-icon p-r-10 font-size-20"></i>
                                <input placeholder="Search...">
                            </div>
                            <div class="chat-user-list" id="room_chat">
                                @foreach ($rooms as $room)
                                    <input type="hidden" name="room_id" id="room_id" value="{{ $room->room_id }}">
                                    <a class="chat-list-item p-h-25" href="/admin/chats/message/{{ $room->room_id }}">
                                        <div class="media align-items-center">
                                            <div class="avatar avatar-image">
                                                <img src="{{ $room->avatar }}" alt="">
                                            </div>
                                            <div class="p-l-15">
                                                <h5 class="m-b-0">{{ $room->name }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        @if ($room_id)
                            <div class="chat-content col-md-8">
                                <div class="conversation">
                                    <div class="conversation-wrapper row">
                                        <div class="conversation-header justify-content-between">
                                            <div class="media align-items-center">
                                                <a href="javascript:void(0);"
                                                    class="chat-close m-r-20 d-md-none d-block text-dark font-size-18 m-t-5">
                                                    <i class="anticon anticon-left-circle"></i>
                                                </a>
                                                <div class="avatar avatar-image">
                                                    <img src="{{ $room_avatar ? $room_avatar->avatar : '' }}"
                                                        alt="">
                                                </div>
                                                <div class="p-l-15">
                                                    <h6 class="m-b-0">
                                                        {{ $room_name ? $room_name->name : 'Bot' }}
                                                    </h6>
                                                    <p class="m-b-0 text-muted font-size-13 m-b-0">
                                                        <span class="badge badge-success badge-dot m-r-5"></span>
                                                        <span>Online</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="conversation-body " id="chat-content">
                                            @foreach ($messages as $message)
                                                @if ($message->user_id == Auth::user()->id)
                                                    <div class="msg msg-sent">
                                                        <div class="bubble" tooltip="21-11-2021">
                                                            <div class="bubble-wrapper text-white" style="background-color: rgb(45, 139, 240)">
                                                                <span>{{ $message->message }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="msg msg-recipient">
                                                        <div class="m-r-10" tooltip="{{$message->user->name}}">
                                                            <div class="avatar avatar-image">
                                                                <img src="{{ $message->avatar }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="bubble" tooltip="{{date('H:i d-m-Y', strtotime($message->created_at))}}">
                                                            <div class="bubble-wrapper text-dark" style="background-color: rgba(144, 147, 150, 0.547)">
                                                                <span>{{ $message->message }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div id="is-typing"
                                            style="height: 50px; width: 100%; margin-bottom: 50px; margin-left: 30px;">

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
                    <div class="conversation-body col-md-8" style="background-color:white; width: 70%">
                        <div class="d-flex flex-column align-items-center">
                            <span style="font-size: 30px;">Chào mừng đến với <b>Bee Chat</b> !</span>
                            <img src="{{ asset('assets/images/logo/ChatApp.png') }}" width="400px" alt="">
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
        integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous">
    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);

            var today = new Date();
            var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var created_at = date + " " + time;

            let chatInput = $('#chatInput');
            chatInput.keypress(function(e) {
                let message = $(this).html();
                let user_id = $('#user_id').val();
                let avatar = $('#avatar').val()
                let user_name = $('#user_name').val()
                let room_id = $('#room_chat_id').val()

                if (e.which === 13 && !e.shiftKey) {
                    $('#chat-content').append(`
                    <div class="msg msg-sent">
                        <div class="bubble" tooltip="${created_at}">
                            <div class="bubble-wrapper text-white" style="background-color: rgb(45, 139, 240)">
                                <span>${message}</span>
                            </div>
                        </div>
                    </div>
                    `);
                    //Gửi dữ liệu lên server
                    socket.emit('sendChatToServer', message, user_id, user_name, avatar, room_id, created_at);
                    chatInput.html('');
                    // Kéo thanh scroll xuống xuối
                    var messageBody = document.getElementById('chat-content');
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                    // không đang nhập
                    let noTyping = ''
                    socket.emit('isTyping', noTyping);
                    sendMessage(message, user_id, avatar, room_id)
                    return false;
                }
            });
            // Hiệu ứng đang nhập
            chatInput.keypress(function(e) {
                let name = $('#user_name').val()
                let room_id = $('#id').val()
                if (e.which != 13 && !e.shiftKey) {
                    let typing = `
                    <span style="float: left;margin-right: 5px; margin-bottom:10px">${name} đang soạn tin</span>
                    <img src="https://static.wixstatic.com/media/c29e02_814402a86a544d12a0ffb478f5c338e9~mv2.gif" width="25px" alt="">
                    `
                    socket.emit('isTyping', typing, room_id);
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
                        if (response.success) {
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
                        <div class="m-r-10" tooltip="${name}">
                            <div class="avatar avatar-image">
                                <img src="${avatar}" alt="">
                            </div>
                        </div>
                        <div class="bubble" tooltip="${created_at}">
                            <div class="bubble-wrapper text-dark" style="background-color: rgba(144, 147, 150, 0.547)">
                                <span>${message}</span>
                            </div>
                        </div>
                    </div>
                    ` :
                    ``
            );
            // $('#room_chat').append(
            //     id != $('#room_id').val() ? `
            //         <a class="chat-list-item p-h-25" href="/admin/chats/message/${id}">
            //             <div class="media align-items-center">
            //                 <div class="avatar avatar-image">
            //                     <img src="${avatar}" alt="">
            //                 </div>
            //                 <div class="p-l-15">
            //                     <h5 class="m-b-0">${name}</h5>
            //                 </div>
            //             </div>
            //         </a>
            //     `
            //     :
            //     ``
            // )
        });
    });
    </script>
    <script>
        var messageBody = document.getElementById('chat-content');
        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
    </script>
@endsection
