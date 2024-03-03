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
                    <i class="fa fa-edit"></i> Update Coupon
                    <a href="{{ route('admin.coupons') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-list"></i> All Coupon</a>
                </h6>

                    <div class="row row-sm mg-t-20">
                        <div class="col-xl-12">
                            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                                <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="post">
                                    @csrf
                                    
                                <div class="row">
                                    <label class="col-sm-3 form-control-label">Coupon Name: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="coupon_name" value="{{ $coupon->coupon_name }}" class="form-control" placeholder="Coupon Name">
                                        @error('coupon_name') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div><!-- row -->
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Coupon Discount (%): <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="coupon_discount" value="{{ $coupon->coupon_discount }}" class="form-control" placeholder="Coupon Discount" min='1' max='99'>
                                        @error('coupon_discount') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">Coupon validity Date: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="date" name="coupon_validity" value="{{ $coupon->coupon_validity }}" class="form-control" id="icon" placeholder="Coupon validity Date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                        @error('coupon_validity') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label"></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <button type="submit" class="btn btn-info mg-r-5">Update change</button>
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
