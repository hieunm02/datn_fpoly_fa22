$(function () {
    $("#avatar").on("click", function () {
        $("#fileinput").trigger("click");
    });
    $(".submit-form").click(function () {
        if (!$("#fileinput").val()) {
            alert("Ảnh sản phẩm đang trống.");
        }
    });
});
var loadFile = function (event) {
    var output = document.querySelector("#avatar");
    console.log(output);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src);
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
            for (var i = 0; i < filesLength; i++) {
                var f = files[i];
                var fileReader = new FileReader();
                fileReader.onload = function (e) {
                    var file = e.target;

                    // Old code here
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
                    })
                };
                fileReader.readAsDataURL(f);
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
