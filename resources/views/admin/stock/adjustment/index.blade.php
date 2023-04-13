@extends('layouts.master')
@section('title','Item Adjustments')
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Stock </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Item Adjustments</a>
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
    <!--end::Subheader-->
@endsection
@section('content')
    <div class="">
        <div class="card card-custom">
            <div class="card-header flex-wrap">
                <h3 class="card-title">
                    @if(Str::contains(Route::currentRouteName(), 'admin.stock.adjustments.create'))
                        Stock Adjustments
                    @elseif(Str::contains(Route::currentRouteName(), 'admin.stock.stock-adjustments.tasks'))
                         Stock Adjustments
                    @else
                        All Stock Adjustments

                    @endif
                </h3>
                @can('Create Adjustment')
                   @if(Str::contains(Route::currentRouteName(), 'admin.stock.adjustments.create'))
                        <div class="card-toolbar">
                            <a href="{{route('admin.stock.stock-adjustments.new')}}" class="btn btn-light-primary">
                                <i class="la la-plus"></i>
                                New Adjustment
                            </a>
                        </div>
                   @endif
                @endcan

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border table-head-solid table-head-custom" id="kt_datatable1">
                        <thead>
                        <tr>
                            <th>Initiated By</th>
                            <th>Description</th>
                            <th>Items</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($adjustments as $adjustment)
                            <tr>
                                <td>{{optional($adjustment->createdBy)->name ?? ''}}</td>
                                <td>{{$adjustment->description}}</td>
                                <td>
                                    <span class="badge  font-weight-bold badge-primary rounded-pill">
                                        {{count($adjustment->items)}}
                                    </span>
                                </td>
                                <td>
                                    @if($adjustment->status == \App\Constants\Status::PENDING)
                                        <span class="badge badge-primary font-weight-bold badge-pill">
                                            Pending
                                        </span>
                                    @elseif($adjustment->status == \App\Constants\Status::SUBMITTED)
                                        <span class="badge badge-info font-weight-bold badge-pill">
                                            Submitted
                                        </span>
                                    @elseif($adjustment->status == \App\Constants\Status::RETURN_BACK)
                                        <span class="badge badge-warning font-weight-bold badge-pill">
                                            Return Back
                                        </span>
                                    @elseif($adjustment->status == \App\Constants\Status::APPROVED)
                                        <span class="badge badge-success font-weight-bold badge-pill">
                                            Approved
                                        </span>
                                    @elseif($adjustment->status == \App\Constants\Status::REJECTED)
                                        <span class="badge badge-danger font-weight-bold badge-pill">
                                            Rejected
                                        </span>
                                    @endif
                                </td>

                                <td>{{$adjustment->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light-primary btn-sm  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                        <div class="dropdown-menu" style="">
                                            @if(in_array($adjustment->status, [\App\Constants\Status::RETURN_BACK, \App\Constants\Status::PENDING]))
                                                <a href="{{route('admin.stock.stock-adjustments.new',['adjustment_id' => encryptId($adjustment->id)])}}"
                                                   class="dropdown-item">
                                                    Details
                                                </a>
                                            @else
                                                <a href="{{route('admin.stock.adjustments.show', encryptId($adjustment->id))}}"
                                                   class="dropdown-item">
                                                    Details
                                                </a>
                                            @endif
                                            @can(\App\Constants\Permission::CreateAdjustment)
                                                @if($adjustment->status == \App\Models\Adjustment::PENDING)
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class=" edit-btn dropdown-item "
                                                       data-toggle="modal"
                                                       data-target="#user_adjustment_edit_modal"
                                                       data-description="{{$adjustment->description}}"
                                                       data-id="{{encryptId($adjustment->id)}}"
                                                       data-url="{{ route('admin.stock.adjustments.update', encryptId($adjustment->id)) }}">
                                                        Edit
                                                    </a>
                                                    <a class="delete_btn dropdown-item"
                                                       data-url="{{route('admin.stock.adjustments.destroy', encryptId($adjustment->id)) }}">
                                                        Delete
                                                    </a>
                                                @endif

                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{--    delete form--}}
        <form id="delete-form" method="POST" style="display: none;">
            @method('DELETE')
            @csrf
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\StoreAdjustmentRequest::class,'#add-adjustment-form') !!}
    {!! JsValidator::formRequest(App\Http\Requests\UpdateAdjustmentRequest::class,'#edit-adjustment-form') !!}
    <script>
        $(document).ready(function () {
            $('.nav-stock-managements').addClass('menu-item-open menu-item-here');
            $('.nav-stock-adjustments').addClass('menu-item-open menu-item-here');
            const currentRoute = @JSON(Route::currentRouteName());
            currentRoute == 'admin.stock.adjustments.index'
                ? $('.nav-adjustments-all').addClass('menu-item-active')
                : currentRoute == 'admin.stock.adjustments.create'
                    ? $('.nav-adjustments-create').addClass('menu-item-active')
                    : $('.nav-adjustments-my-tasks').addClass('menu-item-active')

            $("#kt_datatable1").DataTable({
                responsive:true,
                "order": [[ 4, "desc" ]]
            });


        });
        $('.edit-btn').click(function (e) {
            e.preventDefault();
            $('#_description').val($(this).data('description'));

            $('#edit-adjustment-form').attr('action', $(this).data('url'));
        });

        $('.delete_btn').click(function (e){
            e.preventDefault();
            var url = $(this).data('url');
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if (result.value) {
                    $('#delete-form').attr('action', url);
                    $('#delete-form').submit();
                }
            });
        });
    </script>


@endsection
