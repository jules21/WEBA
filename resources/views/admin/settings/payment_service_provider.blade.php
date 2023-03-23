@extends('layouts.master')
@section("title","Banks")
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
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Banks</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">banks</a>
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
                <h3 class="card-label">List of Banks</h3>
            </div>
            <div class="card-toolbar">
                <!-- Button trigger modal-->
                <a href="{{route('admin.banks.sync')}}" class="btn btn-primary">
                    <span class="flaticon-add"></span>
                    Sync Banks
                </a>

                <!-- Modal-->
            </div>
        </div>
        <div class="card-body">


            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-head-custom border table-head-solid table-hover" id="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Ip</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($banks as $key=>$bank)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$bank->name}}</td>
                            <td>{{$bank->ip}}</td>
                            <td>{{optional($bank->created_at)->format('Y-m-d')}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <!--end: Datatable-->
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        $(document).ready(function () {
            $('#table').DataTable();
        });

        $('.nav-settings').addClass('menu-item-active  menu-item-open');
        $('.nav-banks').addClass('menu-item-active');


    </script>

@endsection
