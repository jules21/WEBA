@extends('layouts.master')
@section("title","Bill Charges")
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
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Bill Charges</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Bill Charges</a>
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
            <div class="card-toolbar">
                <!--begin::Dropdown-->

                <!--end::Dropdown-->
            </div>
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
                            <a href="{{route('admin.bill.charges')}}" class="btn btn-outline-dark"> Clear search</a>
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
                <h3 class="card-label">Bill Charges List</h3>
            </div>

            @if(auth()->user()->is_super_admin)
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-download"></i>Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="nav flex-column nav-hover">
                            <li class="nav-item export-doc">
                                <a href="{{route('admin.export.bill.charges',['start_date'=>request('start_date'),'end_date'=>request('end_date'),'operation_area_id'=>request('operation_area_id')])}}" class="nav-link" target="_blank">
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
                        Add New Record
                    </button>
                    <!-- Modal-->
                </div>
            @endif
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-head-custom border table-head-solid table-hover" id="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Water Network Type</th>
                        @if(auth()->user()->is_super_admin)
                            <th>Operator</th>
                            <th>Operation Area</th>
                        @endif
                        <th>Unit Price</th>
                        @if(auth()->user()->operator_id)
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($bills as $key=>$bill)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$bill->waterNetworkType->name ?? ''}}</td>
                            @if(auth()->user()->is_super_admin)
                                <td>{{$bill->operator->name ?? ''}}</td>
                                <td>{{$bill->operationArea->name ?? ''}}</td>
                            @endif

                            <td>{{$bill->unit_price}}</td>
                            @if(auth()->user()->operator_id)
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-light-primary btn-sm dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                                            <a href="#" data-id="{{$bill->id}}"
                                               data-network="{{$bill->water_network_type_id}}"
                                               data-area="{{$bill->operation_area_id}}"
                                               data-price="{{$bill->unit_price}}"
                                               class="dropdown-item js-edit">Edit</a>
                                            <a href="{{route('admin.bill.charge.delete',$bill->id)}}"
                                               class="dropdown-item js-delete">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            @endif
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
            <form action="{{route('admin.bill.charge.store')}}" method="post" id="submissionForm" class="submissionForm"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Bill Charge</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Water Network Type</label>
                            <select name="water_network_type_id" id="water_network_type_id" class="form-control"
                                    required>
                                <option value="">Please Select Water Network Type</option>
                                @foreach(App\Models\WaterNetworkType::query()->get() as $type)
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
                                <select type="text" name="operation_area_id" id="operation_area_id"
                                        class="form-control">
                                    <option value="">Please Select Operation Area</option>
                                </select>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="name">Operation Area</label>
                                <select type="text" name="operation_area_id" id="operation_area_id"
                                        class="form-control">
                                    <option value="">Please Select Operation Area</option>
                                    @foreach($Areas as $area)
                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="unit_price">Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
            <form action="{{route('admin.bill.charge.edit')}}" method="post" id="submissionFormEdit"
                  class="submissionForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="0" id="BillId" name="BillId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Bill Charge</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <input type="hidden" name="water_network_type_id" id="_water_network_type_id">
                            <label for="name">Water Network Type</label>
                            <select name="water_network_type" id="edit_water_network_type_id" class="form-control" disabled
                                    required>
                                <option value="">Please Select Water Network Type</option>
                                @foreach(App\Models\WaterNetworkType::all() as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
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
                                <label for="name">Operation Area</label>
                                <select type="text" name="operation_area_id" id="edit_operation_area_id"
                                        class="form-control">
                                    <option value="">Please Select Operation Area</option>
                                </select>
                            </div>
                        @else
                            <div class="form-group">
                                <input type="hidden" name="operation_area_id" id="_operation_area_id">
                                <label for="name">Operation Area</label>
                                <select type="text" id="edit_operation_area_id" disabled
                                        class="form-control">
                                    <option value="">Please Select Operation Area</option>
                                    @foreach($Areas as $area)
                                        <option value="{{$area->id}}">{{$area->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="unit_price">Unit Price</label>
                            <input type="number" name="unit_price" id="_unit_price" class="form-control">
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

    @php
        //Declare new queries you want to append to string:
        $newQueries = ['is_download' => 1];
        $newUrl = request()->fullUrlWithQuery($newQueries);
    @endphp

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest(\App\Http\Requests\StoreBillChargeRequest::class,'.submissionForm') !!}
    {!! JsValidator::formRequest(\App\Http\Requests\UpdateBillChargeRequest::class,'.submissionFormEdit') !!}

    <script>

        $(document).on("click","#excel", function(e) {
            var url = "{!! $newUrl !!}";
            $(this).attr("href",url);
        });

        let loadOperationAreas = function (networkTypeId, selectedId) {

            let $operationArea = $('#operation_area_id');
            $operationArea.empty();
            $operationArea.append('<option value="">Select Operation Area</option>');

            $.ajax({
                url: '{{ route('admin.bill-charge.load-area-operation-areas') }}?water_network_type_id=' + networkTypeId,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.length === 0) {
                        Swal.fire({
                            title: "Info",
                            icon: "info",
                            text: "All operation areas have been used"
                        });
                    }

                    $.each(response, function (index, value) {
                        $operationArea.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $operationArea.val(selectedId);
                },
                error: function () {
                    Swal.fire({
                        title: "Error",
                        icon: "error",
                        text: "Unable to load operation areas"
                    });
                }
            })

        }

        $(document).ready(function () {
            $('#table').DataTable();

            /*      $('#water_network_type_id').on('change', function () {
                      if (!$(this).val())
                          return;
                      loadOperationAreas($(this).val(), 0);
                  });*/
        });

        $(document).on("click", "#reset", function(e) {
            e.preventDefault();
            $("#water_network_type_id").html(`<option value="">Please Select Water Network Type</option>`);
            $("#select_res").html(`<option value="">Choose...</option>`);
            $('#record_table').DataTable().destroy();
            fetch();
            fetch_std();
            fetch_res();
        });

        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-bill-charges').addClass('menu-item-active');

        $(document).on('click', '.js-edit', function (e) {
            e.preventDefault();
            $("#modalUpdate").modal('show');
            console.log($(this).data('name'));
            var url = $(this).data('url');
            $("#BillId").val($(this).data('id'));
            $("#edit_water_network_type_id").val($(this).data('network'));
            $("#_water_network_type_id").val($(this).data('network'));
            $("#edit_operation_area_id").val($(this).data('area'));
            $("#_operation_area_id").val($(this).data('area'));
            $("#_unit_price").val($(this).data('price'));
            $('#submissionFormEdit').attr('action', url);
        });

        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();
            var href = this.href;
            Swal.fire({
                title: "Are you sure?",
                text: "Delete this Bill ?",
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
            $('#BillId').val(0);
        });

        $(document).ready(function () {
            $('select[id="operator_id"]').on('change', function () {
                var OperatorId = $(this).val();
                // alert(OperatorId);
                if (OperatorId) {
                    $.ajax({

                        url: '/admin/settings/operation_areas/' + OperatorId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            // alert(data);
                            $('select[id="operation_area_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[id="operation_area_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            })
                        }
                    })
                }
            });
        });

    </script>

@endsection
