<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use PDF;

class OrderController extends Controller
{
    
    public function pendingOrder()
    {
        $orders = Order::where('status','pending')->orderBy('id','DESC')->get();
        return view('backend.pages.orders.pending',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmOrder()
    {
        $orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
        return view('backend.pages.orders.confirm',compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processingOrder()
    {
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('backend.pages.orders.processing',compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('division','district','state','user')->where('id',$id)->first();
        $orderItems = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();
        return view('backend.pages.orders.show',compact('order','orderItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pickedOrder()
    {
        $orders = Order::where('status','picked')->orderBy('id','DESC')->get();
        return view('backend.pages.orders.picked',compact('orders'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shippedOrder()
    {
        $orders = Order::where('status','shipped')->orderBy('id','DESC')->get();
        return view('backend.pages.orders.shipped',compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deliveredOrder()
    {
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
        return view('backend.pages.orders.delivered',compact('orders'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function canceledOrder()
    {
        $orders = Order::where('status','Cancel')->orderBy('id','DESC')->get();
        return view('backend.pages.orders.canceled',compact('orders'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadInvoice($id)
    {
        $order = Order::with('division','district','state','user')->where('id',$id)->first();
        $orderItems = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();
        $pdf = PDF::loadView('backend.pages.orders.invoice',compact('order','orderItems'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
    
    /*
     * Order Pending to Confirm Method
     */
    public function pendingToConfirm(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->status = 'Confirm';
        $order->confirmed_date = Carbon::now();
        $order->save();
        
        $notification=array(
            'message'=>'Order Confirm Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.pending.orders')->with($notification);
    }
    
    /*
     * Order Pending to Cancel Method
     */
    public function pendingToCanceled($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Cancel';
        $order->cancel_date = Carbon::now();
        $order->save();
        
        $notification=array(
            'message'=>'Order Cancel Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.pending.orders')->with($notification);
    }
    
    /*
     * Order Confirm to Processing Method
     */
    public function confirmToProcessing($id)
    {
        $order = Order::find($id);
        $order->status = 'Processing';
        $order->processing_date = Carbon::now();
        $order->save();
        
        $notification=array(
            'message'=>'Order Processing Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.confirm.order')->with($notification);
    }
    
    /*
     * Order processing to Picked Method
     */
    public function processingToPicked($id)
    {
        $order = Order::find($id);
        $order->status = 'Picked';
        $order->picked_date = Carbon::now();
        $order->save();
        
        $notification=array(
            'message'=>'Order Picked Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.processing.order')->with($notification);
    }
    
    /*
     * Order Picked to Shipped Method
     */
    public function pickedToShipped($id)
    {
        $order = Order::find($id);
        $order->status = 'Shipped';
        $order->shipped_date = Carbon::now();
        $order->save();
        
        $notification=array(
            'message'=>'Order Shipped Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.picked.order')->with($notification);
    }
    
    /*
     * Order Shipped to Delivered Method
     */
    public function shippedToDelivered($id)
    {
        $order = Order::find($id);
        $order->status = 'Delivered';
        $order->delivered_date = Carbon::now();
        $order->save();
        
        $notification=array(
            'message'=>'Order Delivered Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.shipped.order')->with($notification);
    }
}
