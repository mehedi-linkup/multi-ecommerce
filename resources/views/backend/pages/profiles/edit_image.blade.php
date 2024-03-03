@extends('backend.layouts.admin_master')
@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Profile</span>
</nav>

<div class="sl-pagebody">

    <div class="row row-sm">
        <div class="col-sm-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top rounded-circle" src="{{ asset('frontend/media/'.Auth::user()->image) }}" width="100%" height="100%" alt="Card image cap">
                <ul class="list-group list-group-flush">
                    <a href="{{ route('admin.profiles') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('admin.image.edit') }}" class="btn btn-primary btn-sm btn-block">Update Image</a>
                    <a href="{{ route('admin.passwords') }}" class="btn btn-primary btn-sm btn-block">Update Password</a>

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
        <div class="col-sm-8">
            <div class="card" style="padding-top: 20px;">
                <h3 class="text-center"><span class="text-danger">Hi...!</span> <strong class="text-warning">{{ Auth::user()->name }}</strong> Update your Profile</h3>
                <div class="card-body">
                    <form action="{{ route('admin.image.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                            @error('image') <span style="color: red">{{$message}}</span> @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger"> Update change</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div><!-- sl-pagebody -->
@endsection
