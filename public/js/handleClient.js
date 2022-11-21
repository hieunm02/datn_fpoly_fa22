$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
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

function saveNotify(user_id,type) {
    let url = "/notifies";
    let formData = new FormData();
    let token = $('meta[name="csrf-token"]').attr('content')

    formData.append('user_id', user_id);
    formData.append('type', type);
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
            console.log(data);
            
        }
    })
}