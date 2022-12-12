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

<body>
    <div style="width: 500px; position: fixed; bottom: 60px; right: 0; z-index: 999999;">
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
                        <div class="msg_cotainer_send">
                            {{$message->message}}
                        </div>
                    </div>
                    @else
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="{{$message->avatar}}" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer_send">
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
        <div id="action_menu_btn" class="col-md-12 col-xl-12 float-lg-right">
            <div style="width: 60px; height: 60px; border-radius: 50%; float: right;">
                <img src="https://iphone-mania.jp/uploads/2020/05/fe9efa2e670f770a12833f801b8b4387.png" width="100%" alt="">
            </div>
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
                                <div class="msg_cotainer_send">
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
                                <div class="img_cont_msg">
                                    <img src="${avatar}" class="rounded-circle user_img_msg">
                                </div>
                                <div class="msg_cotainer_send">
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
<script>
    $(document).ready(function() {
        $('#action_menu_btn').click(function() {
            $('.action_menu').toggle();
            var messageBody = document.getElementById('chat-content');
            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
        });
    });
</script>