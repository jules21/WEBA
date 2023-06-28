@component('mail::message')
![Logo]({{ asset('images/logo.png')}})
# Hello {{ $user->name }},

We are excited to inform you that you have been created as an Admin for the operator "{{ $user->operator->name }}". This new role grants you additional privileges and access to manage the operator's operations.

Here are your login details:

- Username:{{$user->email }}
- Password:{{ $password }}

To access your Admin account, please visit the following link:

@component('mail::button', ['url' => $loginUrl,'color' => 'blue'])
    Login to your account
@endcomponent
Please remember to keep your login credentials confidential and avoid sharing them with anyone else.

Please also remember to change your password after logging in for the first time.

If you have any questions or need assistance, feel free to reach out to our support team.

Thank you!

Best regards,
{{ config('app.name') }}
@endcomponent
