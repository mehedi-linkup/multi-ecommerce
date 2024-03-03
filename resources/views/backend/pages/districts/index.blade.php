@extends('backend.layouts.admin_master')

@section('shippings')
active show-sub
@endsection()

@section('district')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">District</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-list"></i> District List
                    <a href="{{ route('admin.district.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add District</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Division Name</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($districts as $district)
                            <tr class="{{ $district->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $district->division->name }}</td>
                                <td>{{ $district->district_name }}</td>
                                <td>
                                    <a href="{{ route('admin.district.edit',$district->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.district.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$district->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
