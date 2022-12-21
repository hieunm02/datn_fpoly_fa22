<?php

use App\Models\Message;

$messages = Message::where('room_message_id', Auth::user()->id)->get();
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Chat</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> --}}
</head>
<!--Coded With Love By Mutiullah Samim-->
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
<body>
    <div style="width: 500px; position: fixed; bottom: 120px; right: 0; z-index: 999999;">
        <div id="chatbox" class="action_menu" class="col-md-12 col-xl-12 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span>Chat với quản lý</span>
                        </div>
                    </div>
                </div>
                <div class="card-body msg_card_body" id="chat-content">
                    @foreach ($messages as $message)
                    @if ($message->user_id == Auth::user()->id)
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send text-white" tooltip="21-11-2021" style="background-color: rgb(45, 139, 240)">
                            {{$message->message}}
                        </div>
                    </div>
                    @else
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg" tooltip="{{$message->user->name}}">
                            <img src="{{$message->avatar}}" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer_send ml-2" tooltip="21-11-2021" style="background-color: rgba(144, 147, 150, 0.547)">
                            {{$message->message}}
                        </div>
                    </div>
                    @endif
                    @endforeach

                </div>
                <div id="is-typing" style="height: 30px; width: 100%; margin-left: 30px;">

                </div>
                <div class="card-footer">
                    <div class="input-group">
                        @if (isset(Auth::user()->id))
                        <input type="hidden" id="name" value="{{ Auth::user()->name }}">
                        <input type="hidden" id="id" value="{{ Auth::user()->id }}">
                        <input type="hidden" id="avatar" value="{{ Auth::user()->avatar }}">
                        @endif
                        <div id="chatInput" class="form-control type_msg" placeholder="Type your message..." contenteditable="">


                        </div>
                        <div class="input-group-append">
                            <button class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div id="action_menu_btn" class="col-md-3 col-xl-3 float-lg-right">
            <div style="width: 60px; height: 60px; border-radius: 50%; float: right; position: fixed; bottom: 60px; right: 0; z-index: 999999;">
                <img src="https://iphone-mania.jp/uploads/2020/05/fe9efa2e670f770a12833f801b8b4387.png" width="100%" alt="">
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
    <script>
        $(function() {
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);

            let chatInput = $('#chatInput');

            chatInput.keypress(function(e) {
                let message = $(this).html();
                let id = $('#id').val()
                let room_id = $('#id').val()
                let name = $('#name').val()
                let avatar = $('#avatar').val()
                console.log(message);

                if (e.which === 13 && !e.shiftKey) {
                    $('#chat-content').append(`
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send text-white" tooltip="21-11-2021" style="background-color: rgb(45, 139, 240)">
                                            ${message}
                                </div>
                            </div>
                    `);
                    // Gửi dữ liệu lên server 
                    socket.emit('sendChatToServer', message, id, name, avatar, room_id);
                    chatInput.html('');
                    var date = timeDifference(Math.round(new Date().getTime() / 1000), Math.floor(Date.now() / 1000));
                    saveNotify(id, 'message', 'admin', room_id);
                    socket.emit('sendNotifyToServer', {
                        user_name: name,
                        type: 'message',
                        date: date,
                        room_id: room_id,
                        notify_id: result.notify.id
                    });
                    // Kéo thanh scroll xuống xuối
                    var messageBody = document.getElementById('chat-content');
                    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
                    // không đang nhập 
                    let noTyping = ''
                    socket.emit('isTyping', noTyping);
                    sendMessage(message, id, name, avatar)
                    return false;
                }
            });

            // Hiệu ứng đang nhập
            chatInput.keypress(function(e) {
                let name = $('#name').val()
                let room_id = $('#id').val()
                if (e.which != 13 && !e.shiftKey) {
                    let typing = `
                    <span style="float: left;margin-right: 5px; margin-bottom:10px">${name} đang soạn tin</span> 
                    <img src="https://static.wixstatic.com/media/c29e02_814402a86a544d12a0ffb478f5c338e9~mv2.gif" width="25px" alt="">
                    `
                    socket.emit('isTyping', typing, room_id);
                }
            })

            function sendMessage(message, id, name, avatar) {
                let url = "{{ route('send') }}"
                let form = $(this)
                let formData = new FormData()
                let token = "{{ csrf_token() }}"

                formData.append('message', message)
                formData.append('name', name)
                formData.append('id', id)
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
                    room_id == $('#id').val() && id != $('#id').val() ? `
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg" tooltip="${name}">
                                    <img src="${avatar}" class="rounded-circle user_img_msg">
                                </div>
                                <div class="msg_cotainer_send ml-2" tooltip="21-11-2021" style="background-color: rgba(144, 147, 150, 0.547)">
                                            ${message}
                                </div>
                            </div>
                        ` :
                    ``
                );
            });
        });
    </script>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script>
    $(document).ready(function() {
        $('#action_menu_btn').click(function() {
            $('.action_menu').toggle();
            var messageBody = document.getElementById('chat-content');
            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
        });
    });
    $(function() {
        $('[data-toggle="title"]').tooltip()
    })
    </script>
</script>