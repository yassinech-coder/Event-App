@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"> <strong> Create Event </strong></div>    

            <div class="card-body">  
                @if (Session::has('message'))
            <div class="alert alert-success ms"> {{Session::get('message')}} </div>               
            @endif  
                <form action="{{route('event.store')}}" method="POST">@csrf

            <div class="form-group">
              <label for="tirle">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                name="title" value="{{ old('title') }}" name="title">
                @if ($errors->has('title'))
                    <div class="error" style="color:red;">{{$errors->first('title')}}</div>   
                      @endif
                </div>

            <div class="form-group">
            <label for="category">Category</label>
                <select name="category" class="form-control">
                    @foreach (App\Models\Category::all() as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                        
                    @endforeach
                </select>
                </div>

            <div class="form-group">
            <label for="location">Location</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror"
                name="location" value="{{ old('location') }}" name="location">
                @if ($errors->has('location'))
                    <div class="error" style="color:red;">{{$errors->first('location')}}</div>   
                      @endif
                </div>

            <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror" 
            name="date" value="{{ old('date') }}" required autocomplete="date">
                </div>

            <div class="form-group">
                <label for="time">Time</label>
                    <input type="time" class="form-control @error('time') is-invalid @enderror"
                    name="time" value="{{ old('time') }}" name="time" >
                    @if ($errors->has('time'))
                    <div class="error" style="color:red;">{{$errors->first('time')}}</div>   
                      @endif
                    </div>   

            <div class="form-group">
                <label for="price">Price</label>
                    <input type="text"  class="form-control @error('price') is-invalid @enderror"
                    name="price" value="{{ old('price') }}" name="price">
                    @if ($errors->has('price'))
                    <div class="error" style="color:red;">{{$errors->first('price')}}</div>   
                      @endif
                    </div>   
                    
            <div class="form-group">
                <label for="description">Description</label>
                    <textarea class="form-control" name="description"></textarea>
                    </div> 
            <div class="form-group">     
        
    <button type="submit" class="btn btn-success float-right " style="width: 15%"  > Create </button>

                </div>  
                
                 </form> 
                </div>
            
            </div>
                  

        </div>
    </div>
</div>
@endsection
