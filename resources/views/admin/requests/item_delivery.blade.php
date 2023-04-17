@extends('layouts.master')
@section('title', 'Item Delivery')

@section('content')
    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none mb-4" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Request Delivery
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
                                Delivery Management
                            </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>

    <div class="card tw-shadow-sm border tw-border-gray-300">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h4>
                    Delivery Management
                </h4>
            </div>


            <div class="table-responsive my-3">
                <table class="table table-head-custom border rounded-lg table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Created At</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Delivered</th>
                        <th>Remaining</th>
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
            $('.nav-request-management').addClass('menu-item-active menu-item-open');
            $('.nav-item-delivery').addClass('menu-item-active');

            let dataTable = $('.dataTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{!! request()->fullUrl() !!}",
                columns: [
                    {
                        data: "created_at", name: "created_at",
                        render: function (data, type, row) {
                            return (new Date(data)).toLocaleDateString();
                        }
                    },
                    {data: "customer.name", name: "customer.name"},
                    {data: "total_qty", name: "total_qty", searchable: false, orderable: false},
                    {data: "total_delivered", name: "total_delivered",searchable: false, orderable: false},
                    {
                        data: "total_delivered", name: "total_delivered", searchable: false, orderable: false,
                        render: function (data, type, row) {
                            return row.total_qty - data;
                        },
                    },
                    {
                        data: "status", name: "status",
                        render: function (data, type, row) {
                            return `<span class="badge badge-${row.status_color} rounded-pill">${data}</span>`;
                        },
                    },
                    {data: "action", name: "action", orderable: false, searchable: false}
                ],
                order: [[0, 'desc']]
            });


        });
    </script>

@endsection

