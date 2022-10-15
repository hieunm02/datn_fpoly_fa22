@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
<div class="main-content">
    <div class="page-header d-flex align-items-center">
        <h2 class="header-title flex-fill">Danh sách liên hệ</h2>
        {{-- <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="#" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Home</a>
                    <a class="breadcrumb-item" href="#">Apps</a>
                    <a class="breadcrumb-item" href="#">E-commerce</a>
                    <span class="breadcrumb-item active">Orders List</span>
                </nav>
            </div> --}}
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
                    {{-- <div class="d-md-flex">
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
                        </div> --}}
                </div>
                {{-- <div class="col-lg-4 text-right">
                    <a href="{{ route('contacts.create') }}">
                        <button class="btn btn-primary">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Add Menu</span>
                        </button>
                    </a>
                </div> --}}
                <div>
                    {{ $contacts->links() }}
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
                            <th>Phone</th>
                            <th>Content</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
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
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    setTimeout(() => {
        document.getElementById('setout').classList.add('d-none');
    }, 5000);
</script>
