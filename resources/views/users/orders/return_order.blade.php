@extends('frontend.layouts.master')
@section('main_content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li class='active'>Return Order</li>
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
                <div class="col-sm-9 mt-1">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr style="background: #E9EBEC;">
                                    <td>
                                        <label for="">Date</label>
                                    </td>
                                    <td>
                                    <label for="">Total</label>
                                    </td>

                                    <td>
                                        <label for="">Payment</label>
                                    </td>

                                    <td>
                                        <label for="">Invoice</label>
                                    </td>

                                    <td>
                                        <label for="">Status </label>
                                    </td>

                                    <td>
                                        <label for="">Action</label>
                                    </td>

                                </tr>

                            @foreach ($orders as $order)


                                <tr>
                                    <td>
                                       <strong>{{ $order->order_date }}</strong>
                                    </td>
                                    <td>
                                    <strong>৳{{ $order->amount }}</strong>
                                    </td>

                                    <td>
                                    <strong>{{ $order->payment_method }}</strong>
                                    </td>

                                    <td>
                                    <strong>{{ $order->invoice_no }}</strong>
                                    </td>

                                    <td>
                                        <span class="badge badge-pill badge-warning" style="background: #418DB9; text:white;">{{ ucwords($order->status) }}</span>
                                        <span class="badge badge-pill badge-warning" style="background: red; text:white;">Return Requested</span>
                                    </td>

                                    <td>
                                        <a href="{{ route('orders.details', $order->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('orders.invoice', $order->id) }}" title="Download PDF" class="btn btn-sm btn-danger "><i class="fa fa-download" style="color:white;"></i></a>
                                    </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection