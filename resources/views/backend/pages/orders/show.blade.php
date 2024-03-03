@extends('backend.layouts.admin_master')

@section('orders')
active show-sub
@endsection()

@section('pending')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Order Details</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
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
                    <span class="badge badge-pill badge-primary">{{ $order->status }}</span>
                </li>

                <li class="list-group-item">
                    @if($order->status == 'Pending')
                        <a href="{{ route('admin.pending.to.confirm') }}" class="btn btn-block btn-success" id="confirm" data-token="{{csrf_token()}}" data-id="{{$order->id}}">Confirm Order</a>
                        <a href="{{ route('admin.pending.to.canceled', $order->id) }}" class="btn btn-block btn-danger" id="cancel">Cancel Order</a>
                    @elseif($order->status == 'Confirm')
                        <a href="{{ route('admin.confirm.to.processing', $order->id) }}" class="btn btn-block btn-success" id="processing">Processing</a>
                    @elseif($order->status == 'Processing')
                        <a href="{{ route('admin.processing.to.picked', $order->id) }}" class="btn btn-block btn-success" id="order">Picked</a>
                    @elseif($order->status == 'Picked')
                        <a href="{{ route('admin.picked.to.shipped', $order->id) }}" class="btn btn-block btn-success" id="order">Shipped</a>
                    @elseif($order->status == 'Shipped')
                        <a href="{{ route('admin.shipped.to.delivered', $order->id) }}" class="btn btn-block btn-success" id="order">Delevery</a>
                    @endif
                </li>

            </ul>
        </div>

    </div><!-- row -->
    
    <div class="row mt-3">
        <div class="col-md-12">
          <div class="table-responsive">
              <table class="table table-bordered">
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
                              <label for="">Quantity</label>
                          </td>

                          <td>
                              <label for="">Price</label>
                          </td>
                          
                          <td>
                              <label for="">Sub Total</label>
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
                          <strong>৳{{ number_format($item->price, 2) }}</strong>

                          </td>
                          
                          <td>
                          <strong>৳{{ number_format($item->price * $item->qty, 2) }}</strong>

                          </td>
                      </tr>
                   @endforeach
                  </tbody>
              </table>
          </div>
        </div>
    </div>
    
</div><!-- sl-pagebody -->
@endsection
