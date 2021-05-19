@extends('layouts.main')
@section('content')


    <div class="site-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                    <br>
                    <div class="card">
                        <div class="card-header"> <strong> Update Event </strong></div>

                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success ms"> {{ Session::get('message') }} </div>
                            @endif
                            <form action="{{ route('event.update', [$event->id]) }}" method="POST">@csrf

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ $event->title }}" name="title">
                                    @if ($errors->has('title'))
                                        <div class="error" style="color:red;">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach (App\Models\Category::all() as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $cat->id == $event->category_id ? 'selected' : '' }}>{{ $cat->name }}
                                            </option>

                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        name="location" value="{{ $event->location }}" name="location">
                                    @if ($errors->has('location'))
                                        <div class="error" style="color:red;">{{ $errors->first('location') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                                        value="{{ $event->date }}" required autocomplete="date">
                                </div>

                                <div class="form-group">
                                    <label for="time">Time</label>
                                    <input type="time" class="form-control @error('time') is-invalid @enderror" name="time"
                                        value="{{ $event->time }}" name="time">
                                    @if ($errors->has('time'))
                                        <div class="error" style="color:red;">{{ $errors->first('time') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        name="price" value="{{ $event->price }}" name="price">
                                    @if ($errors->has('price'))
                                        <div class="error" style="color:red;">{{ $errors->first('price') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="seats">Seats</label>
                                    <input type="text" class="form-control @error('seats') is-invalid @enderror"
                                        name="seats" value="{{ $event->seats }}" name="seats">
                                    @if ($errors->has('seats'))
                                        <div class="error" style="color:red;">{{ $errors->first('seats') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control"
                                        name="description">{{ $event->description }}</textarea>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success float-right " style="width: 15%"> Update
                                </button>


                            </form>
                        </div>


                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
