@extends('layouts.main')
@section('content')
   <div class="album text-muted">
     <div class="container">
       <div class="row">

    <div class="site-section bg-light col-md-12">
      <div class="container">
        <div class="row">
       @if(Session::has('message'))
                 <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="col-lg-3">
            
            <br>
                <div class="p-4 mb-3 bg-white">
                  <h3 class="h5 text-black mb-3">Dashboard List</h3>
                  <a href="{{route('dash.index')}}">Statistic</a>
                  <br><a href="">Events</a>
                  <br><a href="{{route('dash.show')}}">Users</a>
                </div>
              </div>

          <div class="col-md-12 col-lg-9 mb-5">
              <div class="col-md-12">
              
                <form action="{{route('dash.show')}}" method="GET" >
                    
                     <table style="margin-top: 12px; margin-bottom: 10px">
                        <th style="width: 25%"> </th>
                        <th style="font-size: 80%;"> Search by Name</th>
                        <th> <input style="height: 40px; width:100px" type="text" name="name" class="form-control ">
                        </th>
                    
                        <th style="width: 2%"></th>

                  
                <th style="font-size: 80%">Search by User_Type </th>
                     
                <th> <select style="height: 40px;width:100px" name="user_type" class="form-control">
                         <option value=""></option>
                        <option value="user">user</option>
                        <option value="organizer">organizer</option>
                
                    </select>
                </th>
                <th style="width: 6%"></th>
                <th><button type="submit" class="btn btn-outline-dark ">Search</button></th>
                </table>
        </form>
        
              </div>

            
            <table class="table">
                <thead>
                  <tr>
                    <th style="width: 30%">Name</th>
                    <th style="width: 30%">E-mail</th>
                    <th style="width: 30%"><center>User_Type</center></th>
                    <th style="width: 10%"></th>
                  </tr>
                </thead>
                @foreach ($users as $user)
                <tbody>
                   
                  <tr>
                   
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><center>{{$user->user_type}} </center></td>
           
                     <td> 
                         <a href="">
                      <i class="far fa-trash-alt" style="font-size: 100%" ></i>
                    </a>
                    </td> 

                  </tr>
                 
                </tbody>
                @endforeach
              </table>
              
           
        </div>
        
          </div>

        </div>
      </div>
    </div>



     </div>
   </div>
@endsection
