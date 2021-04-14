@extends('layouts.main')
@section('content')


<div class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
        
            <div class="row">
                
                <div class="col-md-3">
                    <br>
                     @if (empty(Auth::user()->profile->avatar))
                         @if (empty(Auth::user()->avatar)) 
                    <img src="{{asset('avatar/02.jpg')}}"style="width: 75% ; border-radius:50%;margin-left:25px;margin-bottom:5px;">
                         @else 
                    <img src="{{Auth::user()->avatar}}"style="width: 75% ; border-radius:50%;margin-left:25px; margin-bottom:5px;">
                    @endif
                     @else
                         <img src="{{asset('uploads/avatar')}}/{{Auth::user()->profile->avatar}}"
                         style="width: 75% ; border-radius:50%;margin-bottom:5px;margin-left:25px;">             
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
                    <br><br>
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
        
                                <button class="btn btn-dark m float-right" type="submit" >Update</button><br>
           
                               </div>
        
                           
                        </div>
                    </div><br>
                    @if (Session::has('message'))
                    <div class="alert alert-success"> {{Session::get('message')}} </div>               
                    @endif
                </div>
            </form>
                <div class="col-md-4">
                    <br><br>
                    <div class="card">
                        <div class="card-header">Your Information</div>
                          <div class="card-body">
        
                          <p>Name : {{Auth::user()->name}}</p>
                          <p>Email : {{Auth::user()->email}}</p>
                          @if (empty(Auth::user()->profile->address))
                          <p>Address : </p>
                          @else
                         <p>Address : {{Auth::user()->profile->address}}</p>
                          @endif
                          @if (empty(Auth::user()->profile->phone_number))
                          <p>Phone Number : </p>
                          @else
                         <p>Phone Number : {{Auth::user()->profile->phone_number}}</p>
                          @endif
                          @if (empty(Auth::user()->profile->gender))
                          <p>Gender : </p>
                          @else
                         <p>Gender : {{Auth::user()->profile->gender}}</p>
                          @endif   
                          
        
        
                          </div>
                    </div>
                    
                        <div class="card">
                            <div class="card-header">More Info</div>
                              <div class="card-body">
             
                                @if (empty(Auth::user()->profile->details))
                                <p>  </p>
                                @else
                               <p> {{Auth::user()->profile->details}}</p>
                                @endif 
        
                              </div>
                        </div>
                    
                    
                </div>
                
                
            </div>
            </div>
        
       </div>

    </div>
</div>

@endsection

