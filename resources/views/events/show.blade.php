@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $event->title }}</div>
                <img src="{{asset('avatar/01.png')}}" style="width: 100%">
                <div class="card-body">
                    <h3>Description</h3>
                    <p>{{$event->description}}</p>
                 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <br><br>   
            <div class="card">
                
                <div class="card-header">{{ __('Info') }}</div>

                <div class="card-body">
                    <h5>Location</h5>
                    <p>{{$event->location}}</p>
                    <h5>Date</h5>
                    <p>{{$event->date}}</p>
                    <h5>Time</h5>
                    <p>{{$event->time}}</p>
                    <h5>Price</h5>
                    <p>{{$event->price}}TND</p>
                 
                </div>
            </div>
            <br>
            @if (Auth::user()->user_type=='user')
            @if (!$event->checkParticipation())
            <form action="{{route('participate',[$event->id])}}" method="POST">@csrf
            <button type="submit" class="btn btn-success btn-m" style="width: 100%">Participate</button>
        </form>
            
        @else
        <button type="submit" class="btn btn-success btn-m" style="width: 100%" disabled>Participated</button>
        @endif
            
            @endif
            @if (Session::has('message'))
            <div class="alert alert-success ms"> {{Session::get('message')}} </div>               
            @endif  
        </div>

        </div>
    </div>
</div>
@endsection
