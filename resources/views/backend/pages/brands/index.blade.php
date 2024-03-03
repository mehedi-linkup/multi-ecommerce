@extends('backend.layouts.admin_master')

@section('brands')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Brand</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-list"></i> Brand List
                    <a href="{{ route('admin.brand.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Brand</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name en</th>
                                <th>Name bn</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $brand)
                            <tr class="{{ $brand->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img src="{{ asset('backend/images/brand/'.$brand->image) }}" width="50" height="50" alt=""></td>
                                <td>{{ $brand->name_en }}</td>
                                <td>{{ $brand->name_bn }}</td>
                                <td>
                                    <a href="{{ route('admin.brand.edit',$brand->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.brand.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$brand->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
