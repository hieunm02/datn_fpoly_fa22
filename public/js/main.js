$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// UploadFile
$("#upload").change(function (e) {
    const form = new FormData();
    form.append("file", $(this)[0].files[0]);
    var files = e.target.files
    var file = e.target;
    let ftype = files[0].type;
    let fsize = files[0].size;
        if (files.length > 0){
            switch (ftype) {
                case 'image/png':
                case 'image/jpg':
                case 'image/jpeg':
                    if (fsize < 10485760){
                        $.ajax({
                            processData: false,
                            contentType: false,
                            type: "POST",
                            dataType: "JSON",
                            data: form,
                            url: "/admin/upload/services",

                            success: function (results) {
                                if (results.error == false) {
                                    $("#image_show").html(
                                        '<a href="' +
                                        results.url +
                                        '" target="_blank">' +
                                        '<img src="' +
                                        results.url +
                                        '" width="100px"></a> '
                                    );

                                    $("#thumb").val(results.url);
                                } else {
                                    alert("Upload file lỗi");
                                }
                            },
                        });
                    } else {
                        alert('Ảnh quá dung lượng')
                        $("#upload").val("");
                    }
                    break;
                default:
                    alert('Ảnh không đúng định dạng')
                    $("#upload").val("");
                    break;
            }
        } else  {
           alert('else')
        }
});

function deleteAjax(parameter, id) {
    var token = $(this).data("token");

    Swal.fire({
        title: 'Xác nhận thay đổi?',
        text: "Bạn chấp nhận xóa!",
        icon: 'Cảnh báo',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Accept'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `${parameter}` + "/" + `${id}`,
                    type: "DELETE",
                    dataType: "JSON",
                    data: {
                        id: id,
                        _method: "DELETE",
                        _token: token,
                    },
                    success: function (data) {
                        console.log(data.model);
                        Swal.fire(
                            "Successful!",
                            "Xóa thành công!",
                            "success"
                        );
                        console.log(data.model.id);
                        $("#id" + data.model.id).remove();
                    },
                });
            }
    })
}

//View detail order
$('.order-detail').on('click', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        url: "/admin/orders/" + id,
        type: "GET",
        data: {
            id: id,
        },
        dataType: 'json',
        success: function (data) {
            $('#order_products').html('');
            $('#avatar_customer').attr('src', data.user.avatar);
            var billDate = convertUTCDateToLocalDate(new Date(data.order.created_at));
            $('#order_time').text(billDate.toLocaleString("en-GB", { timeZone: "Asia/Ho_Chi_Minh" }));
            $('#order_code').html(`<span style="font-weight:bold;display:inline-block;min-width:146px">Mã đơn</span> ${data.order.code}`);
            var total = 0;
            var products = '';
            var options = '';
            var status = '';
            var totalOption = 0;
            if (data.order.status_id == 1) {
                status = `<span style="font-weight:bold;display:inline-block;min-width:150px">Trạng thái</span><b style="color:#53535f;font-weight:normal;margin:0">Đang chờ xác nhận</b>`
            } else if (data.order.status_id == 2) {
                status = `<span style="font-weight:bold;display:inline-block;min-width:150px">Trạng thái</span><b style="color:#639ef7;font-weight:normal;margin:0">Đang xử lý</b>`
            } else if (data.order.status_id == 3) {
                status = `<span style="font-weight:bold;display:inline-block;min-width:150px">Trạng thái</span><b style="color:#ffc107;font-weight:normal;margin:0">Đang giao</b>`
            } else {
                status = `<span style="font-weight:bold;display:inline-block;min-width:150px">Trạng thái</span><b style="color:red;font-weight:normal;margin:0">Đã hủy</b>`
            }
            // For sản phẩm
            data.billDetail.forEach(element => {
                total += element.total;
                if (element.options != null) {
                    data.options.forEach(option => {
                        element.options.forEach(eOtp => {
                            if (parseInt(eOtp) == option.id) {
                                options += option.value + ', ';
                            }
                        });
                    });
                }
                products += `
                <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                    <span style="display:block;font-size:13px;font-weight:normal;">${element.nameProduct}</span>
                    ${total.toLocaleString('it-IT', { style: 'currency', currency: 'VND' })}
                    <b style="font-size:12px;font-weight:300;"> Số lượng: ${element.quantity}</b>
                    ${element.options != null ? `<span style="display:block;font-size:13px;font-weight:normal;">Option chọn thêm: ${options}</span>` : ''}
                    </p>
                `;
            });
            if (data.voucher) {
                totalBefore = total + totalOption;
                total = (total + totalOption) * ((100 - data.voucher.discount) / 100);
            } else {
                totalBefore = null;
            }
            $('#order_code').html(status);
            var code_voucher = data.voucher ? `<span style="display:block;font-weight:bold;font-size:13px;">Mã voucher</span> ${data.voucher.code} (giảm ${data.voucher.discount}%)` : ''
            $('#order_total').html(`<span style="font-weight:bold;display:inline-block;min-width:146px">Tổng tiền</span> <del>${totalBefore ? totalBefore.toLocaleString('it-IT', { style: 'currency', currency: 'VND' }) : ''}</del> ${total.toLocaleString('it-IT', { style: 'currency', currency: 'VND' })}`);
            $('#name_customer').html(`<span style="display:block;font-weight:bold;font-size:13px">Tên</span> ${data.user.name}`)
            $('#email_customer').html(`<span style="display:block;font-weight:bold;font-size:13px;">Email</span> ${data.user.email}`)
            $('#phone_customer').html(`<span style="display:block;font-weight:bold;font-size:13px;">Số điện thoại</span> ${data.user.phone}`)
            $('#id_customer').html(`<span style="display:block;font-weight:bold;font-size:13px;">ID tài khoản</span> #${data.user.id}`)
            $('#id_customer').html(`<span style="display:block;font-weight:bold;font-size:13px;">ID tài khoản</span> #${data.user.id}`)
            $('#code_voucher').html(code_voucher);
            $('#order_address').html(`<span style="display:block;font-weight:bold;font-size:13px;">Địa chỉ nhận hàng</span> ${data.order.address}`)

            // Append vào table sản phẩm
            $('#order_products').append(products);
        }
    });
});

