@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Recent Events</h1>
        <table class="table">
            <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($events as $event)
                <tr>
                    <td>@if (empty(Auth::user()->events->picture))
                        <img src="{{asset('avatar/01.png')}}" width="200">
                       @else
                             <img src="{{asset('public/pictures')}}/{{Auth::user()->events->picture}}"
                             width="200">             
                        @endif</td>
                    <td>Title: {{$event->title}} </td>
                    <td><i class="fas fa-map-marker-alt"></i> Location : {{$event->location}}  </td>
                    <td><i class="far fa-calendar-alt"></i> Date : {{$event->date}}</td>
                    <td>
                        <a href="{{route('events.show', [$event->id, $event->description])}}">
                        <button class="btn btn-success btn-m">Check</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        
    </div>
</div>
@endsection
