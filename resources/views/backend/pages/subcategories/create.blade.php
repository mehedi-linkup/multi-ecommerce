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
                    <i class="fa fa-plus"></i> Add New Subcategory
                    <a href="{{ route('admin.subcategories') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-list"></i> All Category</a>
                </h6>

                    <div class="row row-sm mg-t-20">
                        <div class="col-xl-12">
                            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                                <form action="{{ route('admin.subcategory.store') }}" method="post">
                                    @csrf
                                    
                                <div class="row">
                                    <label class="col-sm-3 form-control-label">Name English: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="name_en" class="form-control" placeholder="Name English">
                                        @error('name_en') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div><!-- row -->
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Name Bangla: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="name_bn" class="form-control" placeholder="Name Bangla">
                                        @error('name_bn') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Select Category: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <select name="category_id" class="form-control select2-show-search" data-placeholder="Select One">
                                            <option label="Choose one"></option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label"></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <button type="submit" class="btn btn-info mg-r-5">Save change</button>
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