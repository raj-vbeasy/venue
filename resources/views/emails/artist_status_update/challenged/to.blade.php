@component('mail::message')
# Dear {{ $content['artist']['agent'] }}

{{ $content['artist']['name'] }} is currently in the first Hold Position (H1) and has been challenged by the second hold position (H2).<br/>
You have {{ $content['challenge_expiration_hours'] }} business hours to 1) request and Offer or 2) release the date to perform on the {{ $content['event']['date'] }} at the {{ $content['event']['name'] }}.<br/>
If you would like to explore Mutually Agreeable Dates for Future Consideration please check the yes box below and let us know any details.<br/>

<h4>Summary:</h4>
-Artist Name: {{ $content['artist']['name'] }}<br/>
-Event Name: {{ $content['event']['name'] }}<br/>
-Location: {{ $content['location']['name'] }}<br/>
-Status: {{ $content['artist']['status'] }}<br/>
-Hold Position: {{ $content['artist']['hold_position'] }}<br/>

Please notify us of any changes in availability as soon as possible.

@component('mail::button', ['url' => $content['url']])
    Select Date
@endcomponent

Thank you,<br/>
{{ $content['admin']['name'] }}<br/>
{{ config('app.name') }}<br/>
E: {{ $content['admin']['email'] }}
@endcomponent