@extends('layouts.client.client-master')
@section('title-page', 'Maintence')
@section('content')
<div class="d-none">
    <div class="bg-primary p-3 d-flex align-items-center">
        <h4 class="font-weight-bold m-0 text-white flex-fill">Search</h4>
        <a class="toggle1 text-white" id="clickMenus"><span> <i class="feather-align-justify fs-30"></i></span></a>
    </div>
</div>
<div class="osahan-popular">
    <!-- Most popular -->
    <div class="container">
        <div class="py-5">
            <div class="input-group mb-4">
                <input type="text" id="search" class="form-control form-control-lg input_search border-right-0" id="inlineFormInputGroup" placeholder="Tìm kiếm ở đây...">
                <div class="input-group-prepend">
                    <div class="btn input-group-text bg-white border_search border-left-0 text-primary"><i class="feather-search"></i></div>
                </div>
            </div>
            <!-- nav tabs -->
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active border-0 bg-light text-dark rounded" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="feather-search mr-2"></i>Kết quả tìm kiếm...</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <!-- Content Row -->
                    <div class="container mt-4 mb-4 p-0">
                        <!-- restaurants nearby -->
                        <div class="row" id="innerResult">

                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
    </div>
    <!-- Footer -->
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script>
    $('#search').on('keyup', function() {
        var result = document.querySelector('#search').value;
        $.ajax({
            url: '/search/client',
            type: "GET",
            dataType: "JSON",
            data: {
                result: result
            },
            success: function(data) {
                console.log(data.result);
                if (data.result.length <= 0) {
                    data.result = `
                    <div class="row d-flex align-items-center justify-content-center py-5">
                        <div class="col-md-4 py-5">
                            <div class="text-center py-5">
                                <p class="h4 mb-4"><i class="feather-search bg-primary text-white rounded p-2"></i></p>
                                <p class="font-weight-bold text-dark h5">Không tìm thấy</p>
                                <p>Chúng tôi không tìm thấy sản phâm, xin mời thử lại.</p>
                            </div>
                        </div>
                    </div>
                    `;
                }
                $('#innerResult').html(data.result);
            },
        });
    })
</script>
@endsection