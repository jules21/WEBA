@extends('client.layout.auth')
@section('breadcrumbs')
    <x-layouts.breadcrumb>

        <x-layouts.breadcrumb-item>
            Home
        </x-layouts.breadcrumb-item>
        <x-layouts.breadcrumb-item>
            Overview
        </x-layouts.breadcrumb-item>

        <x-slot name="actions">
            <button class="btn rounded tw-bg-accent  tw-font-semibold hover:tw-bg-accent hover:tw-text-white "
                    type="button" data-toggle="modal" data-target="#exampleModal">
                <span class="ti ti-plus"></span>
                New Connection
            </button>
        </x-slot>

    </x-layouts.breadcrumb>
@endsection
@section('content')

    <div class="tw-grid tw-grid-cols-2 tw-gap-2">
        <div class="card card-body tw-rounded-lg text-primary d-flex justify-content-center align-items-center  border">
            <div
                class="bg-primary  text-accent p-2 rounded-circle tw-h-16 tw-w-16 d-flex justify-content-center align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-git-pull-request" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M6 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M18 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M6 8l0 8"></path>
                    <path d="M11 6h5a2 2 0 0 1 2 2v8"></path>
                    <path d="M14 9l-3 -3l3 -3"></path>
                </svg>
            </div>
            <div class="card-text  d-flex justify-content-center align-items-center flex-column mt-4">
                <h5 class="text-center small font-weight-bolder">Total Requests</h5>
                <h4>{{ $customerOverview->totalRequests }}</h4>
            </div>
        </div>
        <div class="card card-body tw-rounded-lg text-primary d-flex justify-content-center align-items-center  border">
            <div
                class="bg-primary  text-accent p-2 rounded-circle tw-h-16 tw-w-16 d-flex justify-content-center align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-affiliate-filled" width="24"
                     height="24" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path
                        d="M18.5 3a2.5 2.5 0 1 1 -.912 4.828l-4.556 4.555a5.475 5.475 0 0 1 .936 3.714l2.624 .787a2.5 2.5 0 1 1 -.575 1.916l-2.623 -.788a5.5 5.5 0 0 1 -10.39 -2.29l-.004 -.222l.004 -.221a5.5 5.5 0 0 1 2.984 -4.673l-.788 -2.624a2.498 2.498 0 0 1 -2.194 -2.304l-.006 -.178l.005 -.164a2.5 2.5 0 1 1 4.111 2.071l.787 2.625a5.475 5.475 0 0 1 3.714 .936l4.555 -4.556a2.487 2.487 0 0 1 -.167 -.748l-.005 -.164l.005 -.164a2.5 2.5 0 0 1 2.495 -2.336z"
                        stroke-width="0" fill="currentColor"></path>
                </svg>
            </div>
            <div class="card-text  d-flex justify-content-center align-items-center flex-column mt-4">
                <h5 class="text-center small font-weight-bolder">
                    Water Connections
                </h5>
                <h4>{{ $customerOverview->totalConnections}} </h4>
            </div>
        </div>
        <div
            class="card card-body tw-rounded-lg tw-col-span-2 border">
            <div class="mb-4 d-flex flex-column flex-lg-row justify-content-between align-items-start">
                <div>
                    <h4>@lang('app.operator_overview')</h4>
                    <p class="card-text">
                        @lang('app.billing_overview_by_operators')
                    </p>
                </div>
                <div class="p-2" style="border: 1px dashed silver">
                    Total Balance Due <span class="text-primary font-weight-bold">{{ number_format($operatorData->sum('balance')) }} RWF</span>
                </div>
            </div>

            <div class="list-group list-group-flush mb-3">
                @foreach($operatorData as $item)
                    <div class="list-group-item d-flex flex-column flex-lg-row justify-content-between">
                        <div class="d-flex">
                            <div>
                                <div>{{ $item->request->operator->name }}</div>
                                <div class="text-muted tw-text-sm mt-2">{{ $item->subscription_number }}</div>
                            </div>
                        </div>
                        <div>
                            <div>
                                Balance Due: <span class="text-primary font-weight-bold">{{ number_format($item->balance??0) }} RWF</span>
                            </div>
                            <div class="btn-group btn-group-sm mt-1">
                                @if($item->billings_sum_balance>0)
                                    <a href="" class="btn btn-accent">
                                        Pay {{ number_format($item->billings_sum_balance??0) }}
                                    </a>
                                @endif
                                <a href="{{ route('client.billings', ['search'=>$item->subscription_number]) }}"
                                   class="btn btn-outline-primary">
                                    View Billings
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-between flex-column flex-lg-row tw-gap-2">
                <div>
                    Showing {{ $operatorData->firstItem() }} to {{ $operatorData->lastItem() }}
                    of {{ $operatorData->total() }} entries
                </div>
                <div>
                    {{ $operatorData->links() }}
                </div>
            </div>

        </div>
    </div>

    {{--    <div class="card card-body my-3 tw-rounded-lg">
            <div class="d-flex justify-content-between ">
                <div>
                    <h5 class="card-title">Water Consumption</h5>
                    <p class="card-text">Water consumption for the last 12 months</p>
                </div>
                <div>
                    --}}{{--               filter by operator--}}{{--
                    <select name="" id="" class="form-control">
                        <option value="">All Operators</option>
                        @foreach(myOperators() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <canvas id="waterChart"></canvas>
        </div>--}}



@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const data = [
            {month: 'January', consumption: 100, provider: 'Provider A'},
            {month: 'February', consumption: 120, provider: 'Provider A'},
            {month: 'March', consumption: 80, provider: 'Provider B'},
            // Add more data for the remaining months
        ];

        function formatKMB(num) {
            if (num < 1000) {
                return num.toString();
            } else if (num < 1000000) {
                return (num / 1000).toFixed(1) + 'K';
            } else if (num < 1000000000) {
                return (num / 1000000).toFixed(1) + 'M';
            } else if (num < 1000000000000) {
                return (num / 1000000000).toFixed(1) + 'B';
            } else {
                return (num / 1000000000000).toFixed(1) + 'T';
            }
        }


        $(function () {

            /*    const ctx = document.getElementById('waterChart').getContext('2d');

                let labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                let myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Water Consumption (cubic meters)',
                            data: labels.map(() => Math.floor(Math.random() * 1000)),
                            backgroundColor: 'rgba(3,77,151,0.9)',
                            borderColor: 'rgb(3,77,151)',
                            borderWidth: 3,
                            fill: true,
                            pointBorderWidth: 0,
                            pointRadius: 2,
                            pointBackgroundColor: 'rgba(3,77,151,0.1)',
                            pointBorderColor: 'rgba(3,77,151,0.9)',
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: 'rgba(3,77,151,0.9)',
                            barPercentage: 0.5, // Adjust the width of the bars (0.0 - 1.0)
                            categoryPercentage: 0.7, // Adjust the spacing between bars (0.0 - 1.0)
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true
                                },
                                ticks: {
                                    callback: function (value, index, values) {
                                        return formatKMB(value);
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        },
                        elements: {
                            line: {
                                tension: 0.4,
                            }
                        },
                    },
                });
    */

        });
    </script>
@endsection
