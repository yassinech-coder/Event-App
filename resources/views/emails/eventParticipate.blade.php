@component('mail::message')


Hi {{$data['friend_name']}}, You have just participated to <strong> {{$data['event_title']}} </strong> !
and this is your code!!

@component('mail::button', ['url' => $data['eventUrl']])
View Event
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent