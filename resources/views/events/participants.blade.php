@extends('layouts.main')
@section('content')


<div class="site-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-11 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">
        <br>
            <div class="card "style="margin-bottom: 7px">
                @foreach ($participants as $participant)
                <div class="card-header" style="background:rgb(211, 207, 207)">
                      <a href="{{route('events.show', [$participant->id, $participant->title])}}" style="color: rgb(0, 0, 0); font-weight:bold" >
                        <i class="fas fa-external-link-alt "style="font-size: 75%"></i>  Event : {{$participant->title}} </a></div>

                <div class="card-body">
                    @foreach ($participant->users as $user)
                        
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th style="width: 20%">Name</th>
                            <th style="width: 25">E-mail</th>
                            <th style="width: 25%">Address</th>
                            <th style="width: 20%">Phone Number</th>
                            <th style="width: 10%"> </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                           
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->profile->address}}</td> 
                            <td>{{$user->profile->phone_number}} </td>
                   
                            <td> 
                              <i class="far fa-trash-alt" style="font-size: 125%" data-toggle="modal" data-target="#exampleModal{{$participant->id,$user->id}}"></i>
                              
                               <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$participant->id,$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Remove participant</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                Do you want to remove?
                                                </div>
                                                <form action="{{route('participant.delete',[$participant->id,$user->id])}}">
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Remove</button>
                                        </form>
                                        
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                            
                            </td>
  
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
</div>

@endsection

