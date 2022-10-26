$(function () {
    //Create floor

    // add filed floor
    var room_group = $(".room_group"); //Input field wrapper

    //
    $("#name_floor").keyup(function () {
        if ($("#name_floor").val()) {
            $(".add_room").css("display", "block");
        } else {
            $(".add_room").css("display", "none");
        }
        $("input[name=name_floor_hd]").val($("#name_floor").val());
    });

    countRoom = 0;
    //Once add button is clicked
    $(".add_room").click(function () {
        //Check maximum number of input fields
        $(".label_floor").text("Phòng tầng " + $("#name_floor").val());
        $("#name_floor").prop("disabled", true);
        countRoom++;
        $(room_group).append(`
       <div class="room_input ip_group mb-2" data-id="${countRoom}">
            <input type="text" class="form-control" class="input_room" name="name_room[]"
                placeholder="Nhập tên Phòng">
                <a class="remove_room" title="Xóa Phòng"><img class="rm_btn"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT42JD1I9iqU6N5sOaz9V4ucchS0I8F_h6epw&usqp=CAU" /></a>
        </div>
       `); //Add field html
    });

    //Once remove button is clicked
    $(room_group).on("click", ".remove_room", function (e) {
        e.preventDefault();
        $(this).parent("div").remove(); //Remove field html
        countRoom--;
        if (countRoom == 0) {
            $(".label_room").text("");
            $("#name_floor").prop("disabled", false);
        }
    });

    // //Floor

    // $(floor_group).on(function () {
    //     gf_id = $(this).parent("div").data("id");
    //     $("#name_floor" + gf_id).keyup(function () {
    //         floor_value = $("#name_floor" + gf_id).val();

    //         console.log(floor_value);
    //     });
    // });
});
