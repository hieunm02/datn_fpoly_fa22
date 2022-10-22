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
                            f = "";
                        });
                };
                fileReader.readAsDataURL(f);
                console.log(f);
            }
        });
    }
});
