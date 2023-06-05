@extends('layouts.master')
@section('title','Stock Movement')
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Stock </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Stock Movement</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content')

    <div class="card card-body mb-5">
        <form action="#" id="filter-form">
            <div class="row">
                @unless(Helper::hasOperationArea())
                    <div class="col-md-3 form-group">
                        <label for="operation_area">Operation Area</label>
                        <select name="operation_area_id[]" id="operation_area" class="form-control select2"
                                data-placeholder="Select Operation Area" multiple="multiple">
                            @foreach($operationAreas as $operationArea)
                                <option value="{{ $operationArea->id }}">{{ $operationArea->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endunless
                <div class="col-md-3 form-group">
                    <label for="type">Type</label>
                    <select name="type[]" id="type" class="form-control select2"
                            data-placeholder="Select Type" multiple="multiple">
                        @foreach(Helper::stockMovementType() as $item)
                            <option value="{{ $item}}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="items">Item Category</label>
                    <select name="item_category_id[]" id="item_category" class="form-control select2"
                            data-placeholder="Select Category" multiple="multiple">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <label for="items">Items</label>
                    <select name="item_id[]" id="item" class="form-control select2"
                            data-placeholder="Select Item" multiple="multiple">
                        <option value="">Select Item</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-sm mr-2">
                        <i class="la la-search"></i>
                        Filter</button>
                    <a href="{{route('admin.stock.stock-items.movements')}}" class="btn btn-outline-dark btn-sm"> clear search</a>
                </div>
            </div>
        </form>
    </div>
        <div class="card card-custom">
            <div class="card-header flex-wrap">
                <h3 class="card-title">Stock Movements</h3>
                <div class="dropdown dropdown-inline pt-5">
                    <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-download"></i>Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="nav flex-column nav-hover">
                            <li class="nav-item export-doc">
                                <a href="#" class="nav-link" target="_blank" id="excel">
                                    <i class="nav-icon la la-file-excel-o"></i>
                                    <span class="nav-text">Excel</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--end::Dropdown Menu-->
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            Stock Movement Details
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @php
        //Declare new queries you want to append to string:
        $newQueries = ['is_download' => 1];
        $newUrl = request()->fullUrlWithQuery($newQueries);
    @endphp
@endsection
@section('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function () {
            initData();
            $(document).on("click","#excel", function(e) {
                let url = "{!! $newUrl !!}";
                $(this).attr("href",url);
            });
            $('.nav-stock-managements').addClass('menu-item-active menu-item-open');
            $('.nav-stock-movements').addClass('menu-item-active');
        });

        const getItems = (itemCategoryId) => {
            const url = "{{ route('get-items-by-categories') }}";
            $.ajax({
                url: url,
                type: 'GET',
                data: {item_category_id: itemCategoryId},
                success: function (data) {
                    $('#item').empty();
                    $('#item').append('<option value="">Select Item</option>');
                    $.each(data, function (key, value) {
                        $('#item').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        };
        const initData = () => {
            const operationAreaId = "{{ request()->get('operation_area_id') ? implode(',', request()->get('operation_area_id')) : '' }}";
            const itemCategoryId = "{{ request()->get('item_category_id') ? implode(',', request()->get('item_category_id')) : '' }}";
            const itemId = "{{ request()->get('item_id') ? implode(',', request()->get('item_id')) : '' }}";
            const selectedType = "{{ request()->get('type') ? implode(',', request()->get('type')) : '' }}";

            if (operationAreaId !== '') {
                $('#operation_area').val(operationAreaId.split(',')).trigger('change');
            }

            if (itemCategoryId !== '') {
                $('#item_category').val(itemCategoryId.split(',')).trigger('change')

            }
            if (itemId !== '') {
                $('#item').val(itemId.split(','));
                // //TODO : fix this
                // $('#item').val(itemId.split(','));
                // console.log($('#item').val())
                // console.log(itemId.split(','))
                // $('#item').val(itemId.split(','))
                // console.log($('#item').val())
            }
            if (type !== '') {
                $('#type').val(selectedType.split(',')).trigger('change');
            }

        };
        $(document).on('change', '#item_category', function () {
            let categoryId = $(this).val();
            if (categoryId !== '') {
                console.log('here')
                getItems(categoryId);
            } else {
                $('#item').empty();
                $('#item').append('<option value="">Select Item</option>');
            }
        });
        </script>
@endsection
