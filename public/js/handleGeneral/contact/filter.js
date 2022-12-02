$(function () {
    var result = $("#contacts_list");
    var paginates = $(".pagination");
    var contactsAll = [];

    //Search with Name contacts
    $('input[name="text_search"]').keyup(function () {
        $(".select-active").val("");
        var data_id = $(this).val();
        //ajax
        ajax(data_id);
    });
  
    //Click numberPage
    paginates.on("click", "#page_item", function () {
        page_id = $(this).data("id");

        contactsPage = contactPage(contactsAll, 5, page_id);

        contactsHtml(contactsPage, result);

        numberPages(contactsAll.length, page_id);

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

        contactsPage = contactPage(contactsAll, 5, page_id);

        contactsHtml(contactsPage, result);

        numberPages(contactsAll.length, page_id);

        $("#page_item").removeClass("active");
        $(".page_" + page_id).addClass("active");
    });

    //Click next
    paginates.on("click", "#next_paginate", function () {
        page_id = $(".curent_page").val();
        if (page_id == Math.ceil(contactsAll.length / 5)) {
            page_id = Math.ceil(contactsAll.length / 5);
        } else {
            page_id = Number(page_id) + 1;
        }

        console.log(page_id);

        contactsPage = contactPage(contactsAll, 5, page_id);

        contactsHtml(contactsPage, result);

        numberPages(contactsAll.length, page_id);

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

    // Ajax search contacts
    function ajax(data) {
        $.ajax({
            type: "GET",
            url: "contacts",
            typeData: "JSON",
            data: {
                text_search: data,
                status: 200,
            },
            success: function (data) {
                contactsAll = data.contacts;
                if (contactsAll) {
                    //Pagination
                    var contactsPage = contactPage(data.contacts, 5, 1);
                    //contacts list
                    contactsHtml(contactsPage, result);
                    // Set numbers of pages
                    numberPages(contactsAll.length);
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
    // contacts list
    function contactsHtml(array, ele) {
        $(ele).html("");
        array.forEach((element, index) => {
            $(ele).append(
                `
                <tr id="id${element.id}">
                    <td>
                        <div class="checkbox">
                            <input id="check-item-1" type="checkbox">
                            <label for="check-item-1" class="m-b-0"></label>
                        </div>
                    </td>
                    <td>
                        #${element.id}
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid rounded" src="" style="max-width: 60px" alt="">
                            <h6 class="m-b-0 m-l-10">${element.name}</h6>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid rounded" src="" style="max-width: 60px" alt="">
                            <h6 class="m-b-0 m-l-10">${element.email}</h6>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid rounded" src="" style="max-width: 60px" alt="">
                            <h6 class="m-b-0 m-l-10">${element.phone}</h6>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid rounded" src="" style="max-width: 60px" alt="">
                            <h6 class="m-b-0 m-l-10">${element.content}</h6>
                        </div>
                    </td>
                    <td style="max-width: 100px;">
                        ${
                            element.status == 0
                            ? `<a href="contacts/${element.id}" class="btn btn-success"><i class="bi bi-send"></i> Send</a></h6>`
                            :` <p class="text-success"><i class="bi bi-check"></i>Đã Send</p>`
                        }
                    </td>
                </tr>
                `
            );
        });
    }

    //Number pages
    function numberPages(numbercontacts, curentPage = 1) {
        pages = Math.ceil(numbercontacts / 5);
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

//Format price contacts
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
function contactPage(array, page_size, page_number) {
    // human-readable page numbers usually start with 1, so we reduce 1 in the first argument
    return array.slice((page_number - 1) * page_size, page_number * page_size);
}
