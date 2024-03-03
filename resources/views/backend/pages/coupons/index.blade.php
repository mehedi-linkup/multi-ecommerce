@extends('backend.layouts.admin_master')

@section('coupon')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Coupon</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-list"></i> Coupon List
                    <a href="{{ route('admin.coupon.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add Coupon</a>
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Coupon Name</th>
                                <th>Coupon Discount</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                            <tr class="{{ $coupon->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $coupon->coupon_name }}</td>
                                <td>{{ $coupon->coupon_discount }}%</td>
                                <td>
                                    {{ Carbon\Carbon::parse($coupon->coupon_validity)->format('D, d F Y') }}
                                </td>
                                <td>
                                    @if($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                        <span class="badge badge-pill badge-success">Valid</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Invalid</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.coupon.edit',$coupon->id) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.coupon.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$coupon->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
