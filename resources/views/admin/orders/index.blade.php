@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')

    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title }}</h2>
        </div>
        @if (session()->has('success'))
            <div class="text-white alert bg-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-8">
                        <div class="d-md-flex">
                            <div class="m-b-10 m-r-15">
                                <select class="custom-select" style="min-width: 180px;">
                                    <option selected>Catergory</option>
                                    <option value="all">All</option>
                                    <option value="homeDeco">Home Decoration</option>
                                    <option value="eletronic">Eletronic</option>
                                    <option value="jewellery">Jewellery</option>
                                </select>
                            </div>
                            <div class="m-b-10">
                                <select class="custom-select" style="min-width: 180px;">
                                    <option selected>Status</option>
                                    <option value="all">All</option>
                                    <option value="inStock">In Stock </option>
                                    <option value="outOfStock">Out of Stock</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div id="div1" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <img src="img_w3slogo.gif" draggable="true" ondragstart="drag(event)" id="drag1" width="88"
                        height="31">
                </div>

                <div id="div2" ondrop="drop(event)" ondragover="allowDrop(event)"></div> --}}
                <div class="row m-b-30 " style="height: 200px">
                    <div class="col border border-danger px-md-5" id="div1" ondrop="drop(event)"
                        ondragover="allowDrop(event)">
                        <div class="m-5">
                            <h4>Chờ xác nhận</h4>
                        </div>
                        <div>
                            <div class="row">
                                <div class="col">ID</div>
                                <div class="col">Code</div>
                                <div class="col">Name</div>
                                <div class="col">abc</div>
                            </div>
                        </div>
                        <hr>
                        @foreach ($wait_confirm as $wait_item)
                            <div draggable="true" ondragstart="drag(event)" id="drag1">
                                <div class="row">
                                    <div class="col">{{ $wait_item->code }}</div>
                                    <div class="col">{{ $wait_item->id }}</div>
                                    <div class="col">{{ $wait_item->name }}</div>
                                    <div class="col">{{ $wait_item->id }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col border border-danger" id="div4" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h4>Đang xử lý</h4>
                        <hr>
                    </div>
                    <div class="col border border-danger" id="div2" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h4>Đang giao hàng</h4>
                        <hr>
                    </div>
                    <div class="col border border-danger " id="div3" ondrop="drop(event)"
                        ondragover="allowDrop(event)">
                        <h4>Giao hàng thành công</h4>
                        <hr>
                    </div>
                    <div class="col border border-danger" id="div4" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h4>Đã hủy</h4>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }
    </script>
@endsection
