@extends('backend.layouts.admin_master')

@section('review')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Reviews</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-list"></i> Customer Review
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product Image</th>
                                <th>Customer Name</th>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                            <tr class="{{ $review->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td><img src="{{ asset('backend/images/products/'.$review->product->product_image) }}" width="50" alt=""></td>
                                <td>{{ $review->user->name }}</td>
                                <td>
                                    <texarea name="" id="" cols="30" disabled rows="2">
                                        {{ $review->comment }}
                                    </texarea>
                                </td>
                                <td>{{ $review->rating }}
                                        @for ($i =1 ; $i <= 5 ; $i++)
                                        <span style="color: red; font-size:15px;" class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty' }}"></span>
                                    @endfor
                                </td>
                                <td>
                                    @if ($review->status == 'pending')
                                        <span class="badg badge-pill badge-warning">{{ $review->status }}</span>
                                    @else
                                        <span class="badg badge-pill badge-success">{{ $review->status }}</span>
                                    @endif
                                    
                                    @if ($review->status == 'pending')
                                        <a href="{{ route('customer.review.approved', $review->id) }}" onclick="return confirm('Are you sure to Approved Now?')" class="btn btn-sm btn-primary">Approve Now</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('customer.review.delete') }}" id="delete" data-token="{{csrf_token()}}" data-id="{{$review->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
