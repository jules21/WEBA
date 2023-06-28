<!DOCTYPE html>
<html>
<head>
    <title>Grace Period Update</title>
</head>
<body>
<h2>Grace Period and Validity Update</h2>
<p>Dear {{ $contactPerson }},</p>
<p>The grace period has been updated to {{ $days }} days, and the validity of your operation area is set until {{ $validTo }}.</p>
<p>Kind regards,</p>
<p>{{ config('app.name') }}</p>
</body>
</html>



{{--@component('mail::message')--}}
{{--    # Dear {{ $contactPerson }},--}}

{{--    The grace period has been updated to {{ $days }} days, and the validity of your operation area is set until {{ $validTo }}.--}}

{{--    @component('mail::button', ['url' => 'http://wfp.orionsys.io/'])--}}
{{--        Visit Water for people--}}
{{--    @endcomponent--}}

{{--    Best regards,--}}
{{--    {{ config('app.name') }}--}}
{{--@endcomponent--}}

