@extends('layouts.main')

@section('extra-js')
    <script>
        function toggleReplyComment(id) {
            let element = document.getElementById('replyComment-' + id);
            element.classList.toggle('d-none');
        }

    </script>
@endsection

@section('content')
    <div class="album text-muted">
        <div class="container">
            @if (Session::has('message'))
                <br><br><br><br><br>
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            @if (Session::has('err_message'))

                <div class="alert alert-danger">{{ Session::get('err_message') }}</div>
            @endif
            @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif

            <div class="row" id="app">

                <div class="col-md-8">
                    <br><br><br><br>
                    <h1>Event : {{ $event->title }}</h1>
                </div>

                <div class="col-lg-8">

                    @if (empty($event->picture))
                        <img src="{{ asset('avatar/01.png') }}" style="width: 100%">
                    @else
                        <img src="{{ env('APP_STORAGE') }}{{ '/storage/articles/' . $event->picture }}"
                            style="width: 100%"> <br><br>
                    @endif
                </div>
                <div class="col-md-4">

                    <meteo-component location="{{ $event->location }}"></meteo-component>

                </div>
                <div class="col-md-8">
                    <div class="p-4 mb-8 bg-white">
                        <h3 class="h5 text-black mb-3"><strong>Description</strong>
                            <div></i> <a href="#" data-toggle="modal" data-target="#exampleModal1">
                                    <i class="fa fa-envelope-square float-right"
                                        style="font-size: 34px;margin-top:-20px;margin-right:-20px"></i></a></div>
                        </h3>
                        <p> {{ $event->description }}.</p>

                    </div>
                    <br><br>
                </div>
                <div class="col-md-4 p-3 site-section bg-light">
                    <h3 class="h5 text-black mb-3 text-center"><strong>Info</strong></h3>
                    <p class=" text-center">Date :{{ $event->date }}</p>
                    <p class=" text-center">Time :{{ $event->time }}</p>
                    <p class="text-center">Location :{{ $event->location }}</p>
                    <p class="text-center">Price :{{ $event->price }}TND</p>
                    <p class="text-center">Available Seats :{{ $event->seats }}</p>

                    <p>
                        @if (empty(Auth::user()->user_type) || $event->seats < 1)
                            <button type="submit" class="btn btn-success btn-m" style="width: 100%"
                                disabled>Participate</button>

                        @else @if (Auth::user()->user_type == 'user')
                                @if (!$event->checkParticipation())
                                    <button type="submit" class="btn btn-success btn-m" data-toggle="modal"
                                        data-target="#exampleModal3" style="width: 100% ; margin-left:5px">Participate</button>
                                @else <button class="alert alert-success btn-m" style="width: 100%" disabled>
                                        Participated Successfully! </button>

                                @endif
                                <favourite-component eventid="{{ $event->id }}"
                                    :fav="{{ $event->checkFavourite() ? 'true' : 'false' }}"></favourite-component>
                            @endif
                        @endif
                    </p>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Send event to anyone</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('mail') }}" method="POST">@csrf

                                    <div class="modal-body">
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        <input type="hidden" name="event_title" value="{{ $event->title }}">

                                        <div class="form-goup">
                                            <label>Your name * </label>
                                            <input type="text" name="your_name" class="form-control" required="">
                                        </div>
                                        <div class="form-goup">
                                            <label>Your email *</label>
                                            <input type="email" name="your_email" class="form-control" required="">
                                        </div>
                                        <div class="form-goup">
                                            <label>Person email *</label>
                                            <input type="text" name="friend_email" class="form-control" required="">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Mail this event</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- Modal3 -->
             <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Partipate to this event</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form  action="{{route('participate', [$event->id])}}" method="POST">@csrf
              
                    <div class="modal-body">
                    <input type="hidden" name="event_id" value="{{$event->id}}">
                      <input type="hidden" name="event_title" value="{{$event->title}}">
              
              
                      <div class="form-goup">
                        <label>Your name *</label>
                        <input type="text" name="friend_name" class="form-control" required="">
                      </div>
                      <div class="form-goup">
                        <label>Your email *</label>
                        <input type="email" name="friend_email" class="form-control" required="">
                      </div>
              
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-dark">Participate</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>


                </div>
            </div>

            <div class="col-lg-8">
                <hr>
                <h3 class="h5 text-black mb-3">Comments</h3>
                @forelse ($event->comments as $comment)
                    <div class="card mb-2" style="border-radius: 10px">
                        <div class="card-body">
                            <strong>{{ $comment->user->name }}</strong><br>
                            {{ $comment->content }}
                            <div class=" d-flex justify-content-between align-items-center">
                                <br>
                                <small class="badge badge-secondary"> Posted
                                    {{ $comment->created_at->format('d/m/Y') }}</small>

                            </div>
                        </div>
                    </div>

                    @auth
                        <button class="btn btn-secondary mb-3"
                            onclick="toggleReplyComment({{ $comment->id }})">Reply</button>
                        <form action="{{ route('comments.storeReply',[$comment ,$event]) }}" method="POST" class="mb-3 ml-5 d-none"
                            id="replyComment-{{ $comment->id }}">
                            @csrf
                            <table>
                                <div class="form-group">
                                    <tr> <label for="replyComment"> Reply here!</label></tr>
                                    <tr>
                                        <th style="width: 3%"></th>
                                        <th style="width: 85%"> <textarea name="replyComment"
                                                style="border-radius: 5px; width:100%"
                                                class="form-control @error('replyComment') is-invalid @enderror"
                                                id="replyComment" rows="2"></textarea>
                                            @error('replyComment')
                                                <div class="invalid-feedback">{{ $errors->first('replyComment') }}
                                                </div>
                                            @enderror
                                </div>
                                </th>
                                <th style="width: 2%"></th>
                                <th style="width: 20%"> <button type="submit" class="btn btn-secondary">Reply</button></th>
                                </tr>
                            </table>
                        </form>
                    @endauth
                    @foreach ($comment->comments as $replyComment)
                        <div class="card mb-3 ml-5" style="border-radius: 10px; height:110px;">
                            <div class="card-body">
                                <strong>{{ $replyComment->user->name }}</strong><br>
                                {{ $replyComment->content }}
                                <div class=" d-flex justify-content-between align-items-center">
                                    <br>
                                    <small class="badge badge-secondary"> Posted
                                        {{ $replyComment->created_at->format('d/m/Y') }}</small>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <div class="alert alert-success">No Comments!</div>
                @endforelse

                @auth
                    <form action="{{ route('comments.store', $event) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="content">Your Comment</label>
                            <textarea style="border-radius: 5px" class="form-control @error('content') is-invalid @enderror"
                                name="content" id="content" rows="2"></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-secondary  float-right"> Post </button><br><br>


                    </form>
                @endauth

            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-12">
                <br><br>
                <p style="font-size: 150%"> <strong> Recommendations </p></strong>
            </div>
            <table>
                @foreach ($eventRecommendations as $eventRecommendation)
                    <th>
                        <div class="card" style="width: 18rem;margin-right:15px">
                            <div class="card-body">
                                <p class="badge badge-success">{{ $eventRecommendation->location }}</p>
                                <p class="badge badge-success">{{ $eventRecommendation->date }}</p>
                                <h5 class="card-title"><strong>{{ $eventRecommendation->title }}</strong> </h5>
                                <p class="card-text">{{ $eventRecommendation->description }}
                                    <center> <a
                                            href="{{ route('events.show', [$eventRecommendation->id, $eventRecommendation->title]) }}"
                                            class="btn btn-secondary">check</a></center>
                            </div>

                        </div>
                    </th>
                @endforeach
            </table>
            <div class="col-md-12">
                <br><br>
            </div>

        </div>






    </div>

    </div>

@endsection
