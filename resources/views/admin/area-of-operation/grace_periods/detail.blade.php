@extends('layouts.master')

@section('title',"Grace Periods Details")

@section('content')

    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none " id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Grace Period Details</h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Grace Periods</span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

        </div>
    </div>



    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom" style="height: 440px">
                <div class="card-body">

                    <strong class="text-uppercase mb-2 d-inline-block">
                         details
                    </strong>
                    <div>
                        <br>
                        <br>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cooperative">Expiry Time (Days)</label>

                                <div><span class="font-weight-bolder" id="cooperative">{{$expiryDays}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cooperative">Comment</label>

                                <div><span class="font-weight-bolder" id="cooperative">{{$gracePeriod->comment}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="judgment_copy" class=" mt-2">Attachment</label><br>
                                <a href="{{route('admin.operator.grace.period.download.attachment',['id' => $gracePeriod->id])}}" target="_blank" class="badge badge-primary">
                                    <i class="fa fa-download text-white"></i>
                                    Download</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection

