@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
               
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th><a href="{{route('event.create')}}">
                                <button class="btn btn-secondary"> Post Event </button></a></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($event as $event)
                            <tr>
                                <td><img src="{{asset('avatar/01.png')}}" width="200"></td>
                                <td>Title: {{$event->title}} </td>
                                <td><i class="fas fa-map-marker-alt"></i> Location : {{$event->location}}  </td>
                                <td><i class="far fa-calendar-alt"></i> Date : {{$event->date}}</td>
                                <td>
                                <a href="{{route('events.show', [$event->id, $event->description])}}">
                            <button class="btn btn-outline-secondary btn-m mb-1"style="width: 83%">Check</button></a>
                            <br> <a href="{{route('event.edit',[$event->id])}}"><button class="btn btn-outline-secondary btn-m mb-1" 
                                style="width: 83%">Edit</button></a>
                            <br> <a href=""> <button class="btn btn-danger btn-m mb-1"style="width: 83%" >Delete</button></a>

                                </td>
                            </tr>   
                            @endforeach
                        </tbody>
                       </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
