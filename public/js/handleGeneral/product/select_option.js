$(function () {
    $("#options").change(function () {
        // $("").on("change", function (e) {

        id_building = this.value;
        // }
        var $option_details = $("#option_details");
        $floor.empty();
        $.ajax({
            type: "GET",
            url: "",
            dataType: "JSON",
            data: {
                id: id_building,
            },
            success: function (data) {
                // the next thing you want to do
                var $option_details = $("#option_details");
                $option_details.empty();
                for (var i = 0; i < data.length; i++) {
                    $option_details.append(
                        "<option id=" +
                            data[i].id +
                            " value=" +
                            data[i].id +
                            ">" +
                            data[i].name +
                            "</option>"
                    );
                }
                // //manually trigger a change event for the contry so that the change handler will get triggered
                $option_details.change();
                // $('#show_order').reload();
            },
        });
    });
});
