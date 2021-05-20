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
                  <a href="{{ route('dash.index') }}">Statistic</a>
                  <br><a href="{{ route('dash.show') }}">Users</a>
                  <br><a href="{{ route('dash.show2') }}">Categories</a>
                  
                </div>
              </div>

          <div class="col-md-12 col-lg-9 mb-5">
            <table class="col-md-12" style="margin-left: 35px">
            <th style="width: 33%"><div class="col-lg-6">
              <div>
                  <div class="panel-heading text-center"> <i class="fas fa-users"></i>
                      Users
                  </div>
                    <div class="panel-body">
                      <h1 class="text-center">{{$users_count}}</h1>
                    </div>

              </div>
           </div>
          </th>
           <th style="width: 33%"><div class="col-lg-6">
            <div class="panel panel-danger">
                <div class="panel-heading text-center"> <i class="fas fa-bookmark" ></i>
                  Categories
                </div>
                  <div class="panel-body">
                    <h1 class="text-center">{{$categories_count}}</h1>
                  </div>

            </div>
         </div>
        </th>
        <th style="width: 33%"> <div class="col-lg-6">
          <div class="panel panel-success">
              <div class="panel-heading text-center"> <i class="fas fa-calendar-week"></i>
                  Events
              </div>
                <div class="panel-body">
                  <h1 class="text-center">{{$events_count}}</h1>
                </div>

          </div>
       </div>
      </th>
      </table>
      <br><br>
          <!-- Chart's container -->
         
    <div id="DashboardChart" style="height: 300px;"></div>
    
          </div>

        </div>
      </div>
    </div>



     </div>
   </div>
@endsection
@push('js')
    
 <!-- Your application script -->
 <script>
  const chart = new Chartisan({
    el: '#DashboardChart',
    url: "@chart('dashboard_chart')",
    hooks: new ChartisanHooks()
    .colors(['#28a745','red'])
    .datasets(['bar',{ type: 'line', fill: false }]),
  });
</script>
@endpush