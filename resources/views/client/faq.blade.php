@extends('layouts.app')
@section('title',"FAQ")
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h4 class="my-4 text-white">
                    Frequently Asked Questions
                </h4>
                <p class="tw-text-gray-300">
                    This is a list of frequently asked questions about the system. If you have any other questions,
                    please contact us.
                </p>
                <div class="accordion" id="accordionExample">
                    @for($i=0;$i<10;$i++)
                        <div class="card my-2 tw-rounded bg-light ">
                            <div class="card-header border-0" id="headingOne">
                                <h2 class="mb-0">
                                    <button
                                        x-data="{collapsed: false}" x-on:click="collapsed = !collapsed" x-cloak
                                        class="btn btn-link d-flex  px-0 tw-text-2xl justify-content-between text-decoration-none align-items-center btn-block text-left tw-outline-0 border-0 focus:tw-outline-0 focus:tw-shadow-none"
                                        type="button" data-toggle="collapse" data-target="#collapseOne{{$i}}"
                                        aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <h6>
                                            How to pay with MTN Mobile Money
                                        </h6>
                                        <svg x-show="collapsed" class="tw-h-4 tw-w-4"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path
                                                d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/>
                                        </svg>
                                        <svg x-show="!collapsed" class="tw-h-4 tw-w-4"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path
                                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                                        </svg>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne{{$i}}" class="collapse" aria-labelledby="headingOne"
                                 data-parent="#accordionExample">
                                <div class="card-body tw-text-gray-700 tw-text-sm tw-tracking-wider">
                                    Yet remarkably appearance gets him his projection. Diverted endeavor bed peculiar
                                    men the not desirous. Acuteness abilities ask can offending furnished fulfilled sex.
                                    Warrant fifteen exposed ye at mistake. Blush since so in noisy still built up an
                                    again. As young ye hopes no he place means. Partiality diminution gay yet entreaties
                                    admiration. In mention perhaps attempt pointed suppose. Unknown ye chamber of
                                    warrant of Norland arrived.
                                </div>
                            </div>
                        </div>

                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
