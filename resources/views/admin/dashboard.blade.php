@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <div class="main-content">
        <div class="alert alert-default-info">
            <h3 class="text-center font-weight-bold">Thống kê trong tháng {{ $month }}</h3>
        </div>
        <div class="col-12">
            <div class="row text-white">
                <div class="col-sm-6 col-lg-3">
                    <div class="card bg-danger">
                        <div class="card-body">
                            <div class="h1 mb-3">{{ $orderMonth }}</div>
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
                <div class="col-sm-6 col-lg-3">
                    <div class="card bg-green-600">
                        <div class="card-body">
                            <div class="h1 mb-3">{{ 10 }}</div>
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
                <div class="col-sm-6 col-lg-3">
                    <div class="card bg-yellow-400">
                        <div class="card-body">
                            <div class="h1 mb-3">{{ 10 }} VND</div>
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
                <div class="col-sm-6 col-lg-3">
                    <div class="card bg-gray-800">
                        <div class="card-body">
                            <div class="h1 mb-3">{{ 10 }}</div>
                            <div class="d-flex mb-2 justify-content-between">
                                <div>Ứng tuyển vào</div>
                                <div class="ms-auto">
                                    <span class="icon_dashboard">
                                        <i class="fas fa-check"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex">
            {{-- <canvas id="myChart" style="width:100%;max-width:600px"></canvas> --}}
            <canvas id="myCharts" style="width:100%;max-width:600px"></canvas>
        </div>
    </div>
    <script>
        // {{-- đếm số lượng sản phẩm theo danh mục --}}
        var xValues = [""];
        var yValues = [0];
        @foreach ($cates as $it)
            // lấy ra tất cả tên danh mục và số lượng sản phẩm của danh mục
            xValues.push("{{ $it->name }}");
            yValues.push("{{ $it->value }}");
        @endforeach
        var barColors = ["red", "green", "blue", "orange", "brown", "lightblue", "lightseagreen"];
        new Chart("myCharts", {
            type: "bar", // bar, line, doughnut, pie
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false // bar
                },
                title: {
                    display: true,
                    text: "{{ $name }}"
                }
            }
        });
    </script>
@endsection
