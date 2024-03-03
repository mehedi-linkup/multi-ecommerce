@extends('backend.layouts.admin_master')

@section('slider')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Slider</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-plus"></i> Add New Slider
                    <a href="{{ route('admin.sliders') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-list"></i> All Slider</a>
                </h6>

                    <div class="row row-sm mg-t-20">
                        <div class="col-xl-12">
                            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                                <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    
                                <div class="row">
                                    <label class="col-sm-3 form-control-label">Title English: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="title_en" class="form-control" placeholder="Title English">
                                        @error('title_en') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div><!-- row -->
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Title Bangla: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="title_bn" class="form-control" placeholder="Title Bangla">
                                        @error('title_bn') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Description English: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="description_en" class="form-control" placeholder="Description English">
                                        @error('description_en') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Description Bangla: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="description_bn" class="form-control" placeholder="Description Bangla">
                                        @error('description_bn') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Image: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="file" name="image" class="form-control">
                                        @error('image') <span style="color: red">{{$message}}</span> @enderror
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
