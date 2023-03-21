@extends('layouts.master')
@section('title','Stock Movement')
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
                            <a class="text-muted">Stock Movement</a>
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
    <div class="">
        <div class="card card-custom">
            <div class="card-header flex-wrap">
                <h3 class="card-title">Stock Movements</h3>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            Stock Movement Details
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        $('.nav-stock-managements').addClass('menu-item-active menu-item-open');
        $('.nav-stock-movements').addClass('menu-item-active');
        // $(document).on('click','.btn-details', function(e){
        //     e.preventDefault();
        //     console.log('clicked');
        //     const link = $(this);
        //     link.addClass('spinner spinner-white spinner-right');
        //     const url = link.attr('href');
        //     $.ajax({
        //         url: url,
        //         method: 'GET',
        //         success: function (response) {
        //             link.removeClass('spinner spinner-white spinner-right');
        //             $('#modal').modal('show');
        //             $('#modal .modal-title').html('Stock Movement Details');
        //             $('#modal .modal-body').html(response);
        //         },
        //         error: function (error) {
        //             link.removeClass('spinner spinner-white spinner-right');
        //             console.log(error);
        //         }
        //     })
        // })
        </script>
@endsection
