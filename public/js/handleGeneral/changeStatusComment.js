$(document).ready(function () {
    // Change status
    $(".btn-status").click(function () {
        if (!confirm("Xác nhận đổi trạng thái.")) {
            return;
        }

        var comment_id = $(this).data("id");
        var active = $("#is-active" + comment_id).val();
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "comment/active",
            data: {
                active: active,
                comment_id: comment_id,
            },
            success: function (data) {
                $(".btn-active" + comment_id).text(data.title);
                $("#icon-active" + comment_id)
                    .addClass(data.btnActive)
                    .removeClass(data.btnRemove);
                $("#is-active" + comment_id).val(data.value);
            },
        });
    });
});
