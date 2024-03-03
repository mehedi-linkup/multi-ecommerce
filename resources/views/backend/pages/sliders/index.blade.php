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
                    <i class="fa fa-list"></i> Slider List
                    <a href="{{ route('admin.slider.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Slider</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Title en</th>
                                <th>Description bn</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr class="{{ $slider->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img src="{{ asset('backend/images/slider/'.$slider->image) }}" width="50" height="50" alt=""></td>
                                <td>
                                    @if ($slider->title_en == NULL)
                                        <span class="badge badg-pill badge-danger">No Title Found</span>
                                    @else
                                        {{ $slider->title_en }}
                                    @endif
                                </td>
                                <td>
                                    @if ($slider->description_en == NULL)
                                        <span class="badge badg-pill badge-danger">No Descp Found</span>
                                    @else
                                        {{ $slider->description_en }}
                                    @endif
                                </td>
                                <td>
                                    @if ($slider->status == 1)
                                        <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.slider.edit',$slider->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    @if($slider->status == 1)
                                        <a href="{{ route('admin.slider.inactive',$slider->id) }}" title="Inactive" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></a>
                                    @else
                                        <a href="{{ route('admin.slider.active',$slider->id) }}" title="Active" class="btn btn-primary btn-sm"><i class="fa fa-thumbs-up"></i></a>
                                    @endif
                                    <a href="{{ route('admin.slider.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$slider->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
