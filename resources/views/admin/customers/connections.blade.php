@extends('layouts.master')

@section('title',"Customers Connections")

@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Customers</h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">Customer Connections</span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>

    <div class="container">
        <div class="card card-body mb-3">
            <h3 class="mb-6">{{$customer->name}} connections</h3>
            <div class="table-responsive">
                <table class="table table-head-custom table-head-solid table-hover">
                    <thead>
                    <tr>
                        <th>Subscription Number</th>
                        <th>Meter Number</th>
                        <th>Address </th>
                        <th></th>

                    </tr>
                    </thead>
                    <tbody>
                    @forelse($customer->connections as $item)
                        <tr>
                            <td>{{ $item->subscription_number }}</td>
                            <td>{{ $item->meter_number }}</td>
{{--                            <td>{{ optional(optional($item->request)->province)->name ?? '-' }}</td>--}}
{{--                            <td>{{ optional(optional($item->request)->district)->name ?? '-' }}</td>--}}
{{--                            <td>{{ optional(optional($item->request)->sector)->name ?? '-' }}</td>--}}
{{--                            <td>{{ optional(optional($item->request)->cell)->name ?? '-' }}</td>--}}

                            <td>
                                <span class="label label-lg font-weight-bold label-light-primary label-inline">{{ optional(optional($item->request)->province)->name ?? '-'  }}
                                - {{ optional(optional($item->request)->district)->name ?? '-' }}
                                - {{ optional(optional($item->request)->sector)->name ?? '-' }}
                                - {{ optional(optional($item->request)->cell)->name ?? '-' }}</span>

                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        Options
                                    </button>
                                    <div class="dropdown-menu border">
                                        <a class="dropdown-item" href="{{ route('admin.billings.meter',[$item->subscription_number, $item->meter_number]) }}">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                            <span class="ml-2">Bills</span>
                                        </a>
                                    </div>
                                </div>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No meter numbers yet</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>
@endsection
