{{--
<div class="card card-body h-100 rounded-lg  d-flex justify-content-center align-items-center tw-bg-gray-400 tw-bg-opacity-10 border-0 hover:tw-bg-accent tw-cursor-pointer tw-group">
    <div class="tw-bg-gray-400  tw-bg-opacity-25 p-2 rounded-circle tw-h-16 tw-w-16 d-flex justify-content-center align-items-center text-accent  group-hover:tw-bg-white">
        {{ $slot }}
    </div>
    <div class="card-text  d-flex justify-content-center align-items-center flex-column mt-4">
        <h5 class="text-center text-white h4 tw-tracking-widest font-weight-bolder">
            {{ $title }}
        </h5>
        <p class="text-center text-white small">
            {{ $description }}
        </p>
    </div>
</div>
--}}

<div class="card card-body h-100 rounded-lg  d-flex justify-content-center align-items-center bg-white tw-bg-opacity-10 border-0 hover:tw-bg-accent/80 tw-cursor-pointer tw-group">
    <div class="bg-primary  p-2 rounded-circle tw-h-16 tw-w-16 d-flex justify-content-center align-items-center text-accent  group-hover:tw-bg-white">
        {{ $slot }}
    </div>
    <div class="card-text  d-flex justify-content-center align-items-center flex-column mt-4">
        <h5 class="text-center text-primary h6 tw-tracking-widest font-weight-bolder">
            {{ $title }}
        </h5>
        <p class="text-center tw-text-gray-500 small group-hover:tw-text-white">
            {{ $description }}
        </p>
    </div>
</div>
