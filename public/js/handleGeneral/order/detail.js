function orderDetails(id) {
    var token = $(this).data("token");
    console.log(id);
    $.ajax({
        url: 'orders/orderDetails/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            result = '';
            data[0].forEach(item => {
                item.option = "";
                item.option_price = 0;
                item.options.forEach(option => {
                    data[1].forEach(val => {
                        if (option == val.id) {
                            item.option += val.value + ', ';
                            item.option_price += val.price;
                        }
                    })
                });
                result += `
                <tr id="id${id}">
                    <td>${item.id}</td>
                    <td>${item.nameProduct}</td>
                    <td><img src="{{asset('${item.thumb}')}} width='75px'"></td>
                    <td>${item.price}</td>
                    <td>${item.quantity}</td>
                    <td>${item.option}</td>
                    <td>${item.option_price}</td>
                    <td>${item.total}</td>
                    </tr>
                `
            })
            $('.order_details').html(result)


            console.log(result);
        },
    });
}