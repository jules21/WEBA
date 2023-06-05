@extends("layouts.master")
@section("title","Dashboard")
@section('css')
    <style>
        .apexcharts-svg {
            overflow: visible;
        }


    </style>
    @stop

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
    <div>

            <!--begin::Dashboard-->
            <div class="row">
                <div class="col-xl-5">
                    <!--begin::Mixed Widget 17-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-1 pt-2">
                            <div class="card-title font-weight-bolder">
                                <div class="card-label">
                                    SYSTEM STATUS
                                </div>
                            </div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body p-0 d-flex flex-column">
                            <!--begin::Items-->
                            <div class="flex-grow-1 card-spacer">
                                <div class="row row-paddingless mb-10">
                                    <!--begin::Item-->
                                    <div class="col">
                                        <div class="d-flex align-items-center mr-2">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45 symbol-light-info mr-4 flex-shrink-0">
                                                <div class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-info"><!--begin::Svg Icon | path:/metronic/theme/html/demo9/dist/assets/media/svg/icons/Shopping/Cart3.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
        <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon--></span>                            </div>
                                            </div>
                                            <!--end::Symbol-->

                                            <!--begin::Title-->
                                            <div>
                                                <div class="font-size-h4 text-dark-75 font-weight-bolder">{{$totalOperators}}</div>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">Operators</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="col">
                                        <div class="d-flex align-items-center mr-2">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45 symbol-light-danger mr-4 flex-shrink-0">
                                                <div class="symbol-label">
                                                    <span class="svg-icon svg-icon-2x svg-icon-danger">
													<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<polygon points="0 0 24 0 24 24 0 24"></polygon>
															<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
															<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
														</g>
													</svg>
                                                        <!--end::Svg Icon-->
												</span>
                                                </div>
                                            </div>
                                            <!--end::Symbol-->

                                            <!--begin::Title-->
                                            <div>
                                                <div class="font-size-h4 text-dark-75 font-weight-bolder">{{$totalCustomers}}</div>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">Consumers</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                    <!--end::Widget Item-->
                                </div>

                                <div class="row row-paddingless">
                                    <!--begin::Item-->
                                    <div class="col">
                                        <div class="d-flex align-items-center mr-2">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
                                                <div class="symbol-label">
                                                    <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo9/dist/../src/media/svg/icons/Code/Git4.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M6,7 C7.1045695,7 8,6.1045695 8,5 C8,3.8954305 7.1045695,3 6,3 C4.8954305,3 4,3.8954305 4,5 C4,6.1045695 4.8954305,7 6,7 Z M6,9 C3.790861,9 2,7.209139 2,5 C2,2.790861 3.790861,1 6,1 C8.209139,1 10,2.790861 10,5 C10,7.209139 8.209139,9 6,9 Z" fill="#000000" fill-rule="nonzero"/>
        <path d="M7,11.4648712 L7,17 C7,18.1045695 7.8954305,19 9,19 L15,19 L15,21 L9,21 C6.790861,21 5,19.209139 5,17 L5,8 L5,7 L7,7 L7,8 C7,9.1045695 7.8954305,10 9,10 L15,10 L15,12 L9,12 C8.27142571,12 7.58834673,11.8052114 7,11.4648712 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M18,22 C19.1045695,22 20,21.1045695 20,20 C20,18.8954305 19.1045695,18 18,18 C16.8954305,18 16,18.8954305 16,20 C16,21.1045695 16.8954305,22 18,22 Z M18,24 C15.790861,24 14,22.209139 14,20 C14,17.790861 15.790861,16 18,16 C20.209139,16 22,17.790861 22,20 C22,22.209139 20.209139,24 18,24 Z" fill="#000000" fill-rule="nonzero"/>
        <path d="M18,13 C19.1045695,13 20,12.1045695 20,11 C20,9.8954305 19.1045695,9 18,9 C16.8954305,9 16,9.8954305 16,11 C16,12.1045695 16.8954305,13 18,13 Z M18,15 C15.790861,15 14,13.209139 14,11 C14,8.790861 15.790861,7 18,7 C20.209139,7 22,8.790861 22,11 C22,13.209139 20.209139,15 18,15 Z" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                                          </div>
                                            </div>
                                            <!--end::Symbol-->

                                            <!--begin::Title-->
                                            <div>
                                                <div class="font-size-h4 text-dark-75 font-weight-bolder">{{$totalMeters}}</div>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">Connections</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="col">
                                        <div class="d-flex align-items-center mr-2">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45 symbol-light-primary mr-4 flex-shrink-0">
                                                <div class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-primary"><!--begin::Svg Icon | path:/metronic/theme/html/demo9/dist/assets/media/svg/icons/Shopping/Barcode-read.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16"></rect>
        <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero"></path>
    </g>
