@extends('client.layout.auth')
@section('title',"Issues Reported")
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-report" width="32"
                 height="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                 stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path>
                <path d="M12 8l0 3"></path>
                <path d="M12 14l0 .01"></path>
            </svg>
            Reported Issues
        </h5>
        <button class="btn btn-primary" type="button" id="addNewBtn">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-2-plus" width="24"
                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                 stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M8 9h8"></path>
                <path d="M8 13h6"></path>
                <path d="M12.5 20.5l-.5 .5l-3 -3h-3a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v5.5"></path>
                <path d="M16 19h6"></path>
                <path d="M19 16v6"></path>
            </svg>
            Report Issue
        </button>
    </div>

    <p class="text-muted my-3">
        View all reported issues and their solutions here, you can also report an issue by clicking on the
        button above.
    </p>

    <livewire:client.issues-reported/>

    <!-- Modal -->
    <div class="modal fade" id="newIssueModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Report an Issue
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('client.client-issues.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="operator_id">
                                Operator
                            </label>
                            <select name="operator_id" id="operator_id" class="form-control">
                                <option value="">Select Operator</option>
                                @foreach($operators as $operator)
                                    <option value="{{$operator->id}}">{{$operator->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="operation_area_id">
                                Operation Area
                            </label>
                            <select name="operation_area_id" id="operation_area_id" class="form-control">
                                <option value="">Select Operation Area</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Issue</label>
                            <input type="text" name="title" id="title" cols="30" rows="5" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5"
                                      placeholder="Describe the issue here"
                                      class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary">
                            Submit Issue
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(\App\Http\Requests\StoreIssueRequest::class) !!}

    <script>
        let operators = @json($operators);
        console.log(operators);

        $(function () {
            $('#addNewBtn').on('click', function () {
                $('#newIssueModal').modal();
            });

            $('#operator_id').on('change', function () {
                let operatorId = $(this).val();
                let operationAreaSelect = $('#operation_area_id');
                operationAreaSelect.empty();
                operationAreaSelect.append('<option value="">Select Operation Area</option>');
                let selectedOperator = operators.find(operator => operator.id === parseInt(operatorId));

                let operatingAreas = selectedOperator.operation_areas;

                let filteredRecords = operatingAreas
                    .filter(operator => operator.operator_id === selectedOperator.id);

                filteredRecords
                    .forEach(operationArea => {
                        operationAreaSelect.append(`<option value="${operationArea.id}">${operationArea.name}</option>`);
                    });
            });
        })
    </script>

@endsection
