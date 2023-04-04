@extends('layouts.master')
@section('title',"Stock Adjustment details")

@section('content')
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    Details
                </h5>

                <!--end::Page Title-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">
                            Home
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.stock.adjustments.index') }}" class="text-muted">
                            Stock Adjustments
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                            Stock Adjustment Details
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">
              <span class="badge badge-{{$adjustment->status_color}} rounded-pill">
                  {{ $adjustment->status }}
              </span>
            </div>

            <!--end::Toolbar-->
        </div>
    </div>
    <div class="card card-body">
        <ul class="nav nav-light-primary nav-pills" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link font-weight-bolder active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                   aria-controls="home"
                   aria-selected="true">
                    <i class="flaticon2-layers mr-2"></i>
                    Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bolder" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                   aria-controls="profile" aria-selected="false">
                    <i class="flaticon2-heart-rate-monitor mr-2"></i>
                    Reviews
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bolder" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                   aria-controls="contact" aria-selected="false">
                    <i class="flaticon2-time mr-2"></i>
                    Flow History
                </a>
            </li>
        </ul>
        <div class="tab-content  mt-5" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <div class="card card-body mb-3">
                    <div class="row">
                        <div class="col-12">
                            <strong class="d-block">Description:</strong>
                            <p readonly class="form-control-plaintext">{{ $adjustment->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="card card-body mb-3">
                    <div class="p-3 mb-3">
                        @if($adjustment->status == App\models\Adjustment::PENDING)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Items</h5>
                                <button type="button" class="btn btn-sm rounded btn-primary" id="addBtn">
                                    <i class="flaticon2-add"></i>
                                    Add Item
                                </button>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table border dataTable rounded table-head-solid table-head-custom" id="">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right font-weight-bold">Total:</td>
                                    <td class="font-weight-bolder">
                                        RWF
                                        <span id="total">{{ number_format($adjustment->items->sum('total')) }}</span>
                                    </td>
                                    <td></td>
                                </tfoot>
                                <tbody>

                                @forelse($adjustment->items as $item)
                                    <tr>
                                        <td>{{ $item->item->name }}</td>
                                        <td>
                                            @if($item->adjustment_type == 'decrease')
                                                <span class="text-danger">-{{ $item->quantity }}</span>
                                            @else
                                                <span class="text-success">+{{ $item->quantity }}</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($item->unit_price) }}</td>
                                        <td>RWF {{ number_format($item->total) }}</td>
                                        <td>
                                            @if($adjustment->status == \App\Models\Adjustment::PENDING)
                                                <button
                                                    data-id="{{ $item->id }}"
                                                    data-quantity="{{ $item->quantity }}"
                                                    data-unit_price="{{ $item->unit_price }}"
                                                    data-item_id="{{ $item->item_id }}"
                                                    data-adjustment_type="{{ $item->adjustment_type }}"
                                                    class="btn btn-sm btn-light-primary btn-icon rounded-circle js-edit">
                                                    <i class="flaticon2-edit"></i>
                                                </button>
                                                <button type="button"
                                                        data-href="{{ route('admin.stock.stock-adjustments.items.remove',[encryptId($adjustment->id),encryptId($item->id)]) }}"
                                                        class="btn btn-sm btn-light-danger btn-icon rounded-circle js-delete">
                                                    <i class="flaticon2-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                @empty
                                        <tr>
                                             <td colspan="5">
                                                 <div class="alert alert-light-info alert-custom py-1">
                                                     <div class="alert-icon">
                                                         <i class="flaticon2-exclamation"></i>
                                                     </div>
                                                     <div class="alert-text">
                                                         No items found, please add some items.
                                                     </div>
                                                 </div>
                                             </td>
                                         </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

