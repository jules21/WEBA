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
        <div >
            <!--begin::Dashboard-->
            <div class="row">
                <div class="col-md-6">
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
                                            <div class="symbol symbol-45 symbol-light-info mr-4 flex-shrink-0">
                                                <div class="symbol-label">
                                                    <span class="svg-icon svg-icon-info svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Design/Arrows.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M10.4289322,12.3786797 L5.30761184,7.25735931 C4.91708755,6.86683502 4.91708755,6.23367004 5.30761184,5.84314575 C5.69813614,5.45262146 6.33130112,5.45262146 6.72182541,5.84314575 L11.8431458,10.9644661 L18.0355339,4.77207794 C18.4260582,4.38155365 19.0592232,4.38155365 19.4497475,4.77207794 C19.8402718,5.16260223 19.8402718,5.79576721 19.4497475,6.1862915 L13.2573593,12.3786797 L19.4497475,18.5710678 C19.8402718,18.9615921 19.8402718,19.5947571 19.4497475,19.9852814 C19.0592232,20.3758057 18.4260582,20.3758057 18.0355339,19.9852814 L11.8431458,13.7928932 L6.72182541,18.9142136 C6.33130112,19.3047379 5.69813614,19.3047379 5.30761184,18.9142136 C4.91708755,18.5236893 4.91708755,17.8905243 5.30761184,17.5 L10.4289322,12.3786797 Z" fill="#000000" opacity="0.3" transform="translate(12.378680, 12.378680) rotate(-315.000000) translate(-12.378680, -12.378680) "/>
        <path d="M3.51471863,12 L5.63603897,14.1213203 C6.02656326,14.6736051 6.02656326,15.1450096 5.63603897,15.5355339 C5.24551468,15.9260582 4.77411016,15.9260582 4.22182541,15.5355339 L0.686291501,12 L4.22182541,8.46446609 C4.69322993,7.99306157 5.16463445,7.99306157 5.63603897,8.46446609 C6.10744349,8.93587061 6.10744349,9.40727514 5.63603897,9.87867966 L3.51471863,12 Z M12,20.4852814 L14.1213203,18.363961 C14.6736051,17.9734367 15.1450096,17.9734367 15.5355339,18.363961 C15.9260582,18.7544853 15.9260582,19.2258898 15.5355339,19.7781746 L12,23.3137085 L8.46446609,19.7781746 C7.99306157,19.3067701 7.99306157,18.8353656 8.46446609,18.363961 C8.93587061,17.8925565 9.40727514,17.8925565 9.87867966,18.363961 L12,20.4852814 Z M20.4852814,12 L18.363961,9.87867966 C17.9734367,9.32639491 17.9734367,8.85499039 18.363961,8.46446609 C18.7544853,8.0739418 19.2258898,8.0739418 19.7781746,8.46446609 L23.3137085,12 L19.7781746,15.5355339 C19.3067701,16.0069384 18.8353656,16.0069384 18.363961,15.5355339 C17.8925565,15.0641294 17.8925565,14.5927249 18.363961,14.1213203 L20.4852814,12 Z M12,3.51471863 L9.87867966,5.63603897 C9.32639491,6.02656326 8.85499039,6.02656326 8.46446609,5.63603897 C8.0739418,5.24551468 8.0739418,4.77411016 8.46446609,4.22182541 L12,0.686291501 L15.5355339,4.22182541 C16.0069384,4.69322993 16.0069384,5.16463445 15.5355339,5.63603897 C15.0641294,6.10744349 14.5927249,6.10744349 14.1213203,5.63603897 L12,3.51471863 Z" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                                </div>
                                            </div>
                                            <!--end::Symbol-->

                                            <!--begin::Title-->
                                            <div>
                                                <div class="font-size-h4 text-dark-75 font-weight-bolder">{{$waterNetworks}}</div>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">Water Networks</div>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                    <!--end::Item-->
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
                                </div>
                            </div>
                            <!--end::Items-->
                            <!--end::Chart-->
                            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 414px; height: 462px;"></div></div><div class="contract-trigger"></div></div></div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 17-->
                </div>
                <div class="col-md-6">
                    <!--begin::Mixed Widget 17-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-1 pt-2">
                            <div class="card-title font-weight-bolder">
                                <div class="card-label">
                                    Request Status
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
                                                    <span class="svg-icon svg-icon-info svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Text/Bullet-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000"/>
        <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                                 </div>
                                            </div>
                                            <!--end::Symbol-->

                                            <!--begin::Title-->
                                            <div>
                                                <div class="font-size-h4 text-dark-75 font-weight-bolder">{{$allRequests}}</div>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">Total Requests</div>
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
                                                  <span class="svg-icon svg-icon-xl svg-icon-primary"><!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Code/Compiling.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"></path>
        <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"></path>
    </g>
