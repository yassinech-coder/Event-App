@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @foreach ($participants as $participant)
                <div class="card-header" style="background:rgb(211, 207, 207)">
                      <a href="{{route('events.show', [$participant->id, $participant->description])}}">
                        Event : {{$participant->title}}</a></div>

                <div class="card-body">
                    @foreach ($participant->users as $user)
                        
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th style="width: 20%">Name</th>
                            <th style="width: 30">E-mail</th>
                            <th style="width: 30%">Address</th>
                            <th style="width: 20%">Phone Number</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                           
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->profile->address}}</td>
                            <td>{{$user->profile->phone_number}}</td>


                          </tr>
                        </tbody>
                      </table>
                      @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
