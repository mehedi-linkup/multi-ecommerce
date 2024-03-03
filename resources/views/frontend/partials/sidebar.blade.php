<div class="col-xs-12 col-sm-12 col-md-3 sidebar">

   
    <!-- ================================== TOP NAVIGATION ================================== -->
    @include('frontend.partials.category')
    <!-- ================================== TOP NAVIGATION : END ================================== -->

    <!-- ============================================== HOT DEALS ============================================== -->
    @include('frontend.partials.hot_deal')
    <!-- ============================================== HOT DEALS: END ============================================== -->


    <!-- ============================================== SPECIAL OFFER ============================================== -->

    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
        <h3 class="section-title">@if(session()->get('language') == 'bangla') বিশেষ প্রস্তাব @else Special Offer @endif</h3>
        <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                <div class="item">
                    <div class="products special-product">
                        @foreach($special_offers as $special_offer)
                        <div class="product">
                            <div class="product-micro">
                                <div class="row product-micro-row">
                                    <div class="col col-xs-5">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="{{ route('product.details', $special_offer->id) }}">
                                                    <img src="{{ asset('backend/images/products/'.$special_offer->product_image) }}" alt="">
                                                </a>					
                                            </div><!-- /.image -->



                                        </div><!-- /.product-image -->
                                    </div><!-- /.col -->
                                    <div class="col col-xs-7">
                                        <div class="product-info">
                                            <h3 class="name">
                                                @if(session()->get('language') == 'bangla')
                                                    <a href="{{ route('product.details', $special_offer->id) }}">{{ $special_offer->name_bn }}</a>
                                                @else
                                                    <a href="{{ route('product.details', $special_offer->id) }}">{{ $special_offer->name_en }}</a>
                                                @endif
                                            </h3>
                                            @if (App\Models\Review::where('product_id', $special_offer->id)->first())
                                                @php
                                                    $reviewProducts = App\Models\Review::where('product_id', $special_offer->id)
                                                        ->where('status', 'approved')
                                                        ->latest()
                                                        ->get();
                                                    $rating = App\Models\Review::where('product_id', $special_offer->id)
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
                                            
                                            <div class="product-price">	
                                                @if(session()->get('language') == 'bangla')
                                                    <span class="price">৳{{ bn_price(number_format($special_offer->selling_price, 2)) }}
                                                @else
                                                    <span class="price">${{ number_format($special_offer->selling_price, 2) }}
                                                @endif

                                            </div><!-- /.product-price -->

                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.product-micro-row -->
                            </div><!-- /.product-micro -->

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div><!-- /.sidebar-widget-body -->
    </div><!-- /.sidebar-widget -->
    <!-- ============================================== SPECIAL OFFER : END ============================================== -->
    <!-- ============================================== PRODUCT TAGS ============================================== -->
    @include('frontend.partials.tag_product')
    <!-- ============================================== PRODUCT TAGS : END ============================================== -->
    <!-- ============================================== SPECIAL DEALS ============================================== -->

    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
        <h3 class="section-title">@if(session()->get('language') == 'bangla') বিশেষ চুক্তি @else Special Deals @endif</h3>
        <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                <div class="item">
                    <div class="products special-product">
                        @foreach($special_deals as $special_deal)
                        <div class="product">
                            <div class="product-micro">
                                <div class="row product-micro-row">
                                    <div class="col col-xs-5">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="{{ route('product.details', $special_deal->id) }}">
                                                    <img src="{{ asset('backend/images/products/'.$special_deal->product_image) }}"  alt="">
                                                </a>					
                                            </div><!-- /.image -->


                                        </div><!-- /.product-image -->
                                    </div><!-- /.col -->
                                    <div class="col col-xs-7">
                                        <div class="product-info">
                                            <h3 class="name">
                                                @if(session()->get('language') == 'bangla')
                                                    <a href="{{ route('product.details', $special_deal->id) }}">{{ $special_deal->name_bn }}</a>
                                                @else
                                                    <a href="{{ route('product.details', $special_deal->id) }}">{{ $special_deal->name_en }}</a>
                                                @endif
                                            </h3>
                                            @if (App\Models\Review::where('product_id', $special_deal->id)->first())
                                                @php
                                                    $reviewProducts = App\Models\Review::where('product_id', $special_deal->id)
                                                        ->where('status', 'approved')
                                                        ->latest()
                                                        ->get();
                                                    $rating = App\Models\Review::where('product_id', $special_deal->id)
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
                                                    
                                            <div class="product-price">	
                                                <span class="price">
                                                    @if(session()->get('language') == 'bangla')
                                                        <span class="price">৳{{ bn_price(number_format($special_deal->selling_price, 2)) }}
                                                    @else
                                                        <span class="price">${{ number_format($special_deal->selling_price, 2) }}
                                                    @endif				
                                                </span>

                                            </div><!-- /.product-price -->

                                        </div>
                                    </div><!-- /.col -->
                                </div><!-- /.product-micro-row -->
                            </div><!-- /.product-micro -->

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div><!-- /.sidebar-widget-body -->
    </div><!-- /.sidebar-widget -->
    <!-- ============================================== SPECIAL DEALS : END ============================================== -->
    <!-- ============================================== NEWSLETTER ============================================== -->
    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
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
                <div class="avatar"><img src="{{ asset('frontend') }}/assets/images/testimonials/member1.png" alt="Image"></div>
                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                <div class="clients_author">John Doe	<span>Abc Company</span>	</div><!-- /.container-fluid -->
            </div><!-- /.item -->

            <div class="item">
                <div class="avatar"><img src="{{ asset('frontend') }}/assets/images/testimonials/member3.png" alt="Image"></div>
                <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                <div class="clients_author">Stephen Doe	<span>Xperia Designs</span>	</div>    
            </div><!-- /.item -->

            <div class="item">
                <div class="avatar"><img src="{{ asset('frontend') }}/assets/images/testimonials/member2.png" alt="Image"></div>
                <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                <div class="clients_author">Saraha Smith	<span>Datsun &amp; Co</span>	</div><!-- /.container-fluid -->
            </div><!-- /.item -->

        </div><!-- /.owl-carousel -->
    </div>

    <!-- ============================================== Testimonials: END ============================================== -->

    <div class="home-banner">
        <img src="{{ asset('frontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
    </div> 




</div><!-- /.sidemenu-holder -->