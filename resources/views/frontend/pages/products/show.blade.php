@extends('frontend.layouts.master')
@section('main_content')

@section('title') Flipmart - Product Details @endsection

@section('meta')
    <meta property="og:title" content="{{ $product->name_en }}" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:image" content="{{ URL::to('backend/images/products/'.$product->product_image) }}" />
    <meta property="og:description" content="{{ $product->short_desc_en }}" />
    <meta property="og:site_name" content="FlipMart" />
@endsection

@php
    function bn_price($str){
        $en = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        $bn = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $str = str_replace($en, $bn, $str);
        return $str;
    }
@endphp

<div id="app">
    
    <!-- ============================================== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Clothing</a></li>
                    <li class='active'>Floral Print Buttoned</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">
                        <div class="home-banner outer-top-n">
                            <img src="{{ asset('frontend') }}/assets//images/banners/LHS-banner.jpg" alt="Image">
                        </div>		

                        <!-- ============================================== HOT DEALS ============================================== -->
                        @include('frontend.partials.hot_deal')
                        <!-- ============================================== HOT DEALS: END ============================================== -->					<!-- ============================================== 

                        <!-- ============================================== NEWSLETTER ============================================== -->
                        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
                            <h3 class="section-title">Newsletters</h3>
                            <div class="sidebar-widget-body outer-top-xs">
                                <p>Sign Up for Our Newsletter!</p>
                                <form role="form">
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
                                    </div>
                                    <button class="btn btn-primary">Subscribe</button>
                                </form>
                            </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                        <!-- ============================================== NEWSLETTER: END ============================================== -->

                        <!-- ============================================== Testimonials============================================== -->
                        <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                            <div id="advertisement" class="advertisement">
                                <div class="item">
                                    <div class="avatar"><img src="{{ asset('frontend') }}/assets//images/testimonials/member1.png" alt="Image"></div>
                                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">John Doe	<span>Abc Company</span>	</div><!-- /.container-fluid -->
                                </div><!-- /.item -->

                                <div class="item">
                                    <div class="avatar"><img src="{{ asset('frontend') }}/assets//images/testimonials/member3.png" alt="Image"></div>
                                    <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">Stephen Doe	<span>Xperia Designs</span>	</div>    
                                </div><!-- /.item -->

                                <div class="item">
                                    <div class="avatar"><img src="{{ asset('frontend') }}/assets//images/testimonials/member2.png" alt="Image"></div>
                                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">Saraha Smith	<span>Datsun &amp; Co</span>	</div><!-- /.container-fluid -->
                                </div><!-- /.item -->

                            </div><!-- /.owl-carousel -->
                        </div>

                        <!-- ============================================== Testimonials: END ============================================== -->



                    </div>
                </div><!-- /.sidebar -->
                <div class='col-md-9'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">

                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">
                                        @foreach($multiImages as $multiImage)
                                        <div class="single-product-gallery-item" id="slide1{{$multiImage->id}}">
                                            <a data-lightbox="image-1" data-title="Gallery" href="{{ asset('backend/images/sub_products/'.$multiImage->images) }}">
                                                <img class="img-responsive" alt="" src="{{ asset('backend/images/sub_products/'.$multiImage->images) }}" data-echo="{{ asset('backend/images/sub_products/'.$multiImage->images) }}" />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                        @endforeach

                                    </div><!-- /.single-product-slider -->


                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">
                                            @foreach($multiImages as $multiImage)
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="{{$multiImage->id}}" href="#slide1{{$multiImage->id}}">
                                                    <img class="img-responsive" width="85" alt="" src="{{ asset('backend/images/sub_products/'.$multiImage->images) }}" data-echo="{{ asset('backend/images/sub_products/'.$multiImage->images) }}" />
                                                </a>
                                            </div>
                                            @endforeach

                                        </div><!-- /#owl-single-product-thumbnails -->



                                    </div><!-- /.gallery-thumbs -->

                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->        			
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name" id="pname">
                                        @if(session()->get('language') == 'bangla')
                                            {{ $product->name_bn }}
                                        @else
                                            {{ $product->name_en }}
                                        @endif
                                    </h1>

                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span style="color: red; font-size:15px;" class="glyphicon glyphicon-star{{ $i <= $avgRating ? '' : '-empty' }}"></span>
                                                @endfor
                                                <h5 class="badge badge-success">5 / {{ $avgRating }}</h5>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">({{ count($productReviews) }} Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->		
                                    </div><!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">@if(session()->get('language') == 'bangla')উপস্থিতি : @else Availability : @endif</span>
                                                </div>	
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    @if($product->quantity == 0)
                                                        @if(session()->get('language') == 'bangla')
                                                            <span class="value">স্টক আউট</span>
                                                        @else
                                                            <span class="value">Out of Stock</span>
                                                        @endif
                                                    @else
                                                        @if(session()->get('language') == 'bangla')
                                                            <span class="value">স্টক আছে</span>
                                                        @else
                                                            <span class="value">In Stock</span>
                                                        @endif

                                                    @endif
                                                </div>	
                                            </div>
                                        </div><!-- /.row -->	
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                       @if(session()->get('language') == 'bangla')
                                            {!! $product->short_desc_bn !!}
                                       @else
                                            {!! $product->short_desc_en !!}
                                       @endif
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">


                                            <div class="col-sm-6">
                                                @auth
                                                    <send-message :receiver-id="{{ $product->user_id }}" receiver-name="{{ $product->user->name }}" :product-id="{{ $product->id }}"></send-message>
                                                @else
                                                    <h4 class="text-danger">Chat This Seller To <a href="{{ route('login') }}" target="_blank">Login</a> Your Account</h4>
                                                @endif
                                                
                                                
                                                <div class="price-box">
                                                    @if($product->discount_price == null)
                                                        @if (session()->get('language') == 'bangla')
                                                            <span class="price">৳{{ bn_price(number_format($product->selling_price, 2)) }}</span>
                                                        @else
                                                            <span class="price">৳{{ number_format($product->selling_price, 2) }}</span>
                                                        @endif
                                                    @else
                                                        @if (session()->get('language') == 'bangla')
                                                            <span class="price">৳{{ bn_price(number_format($product->discount_price, 2)) }}</span>
                                                            <span class="price-strike">৳{{ bn_price(number_format($product->selling_price, 2)) }}</span>
                                                        @else
                                                            <span class="price">${{ number_format($product->discount_price, 2) }}</span>
                                                            <span class="price-strike">${{ number_format($product->selling_price, 2) }}</span>
                                                        @endif

                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <!-- Product Share Button -->
                                                    <div class="sharethis-inline-share-buttons" data-href="{{ Request::url() }}"></div>
                                                </div>
                                            </div>

                                        </div><!-- /.row -->

                                        <div class="row mt-3">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="color">Select Color</label>
                                                    <select class="form-control" id="color">
                                                        <option value="">Select Color</option>
                                                        @foreach ($color_en as $color)
                                                            <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                @if ($product->size_en == null)
                                                @else
                                                    <div class="form-group">
                                                        <label for="size">Select Size</label>
                                                        <select class="form-control" id="size">
                                                            <option value="">Select Size</option>
                                                            @foreach ($size_en as $size)
                                                                <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div><!-- /.price-container -->

                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
                                                        <input type="text" id="qty" value="1" min="1">
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="product_id" value="{{ $product->id }}">

                                            <div class="col-sm-7">
                                                <button type="submit" class="btn btn-primary" onclick="addToCart()"><i class="fa fa-shopping-cart inner-right-vs"></i> @if(session()->get('language') == 'bangla') কার্টে যোগ করুন @else ADD TO CART @endif </button>
                                            </div>


                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->






                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                    <li><a data-toggle="tab" href="#tags">Comments</a></li>
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">
                                                @if(session()->get('language') == 'bangla')
                                                    {!! $product->long_desc_bn !!}
                                                @else
                                                    {!! $product->long_desc_en !!}
                                                @endif
                                            </p>
                                        </div>	
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">
                                            @foreach($productReviews as $review)
                                            <div class="product-reviews">
                                                <h4 class="title">{{ $review->user->name }}</h4>

                                                <div class="reviews">
                                                    <div class="review">
                                                        <div class="review-title"><span class="summary">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <span style="color: red"
                                                                        class="glyphicon glyphicon-star{{ $i <= $review->rating ? '' : '-empty' }}"></span>
                                                                @endfor
                                                            </span>
                                                            <span class="date"><i class="fa fa-calendar"></i><span>{{ $review->created_at->diffForHumans() }}</span></span>
                                                        </div>
                                                        <div class="text">"{{ $review->comment }}"</div>
                                                    </div>

                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->
                                            @endforeach


                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                    <div id="tags" class="tab-pane">
                                        <div class="product-tag">
                                            <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="10"></div>
                                        </div>
                                    </div>


                                    <div id="tags" class="tab-pane">
                                        <div class="product-tag">

                                            <h4 class="title">Product Tags</h4>
                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-container">

                                                    <div class="form-group">
                                                        <label for="exampleInputTag">Add Your Tags: </label>
                                                        <input type="email" id="exampleInputTag" class="form-control txt">


                                                    </div>

                                                    <button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
                                                </div><!-- /.form-container -->
                                            </form><!-- /.form-cnt -->

                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
                                                </div>
                                            </form><!-- /.form-cnt -->

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

                    <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">@if(session()->get('language') == 'bangla') রিলেটেড প্রোডাক্ট @else Relate Products @endif</h3>
                        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                            @foreach($related_products as $related_product)
                            <div class="item item-carousel">
                                <div class="products">

                                    <div class="product">		
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="{{ route('product.details', $related_product->id) }}"><img  src="{{ asset('backend/images/products/'.$related_product->product_image) }}" height="200" alt=""></a>
                                            </div><!-- /.image -->			

                                            @php
                                                $amount = $related_product->selling_price - $related_product->discount_price;
                                                $discount = ($amount/$related_product->selling_price)*100;
                                            @endphp

                                            @if($related_product->discount_price == NULL)
                                                <div class="tag sale">
                                                    <span> @if(session()->get('language') == 'bangla') নতুন @else new @endif</span>
                                                </div>  
                                            @else
                                                <div class="tag hot">
                                                    <span> @if(session()->get('language') == 'bangla') {{ bn_price(round($discount)) }}% @else {{ round($discount) }}% @endif</span>
                                                </div> 
                                            @endif            		   
                                        </div><!-- /.product-image -->


                                        <div class="product-info text-left">
                                            <h3 class="name">
                                                @if(session()->get('language') == 'bangla')
                                                    <a href="{{ route('product.details', $related_product->id) }}">{{ $related_product->name_bn }}</a>
                                                @else
                                                    <a href="{{ route('product.details', $related_product->id) }}">{{ $related_product->name_en }}</a>
                                                @endif
                                            </h3>
                                            @if (App\Models\Review::where('product_id', $related_product->id)->first())
                                                @php
                                                    $reviewProducts = App\Models\Review::where('product_id', $related_product->id)
                                                        ->where('status', 'approved')
                                                        ->latest()
                                                        ->get();
                                                    $rating = App\Models\Review::where('product_id', $related_product->id)
                                                        ->where('status', 'approved')
                                                        ->avg('rating');
                                                    $avgRating = number_format($rating, 1);
                                                @endphp
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span style="color: red; font-size:15px;"
                                                        class="glyphicon glyphicon-star{{ $i <= $avgRating ? '' : '-empty' }}"></span>
                                                @endfor
                                                ({{ count($reviewProducts) }})
                                            @else
                                                <span class="text-danger">No Review</span>
                                            @endif

                                            <div class="description"></div>

                                            <div class="product-price">	
                                                @if($related_product->discount_price)
                                                    @if(session()->get('language') == 'bangla')
                                                        <span class="price">৳{{ bn_price(number_format($related_product->discount_price, 2)) }}</span>
                                                        <span class="price-before-discount">৳{{ bn_price(number_format($related_product->selling_price, 2)) }}
                                                    @else
                                                        <span class="price">${{ number_format($related_product->discount_price, 2) }}</span>
                                                        <span class="price-before-discount">${{ number_format($related_product->selling_price, 2) }}
                                                    @endif
                                                @else
                                                    @if(session()->get('language') == 'bangla')
                                                        <span class="price">৳{{ bn_price(number_format($related_product->selling_price, 2)) }}</span>
                                                    @else
                                                        <span class="price">${{ number_format($related_product->selling_price, 2) }}</span>
                                                    @endif
                                                @endif

                                            </div><!-- /.product-price -->

                                        </div><!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                                            <i class="fa fa-shopping-cart"></i>													
                                                        </button>
                                                        <button class="btn btn-primary cart-btn" type="button">@if(session()->get('language') == 'bangla') কার্টে যোগ করুন @else Add to cart @endif</button>

                                                    </li>

                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                            <i class="icon fa fa-heart"></i>
                                                        </a>
                                                    </li>

                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="detail.html" title="Compare">
                                                            <i class="fa fa-signal"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div><!-- /.action -->
                                        </div><!-- /.cart -->
                                    </div><!-- /.product -->

                                </div><!-- /.products -->
                            </div><!-- /.item -->
                            @endforeach

                        </div><!-- /.home-owl-carousel -->
                    </section><!-- /.section -->
                    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.partials.brand_carousel')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
    </div><!-- /.body-content -->
</div>

<script src="{{ asset('js/app.js') }}" defer></script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0&appId=915308036019808&autoLogAppEvents=1" nonce="F3WY50T8"></script>

<!-- share product button -->
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=61f501915f957c0019a789ef&product=inline-share-buttons" async="async"></script>
@endsection
