<div class="card card-body rounded-0 d-flex justify-content-center align-items-center bg-primary-light border-0">
    <div class="bg-accent p-2 rounded-circle tw-h-16 tw-w-16 d-flex justify-content-center align-items-center">
        {{ $slot }}
    </div>
    <div class="card-text  d-flex justify-content-center align-items-center flex-column mt-4">
        <h5 class="text-center small font-weight-bolder">
            {{ $title }}
        </h5>
        <h4>
            + <span class="purecounter"
                    data-purecounter-start="0"
                    data-purecounter-decimals="0"
{{--                    data-purecounter-currency="true"--}}
                    data-purecounter-separator="true"
                    data-purecounter-end="{{ $count }}"
            >0</span>
        </h4>
    </div>
</div>
