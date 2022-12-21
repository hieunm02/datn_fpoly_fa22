$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function timeDifference(current, previous) {

    var msPerMinute = 60 * 1000;
    var msPerHour = msPerMinute * 60;
    var msPerDay = msPerHour * 24;
    var msPerMonth = msPerDay * 30;
    var msPerYear = msPerDay * 365;

    var elapsed = current - previous;

    if (elapsed < msPerMinute) {
        return Math.round(elapsed / 1000) + ' seconds ago';
    }

    else if (elapsed < msPerHour) {
        return Math.round(elapsed / msPerMinute) + ' minutes ago';
    }

    else if (elapsed < msPerDay) {
        return Math.round(elapsed / msPerHour) + ' hours ago';
    }

    else if (elapsed < msPerMonth) {
        return 'approximately ' + Math.round(elapsed / msPerDay) + ' days ago';
    }

    else if (elapsed < msPerYear) {
        return 'approximately ' + Math.round(elapsed / msPerMonth) + ' months ago';
    }

    else {
        return 'approximately ' + Math.round(elapsed / msPerYear) + ' years ago';
    }
}

$('#btn-exchange-point').on('click', function () {
    var point_exchange = $('#point_exchange').val();
    $.ajax({
        url: "/vouchers/exchange",
        type: "POST",
        data: {
            point_exchange: point_exchange
        },

        dataType: 'json',
        success: function (data) {
            Swal.fire(
                'Successful!',
                'Đổi thành công!',
                'success'
            )
            $('.point-user').text(data.user.point);
            $('.modal-backdrop').removeClass('modal-backdrop fade show');
            $('.modal').css("display", "none");
        },
        error: function (errors) {
            if (errors.responseJSON.errors.required) {
                $('.error').text(errors.responseJSON.errors.required);
            }
            if (errors.responseJSON.errors.enough) {
                $('.error').text(errors.responseJSON.errors.enough);
            }
            if (errors.responseJSON.errors.multiple) {
                $('.error').text(errors.responseJSON.errors.multiple);
            }
            if (errors.responseJSON.errors.dis) {
                $('.error').text(errors.responseJSON.errors.dis);
            }
        }
    });
})

var result;

function saveNotify(user_id, type, role, room_id) {
    let url = "/notifies";
    let formData = new FormData();
    let token = $('meta[name="csrf-token"]').attr('content')

    formData.append('user_id', user_id);
    formData.append('type', type);
    formData.append('role', role);
    formData.append('room_id', room_id);
    formData.append('_token', token);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        async: false,
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function (data) {
            result = data;
        }
    })
}



$('#applyVoucher').on("click", () => {
    $('#modalVouchers').modal('toggle');
    let code_radio = $('input[name=voucher_code]:checked').val();
    $('input[name=voucher]').val(code_radio);
    let code = $('.code-voucher').val();
    $.ajax({
        url: "/vouchers/apply",
        type: "POST",
        data: {
            code: code,
        },

        dataType: 'json',
        success: function (data) {
            Swal.fire(
                'Successful!',
                'Áp mã thành công!',
                'success'
            );
            $('input[name=voucher_user]').val(code_radio);
            $('.error-voucher').text('');
            $('.discount-voucher').text(data.voucher.discount + '%');
            let total = $('.hidden_total').val();
            if ((data.voucher.discount / 100) * total <= 0) {
                $('#show_order').html(`0 <sup>VND</sup>`)
            } else {
                $('#show_order').html(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(((100 - data.voucher.discount) / 100) * total) + '<sup>đ</sup>')
            }
        },
        error: function (errors) {
            if (errors.responseJSON.errors.required) {
                $("input[name=voucher]").val('')
                $('.error-voucher').text(errors.responseJSON.errors.required);
            }
            if (errors.responseJSON.errors.isNotExist) {
                $("input[name=voucher]").val('')
                $('.error-voucher').text(errors.responseJSON.errors.isNotExist);
            }
            if (errors.responseJSON.errors.isNotTime) {
                $("input[name=voucher]").val('')
                $('.error-voucher').text(errors.responseJSON.errors.isNotTime);
            }
            if (errors.responseJSON.errors.isExpirated) {
                $("input[name=voucher]").val('')
                $('.error-voucher').text(errors.responseJSON.errors.isExpirated);
            }
            if (errors.responseJSON.errors.isOutOfStock) {
                $("input[name=voucher]").val('')
                $('.error-voucher').text(errors.responseJSON.errors.isOutOfStock);
            }
        }
    });
})

// $('#confirm_choose').on('click', () => {
//     let code = $('input[name=voucher_code]:checked').val();
//     $('input[name=voucher]').val(code);
    
// });