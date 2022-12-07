$(function () {
    let ip_address = '127.0.0.1';
    let socket_port = '3000';
    let socket = io(ip_address + ':' + socket_port);

    //Create Comment
    $(".submit_comment").click(function () {
        productId = $("input[name=product_id]").val();
        userId = $("input[name=user_id]").val();
        content = $("textarea[name=content]").val();

        if (!content) {
            alert("Nội dung bình luận đang trống");
            return;
        } else if (!userId) {
            alert("Đăng nhập để có thể bình luận.");
            return;
        }
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "comments/create",
            data: {
                product_id: productId,
                content: content,
                user_id: userId,
            },
            success: function (data) {
                listComment = document.querySelector(".info-comment");
                listComment.innerHTML += `
                    <div class="product-item px-3 py-2 my-1 d-flex justify-content-between info-comment ele_${data.comment_id}">
                        <div class="col-md-12 d-flex">
                            <div class="avatar setCt mr-2">
                                <img src="${data.avatar}"
                                    style="width: 60px; height: 60px; object-fit: cover;" class="rounded-circle"
                                    alt="">
                            </div>
                            <div class="setCt d-flex flex-column justify-content-center" style="flex: none;">
                                <h6 class="mb-0">${data.user_id}</h6>
                                <p class="text-black-50">${data.date}</p>
                                <p id="" class="text-black-100 font-weight-bold">
                                    ${content}
                                </p>
                                <p style="cursor: pointer; font-size: 10px">
                                    <span id="edcm_${data.comment_id} " class="edit_comment" data-id="${data.comment_id}" style="color: blue">Edit</span> |
                                    <span id="dlcm_${data.comment_id} " class="dele_comment" data-id="${data.comment_id}" style="color: red">Delete</span>
                                </p>
                            </div>
                        </div>
                    </div>
                `;
                var date = timeDifference(Math.round(new Date().getTime() / 1000), data.date);
                saveNotify(data.id_user, 'comment', 'admin');
                socket.emit('sendNotifyToServer', {
                    user_name: data.user_id, type: 'comment', date: date, comment_id: data.comment_id, notify_id: result.notify.id
                });
                location.reload();
            },
        });
    });

    //Delete Comment

    $(".dele_comment").click(function () {
        if (!confirm("Xóa bình luận của bạn.")) {
            return;
        }

        id = $(this).data("id");
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "comments/delete",
            data: {
                id: id,
            },
            success: function (data) {
                $(".ele_" + id).remove();
            },
        });
    });

    //View input edit comment

    $(".edit_comment").click(function () {
        if (!confirm("Thay đổi bình luận.")) {
            return;
        }
        id = $(this).data("id");
        $(".text_content_" + id).hide();
        $(".edit-content-" + id).prop("type", "text");

        //Save change edit comment
        $("input[name=edit_content]").keypress(function (event) {
            var keycode = event.keyCode ? event.keyCode : event.which;
            if (keycode == "13") {
                value = $(".edit-content-" + id).val();
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: "comments/edit",
                    data: {
                        id: id,
                        value: value,
                    },
                    success: function (data) {
                        $(".text_content_" + id).show();
                        $(".text_content_" + id).text(value);
                        $(".edit-content-" + id).prop("type", "hidden");
                    },
                });
            }
        });
    });

    //Like

    $(".icon-comment").click(function () {
        user_id = $("input[name=user_id]").val();
        id = $(this).data("id");
        reaction_id = $("input[name=reaction_id]").val();
        quantity_like = $(".quan_like_" + id).val();
        if (!user_id) {
            alert("Bạn chưa đăng nhập tài khoản.");
            return;
        }
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "comments/like",
            data: {
                id: id,
                reaction_id: reaction_id,
                user_id: user_id,
            },
            success: function (data) {
                $("#icon_cm_" + id).css("color", "red");
                $(".quan_like_" + id).text(quantity_like + 1);
            },
        });
    });
});
