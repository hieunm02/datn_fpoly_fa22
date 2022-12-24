$(document).ready(function () {
    //avartar
    $("#avatar").on("click", function () {
        $("#fileinput").trigger("click");
    });
    // thumb
    $('#fileinput').on('change', function(e){
        var files = e.target.files
        let ftype = files[0].type;
        switch (ftype) {
            case 'image/png':
            case 'image/jpg':
            case 'image/jpeg':
            loadFile(e);
            $('.show_images').css('display', 'none');
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
    //
    if (window.File && window.FileList && window.FileReader) {
        var thumbs = $("#thumbnail").val();
        var origin = window.location.origin + "/";
        if (thumbs) {
            var convertThumbsJson = $.parseJSON(thumbs);
            convertThumbsJson.forEach((element) => {
                $("<img></img>", {
                    class: "thumbUpdate",
                    src: origin + element,
                    title: "Click to remove",
                })
                    .insertAfter("#files")
                    .click(function () {
                        $(this).remove();
                    });
            });
        }
        //
        $(".submit-form").click(function () {
            var srcThumbs = $(".thumbUpdate")
                .map((_, { src }) => src)
                .get();
            $("#image_update").val(srcThumbs);
            var s = $("#image_update").val().replaceAll(origin, "");
            $("#image_update").val(s);
        });

        //
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
                        title: f.name + " | Click to remove",
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

            console.log($("#files").val());
        });
    }
    //
    $("#productName").change(function () {
        $("#outPut").html($(this).val());
    });
});
