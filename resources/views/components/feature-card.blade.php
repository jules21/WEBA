<div class="card card-body h-100 rounded-lg  d-flex justify-content-center align-items-center bg-white tw-bg-opacity-10 border-0 hover:tw-bg-accent/80 tw-cursor-pointer tw-group">
    <div class="bg-primary  p-4 rounded-circle tw-h-16 tw-w-16 d-flex justify-content-center align-items-center text-accent  group-hover:tw-bg-white">
        {{ $slot }}
    </div>
    <div class="card-text  d-flex justify-content-center align-items-center flex-column mt-4">
        <h5 class="text-center text-primary h6 tw-tracking-widest font-weight-bolder">
            {{ $title }}
        </h5>
        <a href="#" class="text-center text-decoration-none tw-text-gray-500 small group-hover:tw-text-white">
            {{ $description }}
        </a>
    </div>
</div>
