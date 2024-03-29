@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3><strong>Title : {{ $event->title }} </strong></h3> </div>
                @if (empty($event->picture))
                <img src="{{asset('avatar/01.png')}}" style="width: 100%">
                @else
            <img src="{{'/storage/articles/'.$event->picture}}"
            style="width: 100%">             
                @endif
                <div class="card-body">
                    <h3><strong>Description</strong></h3>
                    <p>{{$event->description}}</p>
                 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <br><br>   
            <div class="card">
                
                <div class="card-header"><h3><strong>{{ __('info') }}</strong></h3></div>

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
            
            @if (empty(Auth::user()->user_type))
            <button type="submit" class="btn btn-success btn-m" style="width: 100%" disabled>Participate</button>

          @else @if (Auth::user()->user_type=='user')
                    @if (!$event->checkParticipation())                        
                       <participate-component eventid="{{$event->id}}"></participate-component>
                       @else <button class="alert alert-success btn-m" style="width: 100%" disabled> Participated Successfully! </button>

                    @endif
            <favourite-component eventid="{{$event->id}}":fav = "{{$event->checkFavourite()?'true':'false'}}"></favourite-component>
                @endif
            @endif
            
        
         
            </div>
        </div>
    </div>
    
</div>

@endsection
