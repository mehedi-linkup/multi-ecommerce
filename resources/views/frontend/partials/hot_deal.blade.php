<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    @php
        $hotdeals = App\Models\Product::where('hot_deals', 1)->where('status', 1)->where('discount_price', '!=', null)->orderBy('id', 'DESC')->get();
    @endphp

    <h3 class="section-title">@if(session()->get('language') == 'bangla') হট ডিল @else hot deals @endif</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @foreach($hotdeals as $hotdeal)
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image">
                        <img src="{{ asset('backend/images/products/'.$hotdeal->product_image) }}" height="300" alt="">
                    </div>
                    <div class="sale-offer-tag">
                        @php
                            $amount = $hotdeal->selling_price - $hotdeal->discount_price;
                            $discount = ($amount/$hotdeal->selling_price)*100;
                        @endphp

                        @if($hotdeal->discount_price)
                            <span> @if(session()->get('language') == 'bangla') {{ bn_price(round($discount)) }}% @else {{ round($discount) }}% @endif <br> off</span>

                        @endif
                    </div>
                    <div class="timing-wrapper">
                        <div class="box-wrapper">
                            <div class="date box">
                                <span class="key">120</span>
                                <span class="value">DAYS</span>
                            </div>
                        </div>

                        <div class="box-wrapper">
                            <div class="hour box">
                                <span class="key">20</span>
                                <span class="value">HRS</span>
                            </div>
                        </div>

                        <div class="box-wrapper">
                            <div class="minutes box">
                                <span class="key">36</span>
                                <span class="value">MINS</span>
                            </div>
                        </div>

                        <div class="box-wrapper hidden-md">
                            <div class="seconds box">
                                <span class="key">60</span>
                                <span class="value">SEC</span>
                            </div>
                        </div>
                    </div>
                </div><!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    <h3 class="name">
                        @if(session()->get('language') == 'bangla')
                            <a href="{{ route('product.details', $hotdeal->id) }}">{{ $hotdeal->name_bn }}</a>
                        @else
                            <a href="{{ route('product.details', $hotdeal->id) }}">{{ $hotdeal->name_en }}</a>
                        @endif
                    </h3>
                    @if (App\Models\Review::where('product_id', $hotdeal->id)->first())
                        @php
                            $reviewProducts = App\Models\Review::where('product_id', $hotdeal->id)
                                ->where('status', 'approved')
                                ->latest()
                                ->get();
                            $rating = App\Models\Review::where('product_id', $hotdeal->id)
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
                        @if($hotdeal->discount_price)
                            @if(session()->get('language') == 'bangla')
                                <span class="price">৳{{ bn_price(number_format($hotdeal->discount_price, 2)) }}</span>
                                <span class="price-before-discount">৳{{ bn_price(number_format($hotdeal->selling_price, 2)) }}
                            @else
                                <span class="price">${{ number_format($hotdeal->discount_price, 2) }}</span>
                                <span class="price-before-discount">${{ number_format($hotdeal->selling_price, 2) }}
                            @endif
                        @else
                            @if(session()->get('language') == 'bangla')
                                <span class="price">৳{{ bn_price(number_format($hotdeal->selling_price, 2)) }}</span>
                            @else
                                <span class="price">${{ number_format($hotdeal->selling_price, 2) }}</span>
                            @endif
                        @endif					

                    </div><!-- /.product-price -->

                </div><!-- /.product-info -->

                <div class="cart clearfix animate-effect">
                    <div class="action">

                        <div class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="modal" type="button" id="{{ $hotdeal->id }}" data-target="#cartModal" onclick="productView(this.id)">
                                <i class="fa fa-shopping-cart"></i>													
                            </button>
                            <button class="btn btn-primary cart-btn" type="button">@if(session()->get('language') == 'bangla') কার্টে যোগ করুন @else Add to cart @endif</button>

                        </div>

                    </div><!-- /.action -->
                </div><!-- /.cart -->
            </div>	
        </div>		        
        @endforeach

    </div><!-- /.sidebar-widget -->
</div>