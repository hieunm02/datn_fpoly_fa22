@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <link rel="stylesheet" href="{{ asset('/css/paginate.css') }}">
    <div class="main-content">
        <div class="page-header d-flex align-items-center">
            <h2 class="header-title">{{ $title }}</h2>
            @if (session()->has('success'))
                <p id="setout" class="text-white alert bg-success m-0">
                    {{ session()->get('success') }}
                </p>
            @endif
        </div>
        @if($users->count())
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-8">
                        <div class="d-md-flex">
                            <div class="m-b-10 mr-3">
                                <select class="custom-select select-active" style="min-width: 180px;">
                                    <option selected value="">Trạng thái</option>
                                    <option value="0">Mở</option>
                                    <option value="1">Khóa</option>
                                </select>
                            </div>
                            <div class="m-b-10">
                                <input type="text" name="text_search" class="form-control" placeholder="Tìm kiếm..."
                                    style="width: 180px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right">
                    </div>
                </div>
                <div class="table-responsive">
                    <table style="font-size: 15px" class="table table-hover e-commerce-table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <input id="checkAll" type="checkbox">
                                        <label for="checkAll" class="m-b-0"></label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Kiểu</th>
                                <th class="text-center">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody id="users_list">
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <input id="check-item-1" type="checkbox">
                                            <label for="check-item-1" class="m-b-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        #{{ $user->id }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <h6 class="m-b-0">{{ $user->name }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <h6 class="m-b-0">{{ $user->email }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <h6 class="m-b-0">{{ $user->auth_type }}</h6>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="text-center" style="cursor: pointer">
                                           <input type="hidden" id="is-active{{ $user->id }}"
                                            value="{{ $user->active }}">
                                            <input type="hidden" name="auth_id" value="{{ Auth::user()->id }}">
                                            @if ($user->active === 1)
                                                <div class="btn-status" data-id="{{ $user->id }}">
                                                    <i style="color: red" class="bi bi-lock-fill btn-active{{ $user->id }}"
                                                        id="icon-active{{ $user->id }}"></i>
                                                </div>
                                            @else
                                                <div class="btn-status" data-id="{{ $user->id }}">
                                                    <i style="color: green"
                                                        class="bi bi-unlock-fill btn-active{{ $user->id }}"
                                                        id="icon-active{{ $user->id }}"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right pagination">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <center class="text-uppercase text-center text-20xl font-size-20 opacity-7 font-weight-border">
                                <th>
                                    Chưa có người dùng nào
                                </th>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
<script>
    setTimeout(() => {
        document.getElementById('setout').classList.add('d-none');
    }, 5000);
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('/js/handleGeneral/user/filter.js') }}"></script>
