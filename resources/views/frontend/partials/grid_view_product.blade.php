@foreach($products as $product)
<div class="col-sm-6 col-md-4 wow fadeInUp">
    <div class="products">

        <div class="product">		
            <div class="product-image">
                <div class="image">
                    <a href="{{ route('product.details', $product->id) }}"><img  src="{{ asset('backend/images/products/'.$product->product_image) }}" height="280" alt=""></a>
                </div><!-- /.image -->			

                @php
                    $amount = $product->selling_price - $product->discount_price;
                    $discount = ($amount/$product->selling_price)*100;
                @endphp

                @if($product->discount_price == NULL)
                    <div class="tag new">
                        <span> @if(session()->get('language') == 'bangla') নতুন @else new @endif</span>
                    </div>  
                @else
                    <div class="tag sale">
                        <span> @if(session()->get('language') == 'bangla') {{ bn_price(round($discount)) }}% @else {{ round($discount) }}% @endif</span>
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
                            <span class="price-before-discount">৳{{ bn_price(number_format($product->selling_price, 2)) }}
                        @else
                            <span class="price">${{ number_format($product->discount_price, 2) }}</span>
                            <span class="price-before-discount">${{ number_format($product->selling_price, 2) }}
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
                            <button class="btn btn-primary icon" data-toggle="modal" type="button" id="{{ $product->id }}" data-target="#cartModal" onclick="productView(this.id)">
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