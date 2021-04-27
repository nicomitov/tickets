@component('mail::message')
# Hi there!

Welcome to TODO! <br>
Your account has been created and you're almost ready to use it. <br>
Here's what you need to know:<br>
<ul>
    <li>You can use your email address to login.</li>
    <li>Please, change yor password after login!</li>
    <li>Please, complete your profile after login!</li>
    <li>Any problems, let us know at <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a></li>
</ul>

@component('mail::panel', ['url' => ''])
email: {{ $email }} <br />
password: {{ $password }}
@endcomponent

Please click the button below to verify your email address.

@component('mail::button', ['url' => $verification_url])
Verify Email Address
@endcomponent

Have fun,<br />
{{ config('app.name') }}

@slot('subcopy')
@lang(
    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser: [:actionURL](:actionURL)',
    [
        'actionText' => 'Verify Email Address',
        'actionURL' => $verification_url,
    ]
)
@endslot

@endcomponent
