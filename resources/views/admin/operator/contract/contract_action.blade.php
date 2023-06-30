
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">

    <div class="dropdown">
        <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Options
        </button>

        <div class="dropdown-menu border">

            <a class="dropdown-item" href="{{route('admin.operator.grace.periods.index',['contract_id'=>encryptId($item->id)])}}">
                <i class="fas fa-hand-holding"></i>
                <span class="ml-2">Grace Period</span>
            </a>

            <a class="dropdown-item js-edit" href="#" data-fname="" data-date=""
               data-id="{{$item->id}}"
               data-operation-area="{{$item->operation_area_id}}"
               data-status="{{$item->status}}"
               data-start-date="{{$item->start_date}}"
               data-end-date="{{$item->start_date}}">
                <i class="fas fa-edit"></i>
                <span class="ml-2">Edit</span>
            </a>

            <a class="dropdown-item js-delete" href="{{route('admin.operator.contract.delete',$item->id)}}">
                <i class="fas fa-trash"></i>
                <span class="ml-2">Delete</span>
            </a>
        </div>
    </div>

</div>



