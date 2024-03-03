@extends('backend.layouts.admin_master')

@section('products')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Products</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-info-circle"></i> Product Details
                    <a href="{{ route('admin.products') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-list"></i> All Product</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="" class="table table-bordered table-striped">
                        <tr>
                            <th width="30%">Name English</th>
                            <td>{{ $product->name_en }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Name Bangla</th>
                            <td>{{ $product->name_bn }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Brand English</th>
                            <td>{{ $product->brand->name_en }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Brand Bangla</th>
                            <td>{{ $product->brand->name_bn }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Category English</th>
                            <td>{{ $product->category->name_en }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Category Bangla</th>
                            <td>{{ $product->category->name_bn }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Subcategory English</th>
                            <td>{{ $product->subcategory->name_en }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Subcategory Bangla</th>
                            <td>{{ $product->subcategory->name_bn }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Sub Subcategory English</th>
                            <td>{{ $product->subsubcategory->subcatename_en }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Sub Subcategory Bangla</th>
                            <td>{{ $product->subsubcategory->subcatename_bn }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Short Description English</th>
                            <td>{{ $product->short_desc_en }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Short Description Bangla</th>
                            <td>{{ $product->short_desc_bn }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Long Description English</th>
                            <td>{!! $product->long_desc_en !!}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Long Description Bangla</th>
                            <td>{!! $product->long_desc_bn !!}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Product Code</th>
                            <td>{{ $product->product_code }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Quantity</th>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Tag English</th>
                            <td>{{ $product->tag_en }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Tag Bangla</th>
                            <td>{{ $product->tag_bn }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Size English</th>
                            <td>{{ $product->size_en }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Size Bangla</th>
                            <td>{{ $product->size_bn }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Color English</th>
                            <td>{{ $product->color_en }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Color Bangla</th>
                            <td>{{ $product->color_bn }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Selling Price</th>
                            <td>${{ $product->selling_price }}</td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Discount Price</th>
                            
                            <td>
                                @if($product->discount_price == null)
                                    <span class="badge badge-pill badge-warning">No</span>
                                @else
                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price)*100;
                                    @endphp
                                    
                                    ${{ $product->discount_price }} 
                                    <span class="badge badge-pill badge-success">{{ round($discount) }}%</span>
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Product Image</th>
                            <td>
                                <img src="{{ asset('backend/images/products/'.$product->product_image) }}" width="100" alt="">
                            </td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Gallery Image</th>
                            <td>
                                @foreach($multiimages as $multiImg)
                                <img src="{{ asset('backend/images/sub_products/'.$multiImg->images) }}" width="100" alt="">
                                @endforeach
                            </td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Hot Deal</th>
                            <td>
                                @if($product->hot_deals == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Featured</th>
                            <td>
                                @if($product->featured == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Special Offer</th>
                            <td>
                                @if($product->special_offer == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Special Deals</th>
                            <td>
                                @if($product->special_deals == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <th width="30%">Status</th>
                            <td>
                                @if($product->status == 1)
                                    <span class="badge badge-pill badge-success">Active</span>
                                @else
                                    <span class="badge badge-pill badge-warning">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        
                        
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div>

    </div><!-- row -->
</div><!-- sl-pagebody -->
@endsection
