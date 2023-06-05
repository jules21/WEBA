<div>
    {{-- Success is as dangerous as failure. --}}

    <div class="accordion" id="accordionExample">
        @foreach($issues as $item)
            <div class="card my-2 tw-rounded border">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button
                            class="btn btn-link d-flex  px-0 tw-text-2xl justify-content-between text-decoration-none align-items-start btn-block text-left tw-outline-0 focus:tw-outline-0 focus:tw-shadow-none collapsed"
                            type="button" data-toggle="collapse" data-target="#collapseOne{{$item->id}}"
                            aria-expanded="true"
                            aria-controls="collapseOne">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-plus icon-plus "
                                 width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="icon icon-tabler icon-tabler-minus icon-minus "
                                 width="24"
                                 height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12h14"/>
                            </svg>
                            <div class="flex-grow-1 ml-3 d-flex justify-content-between align-items-start">
                                <div>
                                    <h6>
                                        {{ $item->title }}
                                    </h6>
                                    <div class="tw-text-xs">
                                        <span>{{$item->operator->name}}</span> -
                                        <span>{{$item->operatingArea->name}}</span>
                                    </div>
                                </div>
                                <span
                                    class="badge px-2 font-weight-normal badge-{{$item->statusColor}} tw-text-xs rounded-pill flex-shrink-0">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>

                        </button>
                    </h2>
                </div>
                <div id="collapseOne{{$item->id}}" class="collapse" aria-labelledby="headingOne"
                     data-parent="#accordionExample">
                    <div class="card-body tw-text-gray-700 tw-text-sm tw-tracking-wider">
                        @foreach($item->details as $detail)
                            <div
                                class="p-2 my-2 border tw-rounded-md {{ $detail->user_type==\App\Models\Client::class?'bg-light':'tw-bg-accent/20 tw-border-accent/30' }}">
                                @if($detail->user_type==\App\Models\User::class)
                                    <div class="font-weight-bolder">
                                        <span>{{ $detail->model->name }}</span>
                                        <span class="text-primary">{{ $detail->created_at->diffForHumans() }}</span>
                                    </div>
                                @endif

                                <p class="small mb-0">
                                    {{ $detail->description}}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-3">
        <div class="d-flex justify-content-between flex-column flex-md-row tw-gap-2">
            <div>
                {{ $issues->links() }}
            </div>
            <div>
                Showing {{ $issues->firstItem() }} to {{ $issues->lastItem() }} out of {{ $issues->total() }} items
            </div>
        </div>
    </div>

</div>


