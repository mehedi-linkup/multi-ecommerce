@php
    $categories = App\Models\Category::orderBy('name_en', 'ASC')->get();
@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> @if(session()->get('language') == 'bangla') ক্যাটাগরি @else Categories @endif</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            @foreach($categories as $category)
            <li class="dropdown menu-item">
                @if(session()->get('language') == 'bangla')
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->icon }}" aria-hidden="true"></i>{{ $category->name_bn }}</a>
                @else
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $category->icon }}" aria-hidden="true"></i>{{ $category->name_en }}</a>
                @endif
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        
                        <div class="row">
                            @php
                                $subcategories = App\Models\Subcategory::where('category_id', $category->id)->orderBy('name_en', 'ASC')->get();
                            @endphp

                            @foreach($subcategories as $subcategory)
                            <div class="col-sm-12 col-md-3">
                                @if(session()->get('language') == 'bangla')
                                    <a href="{{ route('product.subcategory.wise', $subcategory->id) }}">{{ $subcategory->name_bn }}</a>
                                @else
                                    <a href="{{ route('product.subcategory.wise', $subcategory->id) }}">{{ $subcategory->name_en }}</a>
                                @endif
                                
                                <ul class="links list-unstyled">  
                                    @php
                                        $subsubcategories = App\Models\SubsubCategory::where('subcategory_id', $subcategory->id)->orderBy('subcatename_en', 'ASC')->get();
                                    @endphp
                                    
                                    @foreach($subsubcategories as $subsubcategory)
                                    <li>
                                        @if(session()->get('language') == 'bangla') 
                                            <a href="{{ route('product.subsubcategory.wise', $subsubcategory->id) }}">{{ $subsubcategory->subcatename_bn }}</a>
                                        @else
                                             <a href="{{ route('product.subsubcategory.wise', $subsubcategory->id) }}">{{ $subsubcategory->subcatename_en }}</a>
                                        @endif
                                    </li> 
                                    @endforeach
                                </ul>
                            </div><!-- /.col -->
                            @endforeach
                        </div><!-- /.row -->
                        
                    </li><!-- /.yamm-content -->                    
                </ul><!-- /.dropdown-menu -->            
            </li><!-- /.menu-item -->
            @endforeach

        </ul><!-- /.nav -->
    </nav><!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->