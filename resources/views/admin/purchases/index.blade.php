@extends('layouts.master')
@section('title', 'Purchases')

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Purchases
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
                            Manage Purchases
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
                    Manage Purchases
                </h4>

                @can(\App\Constants\Permission::CreatePurchase)

                    <a href="{{ route('admin.purchases.create') }}" class="btn btn-primary btn-sm rounded">
                        <i class="flaticon2-plus-1"></i>
                        Add New
                    </a>

                @endcan
            </div>


            <div class="table-responsive my-3">
                <table class="table table-head-custom border table-head-solid table-hover dataTable">
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
            $('.dataTable').DataTable({
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
        });
    </script>
@endsection
