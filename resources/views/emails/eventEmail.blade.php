@component('mail::message')


Hi {{$data['friend_name']}}, {{$data['your_name']}}({{$data['your_email']}})
has refered you this event.

@component('mail::button', ['url' => $data['eventUrl']])
View Event
@endcomponent

Thanks,<br>

@endcomponent
