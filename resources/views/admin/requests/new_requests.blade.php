@extends('layouts.master')

@section('title',"New Requests")

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    New Requests
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
                        <span class="text-muted">New Request Management</span>
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
                    Manage New Requests
                </h4>
            </div>


            <div class="table-responsive my-3">
                <table class="table table-head-custom border table-head-solid  dataTable">
                    <thead>
                    <tr>
                        <th>
                            <label class="checkbox my-3 checkbox-primary">
                                <input type="checkbox" id="checkAll">
                                <span class="mr-1 rounded-0"></span>All
                            </label>
                        </th>
                        <th>Customer</th>
                        <th>Request Type</th>
                        <th>Qty</th>
                        <th>UPI</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <button type="button" disabled class="btn btn-primary btn-lg rounded mt-4" id="btnAssign">
                   <span class="svg-icon">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
</svg>

                   </span>
                    Assign Selected Requests
                </button>


            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="assignModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Assign Request
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.requests.assign') }}"
                      method="post" id="assignForm">
                    @csrf
                    <div class="modal-body">

                        <div class="alert alert-light-success alert-custom">
                            <div class="alert-icon">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <div class="alert-text">
                                <div class="alert-description">You are about to assign <span id="selectedCount"></span>
                                    selected requests to a user.
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="user_id">Users</label>
                            <select name="user_id" id="user_id" class="form-control select2"
                                    style="width: 100% !important;">
                                <option value="">Select User</option>
                                @foreach($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\ValidateAssignRequest::class) !!}

    <script>


        $(document).ready(function () {
            $('.nav-request-management').addClass('menu-item-active menu-item-open');
            $('.nav-pending-requests').addClass('menu-item-active');

            let dataTable = $('.dataTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: "{!! request()->fullUrl() !!}",
                columns: [
                    {
                        data: "id",
                        name: "id",
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `<label class="checkbox my-3 checkbox-primary">
                                        <input type="checkbox" value="${data}" class="js-users"
                                               name="users[]">
                                        <span class="rounded-0"></span>

                                    </label>`;
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
                ]
            });

            let $btnAssign = $('#btnAssign');
            let selectedRows = [];

            let $checkAll = $('#checkAll');
            $checkAll.on('click', function (e) {
                let $jsUsers = $(".js-users");
                if ($(this).is(':checked', true)) {
                    $jsUsers.prop('checked', true);
                    $btnAssign.prop('disabled', false);

                    $jsUsers.each(function () {
                        let id = $(this).val();
                        selectedRows.push(id);
                    });

                } else {
                    $jsUsers.prop('checked', false);
                    $btnAssign.prop('disabled', true);
                    selectedRows = [];
                }
            });

            $(document).on('click', '.js-users', function () {

                let self = $(this);
                let id = self.val();
                if (self.is(':checked', true)) {
                    selectedRows.push(id);
                } else {
                    let index = selectedRows.indexOf(id);
                    selectedRows.splice(index, 1);
                }

                if (selectedRows.length > 0) {
                    $btnAssign.prop('disabled', false);
                } else {
                    $btnAssign.prop('disabled', true);
                }

                if ($('.js-users:checked').length === $('.js-users').length) {
                    $checkAll.prop('checked', true);
                } else {
                    $checkAll.prop('checked', false);
                }

            });

            $btnAssign.on('click', function (e) {
                e.preventDefault();
                if (selectedRows.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please select at least one request!',
                    });
                    return;
                }
                $('#selectedCount').text(selectedRows.length);
                $('#assignModal').modal();
            });

            let isSubmitting = false;
            $('#assignForm').on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);

                if (!$form.valid() || isSubmitting) {
                    return;
                }
                isSubmitting = true;
                let $btn = $form.find('button[type="submit"]');
                $btn.prop('disabled', true)
                    .addClass('spinner spinner-white spinner-right');

                let url = $(this).attr('action');

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        request_ids: selectedRows,
                        user_id: $('#user_id').val(),
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        $('#assignModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Requests assigned successfully!',
                        });
                        dataTable.ajax.reload(function () {
                            selectedRows = [];
                            $checkAll.prop('checked', false);
                            $btnAssign.prop('disabled', true);
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    },
                    complete: function () {
                        $btn.prop('disabled', false)
                            .removeClass('spinner spinner-white spinner-right');
                        isSubmitting = false;
                    }
                })
            });


        });
    </script>

@endsection
