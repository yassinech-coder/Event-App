@extends('layouts.main')
@section('content')


    <div class="site-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5 mb-md-0" data-aos="fade-up" data-aos-delay="100">

                    <table class="table">
                        @if (Session::has('message'))
                            <div class="alert alert-success ms"> {{ Session::get('message') }} </div>
                        @endif
                        <thead><br>
                            <a href="{{ route('event.create') }}">
                                <button class="btn btn-dark py-2 px-3 " style=" margin-bottom: 20px;margin-left: 10px;  ">
                                    Post Event </button></a>
                            <br>

                        </thead>
                        <tbody>

                            @foreach ($events as $event)
                                <tr>
                                    <td>
                                        @if (empty($event->picture))
                                            <img src="{{ asset('avatar/01.png') }}" width="200">
                                        @else
                                            <img src="{{ '/storage/articles/' . $event->picture }}" width="200">
                                        @endif
                                    </td>
                                    <td>Title: {{ $event->title }} </td>
                                    <td><i class="fas fa-map-marker-alt"></i> Location : {{ $event->location }} </td>
                                    <td><i class="far fa-calendar-alt"></i> Date : {{ $event->date }}</td>
                                    <td>
                                        <a href="{{ route('events.show', [$event->id, $event->title]) }}">
                                            <button class="btn btn-secondary btn-m mb-1"
                                                style="width: 90%">Check</button></a>
                                        <br> <a href="{{ route('event.edit', [$event->id]) }}"><button
                                                class="btn btn-secondary btn-m mb-1" style="width: 90%">Edit</button></a>
                                        <br>
                                        <button class="btn btn-danger btn-m mb-1"
                                            onclick="handleDelete({{ $event->id }})" style="width: 90%">Delete</button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{ route('event.delete', [$event->id]) }}">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Event</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this event?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-dark">Delete</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            @endforeach
                        </tbody>
                    </table>




                </div>

            </div>

        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function handleDelete() {

            $('#deleteModal').appendTo('body').modal('show')

        }

    </script>
@endsection
