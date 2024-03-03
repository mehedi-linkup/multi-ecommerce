@extends('frontend.layouts.master')
@section('main_content')

@section('title') Flipmart - Shop Product @endsection

@php
    function bn_price($str){
        $en = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        $bn = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $str = str_replace($en, $bn, $str);
        return $str;
    }
@endphp


<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Shop Product</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class='container'>
        <form action="{{ route('product.shop.filter') }}" method="POST">
            @csrf
            
            <div class='row'>
                <div class='col-md-3 sidebar'>
                    <!-- ================================== TOP NAVIGATION ================================== -->
                    @include('frontend.partials.category')
                    <!-- ================================== TOP NAVIGATION : END ================================== -->	            
                    <div class="sidebar-module-container">

                        <div class="sidebar-filter">
                            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <h3 class="section-title">@if(session()->get('language') == 'bangla') বিভাগ দ্বারা কেনাকাটা @else shop by category @endif </h3>
                                <div class="widget-header">
                                    <h4 class="widget-title">@if(session()->get('language') == 'bangla') ক্যাটাগরি @else Category @endif</h4>
                                </div>
                                <div class="sidebar-widget-body">
                                    <div class="accordion">
                                        @if (!empty($_GET['category']))
                                            @php
                                                $filterCat = explode(',', $_GET['category']);
                                            @endphp
                                        @endif
                                        
                                        @foreach($categories as $category)
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="category[]" id="" value="{{ $category->slug_en }}" @if (!empty($filterCat) && in_array($category->slug_en, $filterCat)) checked @endif onchange="this.form.submit();">
                                                            @if (session()->get('language') == 'bangla')
                                                                {{ $category->name_bn }}
                                                            @else
                                                                {{ $category->name_en }}
                                                            @endif
                                                    </label>
                                                </div><!-- /.accordion-heading -->
                                            </div><!-- /.accordion-group -->
                                        @endforeach

                                    </div><!-- /.accordion -->
                                </div><!-- /.sidebar-widget-body -->
                            </div><!-- /.sidebar-widget -->
                            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

                            <!-- ============================================== SIDEBAR BRAND ============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <h3 class="section-title">@if(session()->get('language') == 'bangla') ব্র্যান্ড দ্বারা কেনাকাটা @else shop by Brand @endif </h3>
                                <div class="widget-header">
                                    <h4 class="widget-title">@if(session()->get('language') == 'bangla') ব্র্যান্ড @else Brand @endif</h4>
                                </div>
                                <div class="sidebar-widget-body">
                                    <div class="accordion">
                                        @if (!empty($_GET['brand']))
                                            @php
                                                $filterBrand = explode(',', $_GET['brand']);
                                            @endphp
                                        @endif
                                        
                                        @foreach($brands as $brand)
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="brand[]" id="" value="{{ $brand->slug_en }}" @if (!empty($filterBrand) && in_array($brand->slug_en, $filterBrand)) checked @endif onchange="this.form.submit();">
                                                            @if (session()->get('language') == 'bangla')
                                                                {{ $brand->name_bn }}
                                                            @else
                                                                {{ $brand->name_en }}
                                                            @endif
                                                    </label>
                                                </div><!-- /.accordion-heading -->
                                            </div><!-- /.accordion-group -->
                                        @endforeach

                                    </div><!-- /.accordion -->
                                </div><!-- /.sidebar-widget-body -->
                            </div><!-- /.sidebar-widget -->
                            <!-- ============================================== SIDEBAR BRAND : END ============================================== -->

                            <!-- ============================================== PRICE SILDER============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <div class="widget-header">
                                    <h4 class="widget-title">Price Range</h4>
                                </div>
                                <div class="sidebar-widget-body m-t-10">
                                    <div id="slider-range" class="price-filter-range" data-min="{{ Helpers::minPrice() }}" data-max="{{ Helpers::maxPrice() }}">
                                        

                                    </div><!-- /.price-range-holder -->
                                    <br>
                                    <input type="hidden" id="price_range" name="price_range" value="@if (!empty($_GET['price'])) {{ $_GET['price'] }} @endif">
                                    @if (!empty($_GET['price']))
                                        @php
                                            $price = explode('-', $_GET['price']);
                                        @endphp
                                    @endif
                                    <input type="text" id="amount" class="form-control" value="@if (!empty($_GET['price'])) ${{ $price[0] }} @else {{ Helpers::minPrice() }} @endif-@if (!empty($_GET['price'])) ${{ $price[1] }} @else {{ Helpers::maxPrice() }} @endif" readonly> <br>
                                    
                                    <button type="submit" class="lnk btn btn-primary">Filter</button>
                                </div><!-- /.sidebar-widget-body -->
                            </div><!-- /.sidebar-widget -->
                            <!-- ============================================== PRICE SILDER : END ============================================== -->


                            <!-- ============================================== PRODUCT TAGS ============================================== -->
                            @include('frontend.partials.tag_product')
                            <!-- ============================================== PRODUCT TAGS : END ============================================== -->		            	<!-- <!-- ============================================== Testimonials============================================== -->
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

                            <div class="home-banner">
                                <img src="{{ asset('frontend') }}/assets//images/banners/LHS-banner.jpg" alt="Image">
                            </div> 

                        </div><!-- /.sidebar-filter -->
                    </div><!-- /.sidebar-module-container -->
                </div><!-- /.sidebar -->
                <div class='col-md-9'>
                    <!-- ========================================== SECTION – HERO ========================================= -->

                    <div id="category" class="category-carousel hidden-xs">
                        <div class="item">	
                            <div class="image">
                                <img src="{{ asset('frontend') }}/assets//images/banners/cat-banner-1.jpg" alt="" class="img-responsive">
                            </div>
                            <div class="container-fluid">
                                <div class="caption vertical-top text-left">
                                    <div class="big-text">
                                        Big Sale
                                    </div>

                                    <div class="excerpt hidden-sm hidden-md">
                                        Save up to 49% off
                                    </div>
                                    <div class="excerpt-normal hidden-sm hidden-md">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                    </div>

                                </div><!-- /.caption -->
                            </div><!-- /.container-fluid -->
                        </div>
                    </div>


                    <!-- ========================================= SECTION – HERO : END ========================================= -->
                    <div class="clearfix filters-container m-t-10">
                        <div class="row">
                            <div class="col col-sm-6 col-md-2">
                                <div class="filter-tabs">
                                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                        <li class="active">
                                            <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a>
                                        </li>
                                        <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                                    </ul>
                                </div><!-- /.filter-tabs -->
                            </div><!-- /.col -->
                            <div class="col col-sm-12 col-md-6">
                                <div class="col col-sm-4 col-md-6 no-padding">
                                    <div class="lbl-cnt">
                                        <div class="fld inline">
                                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                <select class="form-control" name="sortBy" onchange="this.form.submit();">
                                                    <option value="">Sort By Products</option>
                                                    <option value="priceLowtoHigh" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceLowtoHigh') selected @endif>Price:Lower to Higher</option>
                                                    <option value="priceHightoLow" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceHightoLow') selected @endif>Price:Higher to Lower</option>
                                                    <option value="nameAtoZ" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'nameAtoZ') selected @endif>Product Name:A to Z</option>
                                                    <option value="nameZtoA" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'nameZtoA') selected @endif>Product Name:Z to A</option>
                                                </select>
                                            </div>
                                        </div><!-- /.fld -->
                                    </div><!-- /.lbl-cnt -->
                                </div><!-- /.col -->
                                
                            </div><!-- /.col -->

                            {{ $products->appends($_GET)->links('vendor.pagination.custom') }}


                        </div><!-- /.row -->
                    </div>
                    <div class="search-result-container ">
                        <div id="myTabContent" class="tab-content category-list">
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product">
                                    <div class="row">									
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
                                                                    <button class="add-to-cart" type="submit" title="Wishlist" id="{{ $product->id }}" onclick="addToWishlist(this.id)">
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

                                    </div><!-- /.row -->
                                </div><!-- /.category-product -->

                            </div><!-- /.tab-pane -->

                            <div class="tab-pane "  id="list-container">
                                <div class="category-product">

                                    @foreach($products as $product)
                                    <div class="category-product-inner wow fadeInUp">
                                        <div class="products">				
                                            <div class="product-list product">
                                                <div class="row product-list-row">
                                                    <div class="col col-sm-4 col-lg-4">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <img src="{{ asset('backend/images/products/'.$product->product_image) }}" alt="">
                                                            </div>
                                                        </div><!-- /.product-image -->
                                                    </div><!-- /.col -->
                                                    <div class="col col-sm-8 col-lg-8">
                                                        <div class="product-info">
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
                                                            <div class="description m-t-10">
                                                                @if(session()->get('language') == 'bangla')
                                                                   {!! $product->short_desc_bn !!}
                                                                @else
                                                                    {!! $product->short_desc_en !!}
                                                                @endif
                                                            </div>
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

                                                        </div><!-- /.product-info -->	
                                                    </div><!-- /.col -->
                                                </div><!-- /.product-list-row -->
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
                                            </div><!-- /.product-list -->
                                        </div><!-- /.products -->
                                    </div><!-- /.category-product-inner -->
                                    @endforeach

                                </div><!-- /.category-product -->
                            </div><!-- /.tab-pane #list-container -->
                        </div><!-- /.tab-content -->

                        {{ $products->appends($_GET)->links('vendor.pagination.custom') }}

                    </div><!-- /.search-result-container -->

                </div><!-- /.col -->
            </div><!-- /.row -->
        </form>
        
        
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.partials.brand_carousel')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->

</div><!-- /.body-content -->

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        if ($('#slider-range').length > 0) {
            const max_price = parseInt($('#slider-range').data('max'));
            const min_price = parseInt($('#slider-range').data('min'));
            let price_range = min_price + "-" + max_price;
            if ($('#price_range').length > 0 && $('#price_range').val()) {
                price_range = $('#price_range').val().trim();
            }
            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_price,
                max: max_price,
                values: price,
                slide: function(event, ui) {
                    $("#amount").val('$' + ui.values[0] + "-" + '$' + ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
        }
    });

</script>
@endsection