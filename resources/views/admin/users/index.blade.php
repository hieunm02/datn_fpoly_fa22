@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <div class="main-content">
        <div class="page-header d-flex align-items-center">
            <h2 class="header-title flex-fill">Danh sách tài khoản</h2>
            @if (session()->has('success'))
                <p id="setout" class="text-white alert bg-success m-0">
                    {{ session()->get('success') }}
                </p>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-8">
                    </div>
                    <div class="col-lg-4 text-right">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover e-commerce-table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="checkbox">
                                        <input id="checkAll" type="checkbox">
                                        <label for="checkAll" class="m-b-0"></label>
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Active</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
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
                                    <td>{!! \App\Helpers\Helper::active( $user->active ) !!}</td>    
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    setTimeout(() => {
        document.getElementById('setout').classList.add('d-none');
    }, 5000);
</script>