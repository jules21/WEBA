@props([
    'actions' => '',
    'pageTitle' => '',
 ])

<div {{ $attributes->class(['d-flex justify-content-between align-items-md-center mb-4 flex-column flex-md-row']) }}>
    <div class="d-flex tw-gap-1 align-items-center">
        <h3 class="tw-font-semibold mb-0">
            {{ $pageTitle }}
        </h3>

        <div class="text-muted">
            <a href="{{ route('home') }}" class="text-muted text-decoration-none">
                <span class="ti ti-smart-home tw-text-2xl"></span>
            </a>
        </div>
        {{ $slot }}
    </div>
    <div>
        {{ $actions }}
    </div>
</div>