// View detail bill
$('.bill-detail').on('click', function () {
    var id = $(this).attr('data-id');
    $.ajax({
        url: "/admin/bills/" + id,
        type: "GET",
        data: {
            id: id,
        },
        dataType: 'json',
        success: function (data) {
            $('#bill_products').html('');

            $('#avatar_customer').attr('src', data.user.avatar);
            var billDate = convertUTCDateToLocalDate(new Date(data.bill.created_at));
            $('#bill_time').text(billDate.toLocaleString("en-GB", { timeZone: "Asia/Ho_Chi_Minh" }));
            $('#bill_code').html(`<span style="font-weight:bold;display:inline-block;min-width:146px">Mã đơn</span> ${data.bill.code}`);
            var total = 0;
            var totalOption = 0;
            var options = '';
            var products = '';
            // For sản phẩm
            data.billDetail.forEach(element => {
                console.log(element);
                total += (element.price * element.quantity);
                if (element.options != null) {
                    data.options.forEach(option => {
                        element.options.forEach(eOtp => {
                            if (parseInt(eOtp) == option.id) {
                                options += option.value + ', ';
                                totalOption += option.price
                            }
                        });
                    });
                }
                products += `
                <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;"><span style="display:block;font-size:13px;font-weight:normal;">${element.product.name}</span> ${(element.price * element.quantity + totalOption).toLocaleString('it-IT', { style: 'currency', currency: 'VND' })} <b style="font-size:12px;font-weight:300;"> Số lượng: ${element.quantity}</b>
                ${element.options != null ? `<span style="display:block;font-size:13px;font-weight:normal;">Option chọn thêm: ${options}</span>` : ''}
                </p>
                `;
            });
            var code_voucher = data.voucher ? `<span style="display:block;font-weight:bold;font-size:13px;">Mã voucher</span> ${data.voucher.code} (giảm ${data.voucher.discount}%)` : ''
            if (data.voucher) {
                totalBefore = total + totalOption;
                total = (total + totalOption) * ((100 - data.voucher.discount) / 100);
            } else {
                totalBefore = null;
            }
            $('#bill_total').html(`<span style="font-weight:bold;display:inline-block;min-width:146px">Tổng tiền</span> <del>${totalBefore ? totalBefore.toLocaleString('it-IT', { style: 'currency', currency: 'VND' }) : ''}</del> ${total.toLocaleString('it-IT', { style: 'currency', currency: 'VND' })}`)
            $('#name_customer').html(`<span style="display:block;font-weight:bold;font-size:13px">Tên</span> ${data.user.name}`)
            $('#email_customer').html(`<span style="display:block;font-weight:bold;font-size:13px;">Email</span> ${data.user.email}`)
            $('#phone_customer').html(`<span style="display:block;font-weight:bold;font-size:13px;">Số điện thoại</span> ${data.user.phone}`)
            $('#id_customer').html(`<span style="display:block;font-weight:bold;font-size:13px;">ID tài khoản</span> #${data.user.id}`)
            $('#id_customer').html(`<span style="display:block;font-weight:bold;font-size:13px;">ID tài khoản</span> #${data.user.id}`)
            $('#bill_address').html(`<span style="display:block;font-weight:bold;font-size:13px;">Địa chỉ nhận hàng</span> ${data.bill.address}`)
            $('#code_voucher').html(code_voucher);
            // Append vào table sản phẩm
            $('#bill_products').append(products);
        }
    });
});

