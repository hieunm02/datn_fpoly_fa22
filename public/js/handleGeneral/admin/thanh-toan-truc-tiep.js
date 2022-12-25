
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
    Swal.fire({
        title: 'Xác nhận thay đổi?',
        text: "Bạn muốn xóa đơn hàng khỏi đơn!",
        icon: 'Cảnh báo',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Accept'
    }).then((result) => {
        if (result.isConfirmed) {
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
    })
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
    var emailIp = $('input[name=email]').val();
    var phoneIp = $('input[name=phone]').val();

    if ($('input[name=name]').val() == '') {
        $('input[name=name]').addClass('is-invalid');
    } if (emailIp == '') {
        $('input[name=email]').addClass('is-invalid');
    } if ($('input[name=phone]').val() == '') {
        $('input[name=phone]').addClass('is-invalid');
    } if (validateEmail(emailIp) === false) {
        $('input[name=email]').addClass('is-invalid');
    }  if (validatePhone(phoneIp) === false) {
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
                $('input[name=name]').val('')
                $('input[name=email]').val('')
                $('input[name=phone]').val('')
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
    Swal.fire({
        title: 'Xác nhận thay đổi?',
        text: "Bạn muốn hủy đơn hàng này!",
        icon: 'Cảnh báo',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Accept'
    }).then((result) => {
        if (result.isConfirmed) {
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
    })
});

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}

function validatePhone($phone) {
    var emailReg = /^([0][0-9\s\-\+\(\)]*)$/;
    return emailReg.test( $phone );
}
