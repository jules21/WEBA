@extends('layouts.master')
@section("title","Permissions Assignment")

@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Add Permissions to roles</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route("admin.roles.index")}}" class="text-muted">Roles</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a class="text-muted">Add Permissions to roles</a>
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

@section("content")

    <!--end::Notice-->
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h3 class="kt-portlet__head-title">
                    Manage Permissions of <b>{{$role->name}}
                </h3>
            </div>
            <div class="card-toolbar">

            </div>
            <!--end::Dropdown-->


        </div>
        <div class="card-body">
            <!--begin: Datatable -->
            @if($permissions->count() > 0)
                <form class="form" action="{{route('admin.permissions_to_role.store')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="role_id" value="{{$role->id}}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @php
                                        $i=0
                                    @endphp
                                    @foreach($permissions as $key=>$groups)
                                        <li class="nav-item">
                                            <a class="nav-link {{$i == 0 ? 'active':''}}" id="home-tab{{$i}}" data-toggle="tab" href="#home{{$i++}}">
																	<span class="nav-icon">
																		<i class="flaticon2-gear"></i>
																	</span>
                                                <span class="nav-text">{{$key}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <div class="tab-content mt-5" id="myTabContent">
                                    @php
                                        $j=0
                                    @endphp
                                    @foreach($permissions as $key=>$groups)
                                        <div class="tab-pane {{$j == 0 ? 'fade active show':''}}" id="home{{$j++}}" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row p-5">
                                                @foreach($groups as $permission)
                                                        <div class="col-md-3" style="padding: 2px">
                                                            <label class="checkbox checkbox-outline checkbox-primary">
                                                                <input type="checkbox"
                                                                       @if($role->permissions->contains($permission)) checked
                                                                       @endif value="{{$permission->id}}"
                                                                       name="permissions[]">
                                                                <span class="mr-2"></span>
                                                                {{$permission->name}}
                                                            </label>
                                                        </div>


                                                @endforeach
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            </div>


                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><span class="la la-check-circle-o"></span>
                        Update Permissions
                    </button>

                </form>

            @else
                <div
                    class="alert alert-custom alert-notice  my-3 alert-outline-info bg-white fade show rounded-0 w-100"
                    role="alert">
                    <div class="alert-icon">
                        <i class="flaticon-information"></i>
                    </div>
                    <div class="alert-text">
                        <span>No Permission Added Yet!</span>
                    </div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                </div>
            @endif
        </div>


    </div>




@stop

