@extends('layouts.master')
@section('title')
     Profile
@stop
@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Profile</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">User Profile</a>
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
        <!--begin::Notice-->
{{--             @include('partials._alerts')--}}
        <!--end::Notice-->
        <!--begin::Profile Personal Information-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                <!--begin::Profile Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Body-->
                    <div class="card-body pt-4">
                        <!--begin::User-->
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                <div class="symbol-label" style="background-image:url({{ asset('images/users/default.jpg') }})"></div>
                                <i class="symbol-badge bg-success"></i>
                            </div>
                            <div>
                                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">{{Auth::user()->name}}</a>
{{--                                <div class="text-muted">{{optional(Auth::user()->jobTitle)->name}}</div>--}}
                            </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->
                        <div class="py-9">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Email:</span>
                                <a href="#" class="text-muted text-hover-primary">{{Auth::user()->email}}</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">Phone:</span>
                                <span class="text-muted">{{Auth::user()->phone}}</span>
                            </div>
                            @can('view-partner-action')
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">Organization:</span>
                                    <span class="text-muted">{{optional(Auth::user()->operator)->name ?? ''}}</span>
                                </div>
                            @endcan
                        </div>
                        <!--end::Contact-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Profile Card-->
            </div>
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Header-->
                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Profile</h3>
                            <span class="text-muted font-weight-bold font-size-sm mt-1">Roles and Permissions</span>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Roles and Permission-->
                    <div class="card-body pt-0">
                        @foreach($user->roles as $role)
                            <!--begin::Item-->
                            <div class="mb-6">
                                <!--begin::Content-->
                                <div class="d-flex align-items-center flex-grow-1">
                                    <!--begin::Checkbox-->
                                    <label class="checkbox checkbox-lg checkbox-lg checkbox-single flex-shrink-0 mr-4">
                                        <input type="checkbox" checked disabled="" value="1">
                                        <span></span>
                                    </label>
                                    <!--end::Checkbox-->
                                    <!--begin::Section-->
                                    <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column align-items-cente py-2 w-75">
                                            <!--begin::Title-->
                                            <a href="#" onclick="event.preventDefault()" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">{{$role->name}}</a>
                                            <!--end::Title-->
                                            <!--begin::Data-->
                                            @foreach($role->permissions as $permission)
                                                <span class="text-muted font-weight-bold">{{$permission->name}}</span>
                                            @endforeach
                                            <!--end::Data-->
                                        </div>

                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Item-->
                        @endforeach
                    </div>
                </div>
            </div>
            <!--end::Content-->
        </div>
    </div>
    </div>
        <!--end::Profile Personal Information-->
@endsection

