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
    if (confirm('Bạn có chắc chắn muốn xóa?')) {
        $.ajax({
            url: `${parameter}` + "/" + `${id}`,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                id: id,
                _method: "DELETE",
                _token: token,
            },

            success: function (data) {
                Swal.fire(
                    'Successful!',
                    'Student delete successfully!',
                    'success'
                )
                console.log(data.model.id);
                $('#id' + data.model.id).remove();
            }
        });
    }
}