function convertUTCDateToLocalDate(date) {
    var newDate = new Date(date.getTime() + date.getTimezoneOffset() * 60 * 1000);
    var hours = date.getHours();

    newDate.setHours(hours);

    return newDate;
}
// update status order
$('.select-order').on("change", function (event) {
    let id = $(this).attr('data-id');
    var status_id = $(event.target).val();
    let admin_id = $('#user_id').val();
    Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Đang thay đổi trạng thái đơn hàng!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'orders/update-status/',
                type: "PUT",
                dataType: "JSON",
                data: {
                    id: id,
                    status_id: status_id,
                    _method: "PUT",
                },
                success: function (data) {
                    if (data.order.status_id == 4) {
                        $('#idOrder' + data.order.id).remove();
                    }
                    let ip_address = '127.0.0.1';
                    let socket_port = '3000';
                    let socket = io(ip_address + ':' + socket_port);
                    let message = '';
                    if (data.order.status_id == 2) {
                        message = `Đơn hàng #${data.order.id} của bạn đang được xử lý`;
                    }
                    if (data.order.status_id == 3) {
                        message = `Đơn hàng #${data.order.id} của bạn đang được giao`;
                    }
                    if (data.order.status_id == 4) {
                        message = `Đơn hàng #${data.order.id} của bạn đã được giao`;
                    }
                    if (data.order.status_id == 5) {
                        message = `Đơn hàng #${data.order.id} của bạn đã được hủy`;
                    }

                    socket.emit('sendChatToServer', message, admin_id, data.user.name, data.admin.avatar, data.user.id);
                    socket.emit('handleStatusOrderServer', { status_id: data.order.status_id, bill_id: data.order.id });
                    sendMessage(message, admin_id, data.admin.avatar, data.user.id)
                    Swal.fire(
                        'Đã thay đổi!',
                        'Trạng thái của đơn hàng đã được thay đổi',
                        'success'
                    )
                },
            });
        }
    })
});

$('#search-by-code').on('keyup', function () {
    var code = document.querySelector('#search-by-code').value;
    $.ajax({
        url: '/admin/orders/search/code',
        type: "GET",
        dataType: "JSON",
        data: {
            code: code
        },
        success: function (data) {
            console.log(data);
            $('#tbodyOrder').html(data.result);
        },
        error: function (error) {
            console.log(error);
            $('#tbodyOrder').html(error.result);
        },
    });
})

function selectOrderByStatus() {
    status_id = document.getElementById("status_id").value;
    $.ajax({
        url: '/admin/orders/search/status',
        type: "GET",
        dataType: "JSON",
        data: {
            status_id: status_id
        },
        success: function (data) {
            console.log(data.result);
            $('#tbodyOrder').html(data.result);
        },
    });
}

// Random code voucher
function randomCode() {
    length = 6;
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    $('#code-voucher').val(result);
}

// Copy to clipboard
function copyToClipboard() {
    document.getElementById("copy_{{ $voucher->id }}").select();
    document.execCommand('copy');
}

$('.toggle-notify').on('click', function () {
    $('.show-notify').css('display', 'none');
});

$('.notify').on('click', function () {
    var notify_id = $(this).attr('data-id');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'PATCH',
        url: "/notifies/" + notify_id,
        data: {
            notify_id: notify_id
        },
        success: function (data) {
            $('.notify').removeClass('notify-pending');
        }
    });
});

function sendMessage(message, user_id, avatar, room_id) {
    let url = "/rep";
    let formData = new FormData();

    formData.append('user_id', user_id)
    formData.append('message', message)
    formData.append('room_id', room_id)
    formData.append('avatar', avatar)

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function (response) {
            if (response.success) {
                console.log(response.data);
            }
        }
    })
}

function disableSubmitButtons(form) {
    form.find('input[type="submit"]').attr('disabled', true);
    form.find('button[type="submit"]').attr('disabled', true);
}
function enableSubmitButtons(form) {
    form.find('input[type="submit"]').removeAttr('disabled');
    form.find('button[type="submit"]').removeAttr('disabled');
}
$('form').submit(function () {
    disableSubmitButtons($(this));
    return true;
});
