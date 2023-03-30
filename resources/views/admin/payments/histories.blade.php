@extends('layouts.master')
@section('title', 'Payment History')
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Payment Histories </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.payments.index') }}" class="text-muted">Payments</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-success">Payment Histories</a>
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
    <div class="card">
        <div class="card-content card-custom">
            <div class="card-header pb-1 pt-3">
                <h3>
                    Payment Histories</h3>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>PSP Reference Number</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                <th>Creation Date</th>
                                <th>Narration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($histories as $history)
                                <tr>
                                    <td>{{$history->paymentDeclaration->request->customer->name}}</td>
{{--                                    <td>{{optional(optional($history->paymentDeclaration->paymentConfig)->paymentType)->name}}</td>--}}
                                    <td>{{$history->psp_reference_number}}</td>
                                    <td>{{$history->amount}}</td>
                                    <td>{{$history->payment_date}}</td>
                                    <td>{{$history->created_at->format('Y-m-d h:m:s')}}</td>
                                    <td>{{$history->narration}}</td>
                                </tr>
                                @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.nav-payments').addClass('menu-item-active');
            $('.table').DataTable({
                "language": {
                    "emptyTable": "No Payment History Found"
                }
            });
        });
    </script>
@endsection
