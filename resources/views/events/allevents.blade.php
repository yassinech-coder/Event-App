@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>All Events</h1>
        <table class="table">
            <thead>
                <form action="{{route('allevents')}}" method="GET">
                    <th>  
                        title
                        <input type="text" name="title" class="form-control">
                    </th>
                <th>  
                     category 
                     <select name="category_id" class="form-control">
                         <option value=""></option>
                        @foreach (App\Models\Category::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                            
                        @endforeach
                    </select>
                </th>
                
                <th>   
                     location 
                    <input type="text" name="location" class="form-control">
                </th>
                <th>   
                     date 
                     <input type="date" class="form-control" 
                     name="date">
                </th>
                <th>  
                    <button type="submit"class="btn btn-outline-success">Search</button>
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
                        <a href="{{route('events.show', [$event->id, $event->description])}}">
                        <button class="btn btn-success btn-m">Check</button></a>
                    </td>
                </tr>
                @endforeach
                   
            </tbody>
        </table>
        </div>
     <div style="text-align: center"> 
        {{ $events->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}</div>
    
</div>
@endsection
