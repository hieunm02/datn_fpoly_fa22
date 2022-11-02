@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <div class="alert alert-default-info">
        <h3 class="text-center">Thống kê</h3>
    </div>
    <div class="d-flex">
        {{-- <canvas id="myChart" style="width:100%;max-width:600px"></canvas> --}}
        <canvas id="myCharts" style="width:100%;max-width:600px"></canvas>
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
