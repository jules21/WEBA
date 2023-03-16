@extends('layouts.master')
@section('title', 'Stock')
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Stock </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="/" class="text-muted">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.stock.stock-items.index')}}" class="text-muted">Stock</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-success">Stock Movement</a>
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
    <div class="container">
        <div class="card">
            <div class="card-content card-custom">
                <div class="card-header pb-1 pt-3">
                    <h3>{{$stock->item->name}} Movements</h3>
                </div>
                <div class="card-body">
                    <table class="table table-head-solid border" id="kt_datatable1">
                        <thead>
                        <tr>

                            <th>Operation Area</th>
                            <th>Product</th>
                            <th>Product Category</th>
                            <th>Qty In</th>
                            <th>Qty Out</th>
                            <th>Unit Price</th>
                            <th>Description</th>
                            <th>Done At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($movements as $stock)
                            <tr>
                                <td>{{ $stock->operationArea->name ?? '' }}</td>
                                <td>{{ $stock->item->name ?? '' }}</td>
                                <td>{{ $stock->item->category->name ?? '' }}</td>
                                <td>
                                    <span class=" text-success">{{ $stock->qty_in ? " +$stock->qty_in" : '0' }}</span>
                                </td>
                                <td>
                                    <span class=" text-danger">{{ $stock->qty_out ? " -$stock->qty_out" : '0' }}</span>
                                </td>
                                <td>{{ $stock->unit_price ?? '0' }}</td>
                                <td>

                                        @if(strlen($stock->description) > 50)
                                            <a href="#" data-toggle="tooltip" data-trigger="focus" data-html="true" title="{{ $stock->description }}">
                                                {{ Str::limit($stock->description, 50) }}
                                            </a>
                                        @else
                                            {{ Str::limit($stock->description, 50) }}
                                        @endif
                                </td>
                                <th>{{$stock->created_at}}</th>
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
        $(document).ready(function () {
            // initData();
            $("#kt_datatable1").DataTable({
                responsive:true,
                "order": [[ 7, "desc" ]],
            });
        });
    </script>
@endsection