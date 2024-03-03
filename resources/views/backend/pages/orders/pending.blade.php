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
    <span class="breadcrumb-item active">Pending Order</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-list"></i> Pending Order List
                </h6>
                <p class="mg-b-20 mg-sm-b-30"></p>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Invoice</th>
                                <th>Amount</th>
                                <th>TNX Id</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr class="{{ $order->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->invoice_no }}</td>
                                <td>TK. {{ $order->amount }}</td>
                                <td>{{ $order->transaction_id }}</td>
                                <td>
                                    <span class="badge badge-pill badge-warning">{{ $order->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.show.order',$order->id) }}" title="Details" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="" id="delete" data-token="{{csrf_token()}}" data-id="{{$order->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
