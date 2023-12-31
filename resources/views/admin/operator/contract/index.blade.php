@extends('layouts.master')

@section('title',"Contracts")

@section('content')

    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none " id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Contracts</h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.operator.index') }}" class="text-muted">
                            Operator Management
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Contracts</span>
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
                    Contracts
                </h4>

                <buttont type="button" class="btn btn-light-primary rounded font-weight-bolder" id="addButton" data-toggle="modal" data-target="#exampleModalLong">
                       <span class="svg-icon">
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"/>
</svg>

                       </span>
                    Add New Contract
                </buttont>
            </div>


            <div class="table-responsive my-3">
                <table class="table table-head-custom border table-head-solid table-hover yajra-datatable">
                    {{--                <table class="table table-head-custom border  table-hover dataTable">--}}

                    <thead>
                    <tr>
                        <th></th>
                        <th>Attachment</th>
                        <th>Start Date</th>
                        <th>End Date</th>
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



    {{--    add modal--}}

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.operator.contract.store',$operationArea->id)}}" method="post" id="submissionForm" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Contract</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
{{--                        <div class="form-group">--}}
{{--                            <label for="name">Operation Area</label>--}}
{{--                            <select name="operation_area_id" id="operation_area_id" class="form-control" required>--}}
{{--                                <option value="">Select Operation Area</option>--}}
{{--                                @foreach($areas as $area)--}}
{{--                                    <option value="{{$area->id}}">{{$area->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label for="name">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">Contact Attachment</label>
                            <div class="custom-file">
                                <input type="file" id="attachment" name="attachment" class="custom-file-input" required/>
                                <label class="custom-file-label">Attach your file</label>
                            </div>
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
            <form action="{{route('admin.operator.contract.edit')}}" method="post" id="submissionFormEdit" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0"  id="ContractId" name="ContractId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Contract</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
{{--                        <div class="form-group">--}}
{{--                            <label for="name">Operation Area</label>--}}
{{--                            <select name="operation_area_id" id="edit_operation_area_id" class="form-control" required>--}}
{{--                                <option value="">Select Operation Area</option>--}}
{{--                                @foreach($areas as $area)--}}
{{--                                    <option value="{{$area->id}}">{{$area->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <label for="name">Start Date</label>
                            <input type="date" id="edit_start_date" name="start_date" max="{{now()->toDateString()}}" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">End Date</label>
                            <input type="date" id="edit_end_date" name="end_date" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="">Contract Attachment</label>
                            <div class="custom-file">
                                <label for="name" class="custom-file-label">Attach your file</label>
                                <input type="file" id="edit_attachment" name="attachment" class="custom-file-input" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Status</label>
                            <select id="edit_status" name="status" class="form-control" required>
                                <option value="">Please select status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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
    {!! JsValidator::formRequest(\App\Http\Requests\StoreContractRequest::class,'#submissionForm') !!}
    {!! JsValidator::formRequest(App\Http\Requests\UpdateContractRequest::class,'#submissionFormEdit') !!}

    <script>
        $(function () {
            const formData = $("#filter-form").serialize();
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.operator.contract.index',$operationArea->id) }}?" + formData,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',  orderable:false,
                        searchable: false},
                    {data: 'attachment', render: function (data, type, row) {
                            return '<a href="{{ route('admin.operator.contracts.download', ':id') }}" class="btn btn-primary">Download</a>'
                                .replace(':id', row.id);
                        }},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
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
            $("#ContractId").val($(this).data('id'));
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
                text: "Delete this Contract ?",
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
            $('#ContractId').val(0);
        });
    </script>
@endsection

