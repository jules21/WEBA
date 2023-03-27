@extends('layouts.master')
@section('title', 'Stock In')

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
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
                            Manage  Stock In
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>


    <div class="card shadow-none border">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>
                    Manage  Stock In
                </h4>

            {{--    @if( auth()->user()->can(\App\Constants\Permission::StockInItems) && auth()->user()->operation_area)

                    <a href="{{ route('admin.purchases.create') }}" class="btn btn-primary btn-sm rounded">
                        <i class="flaticon2-plus-1"></i>
                        Add New
                    </a>

                @endif--}}
            </div>


            <div class="table-responsive my-3">
                <table class="table table-head-custom border rounded-lg table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Created At</th>
                        <th>Supplier</th>
                        <th>Items</th>
                        <th>Sub Total</th>
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
                    {data: 'movements_count', name: 'movements_count', searchable: false, orderable: false},
                    {
                        data: 'subtotal', name: 'subtotal',
                        render: function (data) {
                            return Number(data).toLocaleString();
                        }
                    },
                    {
                        data: 'tax_amount', name: 'tax_amount',
                        render: function (data) {
                            return Number(data).toLocaleString();
                        }
                    },
                    {
                        data: 'total', name: 'total',
                        render: function (data) {
                            return Number(data).toLocaleString();
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
    </script>
@endsection


