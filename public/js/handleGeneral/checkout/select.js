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
                // $('#show_order').reload();
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
    $('.updateQty').click(function () {
        // id_floor = this.value;
        var cart_id = $(this).data("id");
        var quantity = $("#quantity" + cart_id).val();
        if (quantity >= 1) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PUT',
                url: "carts/update/" + cart_id,
                // dataType: "JSON",
                data: {
                    'cart_id': cart_id,
                    'quantity': quantity
                },
                success: function (data) {
                    var $mess = $('#mess');
                    $mess.append('<div id="setout" class="text-white alert bg-success position-fixed" style="right: 8px; z-index: 9999;">' + data.mess + '</div>');
                    $mess.change();
                    $('#show_total').empty();
                    $('#show_order').empty();
                    $('#show_total_product' + cart_id).empty();
                    var total = 0;
                    var price = 0;
                    data.carts.forEach(el => {
                        total += (el.price * el.quantity);
                        if (el.product_id = cart_id) {
                            price = (quantity * el.price);
                        }
                    });
                    $('#show_total_product' + cart_id).append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(price) + '<sup>đ</sup>');
                    $('#show_total').append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(total) + '<sup>đ</sup>');
                    $('#show_order').append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(total) + '<sup>đ</sup>');
                }
            });
            // cart_id = '';
            // quantity = '';
        } else {
            // alert("có cục cứt");
        }
        // alert('update cart có id: ' + cart_id + ' số lượng mới là: ' + quantity);


    });
    $('.deletePrd').click(function () {
        var cart_id = $(this).data("id");
        // alert(cart_id)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'DELETE',
            url: "/carts/delete/" + cart_id,
            // dataType: "JSON",
            data: {
                'cart': cart_id
            },
            success: function (data) {
                var $mess = $('#mess');
                $mess.append('<div id="setout" class="text-white alert bg-success position-fixed" style="right: 8px; z-index: 9999;">' + data.mess + '</div>');
                $mess.change();
                $('#show_total').empty();
                $('#show_order').empty();
                $('#show_total_product' + cart_id).empty();
                $('#cart_item' + cart_id).empty();
                $('#count_cart').empty();
                var total = 0;
                var price = 0;
                var num = 0;
                data.carts.forEach(el => {
                    num++;
                    total += (el.price * el.quantity);
                    if (el.product_id = cart_id) {
                        price = (el.quantity * el.price);
                    }
                });
                // console.log(num);
                $('#show_total_product' + cart_id).append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(price) + '<sup>đ</sup>');
                $('#show_total').append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(total) + '<sup>đ</sup>');
                $('#show_order').append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(total) + '<sup>đ</sup>');
                $('#count_cart').append(num);
            }
        });
    });
})
