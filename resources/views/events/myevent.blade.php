@extends('layouts.main')
@section('content')


<div class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-10 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
        
            <table class="table">
                @if (Session::has('message'))
                <div class="alert alert-success ms"> {{Session::get('message')}} </div>               
                @endif 
                <thead><br>
                    <th><a href="{{route('event.create')}}">
                        <button class="btn btn-dark py-2 px-3" > Post Event </button></a></th>
                        <br>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($event as $event)
                    <tr>
                        <td>@if (empty($event->picture))
                            <img src="{{asset('avatar/01.png')}}" width="200">
                           @else
                        <img src="{{'/storage/articles/'.$event->picture}}"
                         width="200">             
                            @endif</td>
                        <td>Title: {{$event->title}} </td>
                        <td><i class="fas fa-map-marker-alt"></i> Location : {{$event->location}}  </td>
                        <td><i class="far fa-calendar-alt"></i> Date : {{$event->date}}</td>
                        <td>
                        <a href="{{route('events.show', [$event->id, $event->title])}}">
                    <button class="btn btn-secondary btn-m mb-1"style="width: 90%">Check</button></a>
                    <br> <a href="{{route('event.edit',[$event->id])}}"><button class="btn btn-secondary btn-m mb-1" 
                        style="width: 90%">Edit</button></a>
                    <br> <a href="{{route('event.delete',[$event->id])}}"> 
                        <button class="btn btn-danger btn-m mb-1"style="width: 90%" >Delete</button></a>
                        </td>
                    </tr>   
                    @endforeach
                </tbody>
               </table>
            </div>
        
       </div>

    </div>
</div>

@endsection

