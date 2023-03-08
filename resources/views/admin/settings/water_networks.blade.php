@extends('layouts.master')
@section("title","Water Networks")
@section('css')
@endsection
@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Water Networks</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Water Networks</a>
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
@stop
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Water Networks List</h3>
                    </div>
                    <div class="card-toolbar">
                        <!-- Button trigger modal-->
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModalLong">
                            <span class="flaticon-add"></span>
                            Add New Record
                        </button>

                        <!-- Modal-->
                    </div>
                </div>
                <div class="card-body">


                    <!--begin: Datatable-->
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            {{--                    <table class="table table-striped" id="kt_datatable">--}}
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Request Type</th>
                                @if(auth()->user()->is_super_admin)
                                    <th>Operator</th>
                                @endif
                                <th>Operation Area</th>
                                <th>Processing Days</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($configurations as $key=>$configuration)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$configuration->requestType->name}}</td>
                                    @if(auth()->user()->is_super_admin)
                                        <td>{{$configuration->operator->name}}</td>
                                    @endif
                                    <td>{{$configuration->operationArea->name}}</td>
                                    <td>{{$configuration->processing_days}}</td>
                                    @if($configuration->is_active == 1)
                                        <td><span class="badge badge-success">Yes</span></td>
                                    @else
                                        <td><span class="badge badge-danger">No</span></td>
                                    @endif
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                                <a href="#" data-id="{{$configuration->id}}"
                                                   data-request="{{$configuration->request_type_id}}"
                                                   data-operator="{{$configuration->operator_id}}"
                                                   data-area="{{$configuration->operation_area_id}}"
                                                   data-days="{{$configuration->processing_days}}"
                                                   data-active="{{$configuration->is_active}}"
                                                   class="dropdown-item js-edit">Edit</a>
                                                <a href="{{route('admin.request.duration.configuration.delete',$configuration->id)}}"
                                                   class="dropdown-item js-delete">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>

    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.request.duration.configuration.store')}}" method="post" id="submissionForm" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Request Duration Configuration</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Request Type</label>
                            <select name="request_type_id" id="request_type_id" class="form-control">
                                <option value="">Please Select Type</option>
                                @foreach(App\Models\RequestType::all() as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @if(auth()->user()->operator_id == null)
                            <div class="form-group">
                                <label>Operator</label>
                                <select name="operator_id" class="form-control select2" style="width: 100% !important;" id="kt_select2_1">
                                    <option value="">Select Operator</option>
                                    @foreach($operators as $operator)
                                        <option value="{{$operator->id}}">{{$operator->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                        @endif

                        <div class="form-group">
                            <label for="name">Operation Area</label>
                            <select name="operation_area_id" id="operation_area_id" class="form-control">
                                <option value="">Please Select Type</option>
                                @foreach(App\Models\OperationArea::all() as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Processing Days</label>
                            <input type="number"  name="processing_days" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="active">Active</label>
                            <select type="text" name="is_active" id="is_active" class="form-control" required>
                                <option value="">Please Select</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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




    <div class="modal fade" id="modalUpdate" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.request.duration.configuration.edit')}}" method="post" id="submissionFormEdit" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0"  id="ConfigurationId" name="ConfigurationId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Request Duration Configuration</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Request Type</label>
                            <select name="request_type_id" id="edit_request_type_id" class="form-control">
                                <option value="">Please Select Type</option>
                                @foreach(App\Models\RequestType::all() as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        @if(auth()->user()->operator_id == null)
                            <div class="form-group">
                                <label>Operator</label>
                                <select name="operator_id" class="form-control select2 kt_select2_2" style="width: 100% !important;" id="edit_operator_id">
                                    <option value="">Select Operator</option>
                                    @foreach($operators as $operator)
                                        <option value="{{$operator->id}}">{{$operator->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                        @endif

                        <div class="form-group">
                            <label for="name">Operation Area</label>
                            <select name="operation_area_id" id="edit_operation_area_id" class="form-control">
                                <option value="">Please Select Type</option>
                                @foreach(App\Models\OperationArea::all() as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Processing Days</label>
                            <input type="number"  name="processing_days" id="edit_processing_days" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="active">Active</label>
                            <select type="text" name="is_active" id="edit_is_active" class="form-control" required>
                                <option value="">Please Select</option>
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
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest(\App\Http\Requests\ValidateRequestDurationConfiguration::class,'.submissionForm') !!}

    <script>

        $(document).ready(function() {
            $('#table').DataTable();
        } );

        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-request-duration-configuration').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('name'));
            var url = $(this).data('url');
            $("#ConfigurationId").val($(this).data('id'));
            $("#edit_request_type_id").val($(this).data('request'));
            $("#edit_operator_id").val($(this).data('operator'));
            $("#edit_operation_area_id").val($(this).data('area'));
            $("#edit_processing_days").val($(this).data('days'));
            $("#edit_is_active").val($(this).data('active')? 1:0);
            $('#submissionFormEdit').attr('action', url);
        });

        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this Request Duration Configuration ?",
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

        // basic
        $('#kt_select2_1, .kt_select2_2').select2({
            placeholder: 'Select an operator'
        });

        $('#exampleModal').on('hidden.bs.modal', function (e) {
            $('#TypeId').val(0);
        });

    </script>

@endsection
