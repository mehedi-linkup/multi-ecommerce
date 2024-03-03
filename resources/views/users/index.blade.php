@extends('frontend.layouts.master')
@section('main_content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li class='active'>Login</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content" style="margin-bottom: 20px;">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('frontend/media/'.Auth::user()->image) }}" width="100%" height="100%" alt="Card image cap">
                        <ul class="list-group list-group-flush">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                            <a href="{{ route('orders.show') }}" class="btn btn-primary btn-sm btn-block">My Order</a>
                            <a href="{{ route('user.return.order.show') }}" class="btn btn-primary btn-sm btn-block">Return Orders</a>
                            <a href="{{ route('user.cancel.order') }}" class="btn btn-primary btn-sm btn-block">Cancel Orders</a>
                            <a href="{{ route('user.images') }}" class="btn btn-primary btn-sm btn-block">Update Image</a>
                            <a href="{{ route('user.password.edit') }}" class="btn btn-primary btn-sm btn-block">Update Password</a>
                            <a href="{{ route('chat.page') }}" class="btn btn-primary btn-sm btn-block">Chats</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="btn btn-danger btn-sm btn-block">
                                <i class="fa fa-power-off"></i> 
                                Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9 mt-1">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Hi...!</span> <strong class="text-warning">{{ Auth::user()->name }}</strong> Update your Profile</h3>
                        <div class="card-body">
                            <form action="{{ route('user.profile.update') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->name }}" aria-describedby="">
                                    @error('name') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ Auth::user()->email }}" aria-describedby="">
                                    @error('email') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ Auth::user()->phone }}" aria-describedby="">
                                    @error('phone') <span style="color: red">{{$message}}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"> Save change</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection