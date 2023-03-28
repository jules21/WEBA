@extends('layouts.master')
@section('title', 'Billing History')
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Billing History</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">Billing History</a>
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
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-head-custom border table-head-solid table-hover">
                    <thead>
                        <tr>
                            <th>Subscription Number</th>
                            <th>Bank Ref Number</th>
                            <th>Payment Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Creation Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $invoice)
                        <tr>
                            <td>{{ $invoice->subscription_number }}</td>
                            <td>{{ $invoice->bank_reference_number }}</td>
                            <td>{{ $invoice->payment_date }}</td>
                            <td>{{ $invoice->amount }}</td>
                            <td>
                                <span class="badge badge-success">Paid</span>
                            <td>{{ $invoice->created_at }}</td>
                        </tr>
                        @endforeach
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
        $('.table').DataTable({
            "order": [[ 5, "desc" ]]
        });
    });
    </script>
@endsection
