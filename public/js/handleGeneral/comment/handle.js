$(function () {
    //Create Comment
    $(".submit_comment").click(function () {
        productId = $("input[name=product_id]").val();
        userId = $("input[name=user_id]").val();
        // userId = 1;
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
                                <img src="https://images.foody.vn/res/g105/1048075/prof/s640x400/foody-upload-api-foody-mobile-c3-200924105851.jpg"
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
});
