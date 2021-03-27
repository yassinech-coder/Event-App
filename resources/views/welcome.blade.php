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
                    <td>@if (empty($event->picture))
                        <img src="{{asset('avatar/01.png')}}" width="200">
                       @else
                             <img src="{{'storage/articles/'.$event->picture}}"
                             width="200">             
                        @endif</td>
                    <td>Title: {{$event->title}} </td>
                    <td><i class="fas fa-map-marker-alt"></i> Location : {{$event->location}}  </td>
                    <td><i class="far fa-calendar-alt"></i> Date : {{$event->date}}</td>
                    <td>
                        <a href="{{route('events.show', [$event->id, $event->title])}}">
                        <button class="btn btn-secondary btn-m float-right">Check</button></a>
                    </td>
                </tr>
                @endforeach
                   
            </tbody>
        </table>
        </div>
           
                <div>
                <a href="{{route('allevents')}}"><button class="btn btn-outline-secondary btn-lg" style="width: 100%">All Events</button></a>
            </div>
           
        
    
</div>
@endsection
