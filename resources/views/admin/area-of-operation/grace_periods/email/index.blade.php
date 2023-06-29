@component('mail::message')
# Dear {{ $contactPersonName }},

The grace period has been updated to **{{ $days }} days** , and the validity of your {{$type}} is set from {{ $fromDate }} to **{{ $validTo }}**.

Best regards, <br>
{{ config('app.name') }}
@component('mail::button', ['url' => 'http://cms.orionsys.io/'])
Visit WFP
@endcomponent

@endcomponent