</svg><!--end::Svg Icon--></span>
                                                </div>
                                            </div>
                                            <!--end::Symbol-->

                                            <!--begin::Title-->
                                            <div>
                                                <div class="font-size-h4 text-dark-75 font-weight-bolder">{{$pendingRequests}}</div>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">New Requests</div>
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
                                                    <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Double-check.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M9.26193932,16.6476484 C8.90425297,17.0684559 8.27315905,17.1196257 7.85235158,16.7619393 C7.43154411,16.404253 7.38037434,15.773159 7.73806068,15.3523516 L16.2380607,5.35235158 C16.6013618,4.92493855 17.2451015,4.87991302 17.6643638,5.25259068 L22.1643638,9.25259068 C22.5771466,9.6195087 22.6143273,10.2515811 22.2474093,10.6643638 C21.8804913,11.0771466 21.2484189,11.1143273 20.8356362,10.7474093 L17.0997854,7.42665306 L9.26193932,16.6476484 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(14.999995, 11.000002) rotate(-180.000000) translate(-14.999995, -11.000002) "/>
        <path d="M4.26193932,17.6476484 C3.90425297,18.0684559 3.27315905,18.1196257 2.85235158,17.7619393 C2.43154411,17.404253 2.38037434,16.773159 2.73806068,16.3523516 L11.2380607,6.35235158 C11.6013618,5.92493855 12.2451015,5.87991302 12.6643638,6.25259068 L17.1643638,10.2525907 C17.5771466,10.6195087 17.6143273,11.2515811 17.2474093,11.6643638 C16.8804913,12.0771466 16.2484189,12.1143273 15.8356362,11.7474093 L12.0997854,8.42665306 L4.26193932,17.6476484 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.999995, 12.000002) rotate(-180.000000) translate(-9.999995, -12.000002) "/>
    </g>
</svg><!--end::Svg Icon--></span>
                                                </div>
                                            </div>
                                            <!--end::Symbol-->

                                            <!--begin::Title-->
                                            <div>
                                                <div class="font-size-h4 text-dark-75 font-weight-bolder">{{$approveRequests}}</div>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">Approved</div>
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
                                                    <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Close.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
            <rect x="0" y="7" width="16" height="2" rx="1"/>
            <rect opacity="0.3" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) " x="0" y="7" width="16" height="2" rx="1"/>
        </g>
    </g>
</svg><!--end::Svg Icon--></span>
                                                </div>
                                            </div>
                                            <!--end::Symbol-->

                                            <!--begin::Title-->
                                            <div>
                                                <div class="font-size-h4 text-dark-75 font-weight-bolder">{{$rejectRequests}}</div>
                                                <div class="font-size-sm text-muted font-weight-bold mt-1">Rejected</div>
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

            </div>

            <div class="row mt-5 mb-5">
                <div class="col-md-12">
                    <div class="card card-body rounded shadow-sm border-0 h-100">
                        <h4 class="font-size-lg">Billing and Bills Payment in {{now()->year}}</h4>
                        <div id="chart"></div>
                    </div>
                </div>
                <!--end::Dashboard-->
            </div>

            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="card card-body rounded shadow-sm border-0 h-100">
                        <h4 class="font-size-lg">Graph of Water consumption (㎥) {{now()->year}}  </h4>
                        <div id="sales-per-month"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!--begin::Tiles Widget 1-->
                    <div class="card card-custom gutter-b card-stretch h-100">
                        <!--begin::Header-->
                        <div class="card-header border-1">
                            <div class="card-title">
                                <div class="card-label">
                                    <div class="font-weight-bolder font-size-lg">Water Network With High Consumptions</div>
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
                var _demo14=function (){
                    let data=@json($recentPayment);
                    let billings=@json($billingsPerMonth);
                    var options = {
                        series: [{
                            name: "Bill Payments",
                            data: Object.values(data)
                        },
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
