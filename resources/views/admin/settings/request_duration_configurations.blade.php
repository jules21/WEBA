@extends('layouts.master')
@section("title","Request Duration Configurations")
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
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Request Duration Configurations</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Request Duration Configurations</a>
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

    @if(auth()->user()->is_super_admin)
        <form action="">
            <div class="card card-body mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input value="{{ request('start_date') }}" type="date" name="start_date" id="start_date"
                                   class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input value="{{ request('end_date') }}" type="date" name="end_date" id="end_date"
                                   class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="water_network_type_id">
                            Operator
                        </label>
                        <select name="operator_id" id="operator_id" class="form-control select2">
                            <option value="">Please Select Operator</option>
                            @foreach($operators ?? [] as $operator)
                                <option
                                    value="{{$operator->id}}" {{request('operator_id') == $operator->id ? 'selected' : ''}}>{{$operator->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="water_network_type_id">
                            Operation Area
                        </label>
                        <select name="operation_area_id[]" id="operation_area_id" class="form-control select2"
                                data-placeholder="Select Operation Area" multiple="multiple">
                            {{--                            <option value="">Please Select Operation Area</option>--}}
                            @foreach($operationAreas ?? [] as $area)
                                <option
                                    value="{{$area->id}}" {{ in_array($area->id,request('operation_area_id',[])) ? 'selected' : '' }}>{{$area->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="" style="visibility: hidden">Submit</label> <br>
                            <button type="submit" class="btn btn-primary rounded">
                                <i class="la la-search"></i>Filter
                            </button>
                            <a href="{{route('admin.request.duration.configurations')}}" class="btn btn-outline-dark"> Clear search</a>
                            {{--                            <button id="reset" class="btn btn-outline-dark">clear search</button>--}}
                        </div>
                    </div>


                </div>
            </div>
        </form>
    @endif

    <!--begin::Entry-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Request Duration Configurations List</h3>
            </div>

            @if(auth()->user()->is_super_admin)
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-download"></i>Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="nav flex-column nav-hover">
                            <li class="nav-item export-doc">
                                <a href="{{route('admin.export.request.duration.configuration',['start_date'=>request('start_date'),'end_date'=>request('end_date'),'operation_area_id'=>request('operation_area_id'),'request_type_id'=>request('request_type_id')])}}" class="nav-link" target="_blank">
                                    <i class="nav-icon la la-file-excel-o"></i>
                                    <span class="nav-text">Excel</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
            @endif

            @if(auth()->user()->operator_id)
                <div class="card-toolbar">
                    <!-- Button trigger modal-->
                    <button type="button" class="btn btn-light-primary" data-toggle="modal"
                            data-target="#exampleModalLong">
                        <i class="flaticon2-plus"></i>
                        Add New Configuration
                    </button>
                    <!-- Modal-->
                </div>
            @endif
        </div>
        <div class="card-body">


            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-head-custom border table-head-solid table-hover" id="table">
                    {{--                    <table class="table table-striped" id="kt_datatable">--}}
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Request Type</th>
                        @if(auth()->user()->is_super_admin)
                            <th>Operator</th>
                            <th>Operation Area</th>
                        @endif
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
                                <td>{{$configuration->operationArea->name}}</td>
                            @endif

                            <td>{{$configuration->processing_days}}</td>
                            @if($configuration->is_active == 1)
                                <td><span class="badge badge-success">Yes</span></td>
                            @else
                                <td><span class="badge badge-danger">No</span></td>
                            @endif
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light-primary btn-sm dropdown-toggle" type="button"
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
                                        <select name="operator_id" class="form-control select2" style="width: 100% !important;">
                                            <option value="">Select Operator</option>
                                            @foreach($operators as $operator)
                                                <option value="{{$operator->id}}">{{$operator->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                                @endif


                                @if(auth()->user()->operator_id == null)
                                    <div class="form-group">
                                        <label for="name">Operation Area</label>
                                        <select type="text" name="operation_area_id" id="operation_area_id" class="form-control">
                                            <option value="">Please Select Operation Area</option>
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="name">Operation Area</label>
                                        <select type="text" name="operation_area_id" id="operation_area_id" class="form-control">
                                            <option value="">Please Select Operation Area</option>
                                            @foreach($Areas as $area)
                                                <option value="{{$area->id}}">{{$area->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

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
                                        <select name="operator_id" class="form-control select2" style="width: 100% !important;">
                                            <option value="">Select Operator</option>
                                            @foreach($operators as $operator)
                                                <option value="{{$operator->id}}">{{$operator->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <input type="hidden" name="operator_id" value="{{auth()->user()->operator_id}}">
                                @endif

                                @if(auth()->user()->operator_id == null)
                                    <div class="form-group">
                                        <label for="name">Operation Area</label>
                                        <select type="text" name="operation_area_id" id="edit_operation_area_id" class="form-control">
                                            <option value="">Please Select Operation Area</option>
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="name">Operation Area</label>
                                        <select type="text" name="operation_area_id" id="edit_operation_area_id" class="form-control">
                                            <option value="">Please Select Operation Area</option>
                                            @foreach($Areas as $area)
                                                <option value="{{$area->id}}">{{$area->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif


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

        $(document).ready(function (){
            $('select[id="operator_id"]').on('change',function (){
                var OperatorId = $(this).val();
                // alert(OperatorId);
                if (OperatorId){
                    $.ajax({

                        url:'/admin/settings/operation_areas/'+OperatorId,
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            // alert(data);
                            $('select[id="operation_area_id"]').empty();
                            $.each(data,function (key,value){
                                $('select[id="operation_area_id"]').append('<option value="'+value.id+'">'+value.name+'</option>');
                            })
                        }
                    })
                }
            });
        });

    </script>

@endsection
