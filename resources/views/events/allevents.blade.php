@extends('layouts.main')
@section('content')


<div class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
           
            <table>
                <br><br>
            <h2 class="mb-6 h3" style="margin-bottom: 20px">All Events</h2>

            <thead style="margin-bottom: 20px">
                <form action="{{('allevents')}}" method="GET" >
                <th style="width: 6%"></th>
                <th>title</th>
                <th><input style="height: 37px;width:150px" type="text" name="title" class="form-control "></th>
                <th style="width: 1%"></th>
                <th> category</th>
                <th><select style="height: 37px;width:150px" name="category_id" class="form-control">
                    <option value=""></option>
                   @foreach (App\Models\Category::all() as $cat)
                   <option value="{{$cat->id}}">{{$cat->name}}</option>
                       
                   @endforeach
               </select></th>
               <th style="width: 1%"></th>
                <th>location</th>
                <th><input style="height: 37px;width:150px" type="text" name="location" class="form-control"></th>
                <th style="width: 1%"></th>
                <th>date</th>
                <th><input style="height: 37px;width:170px" type="date" class="form-control" 
                    name="date"></th>
                    <th style="width: 2%"></th>
                    <th>
                        <button type="submit" class="btn btn-outline-dark">Search</button>
                </th>
            </form>
        </thead>
            </table>
        <table class="table" style="margin-top: 20px">
          
            <tbody>
                @if(count($events)>0)
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
                   @else 
                   <td><h2>No Event Found ....</h2></td>
                   @endif
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

