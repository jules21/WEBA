@extends('layouts.app')
@section('title',"Help")
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h4 class="my-4 text-white">
                    @lang('app.help')
                </h4>
                <p class="tw-text-gray-300">
                    @lang('app.help_description')
                </p>
                <div class="card shadow-sm tw-rounded-lg border-0 shadow-none">
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @if($userManuals->isEmpty())
                                <div class="list-group-item">
                                    <div class="alert alert-info">
                                        No user manuals found yet.
                                    </div>
                                </div>
                            @endif

                            @foreach($userManuals as $item)
                                <div class="list-group-item d-flex mb-3">
                                    <div
                                        class="mr-2 tw-h-10 tw-w-10 flex-shrink-0 rounded-circle align-self-start d-flex justify-content-center align-items-center tw-bg-red-100 tw-text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                             fill="currentColor"
                                             class="tw-h-4 tw-w-4">
                                            <path
                                                d="M64 464H96v48H64c-35.3 0-64-28.7-64-64V64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V288H336V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16zM176 352h32c30.9 0 56 25.1 56 56s-25.1 56-56 56H192v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V448 368c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24H192v48h16zm96-80h32c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H304c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H320v96h16zm80-112c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H448v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V432 368z"/>
                                        </svg>
                                    </div>
                                    <!--end::Svg Icon-->
                                    <!--end::Symbol-->
                                    <!--begin::Section-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <!--begin::Content-->
                                        <div
                                            class="d-flex flex-column flex-md-row w-100  justify-content-between mb-2">
                                            <!--begin::Title-->
                                            <a href=""
                                               class="text-dark text-hover-primary text-decoration-none tw-text-sm mr-3 tw-font-medium">
                                                {{$item->title}}
                                            </a>
                                            <!--end::Title-->
                                            <!--begin::Label-->
                                            <a href="{{ route('user.manuals.download',$item->slug) }}"
                                               target="_blank"
                                               class="btn btn-primary btn-sm fw-bold text-white tw-rounded-sm d-flex align-items-center align-self-start hover:tw-ring-2 hover:tw-ring-offset-2 hover:tw-ring-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-download" width="16"
                                                     height="16"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                                    <polyline points="7 11 12 16 17 11"></polyline>
                                                    <line x1="12" y1="4" x2="12" y2="16"></line>
                                                </svg>
                                                <span>Download</span>
                                            </a>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Content-->
                                        <!--begin::Text-->
                                        <span class="text-muted fw-semibold tw-text-sm">{{$item->description}}</span>
                                        <!--end::Text-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                            @endforeach
                        </div>
                        {{ $userManuals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
