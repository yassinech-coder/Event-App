@extends('layouts.main')
@section('content')
   <div class="album text-muted">
     <div class="container">
       <div class="row justify-content-center">
   
    <div class="site-section bg-light col-md-10">
        <br>
        <h1 style="margin-left: 15px"> User Registration </h1>
        <br>
      <div class="container">
        <div class="row justify-content-center">
       @if(Session::has('message'))
                 <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif

          <div class="col-md-10 ">
          
            <form method="POST" action="{{ route('register') }}" class="p-5 bg-white">
                        @csrf

                        <input type="hidden" value="user" name="user_type">

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-left">{{ __('Name') }}</label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                    
                            <div class="col-md-3">Email</div>

                            <div class="col-md-7">
                                <input id="email" type="text" placeholder="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                    
                            <div class="col-md-3">Password</div>

                            <div class="col-md-7">
                                <input id="password" type="password" placeholder="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required autofocus>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">Confirm password</div>

                            <div class="col-md-7">
                                <input id="password-confirm" type="password" placeholder="confirm password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dob" class="col-md-3 col-form-label text-md-left">{{ __('Date Of Birth') }}</label>

                            <div class="col-md-7">
                    <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" 
                    name="dob" value="{{ old('dob') }}" required autocomplete="dob">

                                @if($errors->has('dob'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-3 col-form-label text-md-left">{{ __('Gender') }}</label>

                            <div class="col-md-7">
                            
                                <input type="radio" name="gender" value="male" required=""> Male <br>
                                <input type="radio" name="gender" value="female" > Female

                    
                                @if($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>

              <div class="row form-group">
                <div class="col-md-10">
                  <input type="submit" value="Register as User" class="btn btn-primary  py-2 px-5" style="width: 100%">
                </div>
              </div>

  
            </form>
          </div>

          
        </div>
      </div>
    </div>



     </div>
   </div>
@endsection
