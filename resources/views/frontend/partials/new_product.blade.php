<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
    <div class="more-info-tab clearfix ">
        <h3 class="new-product-title pull-left">@if(session()->get('language') == 'bangla') নতুন পণ্য @else New Products @endif</h3>
        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">@if(session()->get('language') == 'bangla') সব @else All @endif</a></li>
            @foreach($categories as $category)
            <li>
                @if(session()->get('language') == 'bangla')
                    <a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">{{ $category->name_bn }}</a>
                @else
                    <a data-transition-type="backSlide" href="#category{{ $category->id }}" data-toggle="tab">{{ $category->name_en }}</a>
                @endif
            </li>
            @endforeach
        </ul><!-- /.nav-tabs -->
    </div>

    <div class="tab-content outer-top-xs">
        <div class="tab-pane in active" id="all">			
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                    @foreach($products as $product)
                    <div class="item item-carousel">
                        <div class="products">

                            <div class="product">		
                                <div class="product-image">
                                    <div class="image">
                                        <a href="{{ route('product.details', $product->id) }}"><img  src="{{ asset('backend/images/products/'.$product->product_image) }}" height="200" alt=""></a>
                                    </div><!-- /.image -->
                                    
                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price)*100;
                                    @endphp
                                    
                                    @if($product->discount_price == null)
                                        <div class="tag new">
                                            <span>@if(session()->get('language') == 'bangla') নতুন @else new @endif</span>
                                        </div> 
                                    @else
                                        <div class="tag sale">
                                            <span>@if(session()->get('language') == 'bangla') {{ bn_price(round($discount)) }}% @else {{ round($discount) }}% @endif</span>
                                        </div> 
                                    @endif
                                    
                                </div><!-- /.product-image -->


                                <div class="product-info text-left">
                                    <h3 class="name">
                                        @if(session()->get('language') == 'bangla')
                                            <a href="{{ route('product.details', $product->id) }}">{{ $product->name_bn }}</a>
                                        @else
                                            <a href="{{ route('product.details', $product->id) }}">{{ $product->name_en }}</a>
                                        @endif
                                        
                                    </h3>
                                    @if (App\Models\Review::where('product_id', $product->id)->first())
                                        @php
                                            $reviewProducts = App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 'approved')
                                                ->latest()
                                                ->get();
                                            $rating = App\Models\Review::where('product_id', $product->id)
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
                                        @if($product->discount_price)
                                            @if(session()->get('language') == 'bangla')
                                                <span class="price">৳{{ bn_price(number_format($product->discount_price, 2)) }}</span>
                                                <span class="price-before-discount">৳{{ bn_price(number_format($product->selling_price, 2)) }}</span>
                                            @else
                                                <span class="price">${{ number_format($product->discount_price, 2) }}</span>
                                                <span class="price-before-discount">${{ number_format($product->selling_price, 2) }}</span>
                                            @endif
                                        @else
                                            @if(session()->get('language') == 'bangla')
                                                <span class="price">৳{{ bn_price(number_format($product->selling_price, 2)) }}</span>
                                            @else
                                                <span class="price">${{ number_format($product->selling_price, 2) }}</span>
                                            @endif
                                        @endif
                                        

                                    </div><!-- /.product-price -->

                                </div><!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button data-toggle="modal" class="btn btn-primary icon" type="button" id="{{ $product->id }}" title="Add Cart" data-target="#cartModal" onclick="productView(this.id)">
                                                    <i class="fa fa-shopping-cart"></i>													
                                                </button>
                                                <button class="btn btn-primary cart-btn" type="button">@if(session()->get('language') == 'bangla') কার্টে যোগ করুন @else Add to cart @endif</button>

                                            </li>

                                            <li class="lnk wishlist">
                                                <button type="submit" class="add-to-cart" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)">
                                                    <i class="icon fa fa-heart"></i>
                                                </button>
                                            </li>

                                            <li class="lnk">
                                                <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare">
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
            </div><!-- /.product-slider -->
        </div><!-- /.tab-pane -->
        
        @foreach($categories as $category)
        <div class="tab-pane" id="category{{ $category->id }}">
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                    @php
                        $catewiseProducts = App\Models\Product::where('category_id', $category->id)->orderBy('id', 'DESC')->get();
                    @endphp
                    
                    @forelse($catewiseProducts as $catewiseProduct)
                    <div class="item item-carousel">
                        <div class="products">

                            <div class="product">		
                                <div class="product-image">
                                    <div class="image">
                                        <a href="{{ route('product.details', $catewiseProduct->id) }}"><img  src="{{ asset('backend/images/products/'.$catewiseProduct->product_image) }}" height="200" alt=""></a>
                                    </div><!-- /.image -->			   
                                    
                                    @php
                                        $amount = $catewiseProduct->selling_price - $catewiseProduct->discount_price;
                                        $discount = ($amount/$catewiseProduct->selling_price)*100;
                                    @endphp
                                    
                                    @if($catewiseProduct->discount_price == null)
                                        <div class="tag new">
                                            <span>@if(session()->get('language') == 'bangla') নতুন @else new @endif</span>
                                        </div> 
                                    @else
                                        <div class="tag sale">
                                            <span>@if(session()->get('language') == 'bangla') {{ bn_price(round($discount)) }}% @else {{ round($discount) }}% @endif</span>
                                        </div> 
                                    @endif
                                </div><!-- /.product-image -->


                                <div class="product-info text-left">
                                    <h3 class="name">
                                        @if(session()->get('language') == 'bangla')
                                            <a href="{{ route('product.details', $catewiseProduct->id) }}">{{ $catewiseProduct->name_bn }}</a>
                                        @else
                                            <a href="{{ route('product.details', $catewiseProduct->id) }}">{{ $catewiseProduct->name_en }}</a>
                                        @endif
                                    </h3>
                                    @if (App\Models\Review::where('product_id', $catewiseProduct->id)->first())
                                        @php
                                            $reviewProducts = App\Models\Review::where('product_id', $catewiseProduct->id)
                                                ->where('status', 'approved')
                                                ->latest()
                                                ->get();
                                            $rating = App\Models\Review::where('product_id', $catewiseProduct->id)
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
                                        @if($catewiseProduct->discount_price == NULL)
                                            @if(session()->get('language') == 'bangla')
                                                <span class="price">৳{{ bn_price(number_format($catewiseProduct->selling_price, 2)) }}</span>
                                            @else
                                                <span class="price">${{ number_format($catewiseProduct->selling_price, 2) }}</span>
                                            @endif
                                            
                                        @else
                                            @if(session()->get('language') == 'bangla')
                                                <span class="price">৳{{ bn_price(number_format($catewiseProduct->discount_price, 2)) }}</span>
                                                <span class="price-before-discount">৳{{ bn_price(number_format($catewiseProduct->selling_price, 2)) }}</span>
                                            @else
                                                <span class="price">${{ number_format($catewiseProduct->discount_price, 2) }}</span>
                                                <span class="price-before-discount">${{ number_format($catewiseProduct->selling_price, 2) }}</span>
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
                                                <button type="submit" class="add-to-cart" title="Wishlist" id="{{ $catewiseProduct->id }}" onclick="addToWishlist(this.id)">
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
                    @empty
                    <h5 class='text-danger'>
                        @if(session()->get('language') == 'bangla')
                            কোন পণ্য পাওয়া যায়নি
                        @else
                            No Product Found
                        @endif
                    </h5>
                    @endforelse

                </div><!-- /.home-owl-carousel -->
            </div><!-- /.product-slider -->
        </div><!-- /.tab-pane -->
        @endforeach

    </div><!-- /.tab-content -->
</div><!-- /.scroll-tabs -->