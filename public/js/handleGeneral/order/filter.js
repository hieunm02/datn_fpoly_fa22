
$(function () {
    var result = $("#orders_list");
    var paginates = $(".pagination");
    var ordersAll = [];
    var arrStatus = [];

    //Search with status
    $(".select-active").on("change", function (event) {
        $('input[name="text_search"]').val("");
        var target = $(event.target);

        active_search = target.val();

        $.ajax({
            type: "GET",
            url: "orders",
            typeData: "JSON",
            data: {
                active_search: active_search,
                status: 200,
            },
            success: function (data) {
                ordersAll = data.orders;
                arrStatus = data.arrStatus;
                if (ordersAll) {
                    //Pagination
                    var ordersPage = orderPage(data.orders, 5, 1);
                    //orders list
                    ordersHtml(ordersPage, result);
                    // Set numbers of pages
                    numberPages(ordersAll.length);
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
    //Search with Name orders
    $('input[name="text_search"]').keyup(function () {
        $(".select-active").val("");
        var data_id = $(this).val();
        //ajax
        ajax(data_id);
    });

    //Paginate

    //Click numberPage
    paginates.on("click", "#page_item", function () {
        page_id = $(this).data("id");

        ordersPage = orderPage(ordersAll, 5, page_id);

        ordersHtml(ordersPage, result);

        numberPages(ordersAll.length, page_id);

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

        ordersPage = orderPage(ordersAll, 5, page_id);

        ordersHtml(ordersPage, result);

        numberPages(ordersAll.length, page_id);

        $("#page_item").removeClass("active");
        $(".page_" + page_id).addClass("active");
    });

    //Click next
    paginates.on("click", "#next_paginate", function () {
        page_id = $(".curent_page").val();
        if (page_id == Math.ceil(ordersAll.length / 5)) {
            page_id = Math.ceil(ordersAll.length / 5);
        } else {
            page_id = Number(page_id) + 1;
        }

        console.log(page_id);

        ordersPage = orderPage(ordersAll, 5, page_id);

        ordersHtml(ordersPage, result);

        numberPages(ordersAll.length, page_id);

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

    // Ajax search orders
    function ajax(data) {
        $.ajax({
            type: "GET",
            url: "orders",
            typeData: "JSON",
            data: {
                text_search: data,
                status: 200,
            },
            success: function (data) {
                ordersAll = data.orders;
                arrStatus = data.arrStatus;
                if (ordersAll) {
                    //Pagination
                    var ordersPage = orderPage(data.orders, 5, 1);
                    //orders list
                    ordersHtml(ordersPage, result);
                    // Set numbers of pages
                    numberPages(ordersAll.length);
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
    // orders list
    function ordersHtml(array, ele) {
        $(ele).html("");
        array.forEach((element, index) => {
            $(ele).append(
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
                    <td>${element.user_id}</td>
                    <td>${element.note}</td>
                    <td>
                        <select name="status" id="status" class="custom-select custom_status"
                            style="min-width: 180px;"
                            onchange="changeStatusAjax({{ $item->id }})">
                            
                        </select>
                    </td>
                </tr>
                `
            );
        });
    }

    function showCustomstatus () {
        
    }

    //Number pages
    function numberPages(numberorders, curentPage = 1) {
        pages = Math.ceil(numberorders / 5);
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

//Format price orders
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
function orderPage(array, page_size, page_number) {
    // human-readable page numbers usually start with 1, so we reduce 1 in the first argument
    return array.slice((page_number - 1) * page_size, page_number * page_size);
}

//Change active orders

function changeStatusAjax(id) {
    var token = $(this).data("token");
    status_id = document.getElementById("status").value;
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Change it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: 'orders/update-status/',
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    status_id: status_id,
                    _method: "POST",
                    _token: token,
                },
                success: function (data) {
                    console.log(data.model);
                    Swal.fire(
                        'Changed!',
                        'The status of the order has been changed',
                        'success'
                    )
                },
            });
        }
    })
}
