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
                        <th>Name</th>
                        <th>Distance Covered</th>
                        <th>Population Covered</th>
                        <th>Water Network Type</th>
                        <th>Operator</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($waterNetworks as $key=>$waterNetwork)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$waterNetwork->name}}</td>
                            <td>{{$waterNetwork->distance_covered}}</td>
                            <td>{{$waterNetwork->population_covered}}</td>
                            <td>{{$waterNetwork->waterNetworkType->name?? ''}}</td>
                            <td>{{$waterNetwork->operator->name?? ''}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Action
                                    </button>
                                    <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                        <a href="#" data-id="{{$waterNetwork->id}}"
                                           data-name="{{$waterNetwork->name}}"
                                           data-distance="{{$waterNetwork->distance_covered}}"
                                           data-population="{{$waterNetwork->population_covered}}"
                                           data-operator="{{$waterNetwork->operator_id}}"
                                           data-network="{{$waterNetwork->water_network_type_id}}"
                                           class="dropdown-item js-edit">Edit</a>
                                        <a href="{{route('admin.water.network.delete',$waterNetwork->id)}}"
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
            <form action="{{route('admin.water.network.store')}}" method="post" id="submissionForm" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Water Network</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"  name="name" id="name" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">Distance Covered</label>
                            <input type="number"  name="distance_covered" id="distance_covered" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">Population Covered</label>
                            <input type="number"  name="population_covered" id="population_covered" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">Water Network Type</label>
                            <select name="water_network_type_id" id="water_network_type_id" class="form-control" required>
                                <option value="">Please Select Water Network Type</option>
                                @foreach(App\Models\WaterNetworkType::all() as $type)
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

                        <div class="form-group">
                            <label for="name">Operation Area</label>
                            <select type="text" name="operation_area_id" id="operation_area_id" class="form-control">
                                <option value="">Please Select Operation Area</option>
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
            <form action="{{route('admin.water.network.edit')}}" method="post" id="submissionFormEdit" class="submissionForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0"  id="WaterNetworkId" name="WaterNetworkId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Water Network</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text"  name="name" id="edit_name" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">Distance Covered</label>
                            <input type="number"  name="distance_covered" id="edit_distance_covered" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">Water Network Type</label>
                            <select name="water_network_type_id" id="edit_water_network_type_id" class="form-control" required>
                                <option value="">Please Select Water Network Type</option>
                                @foreach(App\Models\WaterNetworkType::all() as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Population Covered</label>
                            <input type="number"  name="population_covered" id="edit_population_covered" class="form-control" required/>
                        </div>

                        @if(auth()->user()->operator_id == null)
                            <div class="form-group">
                                <label>Operator</label>
                                <select name="operator_id" class="form-control select2" style="width: 100% !important;" id="edit_operator_id">
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
                                <label>Operator</label>
                                <select name="operator_id" class="form-control select2" style="width: 100% !important;" id="edit_operator_id">
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
                            <select type="text" name="operation_area_id" id="operation_area_id" class="form-control">
                                <option value="">Please Select Operation Area</option>
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
    {!! JsValidator::formRequest(\App\Http\Requests\StoreWaterNetworkRequest::class,'.submissionForm') !!}
    {!! JsValidator::formRequest(\App\Http\Requests\UpdateWaterNetworkRequest::class,'.submissionForm') !!}

    <script>

        $(document).ready(function() {
            $('#table').DataTable();
        } );

        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-water-networks').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('name'));
            var url = $(this).data('url');
            $("#ConfigurationId").val($(this).data('id'));
            $("#edit_name").val($(this).data('name'));
            $("#edit_distance_covered").val($(this).data('distance'));
            $("#edit_population_covered").val($(this).data('population'));
            $("#edit_operator_id").val($(this).data('operator'));
            $("#edit_water_network_type_id").val($(this).data('network'));
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
        $('.select2').select2({
            placeholder: 'Select an operator'
        });

        $('#exampleModal').on('hidden.bs.modal', function (e) {
            $('#TypeId').val(0);
        });

        $(document).ready(function (){
            $('select[name="operator_id"]').on('change',function (){
                var OperatorId = $(this).val();
                // alert(OperatorId);
                if (OperatorId){
                    $.ajax({

                        url:'/admin/settings/operation_areas/'+OperatorId,
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            // alert(data);
                            $('select[name="operation_area_id"]').empty();
                            $.each(data,function (key,value){
                                $('select[name="operation_area_id"]').append('<option value="'+value.id+'">'+value.name+'</option>');
                            })
                        }
                    })
                }
            });
        });

    </script>

@endsection
