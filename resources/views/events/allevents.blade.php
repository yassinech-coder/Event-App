@extends('layouts.main')
@section('content')


<div class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
        <table class="table">
            <br><br>
            <h2 class="mb-6 h3">All Events</h2>
            <thead>
                <form action="{{('allevents')}}" method="GET" >
                    
                    <th>  
                        title
                        <input style="height: 40px" type="text" name="title" class="form-control ">
                    </th>
                <th>  
                     category 
                     <select style="height: 40px" name="category_id" class="form-control">
                         <option value=""></option>
                        @foreach (App\Models\Category::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                            
                        @endforeach
                    </select>
                </th>
                
                <th>   
                     location 
                    <input style="height: 40px" type="text" name="location" class="form-control">
                </th>
                <th>   
                     date 
                     <input style="height: 40px" type="date" class="form-control" 
                     name="date">
                </th>
                <th>
                    <button type="submit" class="btn btn-outline-dark">Search</button>
            </th>
        </form>
            </thead>
            <tbody>
                @foreach ($events as $event)
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
                        <button class="btn btn-secondary btn-m">Check</button></a>
                    </td>
                </tr>
                @endforeach
                   
            </tbody>
        </table>
        <br>
        </div>
        <br><br>
        <div style="text-align: center"> 
            {{ $events->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}</div>
            <br><br><br>
</div>

    </div>


@endsection

