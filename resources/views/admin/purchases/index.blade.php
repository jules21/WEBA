@extends('layouts.master')
@section('title', 'Stock In')

@section('content')

    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none mb-4" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Stock In
                </h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                              Stock In
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>

    @if(request('type')=='all')
        <div class="card card-body mb-4">
            <form action="#" id="filter-form">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="hidden" name="type" value="all">
                            <label for="from_date">From Date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control " placeholder="From Date" value="{{request()->get('from_date')}}">
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="to_date">To Date</label>
                        <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" value="{{request()->get('to_date')}}">
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control select">
                            <option value="">Select Supplier</option>
                            @foreach(\App\Models\Supplier::all() as $supplier)
                                <option value="{{$supplier->id}}" {{request()->get('supplier_id') == $supplier->id ? 'selected' : ''}}>{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control select">
                            <option value="">Select Status</option>
                            @foreach(\App\Constants\Status::stockStatuses() as $key => $status)
                                <option value="{{$status}}" {{request()->get('status') == $status ? 'selected' : ''}}>{{$status}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="item_id">Item</label>
                        <select name="item_id" id="item_id" class="form-control select2">
                            <option value="">Select Item</option>
                            @foreach(\App\Models\Item::all() as $item)
                                <option value="{{$item->id}}" {{request()->get('item_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm mr-2">
                            <i class="la la-search"></i>
                            Filter</button>
                        <a href="{{route('admin.purchases.index')}}?type=all" class="btn btn-outline-dark btn-sm"> clear search</a>
                    </div>
                </div>
            </form>
        </div>

    @endif

    <div class="card tw-shadow-sm border tw-border-gray-300">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>
                    {{ request('type')=='all'?"All Stock In":"My Tasks" }}
                </h4>
                @if(request('type') !== null && request('type')=='all')
{{--                    <x-simple-export-form action="{{ route('admin.requests.export-data-to-excel') }}"/>--}}
                    <div class="dropdown dropdown-inline mr-2">
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
                @endif
            </div>


            <div class="table-responsive my-3">
                <table class="table table-head-custom border rounded-lg table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Created At</th>
                        <th>Supplier</th>
                        <th>Items</th>
                        <th>Tax</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

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

            $('.nav-purchases').addClass('menu-item-active menu-item-open');

            @if(request('type')=='all')
            $('.nav-all-purchases').addClass('menu-item-active');
            @else
            $('.nav-my-purchases').addClass('menu-item-active');
            @endif
            let dataTable = $('.dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: window.location.href,
                columns: [
                    {
                        data: 'created_at', name: 'created_at',
                        render: function (data) {
                            return moment(data).format('DD/MM/YYYY');
                        }
                    },
                    {data: 'supplier.name', name: "supplier.name"},
                    {
                        data: 'movement_details_count',
                        name: 'movement_details_count',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'tax_amount', name: 'tax_amount',
                        render: function (data) {
                            return Number(data).toLocaleString("en-US", {
                                style: "currency",
                                currency: "RWF"
                            });
                        }
                    },
                    {
                        data: 'total', name: 'total',
                        render: function (data) {
                            return Number(data).toLocaleString("en-US", {
                                    style: "currency",
                                    currency: "RWF"
                                }
                            );
                        }
                    },
                    {
                        data: 'status', name: 'status',
                        render: function (data, type, row) {
                            return `<span class="label label-lg font-weight-bold label-light-${row.status_color} label-inline rounded-pill">${data}</span>`
                        }
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                order: [[0, 'desc']]
            });

            $(document).on('click', '.js-submit', function (e) {

                e.preventDefault();
                let url = $(this).attr('href');
                let method = "patch";

                Swal.fire({
                    title: "Are you sure ?",
                    text: "You want to submit this purchase ?",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, submit it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: !0
                }).then(function (results) {

                    if (results.value) {
                        $.ajax({
                            url: url,
                            method: method,
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            success: function (response) {
                                Swal.fire({
                                    title: "Success",
                                    text: "Purchase submitted successfully",
                                    icon: "success",
                                });
                                dataTable.ajax.reload();
                            },
                            error: function (response) {
                                Swal.fire({
                                    title: "Error",
                                    text: "Unable to submit purchase",
                                    icon: "error",
                                });
                            }
                        });
                    }

                })

            });


            // delete purchase
            $(document).on('click', '.js-delete', function (e) {

                e.preventDefault();
                let url = $(this).attr('href');
                let method = "delete";

                Swal.fire({
                    title: "Are you sure ?",
                    text: "You want to delete this purchase ?",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: !0
                }).then(function (results) {

                    if (results.value) {
                        $.ajax({
                            url: url,
                            method: method,
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            success: function (response) {
                                Swal.fire({
                                    title: "Success",
                                    text: "Purchase deleted successfully",
                                    icon: "success",
                                });
                                dataTable.ajax.reload();
                            },
                            error: function (response) {
                                Swal.fire({
                                    title: "Error",
                                    text: "Unable to delete purchase",
                                    icon: "error",
                                });
                            }
                        });
                    }

                })

            });

        });

        $(document).on("click","#excel", function(e) {
            let url = "{!! $newUrl !!}";
            $(this).attr("href",url);
        });
    </script>
@endsection


