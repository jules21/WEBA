<div {{ $attributes->class(['card mb-4 card-body tw-rounded-lg']) }}>
    <ul class="nav flex-column tw-gap-2">
        <li class="nav-item">
            <a class="nav-link tw-rounded-xl hover:tw-bg-primary hover:tw-text-white tw-text-lg d-flex align-items-center tw-gap-1 tw-group {{ request()->routeIs('home')?'tw-bg-primary/90 tw-text-white':'' }}"
               href="{{ route('home') }}">
                <div
                    class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle flex-shrink-0">
                    <i class="ti ti-smart-home tw-text-[24px]"></i>
                </div>
                <div>
                    <div>@lang('app.home')</div>
                    <div class="tw-text-xs">@lang('app.summary')</div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tw-rounded-xl hover:tw-bg-primary hover:tw-text-white tw-text-lg d-flex align-items-center tw-gap-1 tw-group {{ request()->routeIs('client.requests')?'tw-bg-primary/90 tw-text-white':'' }}"
               href="{{ route('client.requests') }}">
                <div
                    class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle flex-shrink-0">
                    <i class="ti ti-git-pull-request tw-text-[24px]"></i>
                </div>
                <div>
                    <div>@lang('app.requests')</div>
                    <div class="tw-text-xs">
                        @lang('app.view_your_requests')
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tw-rounded-xl hover:tw-bg-primary hover:tw-text-white tw-text-lg d-flex align-items-center tw-gap-1 {{ request()->routeIs('client.billings')?'tw-bg-primary/90 tw-text-white':'' }}"
               href="{{ route('client.billings') }}">
                <div
                    class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle flex-shrink-0">
                    <i class="ti ti-receipt tw-text-[24px]"></i>
                </div>
                <div>
                    <div>@lang('app.billing')</div>
                    <div class="tw-text-xs">
                        @lang('app.view_your_bills')
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tw-rounded-xl hover:tw-bg-primary hover:tw-text-white tw-text-lg d-flex align-items-center tw-gap-1 {{ request()->routeIs('client.payments')?'tw-bg-primary/90 tw-text-white':'' }}"
               href="{{ route('client.payments') }}">
                <div
                    class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle flex-shrink-0">
                    <i class="ti ti-building-bank tw-text-[24px]"></i>
                </div>
                <div>
                    <div>@lang('app.payments')</div>
                    <div class="tw-text-xs">
                        @lang('app.view_your_payments_history')
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tw-rounded-xl hover:tw-bg-primary hover:tw-text-white tw-text-lg d-flex align-items-center tw-gap-1 {{ request()->routeIs('client.issues-reported')?'tw-bg-primary/90 tw-text-white':'' }}"
               href="{{ route('client.issues-reported') }}">
                <div
                    class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle flex-shrink-0">
                    <i class="ti ti-message-report tw-text-[24px]"></i>
                </div>
                <div>
                    <div>Issues Report</div>
                    <div class="tw-text-xs">
                        View your reported issues
                    </div>
                </div>
            </a>
        </li>


    </ul>
</div>
<x-clients.my-operators/>
