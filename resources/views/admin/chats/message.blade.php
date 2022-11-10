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
                            <div class="chat-user-list">
                                @foreach($rooms as $room)
                                <a class="chat-list-item p-h-25" href="/admin/chats/message/{{$room->room_id}}">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-image">
                                            <img src="{{ $room->avatar }}" alt="">
                                        </div>
                                        <div class="p-l-15">
                                            <h5 class="m-b-0">{{$room->name}}</h5>
                                            {{-- <p class="msg-overflow m-b-0 text-muted font-size-13">
                                                Wow, that was cool!
                                            </p> --}}
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>   
                        </div>
                        <div class="chat-content">
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
                                        @if ($message->user_id != 2)
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

                                    <div class="conversation-footer">
                                        <input type="hidden" value="{{$room_id}}" id="room_id">
                                        <input type="hidden" id="avatar" value="{{ Auth::user()->avatar }}">
                                        <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">

                                        <div class="chat-input" id="chatInput" type="text" placeholder="Type a message..." contenteditable=""></div>
                                        <ul class="list-inline d-flex align-items-center m-b-0">
                                            <li class="list-inline-item m-r-15">
                                                <a class="text-gray font-size-20" href="javascript:void(0);" data-toggle="tooltip" title="Emoji">
                                                    <i class="anticon anticon-smile"></i>
                                                </a>
                                            </li> 
                                            <li class="list-inline-item m-r-15">
                                                <a class="text-gray font-size-20" href="javascript:void(0);" data-toggle="tooltip" title="Attachment">
                                                    <i class="anticon anticon-paper-clip"></i>
                                                </a>
                                            </li>    
                                            <li class="list-inline-item">
                                                <button class="d-none d-md-block btn btn-primary">
                                                    <span class="m-r-10">Send</span>
                                                    <i class="far fa-paper-plane"></i>
                                                </button>
                                                <a href="javascript:void(0);" class="text-gray font-size-20 d-md-none d-block">
                                                    <i class="far fa-paper-plane"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Wrapper END -->


        </div>
        <!-- Page Container END -->

</div>
<script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
<script>
    $(function() {
        let ip_address = '127.0.0.1';
        let socket_port = '3000';
        let socket = io(ip_address + ':' + socket_port);

        let chatInput = $('#chatInput');

        chatInput.keypress(function(e) {
            let message = $(this).html();
            let user_id = $('#user_id').val();
            const avatar = $('#avatar').val()
            let room_id = $('#room_id').val()
            console.log(message);
            console.log(room_id);
      
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
                socket.emit('sendChatToServer', message);
                chatInput.html('');
                sendMessage(message, user_id, room_id, avatar)
                return false;
            }
        });

        function sendMessage(message, user_id, room_id, avatar) {
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

        socket.on('sendChatToClient', (message, id, room_id) => {
            $('#chat-content').append(
                id == $('#id').val() ? `
                    <div class="msg msg-sent">
                        <div class="bubble">
                            <div class="bubble-wrapper">
                                <span>${message}</span>
                            </div>
                        </div>
                    </div>
                    `
                    :
                    `
                    <div class="msg msg-recipient">
                        <div class="m-r-10">
                            <div class="avatar avatar-image">
                                <img src="assets/images/avatars/thumb-1.jpg" alt="">
                            </div>
                        </div>
                        <div class="bubble">
                            <div class="bubble-wrapper">
                                <span>${message}</span>
                            </div>
                        </div>
                    </div>
                    `
            );
        });
    });
</script>
@endsection

