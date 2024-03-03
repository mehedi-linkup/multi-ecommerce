@extends('backend.layouts.admin_master')

@section('report')
active
@endsection()

@section('content')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('admin.dashboard') }}">Flipmart</a>
    <span class="breadcrumb-item active">Report Details</span>
</nav>

<div class="sl-pagebody">
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">
                    <i class="fa fa-info"></i> Report Details
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
                                <td>TK. {{ number_format($order->amount, 2) }}</td>
                                <td>{{ $order->transaction_id }}</td>
                                <td>
                                    @if($order->status == 'Cancel')
                                        <span class='badge badge-danger'>{{ $order->status }}</span>
                                    @else
                                        <span class='badge badge-success'>{{ $order->status }}</span>
                                    @endif
                                    
                                </td>
                                <td>
                                    <a href="{{ route('admin.show.order',$order->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.invoice.download', $order->id) }}" title="Download PDF" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a>
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
