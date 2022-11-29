
function filterPrdAll() {
    $('div').filter($('.prdTT')).css('display', 'block');
}
function filterPrd(el) {
    $('div').filter($('.prdTT')).css('display', 'none');
    $('div').filter($('.filterPrd' + el)).css('display', 'block');
}
//tạo mới đơn hàng 
function createOrderNew() {
    var a = Math.floor(Math.random() * 10000);
    $("#showCartTT").html('');
    $("#total1").html(0)
    $("#total2").html(0)
    $("#tenDonHang").text('Đơn mới')
    $("#id_cartTT").html('<input type="hidden" id="orderNew" value="' + a + '">');
}
//showw đơn hàng
function showDonHang(el) {
    $("#id_cartTT").html('');
    $.ajax({
        type: "GET",
        url: "/admin/thanh-toan-truc-tiep/getCart",
        data: {
            order_tt: el
        },
        dataType: "Json",
        success: function (response) {
            $("#showCartTT").html('');
            $("#cartOrder").html('')
            $("#cartOrder").append(response.btn_order)
            $("#id_cartTT").html('<input type="hidden" id="orderNew" value="' + response.order_tt + '">')
            $("#showCartTT").append(response.data);
            $("#total1").html('')
            $("#total2").html('')
            $("#total1").append(new Intl.NumberFormat('vn-VN').format(response.total));
            $("#total2").append(new Intl.NumberFormat('vn-VN').format(response.total));
        }
    });
}
//thêm vào giỏ
$("#addprd").on('click', function () {
    var checks = $("input[type='checkbox']:checked"); // returns object of checkeds.
    var arr = []
    for (var i = 0; i < checks.length; i++) {
        arr.push($(checks[i]).val())
    };
    $.ajax({
        type: "POST",
        url: "/admin/thanh-toan-truc-tiep",
        data: {
            value: arr,
            order_tt: $("#orderNew").val()
        },
        dataType: "JSON",
        success: function () {
            $("#showCartTT").html('');
            $("#total1").html('')
            $("#total2").html('')
            $("input[type='checkbox']").prop('checked', false);
            showDonHang($("#orderNew").val())
            Swal.fire(
                'Successful!',
                'Thêm sản phẩm thành công!',
                'success'
            )
        }
    });
});
//xóa snar phẩm ra khỏi đơn
function deleteTT(el) {
    if (confirm('Bạn muốn xóa sản phẩm này ra khỏi giỏ hàng?')) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            url: "/carts/delete/" + el,
            // dataType: "JSON",
            data: {
                'cart': el,
            },
            success: function (data) {
                $("#showCartTT").html('');
                $("#total1").html('')
                $("#total2").html('')
                showDonHang($("#orderNew").val())
                Swal.fire(
                    'Successful!',
                    'Xóa sản phẩm khỏi giỏ hàng thành công!',
                    'success'
                )
            }
        });
    }
}
//Cập nhật số lượng
function updateQtyTT(el) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'PUT',
        url: "/carts/update/" + el,
        dataType: "JSON",
        data: {
            'cart_id': el,
            'quantity': $('.qty' + el).val()
        },
        success: function (data) {
            $("#showCartTT").html('');
            $("#total1").html('')
            $("#total2").html('')
            showDonHang($("#orderNew").val())
            Swal.fire(
                'Successful!',
                'Cập nhật số lượng thành công!',
                'success'
            )
        }
    });
}
//thanh toán
$("#payment").on('click', function () {
    if ($('input[name=name]').val() == '') {
        $('input[name=name]').addClass('is-invalid');
    } if ($('input[name=email]').val() == '') {
        $('input[name=email]').addClass('is-invalid');
    } if ($('input[name=phone]').val() == '') {
        $('input[name=phone]').addClass('is-invalid');
    } else {
        $('input[name=name]').removeClass('is-invalid');
        $('input[name=email]').removeClass('is-invalid');
        $('input[name=phone]').removeClass('is-invalid');
        $.ajax({
            type: "POST",
            url: "/admin/thanh-toan-truc-tiep/paymanet",
            data: {
                name: $('input[name=name]').val(),
                email: $('input[name=email]').val(),
                phone: $('input[name=phone]').val(),
                order_tt: $("#orderNew").val()
            },
            dataType: "JSON",
            success: function (response) {
                $("#showCartTT").html('');
                $("#total1").html('')
                $("#total2").html('')
                $('input[name=name]').text('')
                $('input[name=email]').text('')
                $('input[name=phone]').text('')
                showDonHang($("#orderNew").val())
                Swal.fire(
                    'Successful!',
                    'Thanh toán thành công!',
                    'success'
                )
            },
            error: function (data) {
                Swal.fire(
                    'Errors!',
                    data.responseJSON,
                    'error'
                )
            }
        });
    }
})
// Xóa đơn hàng trong thanh toán tt
$(document).on("click", ".icon-close-order", function () {
    if (confirm('Bạn có chắc hủy đơn hàng này?')) {
        $.ajax({
            type: "DELETE",
            url: "/admin/thanh-toan-truc-tiep/deleteCartOrder/" + $(this).data("id"),
            // data: "data",
            dataType: "JSON",
            success: function (response) {
                showDonHang($("#orderNew").val())
                Swal.fire(
                    'Successful!',
                    'Xóa đơn hàng thành công!',
                    'success'
                )
            }
        });
    }
});