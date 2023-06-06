@extends('layouts.master')

@section('title','Issues Reporting')

@section('page-header')
    <div class="subheader py-2 py-lg-4 subheader-solid shadow-none border-bottom border-bottom-secondary"
         id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">
                        Issues Reporting
                    </h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-muted">
                                Issues Reporting
                            </a>
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
@stop

@section('content')
    <div class="">
        <div class="card-header flex-wrap d-flex justify-content-between border-2 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Issues Reporting List</h3>
            </div>
            <div class="card-toolbar ">
                <!-- Button trigger modal-->
                <button type="button" class="btn btn-light-primary js-add" data-toggle="modal"
                        data-target="#exampleModalLong">
                    <i class="flaticon2-plus"></i>
                    Add New Issue
                </button>
                <!-- Modal-->
            </div>
        </div>
        <div class="accordion accordion-solid accordion-panel accordion-svg-toggle" id="accordionExample8">

            @for($i=1;$i<10;$i++)
                <div class="card">
                    <div class="card-header" id="headingOne8">
                        <div class="card-title align-items-start collapsed" data-toggle="collapse"
                             data-target="#collapseOne{{$i}}">
                          <span class="svg-icon mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px"
                                 height="24px"
                                 viewBox="0 0 24 24" version="1.1">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                       <polygon points="0 0 24 0 24 24 0 24"></polygon>
                       <path
                           d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                           fill="#000000" fill-rule="nonzero"></path>
                       <path
                           d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                           fill="#000000" fill-rule="nonzero" opacity="0.3"
                           transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                      </g>
                     </svg>
                        </span>
                            <div class="card-label">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-circle symbol-20 mr-3">
                                        <img alt="Pic" src="{{ asset('assets/media/users/300_12.jpg') }}">
                                    </div>
                                    <div>
                                        <a href="#"
                                           class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
                                            {{ auth()->user()->name }}
                                        </a>
                                        <span class="text-muted font-size-sm">
                                        {{ auth()->user()->created_at->diffForHumans()??now()->addMinutes(rand(1,10))->diffForHumans()}}
                                    </span>
                                    </div>
                                </div>
                                <div class="small">
                                    CSPs and embedded SVGs Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Commodi
                                    dolore id nihil? Accusamus at eum non
                                </div>
                            </div>
                            <span class="small label label-inline label-light-primary rounded-pill">Pending</span>
                        </div>
                    </div>
                    <div id="collapseOne{{$i}}" class="collapse " data-parent="#accordionExample8">
                        <div class="card-body">
                            <div class="p-4 bg-light my-2 rounded">
                                Bootstrap “spinners” can be used to show the loading state in your projects. They’re
                                built
                                only with HTML and CSS, meaning you don’t need any JavaScript to create them. You will,
                                however, need some custom JavaScript to toggle their visibility. Their appearance,
                                alignment, and sizing can be easily customized with our amazing utility classes.
                            </div>
                            <div class="d-flex align-items-start">

                                <button class="mt-2 btn btn-primary  btn-sm font-weight-bolder js-reply">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon icon-tabler icon-tabler-messages"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10"></path>
                                        <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2"></path>
                                    </svg>
                                    Reply
                                </button>
                                @if($i%2==0)
                                    <div class="ml-3 p-4 bg-light-primary my-2 rounded">
                                <span class="text-primary">
                                    {{ now()->diffForHumans() }}
                                </span>
                                        <div>
                                            Bootstrap “spinners” can be used to show the loading state in your projects.
                                            They’re
                                            built
                                            only with HTML and CSS, meaning you don’t need any JavaScript to create
                                            them. You
                                            will,
                                            however, need some custom JavaScript to toggle their visibility. Their
                                            appearance,
                                            alignment, and sizing can be easily customized with our amazing utility
                                            classes........
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

    </div>

    <!-- Modal add -->
    <div class="modal fade" id="addModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('admin.issues.issue.reporting.store')}}" method="post" id="submissionForm"
                  class="submissionForm" enctype="multipart/form-data">
                @csrf
{{--                <input type="hidden" value="0" id="issue_report_id" name="issue_report_id">--}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Issue</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="district_id">
                                District:
                            </label>
                            <select name="district_id" id="district_id" class="form-control" aria-describedby="EmailHelp" required>
                                <option value="">Please Select District</option>
                                @foreach(App\Models\District::all() as $district)
                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="title">
                                Title:
                            </label>
                            <input type="text" name="title" class="form-control" aria-describedby="emailHelp"
                                   placeholder="Enter title">
                        </div>

                        <div class="form-group">
                            <label for="description">
                                Description:
                            </label>
                            <textarea class="form-control" placeholder="Type a question here" name="description" rows="5" id="description"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
    </div>

    <!-- Modal reply-->
    <div class="modal fade" id="replyModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog">
            <form action="#" method="post" id="submissionForm"
                  class="submissionForm" enctype="multipart/form-data">
                @csrf
                {{--                <input type="hidden" value="0" id="issue_report_id" name="issue_report_id">--}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reply</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="description">
                                Description:
                            </label>
                            <textarea class="form-control" placeholder="Type a reply here" name="description" rows="5" id="description"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest(\App\Http\Requests\IssueReportingRequest::class,'.submissionForm') !!}
{{--    {!! JsValidator::formRequest(\App\Http\Requests\UpdateBillChargeRequest::class,'.submissionFormEdit') !!}--}}

    <script>

        $('.nav-issues-managements').addClass('menu-item-active  menu-item-open');
        $('.nav-issues-reporting').addClass('menu-item-active');

        $(function () {
            $(document).on('click', '.js-add', function () {
                $('#addModal').modal();
            });
        });

        $(function () {
            $(document).on('click', '.js-reply', function () {
                $('#replyModal').modal();
            });
        });
    </script>
@endsection
