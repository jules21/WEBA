<div {{ $attributes->class(['card mb-4 card-body tw-rounded-lg']) }}>
    <ul class="nav flex-column tw-gap-2">
        <li class="nav-item">
            <a class="nav-link tw-rounded-xl hover:tw-bg-primary/5 tw-text-lg d-flex align-items-center tw-gap-1 {{ request()->routeIs('home')?'tw-bg-primary/5':'' }}"
               href="{{ route('home') }}">
                <div
                    class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle flex-shrink-0">
                    <i class="ti ti-smart-home tw-text-[24px]"></i>
                </div>
                <div>
                    <div>Home</div>
                    <div class="tw-text-sm  text-muted">Summary</div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tw-rounded-xl hover:tw-bg-primary/5 tw-text-lg d-flex align-items-center tw-gap-1 {{ request()->routeIs('client.billings')?'tw-bg-primary/5':'' }}"
               href="{{ route('client.billings') }}">
                <div
                    class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle flex-shrink-0">
                    <i class="ti ti-receipt tw-text-[24px]"></i>
                </div>
                <div>
                    <div>Billing</div>
                    <div class="tw-text-sm  text-muted">
                        View your bills
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tw-rounded-xl hover:tw-bg-primary/5 tw-text-lg d-flex align-items-center tw-gap-1 {{ request()->routeIs('client.payments')?'tw-bg-primary/5':'' }}"
               href="{{ route('client.payments') }}">
                <div
                    class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle flex-shrink-0">
                    <i class="ti ti-building-bank tw-text-[24px]"></i>
                </div>
                <div>
                    <div>Payments</div>
                    <div class="tw-text-sm text-muted">
                        View your payments history
                    </div>
                </div>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link tw-rounded-xl hover:tw-bg-primary/5 tw-text-lg d-flex align-items-center tw-gap-1 active"
               href="#">
                <div
                    class="d-flex justify-content-center align-items-center tw-h-12 tw-w-12 bg-primary text-white rounded-circle flex-shrink-0">
                    <i class="ti ti-notification tw-text-[24px]"></i>
                </div>
                <div>
                    <div>Notifications</div>
                    <div class="tw-text-sm text-muted">
                        Your notifications at a glance
                    </div>
                </div>
            </a>
        </li>


    </ul>
</div>
<x-clients.my-operators/>
