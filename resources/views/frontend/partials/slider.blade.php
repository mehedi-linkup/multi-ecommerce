<div id="hero">
    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
        @foreach($sliders as $slider)
        <div class="item" style="background-image: url({{ asset('backend/images/slider/'.$slider->image) }});">
            <div class="container-fluid">
                <div class="caption bg-color vertical-center text-left">
                    <div class="slider-header fadeInDown-1">Top Brands</div>
                    <div class="big-text fadeInDown-1">
                        {{ $slider->title_en }}
                    </div>

                    <div class="excerpt fadeInDown-2 hidden-xs">

                        <span>{{ $slider->description_en }}</span>

                    </div>
                    <div class="button-holder fadeInDown-3">
                        <a href="index6c11.html?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                    </div>
                </div><!-- /.caption -->
            </div><!-- /.container-fluid -->
        </div><!-- /.item -->
        @endforeach


    </div><!-- /.owl-carousel -->
</div>