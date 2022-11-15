$(function () {
    result = $("#products_list");
    $('input[name="text_search"]').keyup(function () {
        var search = $(this).val();

        $.ajax({
            type: "GET",
            url: "products",
            typeData: "JSON",
            data: {
                text_search: search,
                status: 200,
            },
            success: function (data) {
                console.log(data.products.data);
                if (data.products.from) {
                    $(result).html("");
                    data.products.data.forEach((element, index) => {
                        $(result).append(
                            `
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-${
                                        index + 1
                                    }" class="check-item"
                                        onclick="checkBox(${
                                            element.id
                                        })" value="${element.id}"
                                        name="${element.id}" type="checkbox">
                                    <label for="check-item-${
                                        index + 1
                                    }" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #${element.id}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="" style="max-width: 60px"
                                        alt="">
                                    <h6 class="m-b-0 m-l-10">${
                                        element.name
                                    }</h6>
                                </div>
                            </td>
                            <td>${element.menu.name}</td>
                            <td>${element.price}</td>
                            <td>${element.quantity}</td>
                            <td>
    
                                <div class="d-flex align-items-center" style="cursor: pointer">
                                    ${
                                        element.active === 0
                                            ? `<div class="m-r-10"></div>
                                        <input type="hidden" id="is-active${element.id}"
                                            value="${element.quantity}">
                                        <div class="btn-status" data-id="${element.id}">
                                            <i style="color: green"
                                                class="bi bi-lock-fill btn-active${element.id}"
                                                id="icon-active${element.id}"></i>
                                        </div>`
                                            : `
                                                <div class="m-r-10"></div>
                                        <input type="hidden" id="is-active${element.id}"
                                            value="{{ $product->active }}">
                                        <div class="btn-status" data-id="${element.id}">
                                            <i style="color: red"
                                                class="bi bi-unlock-fill btn-active${element.id}"
                                                id="icon-active${element.id}"></i>
                                        </div>
                                                `
                                    }
                                </div>
                            </td>
                            <td class="text-right">
                                <a href="products/${element.id}/edit">
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                        <i class="anticon anticon-edit"></i>
                                    </button>
                                </a>
                                <form method="DELETE" class="inline-block"
                                    onsubmit="return confirm('Xác nhận xóa sản phẩm.')"
                                    action="products/${element.id}/destroy">
                                    <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                        <i class="anticon anticon-delete"></i>
                                    </button>
                                </form>
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
});
