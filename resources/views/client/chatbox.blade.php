<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js">
    </script>
</head>
<!--Coded With Love By Mutiullah Samim-->

<body>
    <div style="width: 500px; position: fixed; bottom: 60px; right: 0; z-index: 999999;">
        <div id="chatbox" class="action_menu" class="col-md-12 col-xl-12 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span>Chat with Khalid</span>
                            <p>1767 Messages</p>
                        </div>
                    </div>
                </div>
                <div class="card-body msg_card_body">
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            Hi, how are you samim?
                            <span class="msg_time">8:40 AM, Today</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            Hi Khalid i am good tnx how about you?
                            <span class="msg_time_send">8:55 AM, Today</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="data:image/png;base64,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"
                                class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            I am good too, thank you for your chat template
                            <span class="msg_time">9:00 AM, Today</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            You are welcome
                            <span class="msg_time_send">9:05 AM, Today</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="data:image/png;base64,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"
                                class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            I am looking for your next templates
                            <span class="msg_time">9:07 AM, Today</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            Ok, thank you have a good day
                            <span class="msg_time_send">9:10 AM, Today</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="data:image/png;base64,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"
                                class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            Bye, see you
                            <span class="msg_time">9:12 AM, Today</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
                        <div class="input-group-append">
                            <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
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
</body>

</html>
<style>
    body,
    html {
        height: 100%;
        margin: 0;
        background: #7F7FD5;
        background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
    }

    .chat {
        margin-top: auto;
        margin-bottom: auto;
    }

    .card {
        height: 500px;
        border-radius: 15px !important;
        background-color: rgba(255, 255, 255, 0.94) !important;
    }

    .contacts_body {
        padding: 0.75rem 0 !important;
        overflow-y: auto;
        white-space: nowrap;
    }

    .msg_card_body {
        overflow-y: auto;
    }

    .card-header {
        border-radius: 15px 15px 0 0 !important;
        border-bottom: 1px solid grey !important;
    }

    .card-footer {
        border-radius: 0 0 15px 15px !important;
        border-top: 0 !important;
    }

    .container {
        align-content: center;
    }

    .search {
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0, 0, 0, 0.3) !important;
        border: 0 !important;
        color: white !important;
    }

    .search:focus {
        box-shadow: none !important;
        outline: 0px !important;
    }

    .type_msg {
        background-color: white !important;
        border: 0 !important;
        color: black !important;
        height: 60px !important;
        overflow-y: auto;
        border: 1px solid black !important;
    }

    .type_msg:focus {
        box-shadow: none !important;
        outline: 0px !important;
    }

    .attach_btn {
        border-radius: 15px 0 0 15px !important;
        background-color: rgba(0, 0, 0, 0.3) !important;
        border: 0 !important;
        color: white !important;
        cursor: pointer;
    }

    .send_btn {
        border-radius: 0 15px 15px 0 !important;
        background-color: rgb(73, 155, 255) !important;
        border: 0 !important;
        color: white !important;
        cursor: pointer;
    }

    .search_btn {
        border-radius: 0 15px 15px 0 !important;
        background-color: rgba(0, 0, 0, 0.3) !important;
        border: 0 !important;
        color: white !important;
        cursor: pointer;
    }

    .contacts {
        list-style: none;
        padding: 0;
    }

    .contacts li {
        width: 100% !important;
        padding: 5px 10px;
        margin-bottom: 15px !important;
    }

    .active {
        background-color: rgba(0, 0, 0, 0.3);
    }

    .user_img {
        height: 70px;
        width: 70px;
        border: 1.5px solid #f5f6fa;

    }

    .user_img_msg {
        height: 40px;
        width: 40px;
        border: 1.5px solid #f5f6fa;

    }

    .img_cont {
        position: relative;
        height: 70px;
        width: 70px;
    }

    .img_cont_msg {
        height: 40px;
        width: 40px;
    }

    .online_icon {
        position: absolute;
        height: 15px;
        width: 15px;
        background-color: #4cd137;
        border-radius: 50%;
        bottom: 0.2em;
        right: 0.4em;
        border: 1.5px solid white;
    }

    .user_info {
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 15px;
    }

    .user_info span {
        font-size: 20px;
        color: black;
    }

    .user_info p {
        font-size: 10px;
        color: black;
    }

    .msg_cotainer {
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 10px;
        border-radius: 25px;
        background-color: #82ccdd;
        padding: 10px;
        position: relative;
    }

    .msg_cotainer_send {
        margin-top: auto;
        margin-bottom: auto;
        margin-right: 10px;
        border-radius: 25px;
        background-color: #78e08f;
        padding: 10px;
        position: relative;
    }

    .msg_time {
        position: absolute;
        left: 0;
        bottom: -15px;
        color: rgba(255, 255, 255, 0.5);
        font-size: 10px;
    }

    .msg_time_send {
        position: absolute;
        right: 0;
        bottom: -15px;
        color: rgba(255, 255, 255, 0.5);
        font-size: 10px;
    }

    .msg_head {
        position: relative;
    }

    #action_menu_btn {
        cursor: pointer;
        font-size: 20px;
    }

    .action_menu {
        display: none;
    }

    @media(max-width: 576px) {
        .contacts_card {
            margin-bottom: 15px !important;
        }
    }
</style>
<script>
    $(document).ready(function() {
        $('#action_menu_btn').click(function() {
            $('.action_menu').toggle();
        });
    });
</script>
