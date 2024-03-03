@extends('backend.layouts.admin_master')

@section('shippings')
active show-sub
@endsection()

@section('state')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">State</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-list"></i> State List
                    <a href="{{ route('admin.state.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add State</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Division Name</th>
                                <th>District Name</th>
                                <th>state Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($states as $state)
                            <tr class="{{ $state->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $state->division->name }}</td>
                                <td>{{ $state->district->district_name }}</td>
                                <td>{{ $state->state_name }}</td>
                                <td>
                                    <a href="{{ route('admin.state.edit',$state->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.state.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$state->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
