{{--@component('mail::message', ['data' =>$data])--}}
{{--    # Hello,--}}
{{--    ### {{$data['name']}}--}}
{{--    Welcome to WFP--}}

{{--    Your Password is **{{$data['password']}}**--}}
{{--    please follow the link below to login--}}
{{--    @component('mail::button', ['url' =>url('/').'/login','color' => 'green'])--}}
{{--        Login--}}
{{--    @endcomponent--}}
{{--    Thanks,<br>--}}
{{--    {{ config('app.name') }}--}}
{{--@endcomponent--}}


@component('mail::message', ['data' =>$data])
        # Hello,

    The body of your message.

    @component('mail::button', ['url' => $details['url']])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
