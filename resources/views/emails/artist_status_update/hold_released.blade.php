@component('mail::message')
# Dear {{ $content['artist']['agent'] }},

Thank you for the rapid response letting us know that {{ $content['artist']['name'] }} is officially Releasing the Hold Position {{ $content['artist']['hold_position'] }} at the {{ $content['event']['name'] }} on {{ $content['event']['date'] }}.<br/>
If you would like to explore Mutually Agreeable Dates for Future Consideration. please check below button.

<h4>Summary:</h4>
-Artist Name: {{ $content['artist']['name'] }}<br/>
-Event Name: {{ $content['event']['name'] }}<br/>
-Location: {{ $content['location']['name'] }}<br/>

@component('mail::button', ['url' => $content['url']])
    Select Date
@endcomponent

Thank you,<br/>
{{ $content['admin']['name'] }}<br/>
{{ config('app.name') }}<br/>
E: {{ $content['admin']['email'] }}
@endcomponent