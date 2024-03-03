<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">@if(session()->get('language') == 'bangla') {{ $skip_category->name_bn }} @else {{ $skip_category->name_en }} @endif</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
        
        @foreach($skip_product as $feature)
        <div class="item item-carousel">
            <div class="products">

                <div class="product">		
                    <div class="product-image">
                        <div class="image">
                            <a href="{{ route('product.details', $feature->id) }}"><img  src="{{ asset('backend/images/products/'.$feature->product_image) }}" height="200" alt=""></a>
                        </div><!-- /.image -->			

                        @php
                            $amount = $feature->selling_price - $feature->discount_price;
                            $discount = ($amount/$feature->selling_price)*100;
                        @endphp

                        @if($feature->discount_price == NULL)
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
                                <a href="{{ route('product.details', $feature->id) }}">{{ $feature->name_bn }}</a>
                            @else
                                <a href="{{ route('product.details', $feature->id) }}">{{ $feature->name_en }}</a>
                            @endif
                        </h3>
                        @if (App\Models\Review::where('product_id', $feature->id)->first())
                            @php
                                $reviewProducts = App\Models\Review::where('product_id', $feature->id)
                                    ->where('status', 'approved')
                                    ->latest()
                                    ->get();
                                $rating = App\Models\Review::where('product_id', $feature->id)
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
                            @if($feature->discount_price)
                                @if(session()->get('language') == 'bangla')
                                    <span class="price">৳{{ bn_price(number_format($feature->discount_price, 2)) }}</span>
                                    <span class="price-before-discount">৳{{ bn_price(number_format($feature->selling_price, 2)) }}
                                @else
                                    <span class="price">${{ number_format($feature->discount_price, 2) }}</span>
                                    <span class="price-before-discount">${{ number_format($feature->selling_price, 2) }}
                                @endif
                            @else
                                @if(session()->get('language') == 'bangla')
                                    <span class="price">৳{{ bn_price(number_format($feature->selling_price, 2)) }}</span>
                                @else
                                    <span class="price">${{ number_format($feature->selling_price, 2) }}</span>
                                @endif
                            @endif

                        </div><!-- /.product-price -->

                    </div><!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                    <button class="btn btn-primary icon" data-toggle="modal" type="button" id="{{ $feature->id }}" data-target="#cartModal" onclick="productView(this.id)">
                                        <i class="fa fa-shopping-cart"></i>													
                                    </button>
                                    <button class="btn btn-primary cart-btn" type="button">@if(session()->get('language') == 'bangla') কার্টে যোগ করুন @else Add to cart @endif</button>

                                </li>

                                <li class="lnk wishlist">
                                    <button class="add-to-cart" type="submit" title="Wishlist" id="{{ $feature->id }}" onclick="addToWishlist(this.id)">
                                        <i class="icon fa fa-heart"></i>
                                    </button>
                                </li>

                                <li class="lnk">
                                    <a class="add-to-cart" href="detail.html" title="Compare">
                                        <i class="fa fa-signal" aria-hidden="true"></i>
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

<!-- Skip category -->

<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">@if(session()->get('language') == 'bangla') {{ $skip_category1->name_bn }} @else {{ $skip_category1->name_en }} @endif</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
        
        @foreach($skip_product1 as $feature)
        <div class="item item-carousel">
            <div class="products">

                <div class="product">		
                    <div class="product-image">
                        <div class="image">
                            <a href="{{ route('product.details', $feature->id) }}"><img  src="{{ asset('backend/images/products/'.$feature->product_image) }}" height="200" alt=""></a>
                        </div><!-- /.image -->			

                        @php
                            $amount = $feature->selling_price - $feature->discount_price;
                            $discount = ($amount/$feature->selling_price)*100;
                        @endphp

                        @if($feature->discount_price == NULL)
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
                                <a href="{{ route('product.details', $feature->id) }}">{{ $feature->name_bn }}</a>
                            @else
                                <a href="{{ route('product.details', $feature->id) }}">{{ $feature->name_en }}</a>
                            @endif
                        </h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>

                        <div class="product-price">	
                            @if($feature->discount_price)
                                @if(session()->get('language') == 'bangla')
                                    <span class="price">৳{{ bn_price(number_format($feature->discount_price, 2)) }}</span>
                                    <span class="price-before-discount">৳{{ bn_price(number_format($feature->selling_price, 2)) }}
                                @else
                                    <span class="price">${{ number_format($feature->discount_price, 2) }}</span>
                                    <span class="price-before-discount">${{ number_format($feature->selling_price, 2) }}
                                @endif
                            @else
                                @if(session()->get('language') == 'bangla')
                                    <span class="price">৳{{ bn_price(number_format($feature->selling_price, 2)) }}</span>
                                @else
                                    <span class="price">${{ number_format($feature->selling_price, 2) }}</span>
                                @endif
                            @endif

                        </div><!-- /.product-price -->

                    </div><!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                    <button class="btn btn-primary icon" data-toggle="modal" type="button" id="{{ $feature->id }}" data-target="#cartModal" onclick="productView(this.id)">
                                        <i class="fa fa-shopping-cart"></i>													
                                    </button>
                                    <button class="btn btn-primary cart-btn" type="button">@if(session()->get('language') == 'bangla') কার্টে যোগ করুন @else Add to cart @endif</button>

                                </li>

                                <li class="lnk wishlist">
                                    <button class="add-to-cart" type="submit" title="Wishlist" id="{{ $feature->id }}" onclick="addToWishlist(this.id)">
                                        <i class="icon fa fa-heart"></i>
                                    </button>
                                </li>

                                <li class="lnk">
                                    <a class="add-to-cart" href="detail.html" title="Compare">
                                        <i class="fa fa-signal" aria-hidden="true"></i>
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