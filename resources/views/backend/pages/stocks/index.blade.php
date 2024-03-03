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
                    <i class="fa fa-list"></i> Product List
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
                                <th>Stock</th>
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
                                <td>${{ number_format($product->selling_price, 2) }}</td>
                                <td>
                                    <span class="badge badge-pill badge-info">{{ $product->quantity }}</span>
                                </td>
                                <td>
                                    @if($product->status == 1)
                                        <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                        <span class="badge badge-pill badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('product.stock.edit',$product->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    
                                    @if($product->status == 1)
                                        <a href="{{ route('admin.product.inactive', $product->id) }}" title="Inactive" class="btn btn-warning btn-sm"><i class="fa fa-thumbs-down"></i></a>
                                    @else
                                        <a href="{{ route('admin.product.active', $product->id) }}" title="Active" class="btn btn-primary btn-sm"><i class="fa fa-thumbs-up"></i></a>
                                    @endif
                                    
                                    <a href="" id="delete" data-token="{{csrf_token()}}" data-id="{{$product->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
