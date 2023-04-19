<aside {{ $attributes->class(['tw-w-[280px] tw-bg-gray-900 border-right flex-shrink-0 p-4']) }}>
    <div class="d-flex justify-content-center">
        {{--   <h4 class="mb-0 font-weight-bolder">
               CMS
           </h4>--}}
        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="tw-h-10"/>
    </div>
    <div
            class="tw-rounded-md tw-bg-gray-800 border tw-border-gray-700  mx-9 mt-9 mt-lg-2">
        <!--begin::User info-->
        <a href="" class="d-flex align-items-center tw-w-full p-3 ">
            <img src="{{ asset('assets/media/users/100_5.jpg') }}" alt="image" class="tw-h-12 rounded-circle mr-2"/>
            <!--begin::Name-->
            <span class="d-flex flex-column">
                    <span class="tw-text-gray-100 font-weight-bold tw-text-lg mb-1">Johnson</span>
                    <span class="tw-text-gray-200 font-weight-normal tw-text-xs">React Developer</span>
                </span>
            <!--end::Name-->
        </a>
        <!--end::User info-->
    </div>

    <div class="overflow-hidden">
        <div class="w-100 d-flex flex-column tw-font-semibold ">
            <div class="menu-item pt-5">
                <!--begin:Menu content-->
                <div class="menu-content py-1">
                        <span class="menu-heading text-secondary font-weight-bold text-uppercase">
                            Navigation
                        </span>
                </div><!--end:Menu content-->
            </div>
            <x-layouts.menu-item text="Home" href="" class="">
                <span class="ti ti-smart-home tw-text-[24px]"></span>
            </x-layouts.menu-item>
            <x-layouts.menu-item text="New Connection" href="">
                <span class="ti ti-droplet-plus tw-text-[24px]"></span>
            </x-layouts.menu-item>
            <x-layouts.menu-item text="Requests" href="" :is-active="true">
                <span class="ti ti-layout-list tw-text-[24px]"></span>
            </x-layouts.menu-item>
            <x-layouts.menu-item text="Billing" href="">
                <span class="ti ti-receipt tw-text-[24px]"></span>
            </x-layouts.menu-item>
            <x-layouts.menu-item text="Payments" href="">
                <span class="ti ti-building-bank tw-text-[24px]"></span>
            </x-layouts.menu-item>
        </div>
    </div>


</aside>
