@extends('layouts.admin.admin-master')
@section('title', $title)
@section('content')
    <div class="main-content">
        <div class="card">
            <div class="card-body">
                <div class="page-header">
                    <h2 class="header-title">{{ $title }}</h2>
                </div>

                <div class="row mb-5">
                    <div class="col-md-10"></div>
                    <p class="add-one col-md-2">
                        <button class="btn btn-success" type="button">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            Thêm
                        </button>
                    </p>
                </div>
                <!-- HIDDEN DYNAMIC ELEMENT TO CLONE -->
                <!-- you can replace it with any other elements -->
                <div class="form-group dynamic-element" style="display:none">
                    <div class="row">

                        <!-- Replace these fields -->
                        <div class="col-md-6">
                            <label class="font-weight-semibold" for="titleoption_details">Value</label>
                            <input type="text" name="value[]" class="form-control<?php echo $errors->first('value') ? 'is-invalid' : ''; ?>"
                                id="titleoption_details" placeholder="option_details name">
                            @if ($errors->first('value'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('value') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-5">
                            <label class="font-weight-semibold" for="option_detail_price">Price</label>
                            <input type="text" name="price[]" class="form-control <?php echo $errors->first('value') ? 'is-invalid' : ''; ?>"
                                id="option_detail_price" placeholder="option_details name">
                            {{-- @if ($errors->first('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif --}}
                        </div>
                        <div class="col-md-1">
                            <button class="delete btn btn-danger" type="button">
                                <i class="far fa-trash-alt"></i> </button>
                        </div>
                        <!-- End of fields-->

                    </div>
                </div>
                <!-- END OF HIDDEN ELEMENT -->

                <div class="form-container">
                    <form action="{{ route('option-details.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <input type="hidden" value="{{ $option_id }}" name="option_id">
                        <fieldset>
                            <div class="dynamic-stuff">
                                <!-- Dynamic element will be cloned here -->
                                <!-- You can call clone function once if you want it to show it a first element-->
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-10"></div>
                                    <div class="col-md-2">
                                        <button id="singlebutton" name="singlebutton" class="btn btn-primary">Lưu</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //Clone the hidden element and shows it
        $('.add-one').click(function() {
            $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();
            attach_delete();
        });


        //Attach functionality to delete buttons
        function attach_delete() {
            $('.delete').off();
            $('.delete').click(function() {
                console.log("click");
                $(this).closest('.form-group').remove();
            });
        }
    </script>
@endsection
