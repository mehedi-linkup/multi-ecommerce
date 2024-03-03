@extends('frontend.layouts.master')
@section('main_content')

@section('title') Flipmart - Checkout @endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                
            <form action="{{ route('user.checkout.store') }}" method="POST" class="register-form" role="form">
                @csrf
                    
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">		

                                        <!-- guest-login -->			
                                        <div class="col-md-6 col-sm-6 guest-login">
                                            <h4 class="checkout-subtitle">Shipping Address</h4>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                                                <input type="text" name="name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{ Auth::user()->name }}" placeholder="Full Name" data-validation="required">
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
                                                <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{ Auth::user()->email }}" placeholder="Enter Email" data-validation="required">
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
                                                <input type="text" name="phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" value="{{ Auth::user()->phone }}" placeholder="Enter Phone" data-validation="required">
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Post Code<span>*</span></label>
                                                <input type="text" name="post_code" class="form-control unicase-form-control text-input" name="post_code" id="exampleInputEmail1" placeholder="post code" data-validation="required">
                                            </div>
                                        </div>
                                        <!-- guest-login -->

                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <div class="form-group">
                                                <label class="form-control-label">Select Division: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2-show-search" data-placeholder="Select One" name="division_id" data-validation="required">
                                                    <option label="Choose Division"></option>
                                                    @foreach ($divisions as $item)
                                                        <option value="{{ $item->id }}">{{ ucwords($item->name) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('division_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label">Select District: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2-show-search" data-placeholder="Select One" name="district_id" data-validation="required" id="district">
                                                    <option label="Choose District"></option>

                                                </select>
                                                @error('district_id') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label">Select State: <span class="tx-danger">*</span></label>
                                                <select class="form-control select2-show-search" data-placeholder="Select One" name="state_id" data-validation="required">
                                                    <option label="Choose State"></option>

                                                </select>
                                                @error('state_id')<span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">Notes
                                                    <span>*</span></label>
                                                <textarea name="notes" class="form-control" id="" cols="30" rows="5"
                                                    placeholder="notes" data-validation="required"></textarea>
                                            </div>
                                        </div>	
                                        <!-- already-registered-login -->		

                                    </div>			
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        

                    </div><!-- /.checkout-steps -->
                </div>
                
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach($carts as $cart)
                                        <li>
                                            <strong>Images:</strong>
                                            <img src="{{ asset('backend/images/products/'.$cart->options->image) }}" width="50" height="50" alt="">
                                            <Strong>Qty:</Strong>
                                            {{ $cart->qty }},
                                            <Strong>Color:</Strong>
                                            {{ $cart->options->color }},
                                            <Strong>Size:</Strong>
                                            {{ $cart->options->size }}
                                        </li>
                                        @endforeach
                                        <hr>
                                        
                                        <li>
                                            @if (Session::has('coupon'))
                                                <strong>Subtotal: </strong> ${{ $cartTotal }} <br>
                                                <strong>Coupon Name: </strong>
                                                {{ session()->get('coupon')['coupon_name'] }}
                                                ({{ session()->get('coupon')['coupon_discount'] }}%)<br>
                                                <strong>Coupon Discount: </strong> -
                                                ${{ session()->get('coupon')['discount_amount'] }} <br>
                                                <strong>GrandTotal: </strong>
                                                ${{ session()->get('coupon')['total_amount'] }}
                                            @else
                                                <strong>Subtotal: </strong> ${{ $cartTotal }} <br>
                                                <strong>GrandTotal: </strong> ${{ $cartTotal }}
                                            @endif
                                        </li>
                                    </ul>		
                                </div>
                            </div>
                        </div>
                    </div> 					
                </div>
                
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">SELECT PAYMENT METHOD</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        
                                        <li>
                                            <input type="radio" name="payment_method" value="stripe">
                                            <label for="">Stripe</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="payment_method" value="sslHost">
                                            <label for="">SSL HostedPayment</label>
                                        </li>

                                        <li>
                                            <input type="radio" name="payment_method" value="sslEasy">
                                            <label for="">SSL EasyPayment</label>
                                        </li>
                                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button pull-right">Payment Step</button>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- checkout-progress-sidebar -->
                </div>
            </form>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- =================== BRANDS CAROUSEL =================================== -->
        @include('frontend.partials.brand_carousel')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->

<script src="{{asset('backend')}}/lib/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function(){
            var division_id = $(this).val();
            if(division_id) {
                $.ajax({
                    url: "{{  url('/user/district-get/ajax') }}/"+division_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                        $('select[name="state_id"]').empty();
                        $('select[name="district_id"]').empty();
                          $.each(data, function(key, value){

                              $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');

                          });

                    },

                });
            } else {
                alert('danger');
            }

        });
        
        $('select[name="district_id"]').on('change', function() {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: "{{ url('/user/state-get/ajax') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="state_id"]').empty();

                        //append option choose one in state
                        $('select[name="state_id"]').append(
                            '<option value="" disabled selected>Choose one</option>');
                        $.each(data, function(key, value) {
                            $('select[name="state_id"]').append('<option value="' +
                                value.id + '">' + value.state_name + '</option>'
                                );
                        });

                    },

                });
            } else {
                alert('danger');
            }

        });

    });
</script>

@endsection