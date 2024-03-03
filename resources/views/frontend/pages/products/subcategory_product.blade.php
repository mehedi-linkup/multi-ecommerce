@extends('frontend.layouts.master')
@section('main_content')

@section('title') Flipmart - Subcategory Product @endsection

@php
function bn_price($str){
        $en = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        $bn = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $str = str_replace($en, $bn, $str);
        return $str;
    }
@endphp

<!-- ========================= HEADER : END ============================================== -->
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Subcategory Product</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>
                <!-- ================================== TOP NAVIGATION ================================== -->
                @include('frontend.partials.category')
                <!-- ================================== TOP NAVIGATION : END ================================== -->	            
                <div class="sidebar-module-container">

                    <div class="sidebar-filter">
                        <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
                        <div class="sidebar-widget wow fadeInUp">
                            <h3 class="section-title">@if(session()->get('language') == 'bangla') দোকানে @else shop by @endif </h3>
                            <div class="widget-header">
                                <h4 class="widget-title">@if(session()->get('language') == 'bangla') ক্যাটাগরি @else Category @endif</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="accordion">
                                    @foreach($categories as $category)
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed">
                                                @if(session()->get('language') == 'bangla') {{ $category->name_bn }} @else {{ $category->name_en }} @endif
                                            </a>
                                        </div><!-- /.accordion-heading -->
                                        <div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
                                            <div class="accordion-inner">
                                                @php
                                                    $subcategories = App\Models\Subcategory::where('category_id', $category->id)->orderBy('name_en', 'ASC')->get();
                                                @endphp
                                                <ul>
                                                    @foreach($subcategories as $subcategory)
                                                    <li>
                                                        @if(session()->get('language') == 'bangla')
                                                            <a href="{{ route('product.subcategory.wise', $subcategory->id) }}">{{ $subcategory->name_bn }}</a>
                                                        @else
                                                            <a href="{{ route('product.subcategory.wise', $subcategory->id) }}">{{ $subcategory->name_en }}</a>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div><!-- /.accordion-inner -->
                                        </div><!-- /.accordion-body -->
                                    </div><!-- /.accordion-group -->
                                    @endforeach

                                </div><!-- /.accordion -->
                            </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                        <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

                        <!-- ============================================== PRICE SILDER============================================== -->
                        <div class="sidebar-widget wow fadeInUp">
                            <div class="widget-header">
                                <h4 class="widget-title">Price Slider</h4>
                            </div>
                            <div class="sidebar-widget-body m-t-10">
                                <div class="price-range-holder">
                                    <span class="min-max">
                                        <span class="pull-left">$200.00</span>
                                        <span class="pull-right">$800.00</span>
                                    </span>
                                    <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">

                                    <input type="text" class="price-slider" value="" >

                                </div><!-- /.price-range-holder -->
                                <a href="#" class="lnk btn btn-primary">Show Now</a>
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
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt">
                                    <span class="lbl">Sort by</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <select class="form-control" name="" id="sortBy">
                                                <option>Sort By Products</option>
                                                <option value="priceLowtoHigh" {{ $sort == 'priceLowtoHigh' ? 'selected' : '' }}>Price:Lower to Higher</option>
                                                <option value="priceHightoLow" {{ $sort == 'priceHightoLow' ? 'selected' : '' }}>Price:Higher to Lower</option>
                                                <option value="nameAtoZ" {{ $sort == 'nameAtoZ' ? 'selected' : '' }}>Product Name:A to Z</option>
                                                <option value="nameZtoA" {{ $sort == 'nameZtoA' ? 'selected' : '' }}>Product Name:Z to A</option>
                                            </select>
                                        </div>
                                    </div><!-- /.fld -->
                                </div><!-- /.lbl-cnt -->
                            </div><!-- /.col -->
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt">
                                    <span class="lbl">Show</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                1 <span class="caret"></span>
                                            </button>

                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">1</a></li>
                                                <li role="presentation"><a href="#">2</a></li>
                                                <li role="presentation"><a href="#">3</a></li>
                                                <li role="presentation"><a href="#">4</a></li>
                                                <li role="presentation"><a href="#">5</a></li>
                                                <li role="presentation"><a href="#">6</a></li>
                                                <li role="presentation"><a href="#">7</a></li>
                                                <li role="presentation"><a href="#">8</a></li>
                                                <li role="presentation"><a href="#">9</a></li>
                                                <li role="presentation"><a href="#">10</a></li>
                                            </ul>
                                        </div>
                                    </div><!-- /.fld -->
                                </div><!-- /.lbl-cnt -->
                            </div><!-- /.col -->
                        </div><!-- /.col -->
                        <div class="col col-sm-6 col-md-4 text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li><a href="#">1</a></li>	
                                    <li class="active"><a href="#">2</a></li>	
                                    <li><a href="#">3</a></li>	
                                    <li><a href="#">4</a></li>	
                                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul><!-- /.list-inline -->
                            </div><!-- /.pagination-container -->		
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div>
                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row" id="grid_view_product">									
                                    @include('frontend.partials.grid_view_product')

                                </div><!-- /.row -->
                            </div><!-- /.category-product -->

                        </div><!-- /.tab-pane -->

                        <div class="tab-pane "  id="list-container">
                            <div class="category-product" id="list_view_product">

                                @include('frontend.partials.list_view_product')

                            </div><!-- /.category-product -->
                        </div><!-- /.tab-pane #list-container -->
                    </div><!-- /.tab-content -->
                    <div class="clearfix filters-container">

                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    {{ $products->links() }}
                                    
                                    <!--<li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li><a href="#">1</a></li>	
                                    <li class="active"><a href="#">2</a></li>	
                                    <li><a href="#">3</a></li>	
                                    <li><a href="#">4</a></li>	
                                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>-->
                                </ul><!-- /.list-inline -->
                            </div><!-- /.pagination-container -->						    
                        </div><!-- /.text-right -->

                    </div><!-- /.filters-container -->

                </div><!-- /.search-result-container -->

            </div><!-- /.col -->
        </div><!-- /.row -->
        
        <div class="ajax-loadmore-product text-center" style="display: none">
            <img src="{{ asset('frontend/assets/images/ajaxloader.gif') }}"
                style="display: block; margin-left:auto; margin-right:auto; width:10%" alt="">
        </div>
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.partials.brand_carousel')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->

</div><!-- /.body-content -->


@endsection

@section('scripts')
<script>
    $('#sortBy').change(function(e){
        e.preventDefault();
        let sortBy = $('#sortBy').val();
        window.location = "{{ url('' . $route . '') }}/{{ $subCatId }}?sort=" +sortBy;
    });
</script>

<script>
        function loadmoreProduct(page) {
            $.ajax({
                    type: "get",
                    url: "?page=" + page,
                    beforeSend: function(response) {
                        $('.ajax-loadmore-product').show();
                    }
                })

                .done(function(data) {
                    if (data.grid_view == " " || data.list_view == " ") {
                        $('.ajax-loadmore-product').html('No More Product Found');
                        return;
                    }
                    $('.ajax-loadmore-product').hide();

                    $('#grid_view_product').append(data.grid_view);
                    $('#list_view_product').append(data.list_view);
                })

                .fail(function() {
                    alert('something went wrong')
                });

        }
        var page = 1;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadmoreProduct(page);
            }
        });

    </script>
    
@endsection