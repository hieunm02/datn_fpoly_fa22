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
            data.forEach(item => {
                result += `
                <tr>
                    <td>${item.id}</td>
                    <td>${item.nameProduct}</td>
                    <td><img src="{{asset('${item.thumb}')}} width='75px'"></td>
                    <td>${item.price}</td>
                    <td>${item.quantity}</td>
                    <td>${item.total}</td>
                    </tr>
                `
            })
            $('.order_details').html(result)


            console.log(result);
        },
    });
}