<!DOCTYPE html>
<html lang="en">
  <head>
    <title>EventApp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   @include('parts.header')
    
  </head>
  <body>
  
  @include('parts.nav')
  @include('parts.searchbg')
  @include('parts.category')
   
    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-11 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
            <table class="table">
              <h2 class="mb-5 h3">Recent Events</h2>
              <thead>
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
                      <button class="btn btn-secondary rounded py-2 px-3 float-right">Check</button></a>
                  </td>
              </tr>
              @endforeach
                 
          </tbody>
        </table>

            <div class="col-md-12 text-center mt-5">
              <a href="{{route('allevents')}}" class="btn btn-primary rounded py-3 px-5"><span class="icon-plus-circle"></span> Show More Events</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-blocks-cover overlay inner-page" style="background-image: url('external/images/hero_1.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-6 text-center" data-aos="fade">
            <h1 class="h3 mb-0">Participate in our Events </h1>
            <p class="h3 text-white mb-5">Or Make yours</p>
            <p><a href="/register" class="btn btn-outline-warning py-3 px-4">For User</a>
                 <a href="{{route('org.register')}}" class="btn btn-outline-warning py-3 px-4">For Organizer</a></p>
            
          </div>
        </div>
      </div>
    </div>

@include('parts.footer')
  </body>
</html>