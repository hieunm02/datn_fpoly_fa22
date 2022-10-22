$(document).ready(function () {
    // Change status
    $(".btn-status").click(function () {
        if (!confirm("Xác nhận đổi trạng thái.")) {
            return;
        }

        var product_id = $(this).data("id");
        var active = $("#is-active" + product_id).val();
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "product/active",
            data: {
                active: active,
                product_id: product_id,
            },
            success: function (data) {
                $(".btn-active" + product_id).css("color", data.color);
                $("#icon-active" + product_id)
                    .addClass(data.btnActive)
                    .removeClass(data.btnRemove);
                $("#is-active" + product_id).val(data.value);
            },
        });
    });

    // // CLick slect
    // $('.select-massaction').on('change', removeAction);

    // // hanlde check
    // function hanldeCheckbox(event) {
    //     var target = $(event.target);

    //     //check all page
    //     if (target.val() == 'select-page') {
    //         $('.check-item').prop('checked', true);
    //         var productIds = $('.check-item').map((_, {
    //             value
    //         }) => value).get()
    //     }
    //     // check all
    //     else if (target.val() == 'select-all') {
    //         var productIds = null
    //     }
    //     // uncheck
    //     else if (target.val() == 'un-select') {
    //         $('.check-item').prop('checked', false);
    //         var productIds = null
    //     }

    //     return productIds;
    // }

    // //action remove
    // function removeAction(event) {
    //     var data = hanldeCheckbox(event)
    //     actionDelete(data)
    // }

    // function actionDelete(data) {
    //     $('.delete-action').click(function() {
    //         console.log(data);
    //         if (data) {
    //             if (!confirm('Xác nhận xóa sản phẩm.')) {
    //                 return
    //             }
    //         } else {
    //             alert('Chưa chọn sản phẩm nào.')
    //         }

    //         var arr = JSON.parse('[' + data + ']')
    //         if (arr) {
    //             $.ajax({
    //                 url: '{{ route('products.deleteAllPage') }}',
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 data: {
    //                     'product_ids': data
    //                 },
    //                 success: function(res) {
    //                     window.location = '{{ route('products.index') }}'
    //                 }
    //             }).done(function(response) {});
    //         } else {
    //             alert('Chưa chọn sản phẩm.')
    //         }
    //     })
    // }
});
