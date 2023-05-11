<div {{ $attributes->class(['card mb-4 card-body tw-rounded-lg']) }}>
    <h4>
        My Operators
    </h4>


    <ul class="list-unstyled mt-4">
        @forelse(myOperators() as $item)
            <li class="media mb-3">
                <img src="{{ $item->logo_url }}" class="mr-3 tw-w-10" alt="...">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">
                        {{ $item->name }}
                    </h5>
                    <p class="mb-1">
                        {{ $item->address }}
                    </p>
                    <div class="d-flex tw-gap-1 justify-content-between">
                  {{--      <a href="{{ route('client.connection-new',encryptId($item->id)) }}"
                           class="btn btn-sm tw-bg-primary/10 tw-text-primary font-weight-bolder hover:tw-bg-primary hover:tw-text-white">
                            <span class="ti ti-plus d-none d-lg-inline"></span>
                            New Connection
                        </a>
--}}
                    </div>
                </div>
            </li>
        @empty
            <li class="media d-block tw-w-full">
                <div class="alert alert-info">
                    No operators found.
                </div>
            </li>
        @endforelse
    </ul>
</div>
