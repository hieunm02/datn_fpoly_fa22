$(function () {
    //Create floor

    // add filed floor
    var floor_group = $(".floor_group"); //Input field wrapper

    //
    $("#name_floor").keyup(function () {
        if ($("#name_floor").val()) {
            $(".add_room").css("display", "block");
        } else {
            $(".add_room").css("display", "none");
        }
    });

    countFloor = 0;
    //Once add button is clicked
    $(".add_floor").click(function () {
        //Check maximum number of input fields
        $(".label_floor").text("Tầng tòa " + $("#name_building").val());
        $("#name_building").prop("disabled", true);
        countFloor++;
        $(floor_group).append(`
       <div class="floor_input ip_group mt-2" data-id="${countFloor}">
            <input type="text" class="form-control" class="input_floor" id="name_floor${countFloor}" name="name_floor[]"
                placeholder="Nhập tên tầng">
                <a class="add_room" title="Thêm Phòng"><img
                        src="https://cdn-icons-png.flaticon.com/512/189/189689.png" /></a>
                <a class="remove_floor " title="Xóa Tầng"><img class="rm_btn"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT42JD1I9iqU6N5sOaz9V4ucchS0I8F_h6epw&usqp=CAU" /></a>
        </div>
       `); //Add field html
    });

    //Once remove button is clicked
    $(floor_group).on("click", ".remove_floor", function (e) {
        e.preventDefault();
        $(this).parent("div").remove(); //Remove field html
        countFloor--;
        if (countFloor == 0) {
            $(".label_floor").text("");
            $("#name_building").prop("disabled", false);
        }
    });

    //Floor

    $(floor_group).on(function () {
        gf_id = $(this).parent("div").data("id");
        $("#name_floor" + gf_id).keyup(function () {
            floor_value = $("#name_floor" + gf_id).val();

            console.log(floor_value);
        });
    });
});
