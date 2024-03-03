<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class TrackingController extends Controller
{
    
    public function index(Request $request)
    {
        $order = Order::with(['user', 'division', 'district', 'state'])->where('invoice_no', $request->invoice_no)->first();
        if($order){
            $orderItems = OrderItem::with(['product'])->where('order_id', $order->id)->orderBy('id', 'DESC')->get();
            return view('frontend.pages.orders.order_track', compact('order', 'orderItems'));
        }else{
            $notification=array(
                'message'=>'Order Not Found',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    
}
