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
                    <i class="fa fa-list"></i> Product List
                    <a href="{{ route('admin.product.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Product</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name en</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr class="{{ $product->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img src="{{ asset('backend/images/products/'.$product->product_image) }}" width="50" height="50" alt=""></td>
                                <td>{{ $product->name_en }}</td>
                                <td>${{ $product->selling_price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    @if($product->discount_price == null)
                                        <span class="badge badge-pill badge-warning">No</span>
                                    @else
                                        @php
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount/$product->selling_price)*100;
                                        @endphp
                                        
                                        <span class="badge badge-pill badge-success">{{ round($discount) }}%</span>
                                    @endif
                                    
                                </td>
                                <td>
                                    @if($product->status == 1)
                                        <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                        <span class="badge badge-pill badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.product.show',$product->id) }}" title="Details" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.product.edit',$product->id) }}" title="Edit" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    
                                    @if($product->status == 1)
                                        <a href="{{ route('admin.product.inactive', $product->id) }}" title="Inactive" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></a>
                                    @else
                                        <a href="{{ route('admin.product.active', $product->id) }}" title="Active" class="btn btn-primary btn-sm"><i class="fa fa-thumbs-up"></i></a>
                                    @endif
                                    
                                    <a href="{{ route('admin.product.delete') }}" title="Delete" id="delete" data-token="{{csrf_token()}}" data-id="{{$product->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div>

    </div><!-- row -->
</div><!-- sl-pagebody -->
@endsection
