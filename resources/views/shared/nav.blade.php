<?php $user = auth()->user(); ?>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container pt-2 pb-2">
        <a class="navbar-brand" href="{{ url('/') }}">Tutor Finder</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                    </li>
                @else

                    @if($user->type == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/about') }}">About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/tutors') }}">Tutors</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/students') }}">Students</a>
                        </li>
                    @elseif($user->type == 2)
                        @if($user->approved_at != "")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/students') }}">Students</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                        </li>
                    @elseif($user->type == 3)
                        @if($user->approved_at != "")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/tutors') }}">Tutors</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
                        </li>
                    @endif
                @endguest
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/profile') }}">{{$user->first_name}}
                            {{$user->last_name}}</a>
                    </li>

                    @if($user->type == 1)
                    <?php $no_of_awaiting_response = no_of_awaiting_response(); ?>
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="{{ url('/profiles/review') }}" title="Review profiles"><i
                                class="fas fa-bell fa-2x float-left"></i>@if($no_of_awaiting_response > 0)<sup
                                class="badge badge-danger float-left" title="Profiles pending approval">{{
                                $no_of_awaiting_response }}</sup>@endif</a>
                    </li>

                    @elseif($user->type == 2 || $user->type == 3)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/connections') }}" title="Connections"><i
                                class="fas fa-link fa-2x float-left"></i></a>
                    </li>

                    <li class="nav-item mr-3">
                        <?php $no_of_connection_request = no_of_connection_requests(); ?>
                        <a class="nav-link" href="{{ url('/connects/requests') }}" title="Pending connection requests"><i
                                class="fas fa-user-friends fa-2x float-left"></i>@if($no_of_connection_request > 0)<sup
                                class="badge badge-danger float-left" title="Pending connection requests">{{
                                $no_of_connection_request }}</sup>@endif</a>
                    </li>

                    @endif

                    <li class="nav-item mt-2">
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            Logout <i class="fas fa-sign-out-alt"></i>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>