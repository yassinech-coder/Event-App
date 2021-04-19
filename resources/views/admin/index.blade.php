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
            
            
                <div class="p-4 mb-3 bg-white">
                  <h3 class="h5 text-black mb-3">Dashboard List</h3>
                  <a href="">Statistic</a>
                  <br><a href="">Events</a>
                  <br><a href="{{route('dash.show')}}">Users</a>
                </div>
              </div>

          <div class="col-md-12 col-lg-9 mb-5">
          
            <form method="POST" action="" class="p-5 bg-white">
                        @csrf

          </div>

        </div>
      </div>
    </div>



     </div>
   </div>
@endsection
