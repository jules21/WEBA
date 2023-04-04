@extends('layouts.master')
@section('title', 'Stock')
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
                            <a class="text-muted">Stock</a>
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

        <div class="card card-body mb-4">
            <form action="#" id="filter-form">
                <div class="row">
                    @unless(Helper::isOperator())
                        <div class="col-md-3 form-group">
                            <label for="operator">Operator</label>
                            <select name="operator_id[]" id="operator" class="form-control select2"
                                    data-placeholder="Select Operator" multiple="multiple">
                                {{--                                    <option value="">Select Operator</option>--}}
                                @foreach($operators as $operator)
                                    <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endunless
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
                        <a href="{{route('admin.stock.stock-items.index')}}" class="btn btn-outline-dark btn-sm"> clear search</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-content card-custom">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-5">
                        <h3>Stock</h3>
                        <div class="dropdown dropdown-inline mr-2">
                            {{--                            @if ($requests->count() > 0)--}}
                            <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i>Export</button>
                            {{--                            @endif--}}
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
                    <div class="table-responsive">
                        <table class="table table-head-custom border table-head-solid table-hover" id="kt_datatable1">
                            <thead>
                            <tr>

                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Product Category</th>
                                {{--                            <th>operator</th>--}}
                                {{--                            <th>Operation Area</th>--}}
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stocks as $stock)
                                <tr>
                                    <td>{{ $stock->item->name ?? '' }}</td>
                                    <td>{{ $stock->quantity }}</td>
                                    <td>{{ $stock->item->category->name ?? '' }}</td>
                                    {{--                                <td>{{ $stock->operator->name ?? '' }}</td>--}}
                                    {{--                                <td>{{ $stock->operationArea->name ?? '' }}</td>--}}
                                    <td>
                                        <a href="{{route('admin.stock.stock-items.show',encryptId( $stock->id))}}" class="btn btn-sm btn-light-primary">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    <script>
        $(document).ready(function () {
        $('.nav-stock-managements').addClass('menu-item-active menu-item-open');
        $('.nav-stock').addClass('menu-item-active');

            initData();
            $("#kt_datatable1").DataTable({responsive:true});
        });
        $(document).on('change', '#operator', function () {
            let operatorId = $(this).val();
            if (operatorId !== '') {
                getOperationArea(operatorId);
            } else {
                $('#operation_area').empty();
                $('#operation_area').append('<option value="">Select Operation Area</option>');
            }
        });
        const getOperationArea = (operatorId) => {
            const url = "{{ route('get-operation-areas') }}";
            $.ajax({
                url: url,
                type: 'GET',
                data: {operator_id: operatorId},
                success: function (data) {

                    $('#operation_area').empty();
                    $('#operation_area').append('<option value="">Select Operation Area</option>');
                    $.each(data[0], function (key, value) {
                        console.log(value)
                        $('#operation_area').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        };
        const initData = () => {
            const operatorId = "{{ request()->get('operator_id') ? implode(',', request()->get('operator_id')) : '' }}";
            const operationAreaId = "{{ request()->get('operation_area_id') ? implode(',', request()->get('operation_area_id')) : '' }}";
            const itemCategoryId = "{{ request()->get('item_category_id') ? implode(',', request()->get('item_category_id')) : '' }}";
            const itemId = "{{ request()->get('item_id') ? implode(',', request()->get('item_id')) : '' }}";

            if (operatorId !== '') {
                $('#operator').val(operatorId.split(',')).trigger('change');
                getOperationArea(operatorId.split(','));
            }
            if (operationAreaId !== '') {
                $('#operation_area').val(operationAreaId.split(',')).trigger('change');
            }
            if (itemCategoryId !== '') {
                $('#item_category').val(itemCategoryId.split(',')).trigger('change');
            }
            if (itemId !== '') {
                $('#item').val(itemId.split(',')).trigger('change');
            }

        };

        $(document).on("click","#excel", function(e) {
            let url = "{!! $newUrl !!}";
            $(this).attr("href",url);
        });
    </script>
@endsection
