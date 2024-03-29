@extends('layouts.main')
@section('content')


<div class="site-section bg-light">
    <div class="container">
        <br>
      <div class="row justify-content-center">
          
          <div class="col-md-10 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
            @foreach($events as $event)
            <div class="card" style="margin-bottom: 7px">
                <div class="card-header"><i class="fas fa-external-link-alt "style="font-size: 75%"></i> <a href="{{route('events.show', [$event->id, $event->title])}}" style="color: rgb(0, 0, 0); font-weight:bold" >
                {{$event->title}} </a></div>

                <div class="card-body">
                   {{$event->description}}
                </div>
                <div class="card-footer">
                  <span class="float-right">  {{$event->date}}</span></div>
            </div>
            @endforeach
            
            </div>
        
       </div>

    </div>
</div>

@endsection