{{--                submit--}}
                @if($adjustment->canBeSubmitted())
                    <div class="row justify-content-end mr-1">
                        <a class="btn btn-primary btn-lg submitBtn" href="{{ route("admin.stock.stock-adjustments.submit",encryptId($adjustment->id)) }}">
                            <i class="fas fa-check-circle"></i>
                            Submit</a>
                    </div>
                @endif

                {{--                review form--}}

                @if( $adjustment->canBeReviewed())
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h4 class="text-center my-4">
                                Review
                            </h4>

                            <form action="{{ route("admin.stock.stock-adjustments.review",encryptId($adjustment->id)) }}"
                                  method="post" id="formSaveReview">
                                @csrf
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Mark Stock Adjustment As</option>
                                        @foreach($adjustment->getApprovalStatuses() as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class=" form-group">
                                    <label for="comment">Description:</label>
                                    <textarea name="comment" id="comment" rows="5"
                                              class="form-control"></textarea>
                                </div>

                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit">
                                        <span class="svg-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-circle-check" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"
                                                 fill="none" stroke-linecap="round"
                                                 stroke-linejoin="round">
                                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                               <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                               <path d="M9 12l2 2l4 -4"></path>
                                            </svg>
                                        </span>
                                        Submit Review
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                @endif

            </div>

            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="home-tab">
                @if($reviews->count() == 0)
                    <div class="alert alert-light-info alert-custom ">
                        <div class="alert-icon text-info">
                            <i class="flaticon2-exclamation"></i>
                        </div>
                        <div class="alert-text">
                            No reviews yet for this Stock Adjustment
                        </div>
                    </div>

                @else
                    <div class="timeline timeline-justified timeline-4">
                        <div class="timeline-bar"></div>
                        <div class="timeline-items">
                            @foreach($reviews as $item)
                                <div class="timeline-item">
                                    <div class="timeline-badge">
                                        <div class="bg-{{$item->status_color}}"></div>
                                    </div>

                                    <div class="timeline-label">
                                        <span class="text-primary font-weight-bold">
                                            {{ $item->user->name }}
                                        </span>
                                        <span class="ml-2">
                                            {{ $item->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <div class="timeline-content">
                                        {{ $item->comment }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
            <div class="tab-pane fade  " id="contact" role="tabpanel" aria-labelledby="home-tab">
                <div class="card card-body">
                    @if($flowHistories->count()==0)
                        <div class="alert alert-light-info alert-custom ">
                            <div class="alert-icon text-info">
                                <i class="flaticon2-exclamation"></i>
                            </div>
                            <div class="alert-text">
                                No flow history yet for this Stock Adjustment
                            </div>
                        </div>
                    @else
                        <div class="timeline timeline-6 mt-3">
                            @foreach($flowHistories as $item)
                                <!--begin::Item-->
                                <div class="timeline-item align-items-start">
                                    <!--begin::Label-->
                                    <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">
                                        {{ $item->created_at->format('h:i A') }}
                                    </div>
                                    <!--end::Label-->

                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-{{ $item->status_color }} icon-xl"></i>
                                    </div>
                                    <!--end::Badge-->

                                    <!--begin::Text-->
                                    <div class="font-weight-mormal font-size-lg timeline-content pl-3">
                                    <span class="text-muted font-weight-bolder">
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                        <p>
                                            {{ $item->comment }}
                                        </p>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Item</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        &times;
                    </button>
                </div>
                <form action="{{ route('admin.stock.stock-adjustments.items.add',encryptId($adjustment->id)) }}" method="post"
                      id="saveItemForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="item_id">Item</label>
                            <select name="item_id" id="item_id" class="form-control select2"
                                    style="width: 100% !important;">
                                <option value="">Select Item</option>
                                @foreach($stock as $record)
                                    <option value="{{$record->item_id}}">{{optional($record->item)->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{$record->quantity}}"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Adjustment Type</label>
                            <select name="adjustment_type" id="adjustment-type" class="form-control select2"
                                    style="width: 100% !important;">
                                <option value="">Select Type</option>
                                <option value="increase">In</option>
                                <option value="decrease">Out</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="unit_price">Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control"/>
                        </div>


                    </div>
                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\ValidateReviewRequest::class,'#formSaveReview') !!}
    {!! JsValidator::formRequest(App\Http\Requests\ValidateAdjustmentItemRequest::class,'#saveItemForm') !!}

    <script>
        $(document).ready(function () {


            $('#formSaveReview').on('submit', function (e) {
                e.preventDefault();

                let $form = $(this);

                if (!$form.valid())
                    return false;

                let btn = $form.find('[type="submit"]');

                btn.addClass('spinner spinner-white spinner-right')
                    .prop('disabled', true);

                // submit form here
                e.target.submit();

            });


            $('#datatable').DataTable();
        })
        $('#addBtn').on('click', function () {
            $('#addModal').modal('show');
        });
        $('#submitBtn').on('click', function (e){
            e.preventDefault();
            const url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $('#submitBtn').prop('disabled', true)
                    $('#submitBtn').html('<i class="fa fa-spinner fa-spin"></i> Submitting...');
                    //redirect to the url
                    window.location.replace(url);
                }
            });
        })
        $(document).on('click', '.js-edit', function () {
            let $itemId = $('#item_id');
            $itemId.val($(this).data('item_id'));
            $('#quantity').val($(this).data('quantity'));
            $('#unit_price').val($(this).data('unit_price'));
            $('#adjustment-type').val($(this).data('adjustment_type')).trigger('change');
            $itemId.trigger('change');
            $('#addModal').modal('show');
        });
        $(document).on('click', '.js-delete', function (e) {
            e.preventDefault();

            let $this = $(this);
            let url = $this.data('href');


            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $this.prop('disabled', true)
                        .addClass('spinner spinner-white spinner-right');
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        complete: function () {
                            $this.prop('disabled', false)
                                .removeClass('spinner spinner-white spinner-right');
                        },
                        success: function (response) {
                            location.reload();
                        },
                        error: function (xhr) {
                            console.log(xhr);
                            Swal.fire(
                                'Error!',
                                "Unable to delete item, please try again later",
                                'error'
                            );
                        }
                    });
                }
            });

        });
    </script>
@endsection