</svg><!--end::Svg Icon--></span>                            </div>
                                            </div>
                                            <!--end::Symbol-->

                                            <!--begin::Title-->
                                            <div>
                                                <div class="font-size-h4 text-dark-75 font-weight-bolder">{{$totalOperationAreas}}</div>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">Operating Area</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                    <!--end::Item-->
                                </div>
                            </div>
                            <!--end::Items-->
                            <!--end::Chart-->
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 414px; height: 462px;"></div></div><div class="contract-trigger"></div></div></div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 17-->
                </div>
                <div class="col-xl-7">
                    <!--begin::Mixed Widget 17-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-1 pt-1">
                            <div class="card-title font-weight-bolder">
                                <div class="card-label">
                                    Last 5 Months bills Payment
                                </div>
                            </div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body" id="chart">

                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 17-->
                </div>
            </div>
            </div>

            <div class="row mb-5">
                <div class="col-xl-8">
                    <div class="card card-body rounded shadow-sm border-0 h-100 mt-2">
                        <h4 class="font-size-lg">Graph of Water consumption (㎥) {{now()->year}}  </h4>
                        <div id="sales-per-month"></div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <!--begin::Tiles Widget 1-->
                    <div class="card card-custom gutter-b card-stretch h-100 mt-2">
                        <!--begin::Header-->
                        <div class="card-header border-1">
                            <div class="card-title">
                                <div class="card-label">
                                    <div class="font-weight-bolder font-size-lg">Operator With High Water Consumptions</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column px-0" style="position: relative;">
                            @foreach($topOperators as $row)
                            <!--begin::Items-->
                            <div class="flex-grow-1 card-spacer-x">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <div class="d-flex align-items-center mr-2">
                                        <div class="symbol symbol-30 symbol-circle position-relative bg-transparent">
                                            <div class="symbol-label" style="background-image:url({{$row["url_logo"]}})">
                                            </div>
                                        </div>
                                        <div class="ml-2">
                                            <a href="#" class="font-size-base text-dark-75 text-hover-primary font-weight-bolder">{{$row["name"]}}</a>
                                            <div class="font-size-sm text-muted font-weight-bold mt-1">{{$row["address"]}} </div>
                                        </div>
                                    </div>
                                    <div class="label label-light label-inline font-weight-bold text-dark-75 py-4 px-3 font-size-lg">
                                        {{number_format($row["consumed_water"])}} &#13221;</div>
                                </div>
                                <!--end::Item-->
                            </div>
                            @endforeach
                            <!--end::Items-->
                    </div>
                    <!--end::Tiles Widget 1-->
                </div>
            </div>



            <!--end::Dashboard-->
        </div>
        @if(auth()->user()->district_id==null)
            <div class="row mt-5 mb-5">
                <div class="col-md-12">
                    <div class="card card-body rounded shadow-sm border-0 h-100">
                        <h4 class="font-size-lg">Graph of Consumer per Operators  </h4>
                        <div id="consumer-per-Operators"></div>
                    </div>
                </div>
                <!--end::Dashboard-->
            </div>
        @endif
        <!--end::Container-->
    </div>

    <!--end::Entry-->
@endsection
@section("scripts")
    <script>
        $('.nav-dashboard').addClass('menu-item-active');

        let pieData={};
        console.log(pieData);
        var options1 = {
            series: Object.values(pieData),
            chart: {
                type: 'donut',
            },
            plotOptions: {
                pie: {
                    startAngle: -90,
                    endAngle: 270
                }
            },
            labels: Object.keys(pieData),
            fill: {
                type: 'gradient',
            },
            legend: {
                formatter: function (val, opts) {
                    return val + " : " + opts.w.globals.series[opts.seriesIndex].toLocaleString()
                },
                position: 'bottom'
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val.toLocaleString();
                    }
                }
            },
            // title: {
            //     text: "Beneficiaries by Gender"
            // },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var chartId = "#charges-per-service"
        var chart1 = new ApexCharts(document.querySelector(chartId), options1);
        chart1.render();


        var _demo12 = function () {
            let data=@json($consumptionPerMonth);
            const apexChart = "#sales-per-month";
            var options12 = {
                series:[
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
        var _demo13 = function () {
            let data=@json($consumerPerOperators);
            const apexChart = "#consumer-per-Operators";
            var options12 = {
                series:[
                    {
                        name: "Consumers",
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
                    labels: {
                        style: {
                            fontSize: '10px',
                            fontWeight: 600,
                        },
                    }
                },
                yaxis: {
                    title: {
                        text: "Number of Consumers"
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val.toLocaleString() + " Consumers"
                        }
                    }
                }
            };

            var chart12 = new ApexCharts(document.querySelector(apexChart), options12);
            chart12.render();
        }
        var _demo14=function (){
            let data=@json($recentPayment);
            var options = {
                series: [{
                    name: "Recent Payments",
                    data: Object.values(data)
                }],
                chart: {
                    height: 200,
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
                        colors: ['#f3f3f3', 'transparent'],
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: Object.keys(data),
                    labels: {
                        style: {
                            fontSize: '11px',
                            fontWeight: 600,
                        },
                    }

                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val.toLocaleString() + " RWF"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
        $(function () {
            _demo13();
            _demo12();
            _demo14();
        });

    </script>
@stop
