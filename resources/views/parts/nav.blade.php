<div class="site-wrap">

    <div class="site-mobile-menu">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->


    <div class="site-navbar-wrap js-site-navbar bg-white">

        <div class="container">
            <div class="site-navbar bg-light">
                <div class="py-1">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <h2 class="mb-0 site-logo"><a href="{{ route('home2') }}">Event<strong
                                        class="font-weight-bold">App</strong> </a></h2>
                        </div>
                        <div class="col-10">
                            <nav class="site-navigation text-right" role="navigation">
                                <div class="container">
                                    <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                                            class="site-menu-toggle js-menu-toggle text-black"><span
                                                class="icon-menu h3"></span></a></div>

                                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                                        @if (!Auth::check())
                                            <li><a href="{{ route('user.register') }}">User Register</a></li>
                                            <li> <a href="{{ route('org.register') }}">Organizer Register</a></li>
                                            <li>
                                            @else

                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('profile') }}">{{ Auth::user()->name }}</a>
                                            </li>
                                            <li>
                                                @if (Auth::user()->name == 'admin')
                                                    <a class="dropdown-item"
                                                        href="{{ route('dash.index') }}">{{ __('Dashboard') }}</a>
                                                @endif
                                            </li>
                                            <li>
                                                @if (Auth::user()->user_type == 'user')
                                                    <a class="dropdown-item"
                                                        href="{{ route('home') }}">{{ __('Favourites') }}</a>
                                                @endif
                                            </li>
                                            @unless (auth()->user()->unreadNotifications->isEmpty())
                            <li class="nav-item dropdown">@if(Auth::user()->user_type=='user')
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="badge badge-warning">{{ auth()->user()->unreadNotifications->count() }}</span> Notification(s) <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                             @foreach (auth()->user()->unreadNotifications as $unreadNotification)
                            <a href="{{ route('events.showFromNotification', ['id' => $unreadNotification->data['eventId'],'event' => $unreadNotification->data['eventTitle'], 'notification' => $unreadNotification->id])}}" class="dropdown-item">{{ $unreadNotification->data['name'] }} Reply To Your  Comment </a>
                            @endforeach
                            </div>

                            @endif</li>
                           @endunless
                                            <li>
                                                @if (Auth::user()->user_type == 'organizer')
                                                    <a class="dropdown-item"
                                                        href="{{ route('my.events') }}">{{ __('My Events') }}</a>
                                                @endif
                                            </li>

                                            <li>
                                                @if (Auth::user()->user_type == 'organizer')
                                                    <a class="dropdown-item"
                                                        href="{{ route('participant') }}">{{ __('Participants') }}</a>
                                                @endif
                                            </li>
                                            @unless (auth()->user()->unreadNotifications->isEmpty())
                            <li class="nav-item dropdown">@if(Auth::user()->user_type=='organizer')
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="badge badge-warning">{{ auth()->user()->unreadNotifications->count() }}</span> Notification(s) <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                             @foreach (auth()->user()->unreadNotifications as $unreadNotification)
                            <a href="{{ route('events.showFromNotification', ['id' => $unreadNotification->data['eventId'],'event' => $unreadNotification->data['eventTitle'], 'notification' => $unreadNotification->id]) }}" class="dropdown-item">{{ $unreadNotification->data['name'] }} Posted A Comment On <strong>{{ $unreadNotification->data['eventTitle'] }}</strong></a>
                            @endforeach
                            </div>

                            @endif</li>
                           @endunless



                                        @endif
                                        @if (!Auth::check())
                                            <button type="button" class="btn btn-dark text-white py-2 px-3 rounded"
                                                data-toggle="modal" data-target="#exampleModal"> Login</button>
                                        @else
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        @endif
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session('message'))
                    <div class="alert alert-danger">{{ session('message') }}</div>
                @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-3">
                                <a href="{{ route('login.google') }}" class="btn btn-danger btn-block"><span
                                        class="icon-google"></span> Login with Google </a>
                                <a href="{{ route('login.facebook') }}" class="btn btn-info btn-block"><span
                                        class="icon-facebook"></span>
                                    Login with Facebook</a>
                            </div>
                        </div>
                        <p style="margin-left: 250px">OR</p>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                    value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">


                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">
                        {{ __('Login') }}
                    </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
