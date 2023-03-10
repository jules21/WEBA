@extends('layouts.master')
@section('title',"Purchase details")

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
                        <a href="{{ route('admin.purchases.index') }}" class="text-muted">
                            Purchases
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="text-muted">
                            Purchase Details
                        </span>
                    </li>
                </ul>
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">
              <span class="badge badge-{{$purchase->status_color}} rounded-pill">
                  {{ $purchase->status }}
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
                <div class="row">
                    <div class="col-lg-4">
                        {{--                        supplier name --}}
                        <strong class="d-block">Supplier:</strong>
                        <input readonly value=" {{ $purchase->supplier->name }}" class="form-control-plaintext"/>
                    </div>
                    <div class="col-lg-4">
                        {{--                        supplier name --}}
                        <strong class="d-block">Items:</strong>
                        <input readonly value=" {{ $purchase->movements()->count()}}" class="form-control-plaintext"/>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <strong class="d-block">Sub Total:</strong>
                        <input readonly value=" {{ number_format($purchase->subtotal) }}"
                               class="form-control-plaintext"/>
                    </div>
                    <div class="col-lg-4">
                        <strong class="d-block">VAT Amount:</strong>
                        <input readonly value=" {{ number_format($purchase->tax_amount) }}"
                               class="form-control-plaintext"/>
                    </div>
                    <div class="col-lg-4">
                        <strong class="d-block">Total:</strong>
                        <input readonly value=" {{ number_format($purchase->total) }}" class="form-control-plaintext"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <strong class="d-block">Description:</strong>
                        <p readonly class="form-control-plaintext">{{ $purchase->description }}</p>
                    </div>
                </div>

                <h6>
                    Items
                </h6>

                <table class="table table-head-custom table-head-solid border">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Sub Total</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="3" class="text-right font-weight-bolder">Sub Total:</td>
                        <td>{{ number_format($purchase->subtotal) }}</td>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($purchase->movements as $item)
                        <tr>
                            <td>{{ $item->item->name }}</td>
                            <td>{{ $item->qty_in }}</td>
                            <td>{{ number_format($item->unit_price) }}</td>
                            <td>{{ number_format($item->total) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


                {{--                review form--}}

                @if( $purchase->canBeReviewed())

                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h4 class="text-center my-4">
                                Review
                            </h4>

                            <form action="{{ route("admin.purchases.submit-review",encryptId($purchase->id)) }}"
                                  method="post" id="formSaveReview">
                                @csrf
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Mark Purchase As</option>
                                        @foreach($purchase->getApprovalStatuses() as $item)
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
                            No reviews yet for this Purchase
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
                                No flow history yet for this Purchase
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

@endsection

@section('scripts')

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.min.js')}}"></script>
    {!! JsValidator::formRequest(App\Http\Requests\ValidateReviewRequest::class,'#formSaveReview') !!}

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


        });
    </script>
@endsection