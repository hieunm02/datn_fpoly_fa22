$(function () {
    var result = $("#vouchers_list");
    var paginates = $(".pagination");
    var vouchersAll = [];

    //Search with status
    $(".select-active").on("change", function (event) {
        $('input[name="text_search"]').val("");
        var target = $(event.target);

        active_search = target.val();

        $.ajax({
            type: "GET",
            url: "vouchers",
            typeData: "JSON",
            data: {
                active_search: active_search,
                status: 200,
            },
            success: function (data) {
                vouchersAll = data.vouchers;
                if (vouchersAll) {
                    //Pagination
                    var vouchersPage = voucherPage(data.vouchers, 5, 1);
                    //vouchers list
                    vouchersHtml(vouchersPage, result);
                    // Set numbers of pages
                    numberPages(vouchersAll.length);
                    //Set active
                    $(".page_1").addClass("active");
                    //end paginate
                } else {
                    $(result).html("");
                    $(paginates).html("");
                }
            },
        });
    });
    //Search with Name vouchers
    $('input[name="text_search"]').keyup(function () {
        $(".select-active").val("");
        var data_id = $(this).val();
        //ajax
        ajax(data_id);
    });
    //Change active
    result.on("click", ".btn-status", function () {
        if (!confirm("Xác nhận đổi trạng thái.")) {
            return;
        }

        var voucher_id = $(this).data("id");
        var active = $("#is-active" + voucher_id).val();
        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "voucher/active",
            data: {
                active: active,
                voucher_id: voucher_id,
            },
            success: function (data) {
                Swal.fire(
                    "Successful!",
                    "Thay đổi trạng thái thành công!",
                    "success"
                );
                $(".btn-active" + voucher_id).css("color", data.color);
                $("#icon-active" + voucher_id)
                    .addClass(data.btnActive)
                    .removeClass(data.btnRemove);
                $("#is-active" + voucher_id).val(data.value);
                //Handle List vouchers
                console.log(vouchersAll);
                for (let i = 0; i < vouchersAll.length; i++) {
                    if (vouchersAll[i]["id"] === voucher_id) {
                        vouchersAll[i]["active"] = data.value;
                    }
                }
            },
        });
    });
    //Delete voucher
    result.on("click", ".delete", function () {
        var token = $(this).data("token");
        id = $(this).data("id");
        if (confirm("Bạn có chắc chắn muốn xóa?")) {
            $.ajax({
                url: "vouchers/" + id,
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
                    //Handle List vouchers

                    for (let i = 0; i < vouchersAll.length; i++) {
                        if (vouchersAll[i]["id"] === id) {
                            vouchersAll.splice(i, 1);
                        }
                    }
                },
            });
        }
    });
    //Paginate

    //Click numberPage
    paginates.on("click", "#page_item", function () {
        page_id = $(this).data("id");

        vouchersPage = voucherPage(vouchersAll, 5, page_id);

        vouchersHtml(vouchersPage, result);

        numberPages(vouchersAll.length, page_id);

        $("#page_item").removeClass("active");
        $(".page_" + page_id).addClass("active");
    });
    //Click pre
    paginates.on("click", "#pre_paginate", function () {
        page_id = $(".curent_page").val();
        if (page_id == 1) {
            page_id = 1;
        } else {
            page_id = page_id - 1;
        }

        vouchersPage = voucherPage(vouchersAll, 5, page_id);

        vouchersHtml(vouchersPage, result);

        numberPages(vouchersAll.length, page_id);

        $("#page_item").removeClass("active");
        $(".page_" + page_id).addClass("active");
    });

    //Click next
    paginates.on("click", "#next_paginate", function () {
        page_id = $(".curent_page").val();
        if (page_id == Math.ceil(vouchersAll.length / 5)) {
            page_id = Math.ceil(vouchersAll.length / 5);
        } else {
            page_id = Number(page_id) + 1;
        }

        console.log(page_id);

        vouchersPage = voucherPage(vouchersAll, 5, page_id);

        vouchersHtml(vouchersPage, result);

        numberPages(vouchersAll.length, page_id);

        $("#page_item").removeClass("active");
        $(".page_" + page_id).addClass("active");
    });

    pre = `
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item" id="pre_paginate">
                <a class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
    `;
    nex = `
            <li class="page-item" id="next_paginate">
                    <a class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    `;

    // Ajax search vouchers
    function ajax(data) {
        $.ajax({
            type: "GET",
            url: "vouchers",
            typeData: "JSON",
            data: {
                text_search: data,
                status: 200,
            },
            success: function (data) {
                vouchersAll = data.vouchers;
                if (vouchersAll) {
                    //Pagination
                    var vouchersPage = voucherPage(data.vouchers, 5, 1);
                    //vouchers list
                    vouchersHtml(vouchersPage, result);
                    // Set numbers of pages
                    numberPages(vouchersAll.length);
                    //Set active
                    $(".page_1").addClass("active");
                    //end paginate
                } else {
                    $(result).html("");
                    $(paginates).html("");
                }
            },
        });
    }
    // vouchers list
    function vouchersHtml(array, ele) {
        $(ele).html("");
        console.log(array);
        array.forEach((element, index) => {
            $(ele).append(
                `
                <tr class="ele_${ element.id }">
                    <td>
                        <div class="checkbox">
                            <input id="check-item-${index + 1}" class="check-item"
                                onclick="checkBox({{ $voucher->id }})" value="{{ $voucher->id }}"
                                name="{{ $voucher->id }}" type="checkbox">
                            <label for="check-item-${index + 1}" class="m-b-0"></label>
                        </div>
                    </td>
                    <td>
                        #${element.id}
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid rounded" src="" style="max-width: 60px"
                                alt="">
                            <h6 class="m-b-0 m-l-10">${element.code}</h6>
                        </div>
                    </td>
                    <td>${element.menu.name}</td>
                    <td>${element.quantity}</td>
                    <td>${element.discount} %</td>
                    <td>
                        <div class="text-center" style="cursor: pointer">
                            ${
                                element.active === 1
                                    ? `<div class="m-r-10"></div>
                                <input type="hidden" id="is-active${element.id}"
                                    value="${element.active}">
                                <div class="btn-status" data-id="${element.id}">
                                    <i style="color: red"
                                        class="bi bi-lock-fill btn-active${element.id}"
                                        id="icon-active${element.id}"></i>
                                </div>`
                                    : `
                                        <div class="m-r-10"></div>
                                <input type="hidden" id="is-active${element.id}"
                                    value="${element.active}">
                                <div class="btn-status" data-id="${element.id}">
                                    <i style="color: green"
                                        class="bi bi-unlock-fill btn-active${element.id}"
                                        id="icon-active${element.id}"></i>
                                </div>
                                        `
                            }
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="products/${element.id}/edit">
                            <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                <i class="anticon anticon-edit"></i>
                            </button>
                        </a>
                        <button
                            class="btn btn-icon btn-hover btn-sm btn-rounded delete" data-id="${
                                element.id
                            }">
                            <i class="anticon anticon-delete"></i>
                        </button>
                    </td>
                </tr>
                `
            );
        });
    }

    //Number pages
    function numberPages(numbervouchers, curentPage = 1) {
        pages = Math.ceil(numbervouchers / 5);
        tempt = 1;
        arr = [];
        c = curentPage;
        for (let i = 1; i <= pages; i++) {
            if (curentPage === 1) {
                arr.push(i);
                if (arr.length >= 10) {
                    arr.push("string", pages - 1, pages);
                    break;
                }
            } else if (curentPage >= 10) {
                if (arr.length <= 2) {
                    arr.push(1, 2, "string");
                }
                a = pages - curentPage;
                if (a <= 6) {
                    arr.push(
                        curentPage - 4,
                        curentPage - 3,
                        curentPage - 2,
                        curentPage - 1
                    );
                    for (let j = a; j >= 0; j--) {
                        arr.push(pages - j);
                    }
                    if (arr.at(-1) === pages) {
                        break;
                    }
                } else {
                    arr.push(c - 4);
                    c++;
                }
                if (arr.length >= 12) {
                    break;
                }
            } else {
                arr.push(tempt);
                tempt++;
                if (arr.length >= 10) {
                    arr.push("string", pages - 1, pages);
                    break;
                }
            }
        }

        // Set null paginate
        $(paginates).html("");
        if (pages > 1) {
            // Set btn pre
            $(paginates).append(pre);
            $(paginates).append(
                `<input type="hidden" class="curent_page" value="${curentPage}" />`
            );
            arr.forEach((ele) => {
                if (ele != "string") {
                    $(paginates).append(
                        `
                        <li id="page_item" class="page-item page_${ele}"
                        data-id="${ele}">
                            <a class="page-link" >${ele}
                            </a>
                        </li>
                        `
                    );
                } else {
                    $(paginates).append("<p>....</p>");
                }
            });
            // Set btn next
            $(paginates).append(nex);
        }
    }
});

//Format price vouchers
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

//Paginate
function voucherPage(array, page_size, page_number) {
    // human-readable page numbers usually start with 1, so we reduce 1 in the first argument
    return array.slice((page_number - 1) * page_size, page_number * page_size);
}
