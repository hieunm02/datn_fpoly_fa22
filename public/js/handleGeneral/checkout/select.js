$(function () {
    $('#building').change(function () {
        // $("").on("change", function (e) {

        id_building = this.value;
        // }
        var $floor = $('#floor');
        $floor.empty();
        var $room = $('#room');
        $room.empty();
        $.ajax({
            type: 'GET',
            url: "carts/getFloor",
            dataType: "JSON",
            data: {
                'id': id_building
            },
            success: function (data) {
                // the next thing you want to do 
                var $floor = $('#floor');
                $floor.empty();
                for (var i = 0; i < data.length; i++) {
                    $floor.append('<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].name + '</option>');
                }
                // //manually trigger a change event for the contry so that the change handler will get triggered
                $floor.change();
            }
        });

    });
})
$(function () {
    $('#floor').change(function () {
        // $("").on("change", function (e) {
        // id_building = document.getElementById('building').value;
        id_floor = this.value;
        // }
        $.ajax({
            type: 'GET',
            url: "carts/getRoom",
            dataType: "JSON",
            data: {
                'floor_id': id_floor,
                // 'building_id': id_building,
            },
            success: function (data) {
                // the next thing you want to do 
                var $room = $('#room');
                $room.empty();
                for (var i = 0; i < data.length; i++) {
                    $room.append('<option id=' + data[i].id + ' value=' + data[i].name + '>' + data[i].name + '</option>');
                }
                // //manually trigger a change event for the contry so that the change handler will get triggered
                $room.change();
            }
        });

    });
})