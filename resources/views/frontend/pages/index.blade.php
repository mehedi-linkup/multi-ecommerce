@extends('frontend.layouts.master')
@section('main_content')

@section('title') Flipmart - Home @endsection

@php
    function bn_price($str)
    {
        $en = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        $bn = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $str = str_replace($en, $bn, $str);
        return $str;
    }
@endphp

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->	
            @include('frontend.partials.sidebar')
            <!-- ============================================== SIDEBAR : END ============================================== -->

            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                <!-- ========================================== SECTION – HERO ========================================= -->

                @include('frontend.partials.slider')

                <!-- ========================================= SECTION – HERO : END ========================================= -->	

                <!-- ============================================== INFO BOXES ============================================== -->
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">

                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">money back</h4>
                                        </div>
                                    </div>	
                                    <h6 class="text">30 Days Money Back Guarantee</h6>
                                </div>
                            </div><!-- .col -->

                            <div class="hidden-md col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">

                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">free shipping</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Shipping on orders over $99</h6>	
                                </div>
                            </div><!-- .col -->

                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">

                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">Special Sale</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Extra $5 off on all items </h6>	
                                </div>
                            </div><!-- .col -->
                        </div><!-- /.row -->
                    </div><!-- /.info-boxes-inner -->

                </div><!-- /.info-boxes -->
                <!-- ============================================== INFO BOXES : END ============================================== -->
                <!-- ============================================== SCROLL TABS ============================================== -->
                @include('frontend.partials.new_product')
                <!-- ============================================== SCROLL TABS : END ============================================== -->
                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="wide-banner cnt-strip">
                                <div class="image">
                                    <img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/home-banner1.jpg" alt="">
                                </div>

                            </div><!-- /.wide-banner -->
                        </div><!-- /.col -->
                        <div class="col-md-5 col-sm-5">
                            <div class="wide-banner cnt-strip">
                                <div class="image">
                                    <img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/home-banner2.jpg" alt="">
                                </div>

                            </div><!-- /.wide-banner -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.wide-banners -->

                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                <!-- ============================================== FEATURED PRODUCTS ============================ -->
                @include('frontend.partials.featured_product')
                <!-- ============================================== FEATURED PRODUCTS : END ======================= -->
                
                <!-- ============================================== SKIP CATEGORY PRODUCTS ============================ -->
                @include('frontend.partials.skip_category')
                <!-- ============================================== SKIP CATEGORY PRODUCTS : END ======================= -->
                
                <!-- ============================================== SKIP BRAND PRODUCTS ============================ -->
                @include('frontend.partials.skip_brand')
                <!-- ============================================== SKIP BRAND PRODUCTS : END ======================= -->
                
                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="wide-banner cnt-strip">
                                <div class="image">
                                    <img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/home-banner.jpg" alt="">
                                </div>	
                                <div class="strip strip-text">
                                    <div class="strip-inner">
                                        <h2 class="text-right">New Mens Fashion<br>
                                            <span class="shopping-needs">Save up to 40% off</span></h2>
                                    </div>	
                                </div>
                                <div class="new-label">
                                    <div class="text">NEW</div>
                                </div><!-- /.new-label -->
                            </div><!-- /.wide-banner -->
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.wide-banners -->
                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                <!-- ============================================== BEST SELLER ============================================== -->

                @include('frontend.partials.best_seller')
                <!-- ============================================== BEST SELLER : END ============================================== -->	

                <!-- ============================================== BLOG SLIDER ============================================== -->
                @include('frontend.partials.latest_blog')
                <!-- ============================================== BLOG SLIDER : END ============================================== -->	

                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                @include('frontend.partials.new_arrivals')
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

            </div><!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div><!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.partials.brand_carousel')
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

@endsection
