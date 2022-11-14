@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <div class="main-content">
        <div class="alert alert-default-info">
            <h3 class="text-center font-weight-bold" id="title_dashboard">Thống kê trong tháng {{ $month }}</h3>
        </div>
        <div class="col-12">
            <div class="row text-white">
                <div class="col-sm-6 col-lg-4">
                    <div class="card bg-danger">
                        <div class="card-body">
                            <div class="h1 mb-3" id="orderActive">{{ $orderMonth }}</div>
                            <div class="d-flex mb-2 justify-content-between">
                                <div>Số đơn hàng đã bán</div>
                                <div class="ms-auto">
                                    <span class="icon_dashboard">
                                        <i class="anticon anticon-container"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card bg-green-600">
                        <div class="card-body">
                            <div class="h1 mb-3" id="orderQty">{{ $qty }}</div>
                            <div class="d-flex mb-2 justify-content-between">
                                <div>Số lượng sản phẩm</div>
                                <div class="ms-auto">
                                    <span class="icon_dashboard">
                                        <i class="bi bi-grid"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card bg-yellow-400">
                        <div class="card-body">
                            <div class="h1 mb-3" id="orderTotal">{{ number_format($total) }} VND</div>
                            <div class="d-flex mb-2 justify-content-between">
                                <div>Doanh thu</div>
                                <div class="ms-auto">
                                    <span class="icon_dashboard">
                                        <i class="bi bi-coin"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">

            <div class="col-8">
                <div class="col-md-4">
                    <p>Thống kê theo
                        <select class="dashboard-filter form-control">
                            <option>---Chọn---</option>
                            <option value="7ngay">7 ngày qua</option>
                            <option value="thangtruoc">Tháng trước</option>
                            <option value="thangnay">Tháng này</option>
                            <option value="365ngay">365 ngày qua</option>
                        </select>
                    </p>
                </div>
                <div id="bar-chart"></div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-6">
                        <p>Từ ngày
                            <input type="date" id="datefrom" class="form-control">
                        </p>
                    </div>
                    <div class="col-6">
                        <p>Đến ngày
                            <input type="date" id="dateto" class="form-control">
                        </p>
                    </div>
                </div>
                {{-- <div class="text-center">Thống kê sản phẩm trong ngày</div> --}}
                <div class="table-wrapper-scroll-y my-custom-scrollbar mt-2">
                    <table class="table table-bordered">
                        <thead>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Doanh thu</th>
                        </thead>
                        <tbody id="dashboardDay">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#dateto').change(function() {
                var from = $('#datefrom').val();
                var value = $(this).val();
                if (from > value) {
                    $("#datefrom").addClass('is-invalid');
                    $("#dateto").addClass('is-invalid');
                } else {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('admin/dashboard-filterday') }}",
                        data: {
                            from: from,
                            value: value,
                        },
                        dataType: "JSON",
                        success: function(data) {
                            $('#dashboardDay').html('');
                            $("#datefrom").removeClass('is-invalid');
                            $("#dateto").removeClass('is-invalid');
                            data.data.forEach(el => {
                                $('#dashboardDay').append('<tr><td>' + el.name +
                                    '</td><td>' + el
                                    .total_quantity + '</td><td>' + el.total_price +
                                    '</td></tr>');
                            });

                        },
                    });
                }
            });
        })
        dashboardDay()

        function dashboardDay() {
            var value = 'today';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ url('admin/dashboard-filterday') }}",
                data: {
                    value: value,
                },
                dataType: "JSON",
                success: function(data) {
                    data.data.forEach(el => {
                        $('#dashboardDay').append('<tr><td>' + el.name + '</td><td>' + el
                            .total_quantity + '</td><td>' + el.total_price + '</td></tr>');
                    });

                },
            });
        }
        dashboard()

        function dashboard() {
            var value = '7ngay';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ url('admin/dashboard-filter') }}",
                data: {
                    value: value,
                },
                dataType: "JSON",
                success: function(data) {
                    $('#bar-chart').html('');
                    var data_chart = data.chart_data,
                        config = {
                            data: data_chart,
                            xkey: 'date',
                            ykeys: ['quantity', 'total'],
                            labels: ['Số lượng', 'Tổng tiền'],
                            fillOpacity: 0.6,
                            hideHover: 'auto',
                            behaveLikeLine: true,
                            resize: true,
                            pointFillColors: ['#ffffff'],
                            pointStrokeColors: ['black'],
                            lineColors: ['gray', 'red']
                        };
                    config.element = 'bar-chart';
                    Morris.Bar(config);
                },
                error: function() {
                    console.log('error');
                }
            });
        }
        $(document).ready(function() {

            $('.dashboard-filter').change(function() {
                var value = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/dashboard-filter') }}",
                    data: {
                        value: value
                    },
                    dataType: "JSON",
                    success: function(data) {
                        $('#bar-chart').html('');
                        $('#orderActive').text(data.order);
                        $('#orderQty').text(data.qty);
                        $('#title_dashboard').text(data.titleDashboard);
                        $('#orderTotal').text(new Intl.NumberFormat('vn-VN').format(data
                            .total) + ' VND');
                        var data_chart = data.chart_data,
                            config = {
                                data: data_chart,
                                xkey: 'date',
                                ykeys: ['quantity', 'total'],
                                labels: ['Số lượng', 'Tổng tiền'],
                                fillOpacity: 0.6,
                                hideHover: 'auto',
                                behaveLikeLine: true,
                                resize: true,
                                pointFillColors: ['#ffffff'],
                                pointStrokeColors: ['black'],
                                lineColors: ['gray', 'red']
                            };
                        config.element = 'bar-chart';
                        Morris.Bar(config);
                    },
                });

            });
        })
    </script>
    <style>
        .my-custom-scrollbar {
            position: relative;
            height: 360px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }
    </style>
@endsection
