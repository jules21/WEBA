
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">

    <div class="dropdown">
        <button class="btn btn-light-primary rounded-lg btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Options
        </button>
        <div class="dropdown-menu border">
            <a class="dropdown-item" href="{{route('admin.operator.grace.period.detail',$item)}}">
                <i class="fas flaticon-information"></i>
                <span class="ml-2">Details</span>
            </a>
            <a class="dropdown-item js-edit" href="#" data-fname="" data-date=""
               data-id="{{$item->id}}"
               data-status="{{$item->status}}">
                <i class="fas fa-closed-captioning"></i>
                <span class="ml-2">Cancel</span>
            </a>
        </div>
    </div>

</div>



