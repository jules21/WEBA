<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') {{ config('app.name', 'CMS-RWSS') }}</title>
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/icon type"/>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/tailwind.css') }}" rel="stylesheet">
    @yield('styles')
    @livewireStyles
</head>
<body>
<div class="tw-min-h-screen d-flex flex-column">
    <div class="flex-grow-1">
        <x-clients.navbar/>
        <main class="lg:tw-px-20 container-fluid my-4">
            <x-alerts/>
            @yield('breadcrumbs')
            <div class="row">
                <div class="col-md-4">
                    <x-clients.sidebar/>
                </div>
                <div class="col-md-8">
                    @yield('content')
                    @if(isset($slot))
                        {{ $slot }}
                    @endif
                </div>
            </div>
        </main>
    </div>
    <p class="text-center tw-text-gray-500  py-4  mb-0">@lang('app.all_rights_reserved_by_RURA')</p>

</div>

<!-- Modal -->
<div class=" modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content tw-rounded-md border-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @lang('app.new_connection')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <i class="ti ti-x"></i>
                        </span>
                </button>
            </div>
            <form action="{{ route('client.connection-new') }}">
                <div class="modal-body">
                    <div class="tw-my-6">

                        <div class="d-flex justify-content-between">
                            <label for="district">@lang('app.district')</label>
                            <div class="d-none align-items-center" id="loader">
                                <strong>@lang('app.loading...')</strong>
                                <div class="spinner-border spinner-border-sm ml-auto" role="status"
                                     aria-hidden="true"></div>
                            </div>
                        </div>
                        <select required
                                class="form-control focus:tw-ring tw-ring-primary focus:tw-ring-offset-2"
                                id="district" name="district">
                            <option value="">@lang('app.select_district')</option>
                            @foreach(getDistrictsToRequestConnection() as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="tw-my-6">
                        <label for="operator_id">@lang('app.operator')</label>
                        <select required
                                class="form-control focus:tw-ring tw-ring-primary focus:tw-ring-offset-2"
                                id="operator_id" name="op_id">
                            <option value="">@lang('app.select_operator')</option>

                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary" id="btn-create-request">
                        @lang('app.continue') <i class="ti ti-arrow-right"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('app.close')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
@livewireScripts
<script>
    $(function () {
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            let next = $(this).next('.custom-file-label');
            next.addClass("selected").html(fileName);
            // set title attribute to file name
            $(this).attr('title', fileName);
            next.attr('title', fileName);
        });

        $('#district').on('change', function () {
            let districtId = $(this).val();
            $('#loader').removeClass('d-none')
                .addClass('d-flex');
            $.ajax({
                url: '{{ route('get-operators-by-district') }}',
                type: 'GET',
                data: {
                    district_id: districtId
                },
                success: function (response) {
                    let options = '<option value="">Select Operator</option>';
                    $.each(response, function (index, value) {
                        options += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#operator_id').html(options);
                },
                complete: function () {
                    $('#loader').removeClass('d-flex')
                        .addClass('d-none');
                }
            });
        });
    });
</script>
</body>
</html>
