$(document).ready(function () {
    // Change status
    $(".btn-status").click(function () {
        if (!confirm("Xác nhận đổi trạng thái.")) {
            return;
        }

        var slide_id = $(this).data("id");
        var active = $("#is-active" + slide_id).val();
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "slide/active",
            data: {
                active: active,
                slide_id: slide_id,
            },
            success: function (data) {
                $(".btn-active" + slide_id).text(data.title);
                $("#icon-active" + slide_id)
                    .addClass(data.btnActive)
                    .removeClass(data.btnRemove);
                $("#is-active" + slide_id).val(data.value);
            },
        });
    });
});
