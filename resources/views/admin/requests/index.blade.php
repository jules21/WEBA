@extends('layouts.master')

@section('title',"All Requests")

@section('content')

    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none " id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    {{ isset($customer)?$customer->name."'s":'All' }} Requests
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
                        <span class="text-muted">Request Management</span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

        </div>
    </div>


    <div class="card tw-shadow-sm border tw-border-gray-300">
        <div class="card-body">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
                <h4>
                    {{ isset($customer)?$customer->name."'s":'All' }} Requests
                </h4>
                              <x-simple-export-form action="{{ route('admin.requests.export-data-to-excel') }}"/>
            </div>


            <div class="table-responsive my-3">
                <table class="table table-head-custom border rounded-lg table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Created At</th>
                        <th>Customer</th>
                        <th>Request Type</th>
                        <th>Meter Qty</th>
                        <th>UPI</th>
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
    {{--  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
      {!! JsValidator::formRequest(App\Http\Requests\StoreCustomerRequest::class) !!}--}}

    <script>

        function getOperatorAreas(operatorId, $selectedAreaId = null) {
            let operationArea = $('#operation_area_id');
            if (operatorId) {
                operationArea.html('<option value="">Loading...</option>');

                $.ajax({
                    url: "{{ route('operator-operation-areas') }}",
                    data: {operator_id: operatorId},
                    success: function (response) {
                        operationArea.html('<option value="">All</option>');
                        response.forEach(function (item) {
                            operationArea.append(`<option value="${item.id}" ${$selectedAreaId == item.id ? 'selected' : ''}>${item.name}</option>`);
                        });
                    }
                });
            }
        }

        $(document).ready(function () {
            $('.nav-request-management').addClass('menu-item-active menu-item-open');
            $('.nav-all-requests').addClass('menu-item-active');

            window.dataTable = $('.dataTable').DataTable({
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
                    {data: "request_type.name", name: "requestType.name"},
                    {data: "meter_qty", name: "meter_qty"},
                    {data: "upi", name: "upi"},
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

            $('#addButton').on('click', function () {
                $('#addModal').modal('show');
            });

            $('#operator_id').on('change', function () {
                getOperatorAreas($(this).val());
            });

            getOperatorAreas($('#operator_id').val(), "{{ request('operation_area_id') }}");


            $(document).on('click', '.js-delete', function (e) {
                e.preventDefault();

                let url = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: "DELETE",
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (data) {
                                dataTable.ajax.reload();
                            }
                        })
                    }
                });

            });


        });
    </script>

@endsection
