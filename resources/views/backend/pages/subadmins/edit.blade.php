@extends('backend.layouts.admin_master')

@section('subadmins')
active show-sub
@endsection()

@section('add-permission')
active
@endsection()

@section('content')
<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Subadmin Management</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-edit"></i> Update Subadmin
                </h6>

                    <div class="row row-sm mg-t-20">
                        <div class="col-xl-12">
                            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                                <form action="{{ route('subadmin.update', $user->id) }}" method="post">
                                    @csrf
                                    
                                    @method('put')
                                    <div class="row">
                                        <label class="col-sm-3 form-control-label">Name: <span class="tx-danger">*</span></label>
                                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" placeholder="Enter Name" autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <label class="col-sm-3 form-control-label">Email: <span class="tx-danger">*</span></label>
                                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" placeholder="Enter Email Address" autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-2">
                                        <label class="col-sm-3 form-control-label">Password: <span class="tx-danger">*</span></label>
                                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <label class="col-sm-3 form-control-label">Confirm Password: <span class="tx-danger">*</span></label>
                                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="********" autocomplete="new-password">

                                        </div>
                                    </div>
                                    
                                    <div class="row mt-2">
                                        <label class="col-sm-3 form-control-label">Select Role: <span class="tx-danger">*</span></label>
                                        <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                                            <select class="form-control" name="role_id" id="">
                                                <option>Select Role</option>
                                                @foreach ($roles as $role)
                                                   <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endforeach

                                            </select>
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