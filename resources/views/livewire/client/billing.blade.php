<div class="card card-body h-100 tw-rounded-lg tw-bg-cover tw-bg-no-repeat tw-bg-center"
     style="background-image: url({{ asset('images/bg_logo.png') }});">
    <div class="d-flex justify-content-between mb-3 align-items-center">
        <h4 class="mb-0">Billing</h4>
        <div class="tw-relative">
            <div class="tw-absolute tw-inset-y-0 tw-left-0 tw-flex tw-items-center tw-pl-3 tw-pointer-events-none">
                <svg aria-hidden="true" class="tw-w-5 tw-h-5 tw-text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" wire:model.debounce="search"
                   class="tw-bg-gray-50 border tw-border-gray-300 tw-outline-0 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring focus:tw-ring-offset-2 focus:tw-ring-accent focus:tw-border-accent tw-block tw-w-full tw-pl-10 tw-p-2.5  "
                   placeholder="Search..." required>
        </div>

    </div>

    <div class="accordion" id="accordionExample">
        @foreach($billings as $item)
            <div class="card">
                <div class="card-header" id="headingOne">
                    <div class="tw-cursor-pointer  text-left" data-toggle="collapse" data-target="#collapseOne{{$item->id}}" aria-controls="collapseOne{{$item->id}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="font-weight-bold">Subscription #:</div>
                                <div class="tw-text-xs">
                                    {{ $item->subscription_number }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="font-weight-bold">Meter Number:</div>
                                <div class="tw-text-xs">
                                    {{ $item->meter_number }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="font-weight-bold">Amount:</div>
                                <div class="d-flex tw-gap-2 tw-text-xs">
                                    <div>
                                        Paid:
                                        <span class="text-primary font-weight-bold">
                                            {{ number_format($item->amount) }} RWF
                                        </span>
                                    </div>
                                    <div>
                                        Remain:
                                        <span class="text-primary font-weight-bold">
                                            {{ number_format($item->balance) }} RWF
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapseOne{{$item->id}}" class="collapse" aria-labelledby="headingOne"
                     data-parent="#accordionExample">
                    <div class="card-body">
                        <h6>Billing Details</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="font-weight-normal">Starting Index:</div>
                                <div class="tw-text-xs text-muted">
                                    {{ $item->starting_index }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="font-weight-normal">Last Index:</div>
                                <div class="tw-text-xs text-muted">
                                    {{ $item->last_index }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="font-weight-normal">Done By:</div>
                                <div class="tw-text-xs text-muted">
                                    {{ $item->user->name }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="font-weight-normal">Comment:</div>
                                <div class="tw-text-xs text-muted">
                                    {{ $item->comment }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex mt-4 align-items-center flex-column flex-md-row justify-content-between ">
        <div>
            Showing {{ $billings->firstItem() }} to {{ $billings->lastItem() }} out of {{ $billings->total() }} items
        </div>
        <div>{{ $billings->links() }}</div>
    </div>

</div>
