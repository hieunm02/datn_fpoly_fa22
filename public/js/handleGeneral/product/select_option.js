$(function() {
    const option = $("#options");
    window.onload = function() {
        const id = option.find(':selected').val();
        console.log(id);
        var detail_field = $('#option_details');
        detail_field.html("");
        var product_id = option.attr('data-product');
        $.ajax({
            type: "GET",
            url: `/admin/product/product-option-details`,
            dataType: "JSON",
            data: {
                id: id,
                product_id: product_id,
            },
            success: function(data) {
                let result = "";
                data.forEach((item) => {
                    result += `
                    <div class="custom-control custom-checkbox">
                        <input name="option_details[]" type="checkbox" ${item.checked} value="${item.id}" class="custom-control-input" id="option_product_${item.id}">
                        <label class="custom-control-label col-12" for="option_product_${item.id}">
                            <div class="col-6">
                            ${item.value}  -   ${item.price}đ
                            </div>
                        </label>
                    </div>
                    `
                })
                detail_field.html(result);
                // console.log(result);
            },
        });
    };
    option.change(function() {
        const id = this.value;
        console.log(id);
        var detail_field = $('#option_details');
        detail_field.html("");

        $.ajax({
            type: "GET",
            url: `/admin/product/option-details`,
            dataType: "JSON",
            data: {
                id: id,
            },
            success: function(data) {
                let result = "";
                data.forEach((item) => {
                    // console.log(item);
                    result += `
                    <div class="custom-control custom-checkbox">
                        <input name="option_details[]" type="checkbox" value="${item.id}" class="custom-control-input" id="option_product_${item.id}">
                        <label class="custom-control-label col-12" for="option_product_${item.id}">
                            <div class="col-6">
                            ${item.value}  -   ${item.price}đ
                            </div>
                        </label>
                    </div>
                    `
                })
                detail_field.html(result);
                // console.log(result);
            },
        });
    });
});

$(function() {
    const option = $("#options");
    option.change(function() {
        const id = this.value;
        var detail_field = $('#option_details');
        detail_field.html("");

        $.ajax({
            type: "GET",
            url: `/admin/product/option-details`,
            dataType: "JSON",
            data: {
                id: id,
            },
            success: function(data) {
                let result = "";
                data.forEach((item) => {
                    // console.log(item);
                    result += `
                    <div class="custom-control custom-checkbox">
                        <input name="option_details[]" type="checkbox" value="${item.id}" class="custom-control-input" id="option_product_${item.id}">
                        <label class="custom-control-label col-12" for="option_product_${item.id}">
                            <div class="col-6">
                            ${item.value}  -   ${item.price}đ
                            </div>
                        </label>
                    </div>
                    `
                })
                detail_field.html(result);
                // console.log(result);
            },
        });
    });
});