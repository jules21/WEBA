@props([
    'href' => '#',
    'isActive' => false,
    'text' => 'Menu Item',
 ])


<div {{ $attributes->merge(['class' => 'menu-item my-2']) }}>
    <!--begin:Menu content-->
    <div class="menu-content ">
        <a href="{{ $href }}"
           class="w-100 px-3 py-2 d-flex align-items-center tw-gap-1 {{ $isActive?'tw-text-white tw-bg-primary':'tw-text-gray-300 hover:tw-text-accent' }}   rounded text-decoration-none">
            <span class="mb-0 d-inline-flex">
                {{ $slot }}
            </span>
            <span class="mt-1 d-inline-flex">
               {{ $text }}
           </span>
        </a>
    </div><!--end:Menu content-->
</div>
