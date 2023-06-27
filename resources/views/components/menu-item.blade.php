<li class="menu-item {{ $itemClass }}" aria-haspopup="true">
    <a href="{{ $route }}" class="menu-link">
        <i class="menu-bullet menu-bullet-dot">
            <span></span>
        </i>
        <span class="menu-text">{{ $title }}</span>
        @if($count)
            <span class="menu-label">
                <span class="label label-danger label-inline rounded-pill">
                    {{ $count }}
                </span>
            </span>
        @endif
    </a>

</li>
