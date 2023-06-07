@extends('layouts.master')

@section('title','Reported Issues')

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
                        Reported Issues
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
                                Reported Issues
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
        <div class="d-flex justify-content-between align-items-center mb-6">
            <h4 class="mb-0">
                Reported Issues
            </h4>
            @if(auth()->user()->canFilterIssues())
                <form action="" class="form-inline">
                    <select name="operator" id="operator" class="form-control form-control-sm mr-2">
                        <option value="">All Operators</option>
                        @foreach($operators as $operator)
                            <option value="{{ $operator->id }}"
                                {{ request()->get('operator') == $operator->id ? 'selected' : '' }}>
                                {{ $operator->name }}
                            </option>
                        @endforeach
                    </select>
                    <select name="area" id="area" class="form-control form-control-sm">
                        <option value="">All Operating Areas</option>
                    </select>
                    <button class="btn btn-primary btn-sm ml-2">
                        Filter
                        <i class="fa fa-filter"></i>
                    </button>
                </form>
            @endif
        </div>
        <div class="accordion accordion-solid accordion-panel accordion-svg-toggle" id="accordionExample8">

            @foreach($issues as $item)
                <div class="card">
                    <div class="card-header" id="headingOne8">
                        <div class="card-title align-items-start collapsed" data-toggle="collapse"
                             data-target="#collapseOne{{$item->id}}">
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
                                        <a href="#"
                                           class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
                                            {{$item->client->name}}
                                        </a>
                                        <small>reported an issue</small>
                                        <span
                                            class="text-muted font-size-sm">{{ $item->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="small my-2">
                                    {{ $item->title }}
                                </div>
                                <div class="small text-muted">
                                    {{ $item->operator->name }} - {{ $item->operatingArea->name }}
                                </div>
                            </div>
                            <span class="small label label-inline label-light-{{$item->statusColor}} rounded-pill">
                            {{ucfirst( $item->status) }}
                            </span>
                        </div>
                    </div>
                    <div id="collapseOne{{$item->id}}" class="collapse " data-parent="#accordionExample8">
                        <div class="card-body">
                            @foreach($item->details as $detail)
                                <div
                                    class="p-4 bg-{{$detail->user_type==\App\Models\User::class?'light-success':'light'}} my-2 rounded">
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
                                @if($item->status!=\App\Constants\Status::RESOLVED
                                    && auth()->user()->can(\App\Constants\Permission::ManageReportedIssues)
                                     && isForOperationArea())
                                    <button class="mt-2 btn btn-primary  btn-sm font-weight-bolder js-reply"
                                            data-status="{{ucfirst( $item->status) }}"
                                            data-url="{{ route('admin.issues.reply',encryptId($item->id)) }}"
                                            data-id="{{$item->id}}">
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
            @endforeach
        </div>

        <div class="mt-3">
            {{ $issues->links() }}
        </div>

        @if($issues->count()==0)
            <div class="alert alert-info alert-custom py-2">
                <div class="alert-icon">
                    <i class="flaticon2-information"></i>
                </div>
                <div class="alert-text">
                    No issues reported yet.
                </div>
            </div>
        @endif

    </div>

    <!-- Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header  border-0">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Add a Reply
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="" id="issueForm" method="post">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status">Mark issue as:</label>
                            <select name="status" id="status" class="form-control">
                                <option value=""></option>
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
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary">
                            Save Reply
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(\App\Http\Requests\StoreReplyIssueRequest::class,'#issueForm') !!}

    <script>
        let operators = @json($operators->toArray());
        $(function () {
            let $issueForm = $('#issueForm');
            $(document).on('click', '.js-reply', function () {
                $('#replyModal').modal();
                $('#status').val($(this).data('status'));
                $issueForm.attr('action', $(this).data('url'));
            });

            $issueForm.on('submit', function (e) {
                e.preventDefault();
                let btn = $(this).find('[type="submit"]');
                if (!$(this).valid()) {
                    return false;
                }
                btn.prop('disabled', true)
                    .addClass('spinner spinner-white spinner-right');

                e.target.submit();
            });

            let $operator = $('#operator');

            function loadOperatingAreas(operatorId, selectedAreaId = null) {
                let selectedOperator = operators.find(item => Number(item.id) === Number(operatorId));

                let operatingAreas = selectedOperator.operation_areas;
                let $operatingArea = $('#area');
                $operatingArea.empty();
                $operatingArea.append('<option value="">All Operating Area</option>');
                operatingAreas.forEach(function (item) {
                    $operatingArea.append(`<option value="${item.id}">${item.name}</option>`);
                });
                if (selectedAreaId) {
                    $operatingArea.val(selectedAreaId);
                }
            }

            $operator.on('change', function () {
                let operatorId = $(this).val();
                loadOperatingAreas(operatorId);
            });
            $operator.trigger('change');
            loadOperatingAreas($operator.val(), '{{request('area')}}');

        });
    </script>
@endsection
