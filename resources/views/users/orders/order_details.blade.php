@extends('frontend.layouts.master')
@section('main_content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li class='active'>Order Details</li>
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
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item active text-center">Shipping Information</li>
                                
                                <li class="list-group-item">
                                    <strong>Name:</strong> {{ $order->name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Phone:</strong>
                                    {{ $order->phone }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Email:</strong>
                                    {{ $order->email }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Division:</strong>
                                    {{ $order->division->name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>District:</strong>
                                    {{ $order->district->district_name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>State:</strong>
                                    {{ $order->state->state_name }}
                                </li>

                                    <li class="list-group-item">
                                        <strong>Post Code:</strong>
                                        {{ $order->post_code }}
                                    </li>
                                <li class="list-group-item">
                                    <strong>Order Date:</strong>
                                    {{ $order->order_date }}
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item active text-center">Order Information</li>
                                <li class="list-group-item">
                                    <strong>Name:</strong> {{ $order->user->name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Phone:</strong>
                                    {{ $order->user->phone }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Payment By:</strong>
                                    {{ $order->payment_method }}
                                </li>
                                <li class="list-group-item">
                                    <strong>TNX Id:</strong>
                                    {{ $order->transaction_id }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Invoice No:</strong>
                                    {{ $order->invoice_no }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Order Total:</strong>
                                    {{ $order->amount }}Tk
                                </li>

                                <li class="list-group-item">
                                    <strong>Order Status:</strong>
                                    <span class="badge badge-pill badge-primary">{{ $order->status }}</span> <br>

                                </li>
                                
                                <li class="list-group-item">
                                    <strong>Return: </strong>
                                    @php
                                    $order_r = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
                                    @endphp
                                    @if (!$order_r)
                                    <span class="badge badge-pill badge-warning" style="background: red; text:white;">You Have Send a Return Request</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table class="table table-responsive">
                                <tbody>
                                    <tr style="background: #E9EBEC;">
                                        <td>
                                              <label for="">Image</label>
                                          </td>
                                          <td>
                                          <label for="">Poduct Name</label>
                                          </td>

                                          <td>
                                              <label for="">Poduct Code</label>
                                          </td>

                                          <td>
                                              <label for="">Color</label>
                                          </td>

                                          <td>
                                              <label for="">Size</label>
                                          </td>

                                          <td>
                                              <label for="">Qty</label>
                                          </td>

                                          <td>
                                              <label for="">Price</label>
                                          </td>
                                    </tr>
                                    
                                    @foreach ($orderItems as $item)
                                      <tr>
                                          <td><img src="{{ asset('backend/images/products/'.$item->product->product_image) }}" height="50px;" width="50px;" alt="imga"></td>
                                          <td>
                                              <div class="product-name"><strong>{{ $item->product->name_en }}</strong>
                                              </div>
                                          </td>

                                          <td>
                                          <strong>{{ $item->product->product_code }}</strong>
                                          </td>

                                          <td>
                                              <strong>{{ $item->color }}</strong>
                                              </td>

                                          <td>
                                          <strong>{{ $item->size }}</strong>
                                          </td>

                                          <td>
                                          <strong>{{ $item->qty }}</strong>
                                          </td>
                                          
                                          <td>
                                          <strong>৳{{ $item->price }} ({{ $item->price * $item->qty }})</strong>
                                            @if ($order->status == 'Delivered')
                                              <td>
                                                <a href="{{ route('user.review.create', $item->product_id) }}">write a review</a>
                                              </td>
                                            @endif

                                      </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    @if ($order->status !== "Delivered")
                    @else
                    @php
                        $order = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
                    @endphp
                        @if ($order)
                        <form action="{{ route('user.return.order', $order->id) }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="return_reason">Do You want To Return This Order?:</label>
                                <textarea name="return_reason" id="return_reason" class="form-control" cols="30" rows="05" placeholder="Return Reason"></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-danger">Submit</button>
                        </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection