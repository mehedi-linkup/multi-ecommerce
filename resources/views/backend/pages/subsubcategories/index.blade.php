@extends('backend.layouts.admin_master')

@section('categories')
active show-sub
@endsection()

@section('view-subsubcategory')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Sub Subcategories</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-list"></i> Sub Subcategory List
                    <a href="{{ route('admin.subsubcategory.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Sub Subcategory</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Category Name</th>
                                <th>Subcategory Name</th>
                                <th>Sub Subcategory Name en</th>
                                <th>Sub Subcategory Name bn</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subsubcategories as $subsubcategory)
                            <tr class="{{ $subsubcategory->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $subsubcategory->category->name_en }}</td>
                                <td>{{ $subsubcategory->subcategory->name_en }}</td>
                                <td>{{ $subsubcategory->subcatename_en }}</td>
                                <td>{{ $subsubcategory->subcatename_bn }}</td>
                                <td>
                                    <a href="{{ route('admin.subsubcategory.edit',$subsubcategory->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.subsubcategory.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$subsubcategory->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
