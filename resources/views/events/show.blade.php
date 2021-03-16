@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $event->title }}</div>
                

                <div class="card-body">
                    <h3>Description</h3>
                    <p>{{$event->description}}</p>
                 
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Info') }}</div>

                <div class="card-body">
                    <h5>Location</h5>
                    <p>{{$event->location}}</p>
                    <h5>Date</h5>
                    <p>{{$event->date}}</p>
                    <h5>Price</h5>
                    <p>{{$event->price}}TND</p>
                 
                </div>
            </div>
            <br>
            @if (Auth::check()&&Auth::user()->user_type='user')
            <button class="btn btn-success btn-m" style="width: 100%">Participate</button>
            @endif
        </div>

        </div>
    </div>
</div>
@endsection
