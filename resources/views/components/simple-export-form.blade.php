<form
      {{ $attributes->class(['form-inline']) }} autocomplete="off"
      target="_blank">
    <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 w-100 w-lg-150px datepicker rounded-sm"
           placeholder="Start Date" value="{{ request('start_date') }}"
           id="start_date" name="start_date"/>
    <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 w-100 w-lg-150px datepicker rounded-sm"
           placeholder="End Date" value="{{ request('end_date') }}" id="end_date"
           name="end_date"/>

    <div class="btn-group btn-group-sm">
        <button type="button" id="btnLoadData"
                class="btn btn-primary mb-2 mr-3 rounded-sm font-weight-bolder border-0">
            <i class="la la-refresh"></i>
            Reload
        </button>
        <button type="submit" class="btn btn-light-success mb-2 font-weight-bolder rounded-sm">
            Export
            <i class="la la-file-export"></i>
        </button>
    </div>
</form>
