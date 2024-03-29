@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="main-content">
    <div class="page-header d-flex align-items-center">
        <h2 class="header-title flex-fill">{{$title}}</h2>
        @if (session()->has('success'))
        <p id="setout" class="text-white alert bg-success m-0">
            {{ session()->get('success') }}
        </p>
        @endif
    </div>
    @if($contacts->count())
    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-7">
                    <div class="d-md-flex">
                        <div class="m-b-10">
                            <input type="text" name="text_search" class="form-control" placeholder="Tìm kiếm..."
                                style="width: 180px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover e-commerce-table" style="font-size: 15px">
                    <thead>
                        <tr>
                            <th>
                                <div class="checkbox">
                                    <input id="checkAll" type="checkbox">
                                    <label for="checkAll" class="m-b-0"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Nội dung</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="contacts_list">
                        @foreach ($contacts as $contact)
                        <tr id="id{{$contact->id}}">
                            <td>
                                <div class="checkbox">
                                    <input id="check-item-1" type="checkbox">
                                    <label for="check-item-1" class="m-b-0"></label>
                                </div>
                            </td>
                            <td>
                                #{{ $contact->id }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="" style="max-width: 60px" alt="">
                                    <h6 class="m-b-0 m-l-10">{{ $contact->name }}</h6>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="" style="max-width: 60px" alt="">
                                    <h6 class="m-b-0 m-l-10">{{ $contact->email }}</h6>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="" style="max-width: 60px" alt="">
                                    <h6 class="m-b-0 m-l-10">{{ $contact->phone }}</h6>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img class="img-fluid rounded" src="" style="max-width: 60px" alt="">
                                    <h6 class="m-b-0 m-l-10">{{ $contact->content }}</h6>
                                </div>
                            </td>
                            <td style="max-width: 100px;">
                                @if ($contact->status == 0)
                                    <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-success"><i class="bi bi-send"></i> Send</a></h6>
                                @elseif ($contact->status == 1)
                                    <p class="text-success"><i class="bi bi-check"></i>Đã Send</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right pagination">
                    {{ $contacts->links() }}
                </div>
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
                                chưa có liên hệ nào được gửi tới
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
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    setTimeout(() => {
        document.getElementById('setout').classList.add('d-none');
    }, 3000);
</script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('/js/handleGeneral/contact/filter.js') }}"></script>
