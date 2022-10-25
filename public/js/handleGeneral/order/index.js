$(function () {
    $(".select_status").on("change", function (e) {
        order_id = $(this).data("id");
        order_status = $("#is-status" + order_id).val();
        order_active = $("#is-active" + order_id).val();

        if (!confirm("Xác nhận đổi trạng thái đơn hàng.")) {
            return;
        }

        status_select = this.value;
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "order/status",
            data: {
                order_id: order_id,
                status_id: status_select,
                status_cur: order_status,
            },
            success: function (data) {
                if (status_select == 1) {
                    $("#is-status" + order_id).val(status_select);
                    $("#icon-active" + order_id).addClass("badge-warning");
                    $("#icon-active" + order_id).removeClass(data.class);
                } else if (status_select == 2) {
                    $("#is-status" + order_id).val(status_select);
                    $("#icon-active" + order_id).addClass("badge-success");
                    $("#icon-active" + order_id).removeClass(data.class);
                } else if (status_select == 3) {
                    $("#is-status" + order_id).val(status_select);
                    $(".select_status" + order_id).prop("disabled", true);
                    $("#icon-active" + order_id).addClass("badge-danger");
                    $("#icon-active" + order_id).removeClass(data.class);
                }
                $("#op" + order_status).prop("selected", false);
                $("#op" + status_select).prop("selected", true);
            },
        });
    });
});
