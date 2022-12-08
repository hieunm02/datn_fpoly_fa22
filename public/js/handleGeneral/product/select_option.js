$(function() {
    $("#options").change(function() {
        // $("").on("change", function (e) {

        option_id = this.value;
        // }
        var $option_details = $("#multiple");
        $option_details.empty();
        $.ajax({
            type: "GET",
            url: "/getOptionDetails",
            dataType: "JSON",
            data: {
                id: option_id,
            },
            success: function(data) {
                // the next thing you want to do
                var $option_details = $("#multiple");
                $option_details.empty();

                for (var i = 0; i < data.length; i++) {
                    $option_details.append(
                        "<option id=" +
                        data[i].id +
                        " value=" +
                        data[i].id +
                        ">" +
                        data[i].value +
                        "</option>"
                    );
                    console.log(data[i]);
                }

                // //manually trigger a change event for the contry so that the change handler will get triggered
                $option_details.change();
                // $('#show_order').reload();
            },
        });
    });
});