@extends("layouts.master")
@section("title","Dashboard")
@section('page-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@stop
@section("content")
    <!--begin::Entry-->
    <!--begin::Container-->
    <div>
        <!--begin::Dashboard-->
        <!--begin::Row-->
        <div class="row">

            <div class="col-md-3 col-6">
                <!--begin::Tiles Widget 11-->
                <div class="card card-custom bg-primary gutter-b">
                    <div class="card-body" style="height: 160px">
                            <span class="svg-icon svg-icon-3x text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </span>
                        <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">
                            <span>{{\App\Models\Customer::query()->count()}}</span>
                        </div>
                        <a href="https://licensing.rura.rw/admin/assigned/applications"
                           class="text-inverse-success font-weight-bold font-size-sm mt-1 mb-2">
                            Total Customers
                        </a>
                    </div>
                </div>
                <!--end::Tiles Widget 11-->
            </div>

            <div class="col-md-3 col-6">
                <!--begin::Tiles Widget 11-->
                <div class="card card-custom bg-info gutter-b">
                    <div class="card-body" style="height: 160px">
                            <span class="svg-icon svg-icon-3x text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </span>
                        <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">
                            <span>{{\App\Models\Request::query()->count()}}</span>
                        </div>
                        <a href="https://licensing.rura.rw/admin/assigned/applications"
                           class="text-inverse-success font-weight-bold font-size-sm mt-1 mb-2">
                            Total Requests
                        </a>
                    </div>
                </div>
                <!--end::Tiles Widget 11-->
            </div>
            <div class="col-md-3 col-6">
                <!--begin::Tiles Widget 11-->
                <div class="card card-custom bg-dark gutter-b">
                    <div class="card-body" style="height: 160px">
                            <span class="svg-icon svg-icon-3x text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            </span>
                        <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">
                            <span>{{\App\Models\MeterRequest::query()->get()->count()}}</span>
                        </div>
                        <a href="https://licensing.rura.rw/admin/assigned/applications"
                           class="text-inverse-success font-weight-bold font-size-sm mt-1 mb-2">
                            Meter Assigned
                        </a>
                    </div>
                </div>
                <!--end::Tiles Widget 11-->
            </div>
            <div class="col-md-3 col-6">
                <!--begin::Tiles Widget 11-->
                <div class="card card-custom bg-primary gutter-b">
                    <div class="card-body" style="height: 160px">
                            <span class="svg-icon svg-icon-3x text-white">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
</svg>
                            </span>
                        <div class="text-inverse-success font-weight-bolder font-size-h2 mt-3">
                            <span>17</span>
                        </div>
                        <a href="https://licensing.rura.rw/admin/assigned/applications"
                           class="text-inverse-success font-weight-bold font-size-sm mt-1 mb-2">
                            Rejected Requests
                        </a>
                    </div>
                </div>
                <!--end::Tiles Widget 11-->
            </div>


        </div>
        <!--end::Row-->

        <div class="row mt-5 mb-5">
            <div class="col-md-12">
                <div class="card card-body rounded shadow-sm border-0 h-100">
                    <h4 class="font-size-lg">Billing {{now()->year}}</h4>
                    <div id="chart"></div>
                </div>
            </div>
            <!--end::Dashboard-->
        </div>

        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card card-body rounded shadow-sm border-0 h-100">
                    <h4 class="font-size-lg">Graph of Water consumption (㎥) {{now()->year}}  </h4>
                    <div id="sales-per-month"></div>
                </div>
            </div>
        </div>
        <!--end::Dashboard-->
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection
@section("scripts")
    <script>
        $('.nav-dashboard').addClass('menu-item-active');

        var _demo12 = function () {
            let data =@json($consumptionPerMonth);
            const apexChart = "#sales-per-month";
            var options12 = {
                series: [
                    {
                        name: "Consumption",
                        data: Object.values(data)
                    }
                ],
                chart: {
                    type: 'bar',
                    height: 300
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: Object.keys(data),
                },
                yaxis: {
                    title: {
                        text: "\u33A5"
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val.toLocaleString() + "\u33A5"
                        }
                    }
                }
            };

            var chart12 = new ApexCharts(document.querySelector(apexChart), options12);
            chart12.render();
        }
        var _demo14 = function () {
            let data =[];
            let billings =@json($billingsPerMonth);
            var options = {
                series: [
                    {
                        name: "Billings",
                        data: Object.values(billings)
                    }],
                chart: {
                    height: 300,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: '',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: Object.keys(data),
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val.toLocaleString() + "\u33A5"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
        $(function () {
            _demo12();
            _demo14();
        });

    </script>
@stop
