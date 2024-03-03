<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">@if(session()->get('language') == 'bangla') পণ্য ট্যাগ @else Product tags @endif</h3>
    <div class="sidebar-widget-body outer-top-xs">
        @php
            $tags_en = App\Models\Product::select('tag_en')->groupBy('tag_en')->get();
            $tags_bn = App\Models\Product::select('tag_bn')->groupBy('tag_bn')->get();
        @endphp
        <div class="tag-list">	
            @if(session()->get('language') == 'bangla')
                @foreach($tags_bn as $tag)
                <a class="item" title="Phone" href="{{ route('product.tag.wise', $tag->tag_bn) }}">{{ str_replace(',',' ',$tag->tag_bn) }}</a>
                @endforeach
            @else
                @foreach($tags_en as $tag)
                <a class="item" title="Phone" href="{{ route('product.tag.wise', $tag->tag_en) }}">{{ str_replace(',',' ',$tag->tag_en) }}</a>
                @endforeach
            @endif
        </div><!-- /.tag-list -->
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->