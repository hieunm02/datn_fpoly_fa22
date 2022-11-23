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

function result(data) {
    console.log(data);
    return data;
}

function saveNotify(user_id, type, role, product_id) {
    let url = "/notifies";
    let formData = new FormData();
    let token = $('meta[name="csrf-token"]').attr('content')

    formData.append('user_id', user_id);
    formData.append('type', type);
    formData.append('role', role);
    formData.append('product_id', product_id);
    formData.append('_token', token);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        success: function (data) {
            result(data);
        }
    })
}

