@extends('backend.layouts.admin_master')

@section('stock')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Stock Management</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-edit"></i> Update Product Quantity
                    <a href="{{ route('product.stock') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-list"></i> All Product</a>
                </h6>

                    <div class="row row-sm mg-t-20">
                        <div class="col-xl-12">
                            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                                <form action="{{ route('product.stock.update', $product->id) }}" method="post">
                                    @csrf
                                    
                                <div class="row">
                                    <label class="col-sm-3 form-control-label">Product Name English: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="name_en" class="form-control" value="{{ $product->name_en }}" placeholder="Product Name English">
                                        @error('name_en') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div><!-- row -->
                                
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Product Code: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="product_code" class="form-control" value="{{ $product->product_code }}" placeholder="Product Code">
                                        @error('product_code') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Product Quantity: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="quantity" class="form-control" value="{{ $product->quantity }}" placeholder="Product Quantity">
                                        @error('quantity') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label"></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <button type="submit" class="btn btn-info mg-r-5">Update change</button>
                                        <button class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                               </form>
                                
                            </div><!-- card -->
                        </div><!-- col-6 -->
                    </div><!-- row -->
            </div><!-- card -->
        </div>

    </div><!-- row -->
</div><!-- sl-pagebody -->
@endsection