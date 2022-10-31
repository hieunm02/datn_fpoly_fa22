$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// UploadFile
$("#upload").change(function () {
    const form = new FormData();
    form.append("file", $(this)[0].files[0]);

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
});

function deleteAjax(parameter, id) {
    var token = $(this).data("token");

    if (confirm("Bạn có chắc chắn muốn xóa?")) {
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
                    "Student delete successfully!",
                    "success"
                );
                console.log(data.model.id);
                $("#id" + data.model.id).remove();
            },
        });
    }
}

// View detail bill
function viewBillDetail(id) {
    $.ajax({
        url: "/admin/bills/" + id,
        type: "GET",
        data: {
            id: id,
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var tr = '';
            data.bill.forEach(element => {
                tr += `
                    <tr>
                        <td>${element['id']}</td>
                        <td>${element['email']}</td>
                        <td>${element['code']}</td>
                        <td>${element['name']}</td>
                        <td>${element['phone']}</td>
                        <td>${element['address']}</td>
                        <td>${element['shipper']}</td>
                        <td>${element['voucher']}</td>
                        <td>${element['note']}</td>
                    </tr>
                `
            });
            $('#table-bill-detail').html(tr);
        }
    })
}


function changeStatusAjax(id) {
    var token = $(this).data("token");
    status_id = document.getElementById("status").value;
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Change it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: 'orders/update-status/',
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    status_id: status_id,
                    _method: "POST",
                    _token: token,
                },
                success: function (data) {
                    console.log(data.model);
                    Swal.fire(
                        'Changed!',
                        'The status of the order has been changed',
                        'success'
                    )
                },
            });
        }
    })
}

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
        error:function (error) {
            console.log(error);
            $('#tbodyOrder').html(error.result);
        },
    });
})

