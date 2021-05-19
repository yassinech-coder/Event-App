@extends('layouts.main')
@section('content')
    <div class="album text-muted">
        <div class="container">
            <div class="row">

                <div class="site-section bg-light col-md-12">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-3">

                                <br>
                                <div class="p-4 mb-3 bg-white">
                                    <h3 class="h5 text-black mb-3">Dashboard List</h3>
                                    <a href="{{ route('dash.index') }}">Statistic</a>
                                    <br><a href="{{ route('dash.show') }}">Users</a>
                                    <br><a href="{{ route('dash.show2') }}">Categories</a>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-9 mb-5">
                                <div class="col-md-12">
                                    @if (Session::has('message'))
                                        <div class="alert alert-success">
                                            {{ Session::get('message') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('dash.show') }}" method="GET">

                                        <table style="margin-top: 12px; margin-bottom: 10px">
                                            <th style="width: 25%"> </th>
                                            <th style="font-size: 80%;"> Search by Name</th>
                                            <th> <input style="height: 40px; width:100px" type="text" name="name"
                                                    class="form-control ">
                                            </th>

                                            <th style="width: 2%"></th>


                                            <th style="font-size: 80%">Search by User_Type </th>

                                            <th> <select style="height: 40px;width:100px" name="user_type"
                                                    class="form-control">
                                                    <option value=""></option>
                                                    <option value="user">user</option>
                                                    <option value="organizer">organizer</option>

                                                </select>
                                            </th>
                                            <th style="width: 6%"></th>
                                            <th><button type="submit" class="btn btn-outline-dark ">Search</button></th>
                                        </table>
                                    </form>

                                </div>


                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%">Name</th>
                                            <th style="width: 30%">E-mail</th>
                                            <th style="width: 30%">
                                                <center>User_Type</center>
                                            </th>
                                            <th style="width: 10%"></th>
                                        </tr>
                                    </thead>
                                    @foreach ($users as $user)
                                        <tbody>

                                            <tr>

                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <center>{{ $user->user_type }} </center>
                                                </td>

                                                <td>
                                                    @if ($user->banned_until != null && $user->banned_until > date('Y-m-d'))
                                                        <i class="fas fa-ban" style="font-size: 100% ;color:#990008"
                                                            onclick="handleDelete('{{ $user->id }}')"></i>
                                                    @else
                                                        <i class="fas fa-ban" style="font-size: 100% ;color:#28a745"
                                                            onclick="handleDelete('{{ $user->id }}')"></i>
                                                    @endif
                                                </td>

                                            </tr>
                                            <!-- Modal8 -->
                                            <div class="modal fade" id="exampleModal8{{ $user->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Block Member</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('user.block', [$user->id]) }}"
                                                            method="POST" enctype="multipart/form-data">@csrf

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="banned_until">Banned_Until</label>
                                                                    <input type="date"
                                                                        class="form-control @error('banned_until') is-invalid @enderror"
                                                                        name="banned_until"
                                                                        value="{{ $user->banned_until }}" required
                                                                        autocomplete="banned_until">
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-dark">Block</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tbody>
                                    @endforeach
                                </table>

                                <br><br>
                                <div style="text-align: center">
                                    {{ $users->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}</div>
                                <br><br><br>
                            </div>

                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function handleDelete(user_id) {

            $(`#exampleModal8${user_id}`).appendTo('body').modal('show')

        }

    </script>
@endsection
