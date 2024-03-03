@extends('backend.layouts.admin_master')

@section('categories')
active show-sub
@endsection()

@section('view-subcategory')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Subcategories</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-list"></i> Subcategory List
                    <a href="{{ route('admin.subcategory.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Subcategory</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Category Name</th>
                                <th>Subcategory Name en</th>
                                <th>Subcategory Name bn</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategories as $subcategory)
                            <tr class="{{ $subcategory->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $subcategory->category->name_en }}</td>
                                <td>{{ $subcategory->name_en }}</td>
                                <td>{{ $subcategory->name_bn }}</td>
                                <td>
                                    <a href="{{ route('admin.subcategory.edit',$subcategory->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.subcategory.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$subcategory->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
