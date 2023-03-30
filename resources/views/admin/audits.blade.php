@extends('layouts.master')
@section('title', 'Audits')
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Audits </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Audits</a>
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

@section("content")
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h3 class="card-label">System Audits</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.audits.index') }}">
                <div class="row mb-5">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="start_date" class="control-label">start date</label>
                            <input id="start_date" readonly type="text" value="{{request('start_date')}}" name="start_date" class="form-control start end-today-datepicker" required>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="end_date" class="control-label">End Date</label>
                            <input id="end_date" readonly type="text" class="form-control end end-today-datepicker" value="{{request('end_date')}}" name="end_date" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="event" class="control-label">Events</label>
                            <select class="form-control" name="event" id="event">
                                <option value="">--Select Event--</option>
                                <option {{request('event')=='created'?'selected':''}} value="created">Created</option>
                                <option {{request('event')=='deleted'?'selected':''}} value="deleted">Deleted</option>
                                <option {{request('event')=='updated'?'selected':''}} value="updated">Updated</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="event" class="control-label">Model Accessed</label>
                            <input name="model" class="form-control" value="{{request('model')}}">
                        </div>
                    </div>
                    <div>
                        <button type="submit"  class="btn btn-primary" style="color: white;margin-top: 25px"> view Audits</button>
                        <button type="button" onclick="window.location.href='{{route('admin.audits.index')}}'" class="btn btn-outline-dark" style="margin-top: 25px"> Clear</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-head-custom border table-head-solid table-hover" id="kt_datatable1">
                    <thead>
                    <tr>
                        <th >#</th>
                        <th >Done By</th>
                        <th>Event</th>
                        <th>Model Accessed</th>
                        <th>Old values</th>
                        <th>New values</th>
                        <th>Done At</th>
                    </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.3")}}"></script>
    <script>
        $('.nav-audits').addClass('menu-item-active');
        $('.end-today-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            endDate: 'today',
            todayHighlight: true,
            todayBtn: "linked",
            clearBtn: true,
        });

        $('.start-today-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: 'today',
            todayHighlight: true,
            todayBtn: "linked",
            clearBtn: true,
        });

        $('#kt_datatable1').DataTable({
            processing: true,
            serverSide: true,
            "deferRender": true,
            ajax: "{{ route('admin.audits.index') }}"+"?"+$('form').serialize(),
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'user_name', name: 'user.name'},
                {data: 'event', name: 'event'},
                {data: 'model', name: 'auditable_type'},
                {data: 'formatted_old_values', name: 'old_values'},
                {data: 'formatted_new_values', name: 'new_values'},
                {data: 'created_at', name: 'created_at'},
            ],
            'order':[[6,'desc']]
        });
    </script>
@endsection

