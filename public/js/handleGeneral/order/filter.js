$(function () {
    result = $(".order_list");
    $('input[name="text_search"]').keyup(function () {
        var search = $(this).val();

        $.ajax({
            type: "GET",
            url: "orders",
            typeData: "JSON",
            data: {
                text_search: search,
                status: 200,
            },
            success: function (data) {
                console.log(data.orders.data);
                $(".paginate").text("");
                if (data.orders.from) {
                    $(result).html("");
                    data.orders.data.forEach((element, index) => {
                        $(result).append(
                            `
                            <tr id="id${element.id}">
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-${element.id}" type="checkbox">
                                    <label for="check-item-${element.id}" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>#${element.id}</td>
                            <td>${element.code}</td>
                            <td>${element.name}</td>
                            <td>${element.phone}</td>
                            <td>${element.address}</td>
                            <td>${element.created_at}</td>
                            <td>
                                @foreach ($authors as $author)
                                    @if ($author->id == $item->user_id)
                                        {{ $author->name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $item->note }}</td>
                            <td>
                                <select name="status" id="status" class="custom-select"
                                    style="min-width: 180px;" onchange="changeStatusAjax({{ $item->id }})">
                                    @foreach ($status as $stt)
                                        <option class="status-{{ $item->id }}" value="{{ $stt->id }}"
                                            {{ $stt->id == $item->status_id ? ' selected' : '' }}>
                                            {{ $stt->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        `
                        );
                    });
                } else {
                    $(result).html("");
                }
            },
        });
    });

    result.on("click", ".btn-status", function () {
        if (!confirm("Xác nhận đổi trạng thái.")) {
            return;
        }

        var product_id = $(this).data("id");
        var active = $("#is-active" + product_id).val();
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "product/active",
            data: {
                active: active,
                product_id: product_id,
            },
            success: function (data) {
                $(".btn-active" + product_id).css("color", data.color);
                $("#icon-active" + product_id)
                    .addClass(data.btnActive)
                    .removeClass(data.btnRemove);
                $("#is-active" + product_id).val(data.value);
            },
        });
    });

    result.on("click", ".delete", function () {
        var token = $(this).data("token");
        id = $(this).data("id");
        if (confirm("Bạn có chắc chắn muốn xóa?")) {
            $.ajax({
                url: "products/" + id,
                type: "DELETE",
                dataType: "JSON",
                data: {
                    id: id,
                    _method: "DELETE",
                    _token: token,
                },
                success: function (data) {
                    Swal.fire("Successful!", "Xóa thành công!", "success");
                    $(".ele_" + id).remove();
                },
            });
        }
    });
});

//Format price products
function formatNumber(nStr, decSeperate, groupSeperate) {
    nStr += "";
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? "." + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, "$1" + groupSeperate + "$2");
    }
    return x1 + x2;
}
