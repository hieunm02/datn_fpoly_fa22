
function filterPrdAll() {
    $('div').filter($('.prdTT')).css('display', 'block');
}
function filterPrd(el) {
    $('div').filter($('.prdTT')).css('display', 'none');
    $('div').filter($('.filterPrd' + el)).css('display', 'block');
}
//showw đơn hàng
index()
function index() {
    $.ajax({
        type: "GET",
        url: "/admin/thanh-toan-truc-tiep/getCart",
        dataType: "Json",
        success: function (response) {
            $("#showCartTT").append(response.data);
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
            value: arr
        },
        dataType: "JSON",
        success: function () {
            $("#showCartTT").html('');
            $("#total1").html('')
            $("#total2").html('')
            $("input[type='checkbox']").prop('checked', false);
            index()
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
                'cart': el
            },
            success: function (data) {
                $("#showCartTT").html('');
                $("#total1").html('')
                $("#total2").html('')
                index()
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
            index()
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
    $.ajax({
        type: "POST",
        url: "/admin/thanh-toan-truc-tiep/paymanet",
        data: {
            name: $('input[name=name]').val(),
            email: $('input[name=email]').val(),
            phone: $('input[name=phone]').val()
        },
        dataType: "JSON",
        success: function (response) {
            $("#showCartTT").html('');
            $("#total1").html('')
            $("#total2").html('')
            $('input[name=name]').text('')
            $('input[name=email]').text('')
            $('input[name=phone]').text('')
            index()
            Swal.fire(
                'Successful!',
                'Thanh toán thành công!',
                'success'
            )
        }
    });
})