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
    // thêm sản phẩm vào giỏ
    $('#addtocart').click(function () {
        var product_id = $('input[name=product_id]').val();
        var user_id = $('input[name=user_id]').val();
        var date = $('input[name=date]').val();
        var quantity = $('input[name=quantity]').val();
        // alert(product_id +'-' + user_id+ '-' + date+ '-' + quantity)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "/storeCart",
            dataType: "JSON",
            data: {
                'product_id': product_id,
                'user_id': user_id,
                'date': date,
                'quantity': quantity
            },
            success: function (data) {
                $('#count_cart').empty();
                var num = 0;
                data.carts.forEach(el => {
                    num++;
                });
                console.log(num);
                $('#count_cart').append(num);
                Swal.fire(
                    'Successful!',
                    'Thêm vào giỏ hàng thành công!',
                    'success'
                )
            }
        });

    });
    //update giỏ hàng
    $('.updateQty').click(function () {
        var cart_id = $(this).data("id");
        var quantity = $("#quantity" + cart_id).val();
        var prd_id = $("#prd_id" + cart_id).val();
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
                    // console.log(data.prd.id);
                    $('#show_total').empty();
                    $('#show_order').empty();
                    $('#show_total_product' + cart_id).empty();
                    var total = 0;
                    var price = 0;
                    data.carts.forEach(el => {
                        total += (el.price * el.quantity);
                        if (el.product_id == prd_id) {
                            price = (quantity * el.price);
                        }
                    });
                    $('#show_total_product' + cart_id).append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(price) + '<sup>đ</sup>');
                    $('#show_total').append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(total) + '<sup>đ</sup>');
                    $('#show_order').append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(total) + '<sup>đ</sup>');
                    Swal.fire(
                        'Successful!',
                        'Cập nhật số lượng thành công!',
                        'success'
                    )
                    // $('#cart_id' + data.prd.id).remove();
                }
            });
            // cart_id = '';
            // quantity = '';
        } else {
            alert("số lượng không được âm");
        }


    });
    // xóa sản phẩm giỏ hàng
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
                $('#show_total_product' + cart_id).append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(price) + '<sup>đ</sup>');
                $('#show_total').append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(total) + '<sup>đ</sup>');
                $('#show_order').append(new Intl.NumberFormat('vn-VN', { maximumSignificantDigits: 3 }).format(total) + '<sup>đ</sup>');
                $('#count_cart').append(num);
                Swal.fire(
                    'Successful!',
                    'Xóa sản phẩm khỏi giỏ hàng thành công!',
                    'success'
                )
                // console.log(data.prd.id);
                $('#cart_id' + data.prd.id).remove();
            }
        });
    });
    // thanh toán đơn hàng
    $("#datHang").click(function () {
        var checks = $("input[type='checkbox']:checked"); // returns object of checkeds.
        var arr = []
        for (var i = 0; i < checks.length; i++) {
            arr.push($(checks[i]).val())
        };
        $.ajax({
            type: "POST",
            url: "/orders",
            data: {
                name: $("input[name=name]").val(),
                building: $("select[name=building]").val(),
                floor: $("select[name=floor]").val(),
                room: $("select[name=room]").val(),
                phone: $("input[name=phone]").val(),
                email: $("input[name=email]").val(),
                note: $("textarea[name=note]").val(),
                product_id: arr,
            },
            dataType: "JSON",
            success: function (response) {
                $("#showCartUser").html('');
                $("#cartNull").html('Chưa có sản phẩm nào!');
                $('#show_total').html('');
                $('#show_order').html('');
                $('#show_total').append('0<sup>đ</sup>');
                $('#show_order').append('0<sup>đ</sup>');
                $('#count_cart').html('');
                $('#count_cart').append(response);
                Swal.fire(
                    'Successful!',
                    'Đăt hàng thành công!',
                    'success'
                )
            }
        });
    })
})
