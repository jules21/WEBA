@extends('layouts.master')
@section('title', 'Operator Details')

@section('content')

    <div class="subheader py-2 py-lg-4 tw-border-b-gray-300 border-bottom tw-shadow-none " id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Operator Details
                </h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.operator.index') }}" class="text-muted">
                            Operators
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                           Operator Details
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>


    <div class="card tw-shadow-sm border mt-4 tw-border-gray-300">
        <div class="card-body">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="mb-0">Operator Details</h4>
                <span class="symbol symbol-50 symbol-circle  symbol-light-primary">
                    <img src="{{ $operator->logo_url }}" alt="">
				</span>
            </div>


            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <label for="name" class="font-weight-bolder">Name:</label>
                    <div class="form-control-plaintext">
                        {{ $operator->name }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label for="email" class="font-weight-bolder">Legal Type:</label>
                    <div class="form-control-plaintext">
                        {{ $operator->legalType->name }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label for="email" class="font-weight-bolder">ID Type:</label>
                    <div class="form-control-plaintext">
                        {{ $operator->id_type }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label for="email" class="font-weight-bolder">ID Number:</label>
                    <div class="form-control-plaintext">
                        {{ $operator->doc_number }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label for="email" class="font-weight-bolder">Address:</label>
                    <div class="form-control-plaintext">
                        {{ $operator->address }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <label for="email" class="font-weight-bolder">Province:</label>
                    <div class="form-control-plaintext">
                        {{ $operator->province->name }}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="font-weight-bolder">District:</label>
                    <div class="form-control-plaintext">
                        {{ $operator->district->name }}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="font-weight-bolder">Sector:</label>
                    <div class="form-control-plaintext">
                        {{ $operator->sector->name }}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="font-weight-bolder">Cell:</label>
                    <div class="form-control-plaintext">
                        {{ $operator->cell->name }}
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="font-weight-bolder">Village:</label>
                    <div class="form-control-plaintext">
                        {{ $operator->village->name??'N/A' }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h6 class="my-4">
                       <span class="svg-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2"
                                 width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5"></path>
                               <path d="M9 4v13"></path>
                               <path d="M15 7v5.5"></path>
                               <path
                                   d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z"></path>
                               <path d="M19 18v.01"></path>
                            </svg>
                       </span>
                        Operation Areas
                    </h6>

                    <div class="row">
                        @forelse($operator->operationAreas as $item)
                            <div class="col-lg-4">
                                <div class="my-2">
                                    <span class="svg-icon text-success font-weight-bolder">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-checkbox" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                           <path d="M9 11l3 3l8 -8"></path>
                                           <path
                                               d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
                                        </svg>
                                    </span>
                                    {{ $item->name }}
                                    -
                                    {{ $item->district->name }}
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-light-info alert-custom py-2 px-3">
                                    <div class="alert-icon text-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-exclamation-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                            <path d="M12 9v4"></path>
                                            <path d="M12 16v.01"></path>
                                        </svg>
                                    </div>
                                   <div class="alert-text">
                                       No Operation Areas Found for this Operator !
                                   </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>


            <div class="mt-5">
                <a href="{{ route('admin.operator.index') }}" class="btn btn-light-primary btn-sm ">
                    <i class="flaticon2-left-arrow"></i>
                    Back to Operators
                </a>
            </div>
        </div>
    </div>

@endsection
