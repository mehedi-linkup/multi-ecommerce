@extends('frontend.layouts.master')
@section('main_content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li class='active'>My Review</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content" style="margin-bottom: 20px;">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('frontend/media/'.Auth::user()->image) }}" width="100%" height="100%" alt="Card image cap">
                        <ul class="list-group list-group-flush">
                            <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                            <a href="{{ route('orders.show') }}" class="btn btn-primary btn-sm btn-block">My Order</a>
                            <a href="{{ route('user.return.order.show') }}" class="btn btn-primary btn-sm btn-block">Return Orders</a>
                            <a href="{{ route('user.cancel.order') }}" class="btn btn-primary btn-sm btn-block">Cancel Orders</a>
                            <a href="{{ route('user.images') }}" class="btn btn-primary btn-sm btn-block">Update Image</a>
                            <a href="{{ route('user.password.edit') }}" class="btn btn-primary btn-sm btn-block">Update Password</a>
                            <a href="{{ route('chat.page') }}" class="btn btn-primary btn-sm btn-block">Chats</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="btn btn-danger btn-sm btn-block">
                                <i class="fa fa-power-off"></i> 
                                Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9 mt-2">
                    <div class="product-add-review">
                        <h4 class="title">Write your own review</h4>
                        <div class="review-table">
                            <div class="table-responsive">
                              <form action="{{ route('user.review.store') }}" method="POST" role="form" class="cnt-form">
                                  @csrf
                                  
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <table class="table">	
                                    <thead>
                                        <tr>
                                            <th class="cell-label">&nbsp;</th>
                                            <th>1 star</th>
                                            <th>2 stars</th>
                                            <th>3 stars</th>
                                            <th>4 stars</th>
                                            <th>5 stars</th>
                                        </tr>
                                    </thead>	
                                    <tbody>
                                        <tr>
                                            <td class="cell-label">Quality</td>
                                            <td><input type="radio" name="rating" class="radio" value="1"></td>
                                            <td><input type="radio" name="rating" class="radio" value="2"></td>
                                            <td><input type="radio" name="rating" class="radio" value="3"></td>
                                            <td><input type="radio" name="rating" class="radio" value="4"></td>
                                            <td><input type="radio" name="rating" class="radio" value="5"></td>
                                        </tr>
                                        
                                    </tbody>
                                </table><!-- /.table .table-bordered -->
                            </div><!-- /.table-responsive -->
                        </div><!-- /.review-table -->

                        <div class="review-form">
                            <div class="form-container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                            <textarea class="form-control txt txt-review" id="exampleInputReview" data-validation="required" name="comment" rows="4" placeholder=""></textarea>
                                        </div>
                                    </div>

                                </div><!-- /.row -->

                                <div class="action text-right">
                                    <button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                </div><!-- /.action -->

                       </form><!-- /.cnt-form -->
                            </div><!-- /.form-container -->
                        </div><!-- /.review-form -->

                    </div><!-- /.product-add-review -->	
                </div>
            </div>
        </div>
    </div>
</div>
@endsection