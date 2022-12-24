$(function () {
    $("#avatar").on("click", function () {
        $("#fileinput").trigger("click");
    });
});
$('#fileinput').on('change', function(e){
    var files = e.target.files
    let ftype = files[0].type;
    let fsize = files[0].size;
    switch (ftype) {
        case 'image/png':
        case 'image/jpg':
        case 'image/jpeg':
        if (fsize < 10485760){
            loadFile(e);
            $('.show_images').css('display', 'none');
            $('.show_error_size').remove();
        } else {
            $('.show_images').remove();
            $('.show_error_size').css('display', 'inline-flex');
        }
            break;
        default:
            $('.show_images').css('display', 'inline-flex');
            break;
    }
})
var loadFile = function (event) {
    var output = document.querySelector("#avatar");
    console.log(output);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src); // preview
    };
};
$(function () {
    $("#thumb").on("click", function () {
        $("#files").trigger("click");
    });
});
$(document).ready(function () {
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function (e) {
            $('.imageThumb').remove()
            var files = e.target.files,
                filesLength = files.length;
                let data = new FormData();
                if (filesLength <= 4) {
                    if (filesLength > 0) {
                        let errorSize = '';
                        let errorType = '';
                        for (var i = 0; i < filesLength; i++) {
                            let ftype = files[i].type;
                            let fsize = files[i].size;
                            switch (ftype) {
                                    case 'image/png':
                                    case 'image/jpg':
                                    case 'image/jpeg':
                                    if (fsize < 10485760) {
                                        var f = files[i];
                                        var fileReader = new FileReader();
                                        fileReader.onload = function (e) {
                                        var file = e.target;
                                            $("<img></img>", {
                                                class: "imageThumb",
                                                src: e.target.result,
                                                title: file.name + " | Click to remove",
                                            })
                                            .insertAfter("#files")
                                            .click(function () {
                                                $(this).remove();
                                                removeFileFromFileList($(this).data('id'))
                                                if ($('.imageThumb').length <= 0) {
                                                    $('.publisher-input').removeClass('d-none');
                                                    $('#fileUpload').removeClass('d-none');
                                                }
                                            });
                                            $('.imageThumb').map((index, e) => {
                                                $(e).attr('data-id', index)
                                            });
                                        }
                                        fileReader.readAsDataURL(f);
                                    } else {
                                        errorSize = errorSize + files[i].name + ', ';
                                    }
                                    break;
                                default:
                                    errorType = errorType + files[i].name + ', ';
                                    break;
                            }
                        }
                        if (errorSize.length > 0) {
                            errorSize = errorSize.substr(0, errorSize.length - 2)
                            alert( `${errorSize} : đã quá 10MB`)
                        }
                        if (errorType.length > 0) {
                            errorType = errorType.substr(0, errorType.length - 2)
                            alert( `${errorType}: chỉ nhận file PNG, JPEG, JPG`)
                        }
                    }
                } else {
                        alert('Ảnh chi tiết tối đa là 5 ảnh !')
                }
        });
    }
});

function removeFileFromFileList(index) {
    const dt = new DataTransfer()
    const input = document.getElementById('files')
    const {files} = input

    for (let i = 0; i < files.length; i++) {
        const file = files[i]
        if (index !== i) dt.items.add(file) // here you exclude the file. thus removing it.
    }

    input.files = dt.files // Assign the updates list

}
