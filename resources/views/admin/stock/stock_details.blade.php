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
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">Home</a>
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
    <div class="card">
        <div class="card-content card-custom">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-5">
                    <h3>{{$item->name}} Stock Card</h3>
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-download"></i>Export</button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="nav flex-column nav-hover">
                                <li class="nav-item export-doc">
                                    <a href="#" class="nav-link" target="_blank" id="excel">
                                        <i class="nav-icon la la-file-excel-o"></i>
                                        <span class="nav-text">Excel</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                </div>
                <table class="table table-head-custom table-head-solid table-hover" id="kt_datatable1">
                    <thead>
                    <tr>
                        <th>Done At</th>
                        {{--                            <th>Operation Area</th>--}}
                        <th>Product</th>
                        <th>Product Category</th>
                        <th>Opening Qty</th>
                        <th>Qty In</th>
                        <th>Qty Out</th>
                        <th>Closing Qty</th>
                        <th>Unit Price</th>
                        <th>Initiated By</th>
{{--                        <th>Description</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($movements as $stock)
                        <tr>
                            <th>{{$stock->created_at}}</th>
                            {{--                                <td>{{ $stock->operationArea->name ?? '' }}</td>--}}
                            <td>{{ $stock->item->name ?? '' }}</td>
                            <td>{{ $stock->item->category->name ?? '' }}</td>
                            <td>
                                <span class=" text-black">{{ $stock->opening_qty ? " $stock->opening_qty" : '0' }}</span>
                            </td>
                            <td>
                                <span class=" text-success font-weight-bold">{{ $stock->qty_in ? " +$stock->qty_in" : '0' }}</span>
                            </td>
                            <td>
                                <a href="{{route('admin.stock.stock-items.movements.history', encryptId($stock->id))}}">
                                    <span class=" text-danger font-weight-bold">{{ $stock->qty_out ? " -$stock->qty_out" : '0' }}</span>
                                </a>
                            </td>
                            <td>
                                <span class=" text-info font-weight-bold">
                                @if($stock->qty_in > 0)
                                    {{ $stock->opening_qty + $stock->qty_in - $stock->qty_out }}
                                    @else
                                    {{ $stock->opening_qty - $stock->qty_out }}
                                @endif
                                </span>
                            </td>
                            <td>{{ $stock->unit_price ?? '0' }} RWF</td>
{{--                            <td>--}}

{{--                                @if(strlen($stock->description) > 50)--}}
{{--                                    <a href="#" data-toggle="tooltip" data-trigger="focus" data-html="true" title="{{ $stock->description }}">--}}
{{--                                        {{ Str::limit($stock->description, 50) }}--}}
{{--                                    </a>--}}
{{--                                @else--}}
{{--                                    {{ Str::limit($stock->description, 50) }}--}}
{{--                                @endif--}}
{{--                            </td>--}}
                            <td>
                                {{Helper::stockCardInitiator($stock->id)}}
                            </td>

                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @php
        //Declare new queries you want to append to string:
        $newQueries = ['is_download' => 1];
        $newUrl = request()->fullUrlWithQuery($newQueries);
    @endphp
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $("#kt_datatable1").DataTable({
                responsive:true,
                "order": [[ 0, "desc" ]],
            });
            $(document).on("click","#excel", function(e) {
                let url = "{!! $newUrl !!}";
                $(this).attr("href",url);
            });
        });
    </script>
@endsection
