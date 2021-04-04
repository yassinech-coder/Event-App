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
          
        <div class="col-md-12">
            
          @if (empty($event->picture))
          <img src="{{asset('avatar/01.png')}}" style="width: 100%">
          @else
      <img src="{{'/storage/articles/'.$event->picture}}"
      style="width: 100%">    <br><br>         
          @endif
        </div>
          <div class="col-lg-8">
            
            
            <div class="p-4 mb-8 bg-white">
              <h3 class="h5 text-black mb-3"><strong>Description</strong> </h3>
             <p> {{$event->description}}.</p>
              
            </div>
           
            </div>
           
            <div class="col-md-4 p-4 site-section bg-light">
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
          </div>

          



</div>

     </div>
   
@endsection
