<div class=" card card-body mb-4  tw-shadow-sm border tw-border-gray-300">
    <form autocomplete="off" action="{{ route('admin.requests.index') }}">

        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="start_date">From Date</label>
                    <input type="date" class="form-control rounded-sm"
                           placeholder="Start Date" value="{{ request('start_date') }}"
                           id="start_date" name="start_date"/>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="end_date">To Date</label>
                    <input type="date" class="form-control rounded-sm"
                           placeholder="End Date" value="{{ request('end_date') }}"
                           id="start_date" name="end_date"/>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="district_id">District</label>
                    <select name="district_id" id="district_id"
                            class="form-control rounded-sm select2">
                        <option value="">All</option>
                        @foreach(\App\Models\District::query()->get()  as $district)
                            <option value="{{ $district->id }}"
                                {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                {{ $district->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="operator_id">Operator</label>
                    <select name="operator_id" id="operator_id"
                            class="form-control rounded-sm select2">
                        <option value="">All</option>
                        @foreach(\App\Models\Operator::query()->get()  as $item)
                            <option value="{{ $item->id }}"
                                {{ request('operator_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="operation_area_id">Operation Areas</label>
                    <select name="operation_area_id" id="operation_area_id"
                            class="form-control rounded-sm select2">
                        <option value="">All</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <div class="btn-group">
                <button type="submit"
                        class="btn btn-primary  mr-3 font-weight-bolder border-0  rounded">
                    <i class="la la-search"></i>
                    Filter
                </button>
                <a href="{{ route('admin.requests.index') }}"
                   class="btn btn-outline-dark font-weight-bolder rounded">
                    Clear Search
                </a>
            </div>

            <a href="{{ route('admin.requests.export-data-to-excel',['start_date'=>request('start_date'),'end_date'=>request('end_date'),'district_id'=>request('district_id'),'operator_id'=>request('operator_id'),'operation_area_id'=>request('operation_area_id')]) }}"
               target="_blank"
               class="btn btn-light-primary font-weight-bolder border-0  rounded">
                <i class="la la-download"></i>
                Export
            </a>
        </div>
    </form>
</div>
