@extends('frontend.layouts.master')
@section('main_content')

@section('title') Flipmart - Checkout @endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li class='active'>Forgot Password</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- Sign-in -->			
                <div class="col-md-12 col-sm-12 sign-in">
                    <h4 class="">Forgot Passsword</h4>
                    
                    <form method="POST" action="{{ route('password.email') }}" class="register-form outer-top-xs" role="form">
                        @csrf
                        
                        <div class="form-group">
                            <label class="info-title" for="email">Email Address <span>*</span></label>
                            <input type="email" class="form-control unicase-form-control text-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Send Password Reset Link</button>
                    </form>					
                </div>
                <!-- Sign-in -->
			
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->
        
        	
    </div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
