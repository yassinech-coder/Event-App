@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">

            @if (empty(Auth::user()->profile->avatar))
            <img src="{{asset('avatar/02.jpg')}}"style="width: 100%">
           @else
                 <img src="{{asset('uploads/avatar')}}/{{Auth::user()->profile->avatar}}"
                 style="width: 100%">             
            @endif
          
            <form action="{{route('avatar')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="card">
              <div class="card-header"> Update your Avatar </div>
                     <div class="card-body">
                         <input type="file" class=" form-control " name="avatar" >
                            <br>
                            <button class="btn btn-dark ms float-right" type="submit" >Update</button>
                        </div>             
            </div>
            </form>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Update Profile</div>
                <form action="{{route('profile.create')}}" method="POST">@csrf
                <div class="card-body">
                    <div class="form-group">
                       
                     <label for="">Address</label>
                     <input type="text" class="form-control" name="address"
                      >
                      @if ($errors->has('address'))
                    <div class="error" style="color:red;">{{$errors->first('address')}}</div>   
                      @endif

                    </div>
                    <div class="form-group">
                       
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number">
                        @if ($errors->has('phone_number'))
                    <div class="error" style="color:red;">{{$errors->first('phone_number')}}</div>   
                      @endif
   
                       </div>
                    <div class="form-group">

                        <label for="">Details</label>
                        <textarea name="details" class="form-control"></textarea>
                        @if ($errors->has('details'))
                    <div class="error" style="color:red;">{{$errors->first('details')}}</div>   
                      @endif
                        <br>
   
                       </div>
                       <div class="form-group">

                        <button class="btn btn-dark m float-right" type="submit" >Update</button>
   
                       </div>

                   
                </div>
            </div><br>
            @if (Session::has('message'))
            <div class="alert alert-success"> {{Session::get('message')}} </div>               
            @endif
        </div>
    </form>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Your Information</div>
                  <div class="card-body">

                  <p>Name : {{Auth::user()->name}}</p>
                  <p>Email : {{Auth::user()->email}}</p>
                  <p>Address : {{Auth::user()->profile->address}}</p>
                  <p>Phone Number : {{Auth::user()->profile->phone_number}}</p>
                  <p>Gender : {{Auth::user()->profile->gender}}</p>


                  </div>
            </div>
            
                <div class="card">
                    <div class="card-header">More Info</div>
                      <div class="card-body">
     
                        <p>{{Auth::user()->profile->details}}</p>

                      </div>
                </div>
            
            
        </div>
        
        
    </div>
</div>
@endsection
