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
        <div class="d-flex justify-content-between mb-4">
            <h6>
                Issues Reporting List
            </h6>
            <button type="button" class="btn btn-primary btn-sm js-add" data-toggle="modal"
                    data-target="#exampleModalLong">
                <i class="flaticon2-plus"></i>
                Add New Issue
            </button>
        </div>
        <div class="accordion accordion-solid accordion-panel accordion-svg-toggle" id="accordionExample8">

            @forelse($issueReports as $issue)
                <div class="card">
                    <div class="card-header" id="headingOne8">
                        <div class="card-title align-items-start collapsed" data-toggle="collapse"
                             data-target="#collapseOne{{$issue->id}}">
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

                                    <div>
                                        <div>
                                            <a href="#"
                                               class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
                                                {{ auth()->user()->name }}
                                                <span class="text-muted font-size-sm">{{ $issue->created_at->diffForHumans() }}</span>
                                            </a>
                                            <div>
                                                {{ $issue->operator->name }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="small">
                                    {{ $issue->title }}
                                </div>
                            </div>
                            <span class="small label label-inline label-light-{{$issue->statusColor}} rounded-pill">
                            {{ucfirst( $issue->status) }}
                            </span>
                        </div>
                    </div>
                    <div id="collapseOne{{$issue->id}}" class="collapse " data-parent="#accordionExample8">
                        <div class="card-body">

                            @foreach($issue->details as $detail)
                                <div
                                    class="p-4 bg-{{$detail->district_id==auth()->user()->district_id && !is_null($detail->district_id)?'light-success':'light'}} my-2 rounded">
                                    <div class="font-weight-bolder mb-3">
                                        <span class="font-weight-bolder">{{$detail->model->name}}</span> ,
                                        <span class="text-primary">{{ $detail->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="">
                                        {{$detail->description}}
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex align-items-start">
                                @if($issue->status!=\App\Constants\Status::RESOLVED
                                    && !is_null(auth()->user()->district_id)
                                    && auth()->user()->can(\App\Constants\Permission::ManageIssuesReporting)
                                     && isForOperationArea())
                                    <button class="mt-2 btn btn-primary  btn-sm font-weight-bolder js-reply"
                                            data-status="{{ucfirst( $issue->status) }}"
                                            data-url="{{ route('admin.issues.issues.reporting.reply',encryptId($issue->id)) }}"
                                            data-id="{{$issue->id}}">
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    <div class="alert-text">
                        No issues reported yet. You can report issues by clicking on the button above.
                    </div>
                </div>
            @endforelse
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
                            <textarea class="form-control" placeholder="Type a question here" name="description"
                                      rows="5" id="description"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            <form action="" method="post" id="replyForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reply</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="status">Mark issue as:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Please Select</option>
                                @foreach(\App\Constants\Status::issueStatues() as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">
                                Description:
                            </label>
                            <textarea class="form-control" placeholder="Type a reply here" name="description" rows="5"
                                      id="description"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    {!! JsValidator::formRequest(\App\Http\Requests\StoreReplyIssueRequest::class,'#replyForm') !!}
    {{--    {!! JsValidator::formRequest(\App\Http\Requests\UpdateBillChargeRequest::class,'.submissionFormEdit') !!}--}}

    <script>

        $('.nav-issues-managements').addClass('menu-item-active  menu-item-open');
        $('.nav-issues-reporting').addClass('menu-item-active');

        $(function () {
            $(document).on('click', '.js-add', function () {
                $('#addModal').modal();
            });
            let $replyForm = $('#replyForm');
            $(document).on('click', '.js-reply', function () {
                let url = $(this).data('url');
                $replyForm.attr('action', url);
                $('#replyModal').modal();
            });

            $replyForm.on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                if (!form.valid())
                    return;
                let btn = form.find("input[type='submit']");
                btn.prop('disabled', true)
                    .addClass('spinner spinner-right spinner-white');
                e.target.submit();
            });


        });


    </script>
@endsection
