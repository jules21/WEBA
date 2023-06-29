<div class="card mb-3">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4 class="my-4">Review</h4>
                <form
                        action="{{ route('admin.requests.reviews.save',encryptId($request->id)) }}"
                        method="post" id="formSaveReview">
                    @csrf
                    <div class="form-group row">
                        <label for="status" class="col-md-3 col-form-label">Status: <x-required-sign/></label>
                        <div class="col-md-9">
                            <select name="status" id="status" class="form-control">
                                <option value="">Select Status</option>
                                @foreach($request->getApprovalStatuses() as $item)
                                    <option value="{{$item}}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="comment" class="col-md-3 col-form-label">Comment: <x-required-sign/></label>
                        <div class="col-md-9">
                                                <textarea class="form-control" name="comment" id="comment" cols="30"
                                                          rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                            <button type="submit" class="btn btn-primary">
                                                <span class="svg-icon">
                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                      stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                  <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                </span>
                                Submit Review
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
