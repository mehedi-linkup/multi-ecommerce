
<style>
    .search-area {
        position: relative;
    }

    #suggestProduct {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #fff;
        z-index: 999;
        border-radius: 4px;
        margin-top: 2px;
    }

</style>

<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="icon fa fa-user"></i>@if(session()->get('language') == 'bangla') আমার অ্যাকাউন্ট @else My Account @endif</a></li>
                        <li><a href="{{ route('wishlist.index') }}"><i class="icon fa fa-heart"></i>@if(session()->get('language') == 'bangla') ইচ্ছেতালিকা @else Wishlist @endif</a></li>
                        <li><a href="{{ route('product.carts') }}"><i class="icon fa fa-shopping-cart"></i>@if(session()->get('language') == 'bangla') আমার কার্ট @else My Cart @endif</a></li>
                        <li><a href="{{ route('product.checkout') }}"><i class="icon fa fa-check"></i>@if(session()->get('language') == 'bangla') চেকআউট @else Checkout @endif</a></li>
                        
                        
                        <li>
                            @auth
                                <a href="{{ route('user.dashboard') }}"><i class="icon fa fa-user"></i>@if(session()->get('language') == 'bangla') আমার প্রোফাইল @else My Profile @endif</a>
                            @else
                                <a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>@if(session()->get('language') == 'bangla') লগইন/রেজিস্টার করুন @else Login/Register @endif</a>
                            @endif
                        </li>
                    </ul>
                </div><!-- /.cnt-account -->

                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="modal" data-target="#exampleModal"><span class="value"> Order Tracke</a>
                            
                        </li>

                        <li class="dropdown dropdown-small">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">@if(session()->get('language') == 'bangla') ভাষা পরিবর্তন করুন @else Language @endif </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @if(session()->get('language') == 'bangla')
                                    <li><a href="{{ route('english.language') }}">English</a></li>
                                @else
                                    <li><a href="{{ route('bangla.language') }}">বাংলা</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul><!-- /.list-unstyled -->
                </div><!-- /.cnt-cart -->
                
                <!-- Order Tracking Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Order Tracking</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('order.tracking') }}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                              <label for="invoice_no">Invoice No</label>
                              <input type="text" name="invoice_no" class="form-control" id="invoice_no" aria-describedby="emailHelp" placeholder="Enter Invoice No">
                            </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Track Now</button>
                        
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="clearfix"></div>
            </div><!-- /.header-top-inner -->
        </div><!-- /.container -->
    </div><!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo">
                        <a href="{{ route('index') }}">

                            <img src="{{ asset('frontend') }}/assets/images/logo.png" alt="">

                        </a>
                    </div><!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->				</div><!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form action="{{ route('search.product') }}" method="GET">
                            <div class="control-group">
                                <input name="search" id="search" class="search-field" onfocus="showSearchResult()" onblur="hideSearchResult()" placeholder="Search here..." />
                                <button class="search-button"></button>    

                            </div>
                        </form>
                        <div id="suggestProduct"></div>
                    </div><!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart">
                        <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                </div>
                                <div class="basket-item-count"><span class="count" id="cartQty"></span></div>
                                <div class="total-price-basket">
                                    <span class="lbl">@if(session()->get('language') == 'bangla') কার্ট - @else cart - @endif</span>
                                    <span class="total-price">
                                        <span class="sign">$</span><span class="value" id="cartSubTotal"></span>
                                    </span>
                                </div>


                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                 <!-- Mini Cart Start here -->
                                <div id="miniCart">
                                    
                                </div>
                             
                                <div class="clearfix cart-total">
                                    <div class="pull-right">

                                        <span class="text">Sub Total :</span><span class='price' id="cartSubTotal"></span>

                                    </div>
                                    <div class="clearfix"></div>

                                    <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>	
                                </div><!-- /.cart-total-->


                            </li>
                        </ul><!-- /.dropdown-menu-->
                    </div><!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
            </div><!-- /.row -->

        </div><!-- /.container -->

    </div><!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw">
                                    <a href="{{ route('index') }}">@if(session()->get('language') == 'bangla') হোম @else Home @endif</a>

                                </li>
                                
                                @php
                                    $categories = App\Models\Category::orderBy('name_en', 'ASC')->get();
                                @endphp
                                
                                @foreach($categories as $category)
                                <li class="dropdown yamm mega-menu">
                                    @if(session()->get('language') == 'bangla')
                                        <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $category->name_bn }}</a>
                                    @else
                                        <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $category->name_en }}</a>
                                    @endif
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                
                                                <div class="row">
                                                    @php
                                                        $subcategories = App\Models\Subcategory::where('category_id', $category->id)->orderBy('name_en', 'ASC')->get();
                                                    @endphp

                                                    @foreach($subcategories as $subcategory)
                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                        @if(session()->get('language') == 'bangla')
                                                            <a href="{{ route('product.subcategory.wise', $subcategory->id) }}" class="text-center">
                                                                <h2 class="title">{{ $subcategory->name_bn }}</h2>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('product.subcategory.wise', $subcategory->id) }}" class="text-center">
                                                                <h2 class="title">{{ $subcategory->name_en }}</h2>
                                                            </a>
                                                        @endif
                                                        
                                                        @php
                                                            $subsubcategories = App\Models\Subsubcategory::where('subcategory_id', $subcategory->id)->orderBy('subcatename_en', 'ASC')->get();
                                                        @endphp

                                                        
                                                        <ul class="links">
                                                            @foreach($subsubcategories as $subsubcategory)
                                                                @if(session()->get('language') == 'bangla')
                                                                    <li><a href="{{ route('product.subsubcategory.wise', $subsubcategory->id) }}" class="text-center">{{ $subsubcategory->subcatename_bn }}</a></li>
                                                                @else
                                                                    <li><a href="{{ route('product.subsubcategory.wise', $subsubcategory->id) }}" class="text-center">{{ $subsubcategory->subcatename_en }}</a></li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                        
                                                    </div><!-- /.col -->
                                                    @endforeach
                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                        <img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/top-menu-banner.jpg" alt="">

                                                    </div><!-- /.yamm-content -->					
                                                </div>
                                                
                                            </div>

                                        </li>
                                    </ul>

                                </li>
                                @endforeach

                                
                                <li class="dropdown">
                                    <a href="{{ route('product.shop') }}">@if(session()->get('language') == 'bangla') দোকান @else Shop @endif</a>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">@if(session()->get('language') == 'bangla') পাতা @else Pages @endif</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">

                                                    <div class="col-xs-12 col-menu">
                                                        <ul class="links">
                                                            <li><a href="home.html">Home</a></li>
                                                            <li><a href="category.html">Category</a></li>
                                                            <li><a href="detail.html">Detail</a></li>
                                                            <li><a href="shopping-cart.html">Shopping Cart Summary</a></li>
                                                            <li><a href="checkout.html">Checkout</a></li>
                                                            <li><a href="blog.html">Blog</a></li>
                                                            <li><a href="blog-details.html">Blog Detail</a></li>
                                                            <li><a href="contact.html">Contact</a></li>
                                                            <li><a href="sign-in.html">Sign In</a></li>
                                                            <li><a href="my-wishlist.html">Wishlist</a></li>
                                                            <li><a href="terms-conditions.html">Terms and Condition</a></li>
                                                            <li><a href="track-orders.html">Track Orders</a></li>
                                                            <li><a href="product-comparison.html">Product-Comparison</a></li>
                                                            <li><a href="faq.html">FAQ</a></li>
                                                            <li><a href="404.html">404</a></li>

                                                        </ul>
                                                    </div>



                                                </div>
                                            </div>
                                        </li>



                                    </ul>
                                </li>
                                <li class="dropdown  navbar-right special-menu">
                                    <a href="#">Todays offer</a>
                                </li>


                            </ul><!-- /.navbar-nav -->
                            <div class="clearfix"></div>				
                        </div><!-- /.nav-outer -->
                    </div><!-- /.navbar-collapse -->


                </div><!-- /.nav-bg-class -->
            </div><!-- /.navbar-default -->
        </div><!-- /.container-class -->

    </div><!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>

@section('scripts')

<script>
    $("body").on("keyup", "#search", function(){
        let searchData = $("#search").val();
        if(searchData.length > 0){
            $.ajax({
                type: "POST",
                url: "{{ url('/product/get') }}",
                data: {search: searchData},
                success: function(result){
                    $("#suggestProduct").html(result);
                }
            });
        }
        if (searchData.length < 1) $('#suggestProduct').html("");
    })
</script>

<script>
    function showSearchResult() {
        $('#suggestProduct').slideDown();
    }

    function hideSearchResult() {
        $('#suggestProduct').slideUp();
    }

</script>

@endsection