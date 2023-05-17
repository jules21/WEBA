<div>
    @section('breadcrumbs')
        <x-layouts.breadcrumb>

            <x-layouts.breadcrumb-item>
                Payments
            </x-layouts.breadcrumb-item>

            <x-slot name="actions">
            </x-slot>

        </x-layouts.breadcrumb>
    @endsection

    <div class="card card-body h-100 tw-rounded-lg tw-bg-cover tw-bg-no-repeat tw-bg-center"
         style="background-image: url({{ asset('images/bg_logo.png') }});">
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <h4 class="mb-0">
                Payments
                <div wire:loading>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </div>
            </h4>
            <div class="tw-relative">
                <div class="tw-absolute tw-inset-y-0 tw-left-0 tw-flex tw-items-center tw-pl-3 tw-pointer-events-none">
                    <svg aria-hidden="true" class="tw-w-5 tw-h-5 tw-text-gray-500" fill="currentColor"
                         viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" wire:model="search"
                       class="tw-bg-gray-50 border tw-border-gray-300 tw-outline-0 tw-text-gray-900 tw-text-sm tw-rounded-lg focus:tw-ring focus:tw-ring-offset-2 focus:tw-ring-accent focus:tw-border-accent tw-block tw-w-full tw-pl-10 tw-p-2.5  "
                       placeholder="Search..." required>
            </div>

        </div>

        <div class="accordion" id="accordionExample">
            @foreach($payments as $item)
                <div class="card">
                    <div class="card-header">
                        <div class="tw-cursor-pointer  text-left" data-toggle="collapse"
                             data-target="#collapseOne{{$item->id}}" aria-controls="collapseOne{{$item->id}}">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="d-flex flex-column tw-gap-1">
                                        <div class="">
                                            <span class="text-muted">Code:</span>
                                            <span
                                                class="tw-text-xs tw-font-medium">{{ $item->payment_reference }}</span>
                                        </div>
                                        <div>
                                            <span class="text-muted">Payment Type:</span>
                                            <span class="tw-text-xs tw-font-medium">{{ $item->type }}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="d-flex flex-column tw-gap-1">
                                        <div>
                                            <span class="text-muted">Amount to pay:</span>
                                            <span class="text-primary font-weight-bold">
                                            {{ number_format($item->amount) }} RWF
                                        </span>
                                        </div>
                                        <div>
                                            <span class="text-muted">Balance:</span>
                                            <span class="text-primary font-weight-bold">
                                            {{ number_format($item->balance) }} RWF
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="d-flex justify-content-end flex-column align-items-lg-end">
                                        <div>
                                        <span class="text-muted">
                                            {{ $item->request->operator->name }}
                                        </span>
                                        </div>
                                        <div>
                                        <span
                                            class="badge badge-{{$item->status_color}} rounded-pill tw-px-2 tw-py-1 text-capitalize">{{strtolower($item->status)=='active'?'Not Paid':$item->status }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne{{$item->id}}" class="collapse {{ $loop->first?'show':'' }}"
                         aria-labelledby="headingOne"
                         data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="font-weight-normal">Operating area:</div>
                                <div class="tw-text-xs text-muted">
                                    {{ $item->request->operationArea->name }}
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Payment History</h6>
                            </div>




                            @if($item->paymentHistories->isEmpty())
                                <div class="tw-text-center  tw-mt-5 alert alert-info">
                                    No payment made yet, after payment you will see the history here
                                </div>
                            @endif

                            <ul class="tw-relative border-left tw-border-l-2 tw-border-accent dark:tw-border-gray-700 tw-list-none ">
                                @foreach($item->paymentHistories as $history)
                                    <li class="border-bottom tw-mb-4 tw-border-b-2 tw-border-b-gray-200 tw-ml-2 last:tw-border-b-0">
                                        <div
                                            class="tw-absolute tw-w-3 tw-h-3 tw-bg-accent tw-rounded-full tw-mt-1.5 tw--left-1.5 border tw-border tw-border-white"></div>
                                        <time
                                            class="tw-mb-1 tw-text-sm tw-font-normal tw-leading-none tw-text-gray-400 dark:tw-text-gray-500">
                                            {{ $history->created_at->format('d M Y') }}
                                        </time>
                                        <h3 class="tw-text-lg tw-font-semibold tw-text-gray-900 dark:tw-text-white">
                                            {{number_format($history->amount)}} RWF
                                        </h3>
                                        <p class="tw-mb-4 tw-text-base tw-font-normal tw-text-gray-500 dark:tw-text-gray-400">
                                            {{ $history->mapping->account->paymentServiceProvider->name }}
                                        </p>

                                    </li>
                                @endforeach
                            </ul>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex mt-4 align-items-center flex-column flex-md-row justify-content-between ">
            <div>
                Showing {{ $payments->firstItem() }} to {{ $payments->lastItem() }} out of {{ $payments->total() }}
                items
            </div>
            <div>{{ $payments->links() }}</div>
        </div>

    </div>

</div>
