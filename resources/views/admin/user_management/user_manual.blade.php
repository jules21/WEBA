@extends('layouts.master')
@section('title')
     User Manual
@stop
@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Help</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">User Manual</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->

            <!--end::Toolbar-->
        </div>
    </div>
@stop
@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">

        <!--begin::Profile Personal Information-->
        <div class="d-flex flex-row">
            <!--begin::Content-->
            <div class="flex-row-fluid d-flex flex-column">
                <div class="d-flex flex-column flex-grow-1">
                    <!--begin::Head-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-center justify-content-between flex-wrap py-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center mr-2 py-2">
                                <!--begin::Title-->
                                <h3 class="font-weight-bold mb-0 mr-10">User Manuals</h3>
                                <!--end::Title-->

                            </div>
                            <!--end::Info-->

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Head-->
                    <!--begin::Row-->
                    <div class="row">
                        @forelse($manuals as $manual)
                            <!--begin::Col-->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b card-stretch">
                                    <div class="card-header border-0">
                                        <h3 class="card-title"></h3>
                                        <div class="card-toolbar">
                                            <div class="dropdown dropdown-inline">
                                                <a href="{{route('admin.user.manuals.download',$manual->slug)}}" class="btn btn-light-primary btn-hover-primary btn-sm btn-icon">
                                                    <i class="la la-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center">
                                            <!--begin: Icon-->
                                            <img alt="" class="max-h-65px" src="{{asset("assets/media/svg/files/pdf.svg")}}">
                                            <!--end: Icon-->
                                            <!--begin: Title-->
                                            <a href="#" class="text-dark-75 font-weight-bold mt-15 font-size-lg">
                                                {{trans($manual->title,[],app()->getLocale())}}.pdf
                                            </a>
                                            <!--end: Title-->
                                        </div>
                                    </div>
                                </div>
                                <!--end:: Card-->
                            </div>
                            <!--end::Col-->
                        @empty
                            <div class="col-md-12">
                                <div class="alert alert-custom alert-notice alert-light-success fade show mb-5" role="alert">
                                    <div class="alert-icon">
                                        <i class="flaticon-warning"></i>
                                    </div>
                                    <div class="alert-text">No User Manual Found</div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <!--end::Row-->

                </div>
            </div>
            <!--end::Content-->
        </div>
    </div>
    </div>
        <!--end::Profile Personal Information-->
@endsection

