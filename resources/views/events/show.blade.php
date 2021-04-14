@extends('layouts.main')
@section('content')
   <div class="album text-muted">
     <div class="container">
      @if(Session::has('message'))

      <div class="alert alert-success">{{Session::get('message')}}</div>
      @endif
        @if(Session::has('err_message'))

      <div class="alert alert-danger">{{Session::get('err_message')}}</div>
      @endif
      @if(isset($errors)&&count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>

      @endif

       <div class="row" id="app">
     
           <div class="col-md-8">   
               <br><br><br><br>
                <h1 >Event : {{$event->title}}</h1> 
          </div>
          
        <div class="col-lg-8">
            
          @if (empty($event->picture))
          <img src="{{asset('avatar/01.png')}}" style="width: 100%">
          @else
      <img src="{{'/storage/articles/'.$event->picture}}"
      style="width: 100%">    <br><br>         
          @endif
        </div>
         
          <div class="col-md-8">
            
            
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3"><strong>Description</strong> </h3>
             <p> {{$event->description}}.</p>
              
            </div>
           <br><br>
            </div>
            <div class="col-md-4 p-3 site-section bg-light" style="margin-top: -20px ">
              <h3 class="h5 text-black mb-3 text-center"><strong>Info</strong></h3>
              <p class=" text-center">Date :{{$event->date}}</p>
              <p class=" text-center">Time :{{$event->time}}</p>
              <p class="text-center">Location :{{$event->location}}</p>
            <p class="text-center">Price :{{$event->price}}TND</p>
           
              <p>
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
              </p>
            </div>
           
                        
               <div class="col-lg-8">
                <hr>
                <h3 class="h5 text-black mb-3">Comments</h3>
                @forelse ($event->comments as $comment)
                <div class="card mb-2">
                   <div class="card-body">
                    <strong>{{ $comment->user->name }}</strong><br>
                        {{ $comment->content }}
                        <div class=" d-flex justify-content-between align-items-center">
                          <br>
                        <small class="badge badge-secondary"> Posted {{ $comment->created_at->format('d/m/Y') }}</small>
                        
                        </div>
                     </div>
                </div>
                @empty
                            <div class="alert alert-info">No Comments!</div>
                 @endforelse
                

                <form action="{{ route('comments.store', $event) }}" method="POST" class="mt-3">
                @csrf
                <div class="form-group">
                                <label for="content">Your Comment</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="2"></textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                                @enderror
                            </div>
                 @if (Auth::check())
                 <button type="submit" class="btn btn-secondary  float-right"> Post </button><br><br>
                 @else 
                 <button type="submit" class="btn btn-secondary  float-right" disabled> Post </button><br><br>
                 @endif
                </form>

              </div>
              <div class="col-md-4">
              </div>
              <div class="col-md-12">
                <br><br>
                <p style="font-size: 150%"> <strong> Recommendations </p></strong>
              </div>
              @foreach($eventRecommendations as $eventRecommendation)
              <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <p class="badge badge-success">{{$eventRecommendation->location}}</p>
                  <p class="badge badge-success">{{$eventRecommendation->date}}</p>
                  <h5 class="card-title"><strong>{{$eventRecommendation->title}}</strong> </h5>
                  <p class="card-text">{{$eventRecommendation->description}}
                 <center> <a href="{{route('events.show',[$eventRecommendation->id,$eventRecommendation->title])}}" class="btn btn-secondary">check</a></center>
                </div>
              
              </div>
              @endforeach
              <div class="col-md-12">
                <br><br>
              </div>

  </div>


          



</div>

     </div>
   
@endsection
