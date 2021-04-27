@component('mail::message')
# Hi there!

<p><strong>"{{ $subject }}"</strong> has been {{ $action }}.</p>

@component('mail::panel')
Type: {{ $entry_type }} <br>
{{ ucfirst($action) }} by: {{ $author }} <br>
Date: {{ $date->format('j-M-Y, H:i') }} <br>
@endcomponent

@component('mail::button', ['url' => $url])
View
@endcomponent

@slot('subcopy')
Have fun,<br>
{{ config('app.name') }}
@endslot

@endcomponent
