<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use PDF;

class UserDashboardController extends Controller
{
    
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imagePage()
    {
        return view('users.change_image');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function imageUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);
        
        $image = $request->file('image');
        if($image){
            $imgName = date('YmdHi').$image->getClientOriginalName();
            $image->move('frontend/media/', $imgName);
            if(file_exists('frontend/media/'.$user->image) AND !empty($user->image)){
                unlink('frontend/media/'.$user->image);
            }
            $user->image = $imgName;
        }
        
        $user->save();

        $notification=array(
            'message'=>'Image Successfully Updated',
            'alert-type'=>'success'
        );
        return Redirect()->route('user.dashboard')->with($notification);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordEdit()
    {
        return view('users.update_password');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'password_confirmation' => 'required|min:8',
        ]);
        
        if(Auth::attempt(['id' => Auth::user()->id, 'password' => $request->old_password])){
            $user = User::findOrFail(Auth::id());
            $user->password = Hash::make($request->new_password);
            $user->save();
            
            Auth::logout();
            
            $notification=array(
              'message'=>'Your Password Change Success. Now Login With New Password',
              'alert-type'=>'success'
            );
            return Redirect()->route('login')->with($notification);
        }else{
            $notification=array(
                'message'=>'Old Password Not Match',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ],[
            'name.required' => 'input your name',
        ]);

        User::findOrFail(Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => Carbon::now(),
        ]);

        $notification=array(
            'message'=>'Your Profile Updated',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderShow()
    {
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->paginate(5);
        return view('users.orders.index',compact('orders'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderDetails($id)
    {
        $order = Order::with(['division','district','state','user'])->where('user_id',Auth::id())->where('id', $id)->first();
        $orderItems = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();
        return view('users.orders.order_details',compact('order', 'orderItems'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
    {
        $order = Order::with(['division','district','state','user'])->where('user_id',Auth::id())->where('id', $id)->first();
        $orderItems = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();
        $pdf = PDF::loadView('users.orders.invoice', compact('order','orderItems'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function returnOrderStore(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->return_date = Carbon::now()->format('d F Y');
        $order->return_reason = $request->return_reason;
        $order->save();
        
        $notification=array(
            'message'=>'Return Request Send Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('orders.show')->with($notification);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function returnOrderShow()
    {
        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('users.orders.return_order',compact('orders'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder()
    {
        $orders = Order::where('user_id',Auth::id())->where('status', 'Cancel')->orderBy('id','DESC')->get();
        return view('users.orders.cancel_order',compact('orders'));
    }
}
