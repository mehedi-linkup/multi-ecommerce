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
                    <i class="fa fa-plus"></i> Add New State
                    <a href="{{ route('admin.states') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-list"></i> All State</a>
                </h6>

                    <div class="row row-sm mg-t-20">
                        <div class="col-xl-12">
                            <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                                <form action="{{ route('admin.state.store') }}" method="post">
                                    @csrf
                                    
                                <div class="row">
                                    <label class="col-sm-3 form-control-label">Division Name: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <select class="form-control select2-show-search" data-placeholder="Select One" name="division_id">
                                            <option label="Choose one"></option>
                                            @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ ucwords($division->name) }}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div><!-- row -->
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">District Name: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <select class="form-control select2-show-search" data-placeholder="Select One" name="district_id">
                                            <option label="Choose one"></option>
                                            
                                        </select>
                                    </div>
                                </div><!-- row -->
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-3 form-control-label">State Name: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                        <input type="text" name="state_name" class="form-control" placeholder="State Name">
                                        @error('state_name') <span style="color: red">{{$message}}</span> @enderror
                                    </div>
                                </div><!-- row -->
                                
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

<script src="{{asset('backend')}}/lib/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function(){
            var division_id = $(this).val();
            if(division_id) {
                $.ajax({
                    url: "{{  url('/admin/district-get/ajax') }}/"+division_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="district_id"]').empty();
                          $.each(data, function(key, value){

                              $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');

                          });

                    },

                });
            } else {
                alert('danger');
            }

        });

    });
</script>
@endsection
