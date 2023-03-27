@extends('layouts.master')

@section('title',"Chart Of Accounts")


@section('content')

    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Chart Of Accounts
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
                        <span class="text-muted">
                            Chart Of Accounts
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->
        </div>
    </div>

    <div class="card card-body">
        <h4 class="mb-4">
            Chart Of Accounts
        </h4>
        <div class="accordion" id="accordionParent">
            @foreach($chartAccounts as $key=> $item)
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <div class="btn btn-block pt-0 text-left collapsed"
                                 data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="false"
                                 aria-controls="collapseTwo">
                                <table class="table mb-0 table-head-solid border-0">
                                    <thead>
                                    @if($key==0)
                                        <tr>
                                            <th class="text-uppercase font-weight-bolder w-100px">Ledger No</th>
                                            <th class="text-uppercase font-weight-bolder ">Ledger Description</th>
                                            <th class="text-uppercase font-weight-bolder w-150px">Ledger Type</th>
                                            <th class="text-uppercase font-weight-bolder w-100px">Level</th>
                                        </tr>
                                    @endif
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="w-100px"> {{ $item->ledger_no }}</td>
                                        <td> {{ $item->ledger_description }}</td>
                                        <td class="w-150px"> {{ $item->ledger_type }}</td>
                                        <td class="w-100px"> {{ $item->level }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </h2>
                    </div>
                    <div id="collapse{{$item->id}}" class="collapse" aria-labelledby="headingTwo"
                         data-parent="#accordionParent">
                        <div class="card-body p-1">
                            @foreach($item->children as $child)
                                <div class="accordion bg-transparent my-1" id="accordionExample{{$child->id}}">
                                    <div class="card rounded-0">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <div class="btn pt-0 btn-block text-left"
                                                     data-toggle="collapse" data-target="#collapseOne{{$child->id}}"
                                                     aria-expanded="true" aria-controls="collapseOne">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                        <tr>
                                                            <td class="w-100px"> {{ $child->ledger_no }}</td>
                                                            <td> {{ $child->ledger_description }}</td>
                                                            <td class="w-150px"> {{ $child->ledger_type }}</td>
                                                            <td class="w-100px"> {{ $child->level }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </h2>
                                        </div>
                                        <div id="collapseOne{{$child->id}}" class="collapse"
                                             aria-labelledby="headingOne" data-parent="#accordionExample{{$child->id}}">
                                            <div class="card-body p-1">
                                                <table class="table border mb-0">
                                                    <tbody>
                                                    @forelse($child->children as $child2)
                                                        <tr>
                                                            <td class="w-100px"> {{ $child2->ledger_no }}</td>
                                                            <td> {{ $child2->ledger_description }}</td>
                                                            <td class="w-150px"> {{ $child2->ledger_type }}</td>
                                                            <td class="w-100px"> {{ $child2->level }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center">No Data Found</td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.nav-accounting-settings').addClass('menu-item-active menu-item-open');
        $('.nav-chart-accounts').addClass('menu-item-active menu-item-open');
    </script>
@endsection
