$(function () {
    //Create floor

    // add filed floor
    var room_group = $(".room_group"); //Input field wrapper

    //
    $("#name_floor").keyup(function () {
        val = $("#name_floor").val();
        id = $(this).data("id");
        building_id = $("input[name=building_id]").val();

        if (val) {
            //validate
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "unique",
                data: {
                    name: val,
                    id: id,
                    building_id: building_id,
                },
                success: function (res) {
                    if (res.errors) {
                        console.log(res.errors);
                        $(".submit_form").prop("disabled", true);
                        $(".log_error").text(
                            "Tên tầng đã tồn tại or đang để trống."
                        );
                        $("#name_floor").addClass("is-invalid");
                    } else {
                        $(".log_error").text("");
                        $("#name_floor").removeClass("is-invalid");
                        $(".add_room").css("display", "block");
                        $(".submit_form").prop("disabled", false);
                    }
                },
            });
            //
        } else {
            $(".add_room").css("display", "none");
        }
        $("input[name=name_floor_hd]").val(val);
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
        console.log(countRoom);
        if (countRoom == 0) {
            $(".label_room").text("");
            $("#name_floor").prop("disabled", false);
        }
    });

    //Submit
});
