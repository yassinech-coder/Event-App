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
                                @if (Session::has('message'))
                                <div class="alert alert-success">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                                <table class="table col-md-10" style="margin-left: 50px">

                                    <tr>
                                        <center>
                                            <th>Name</th>
                                        </center>
                                        <th>

                                            <center><i class="far fa-plus-square" style="font-size: 180%"
                                                    data-toggle="modal" data-target="#exampleModal5"></i> </center>

                                        </th>
                                    </tr>

                                    @foreach ($categories as $cat)
                                        <tbody>

                                            <tr>
                                                <td>{{ $cat->name }}</td>
                                                <td>
                                                    <center>
                                                            <i class="far fa-edit" style="font-size: 100% ;color:#28a745"
                                                            onclick="handleDelete('{{$cat->id}}')"></i>
                                                      
                                                        
                                                            <i class="far fa-trash-alt" style="font-size: 100% ;color:#28a745"
                                                            onclick="handleDelete2('{{$cat->id}}')"></i>
                                                       
                                                    </center>
                                                </td>
                                            </tr>
                                            <!-- Modal5 -->
                                            <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Create new Categories</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('category.store') }}" method="POST"
                                                            enctype="multipart/form-data">@csrf

                                                            <div class="modal-body">
                                                                <div class="form-goup">
                                                                    <label>Category_Name*</label>
                                                                    <input type="text" name="name" class="form-control"
                                                                        required="">
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-dark">Create</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal6 -->
                                            <div class="modal fade" id="exampleModal6{{$cat->id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Categories</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('category.update', [$cat->id]) }}" method="POST"
                                                            enctype="multipart/form-data">@csrf

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">Category_Name*</label>
                                                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                                        name="name" value="{{ $cat->name }}" name="name">
                                                                    @if ($errors->has('name'))
                                                                        <div class="error" style="color:red;">{{ $errors->first('name') }}</div>
                                                                    @endif
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-dark">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal7 -->
                                            <div class="modal fade" id="exampleModal7{{$cat->id}}" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Remove Categories</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('category.delete', [$cat->id]) }}">

                                                            <div class="modal-body">
                                                                Are you sure you want to delete this category?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-dark">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tbody>
                                    @endforeach
                                </table>


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
        function handleDelete(cat_id) {

            $(`#exampleModal6${cat_id}`).appendTo('body').modal('show')

        }
        function handleDelete2(cat_id) {

$(`#exampleModal7${cat_id}`).appendTo('body').modal('show')

}

    </script>
@endsection