@extends('layouts.master')

@section('title',"Grace Periods")

@section('content')

    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none " id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Grace Periods</h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Grace Periods</span>
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
                    Grace Periods
                </h4>

                <buttont type="button" class="btn btn-light-primary rounded font-weight-bolder" id="addButton" data-toggle="modal" data-target="#exampleModalLong">
                       <span class="svg-icon">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
</svg>

                       </span>
                    Add New Period
                </buttont>
            </div>


            <div class="table-responsive my-3">
                <table class="table table-head-custom border table-head-solid table-hover yajra-datatable">
                    {{--                <table class="table table-head-custom border  table-hover dataTable">--}}

                    <thead>
                    <tr>
                        <th></th>
                        <th>Days</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>



    {{--    add modal--}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.operator.grace.period.store',$operationArea->id)}}" method="post" id="submissionForm" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Grace Period</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">

                            <div class="form-group">
                                <label for="name">Days</label>
                                <input type="number" id="days" name="days" class="form-control" required/>
                            </div>

                            <label for="name">Status</label>
                            <select name="operation_area_id" id="operation_area_id" class="form-control" required>
                                <option value="">Select status</option>

                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>

                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save </button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
    </div>

    {{--    edit modal--}}

    <div class="modal fade" id="modalUpdate" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.operator.grace.period.edit')}}" method="post" id="submissionFormEdit" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0"  id="GracePeriodId" name="GracePeriodId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Grace Period</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">

                            <div class="form-group">
                                <label for="name">Days</label>
                                <input type="number" id="days" name="days" class="form-control" required/>
                            </div>

                            <label for="name">Status</label>
                            <select name="operation_area_id" id="operation_area_id" class="form-control" required>
                                <option value="">Select status</option>

                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>

                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(\App\Http\Requests\StoreGracePeriodRequest::class,'#submissionForm') !!}
    {!! JsValidator::formRequest(App\Http\Requests\UpdateGracePeriodRequest::class,'#submissionFormEdit') !!}

    <script>
        $(function () {
            const formData = $("#filter-form").serialize();
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.operator.grace.periods.index',$operationArea->id) }}?" + formData,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable:false,
                        searchable: false},
                    {data: 'days', name: 'days'},
                    {data: 'status', name: 'status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
            });

        });

        // $("#submissionForm").validate();
        // $("#submissionFormEdit").validate();
        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('id'));
            console.log($(this).data('name'));
            console.log($(this).data('description'));
            var url = $(this).data('url');
            $("#GracePeriodId").val($(this).data('id'));
            $("#edit_operation_area_id").val($(this).data('operation-area'));
            $("#edit_status").val($(this).data('status'));
            $("#edit_start_date").val($(this).data('start-date'));
            $("#edit_end_date").val($(this).data('end-date'));
            $("#edit_attachment").val($(this).data('attachment'));
            $('#submissionFormEdit').attr('action', url);
        });
        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this Period ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((willDelete) => {
                if (willDelete.value) {
                    window.location = href;
                } else {
                    //swal("Your imaginary file is safe!");
                }
            });
        });

        $('#exampleModal').on('hidden.bs.modal', function (e) {
            $('#GracePeriodId').val(0);
        });
    </script>
@endsection

