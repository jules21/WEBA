@extends('layouts.app')
@section('title',"FAQ")
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h4 class="my-4 text-white">
                    @lang('app.frequently_asked_questions')
                </h4>
                <p class="tw-text-gray-300">
                    @lang('app.faq_description')
                </p>
                <div class="accordion" id="accordionExample">
                    @foreach($faqs as $item)
                        <div class="card my-2 tw-rounded bg-light">
                            <div class="card-header border-0" id="headingOne">
                                <h2 class="mb-0">
                                    <button

                                        class="btn btn-link d-flex  px-0 tw-text-2xl justify-content-between text-decoration-none align-items-center btn-block text-left tw-outline-0 border-0 focus:tw-outline-0 focus:tw-shadow-none collapsed"
                                        type="button" data-toggle="collapse" data-target="#collapseOne{{$item->id}}"
                                        aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <h6>
                                            @if(app()->getLocale() == 'rw')
                                                {{trans($item->question, [], 'kn')}}
                                            @else
                                                {{trans($item->question)}}
                                            @endif
                                        </h6>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-plus icon-plus tw-h-4 tw-w-4" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M12 5l0 14"/>
                                            <path d="M5 12l14 0"/>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-minus icon-minus tw-h-4 tw-w-4" width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 12h14"/>
                                        </svg>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne{{$item->id}}" class="collapse" aria-labelledby="headingOne"
                                 data-parent="#accordionExample">
                                <div class="card-body tw-text-gray-700 tw-text-sm tw-tracking-wider">
                                    @if(app()->getLocale() == 'rw')
                                        {{trans($item->answer, [], 'kn')}}
                                    @else
                                        {{trans($item->answer)}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    {{ $faqs->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
