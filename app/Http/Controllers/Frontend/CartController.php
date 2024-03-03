<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Coupon;
use App\Models\Division;
use Cart;

class CartController extends Controller
{
    public function index() 
    {
        return view('frontend.pages.carts.index');
    }
    
    public function miniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        
        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function miniCartRemove($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        if($product->discount_price == null){
            Cart::add([
                 'id' => $id,
                 'name' => $request->product_name,
                 'qty' => $request->quantity,
                 'price' => $product->selling_price,
                 'weight' => 1,
                 'options' => [
                     'image' => $product->product_image,
                     'color' => $request->color,
                     'size' => $request->size,
                    ],
                 ]);

            return response()->json(['success' => 'Sucessfully Added On Your Cart']);
        }else{
            Cart::add([
                 'id' => $id,
                 'name' => $request->product_name,
                 'qty' => $request->quantity,
                 'price' => $product->discount_price,
                 'weight' => 1,
                 'options' => [
                    'image' => $product->product_image,
                    'color' => $request->color,
                    'size' => $request->size,
                   ],
                ]);
            return response()->json(['success' => 'Sucessfully Added On Your Cart']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addToWishlist(Request $request, $id)
    {
        if(Auth::check()){
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();
            if(!$exists){
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::id();
                $wishlist->product_id = $id;
                $wishlist->save();
                return response()->json(['success' => 'Sucessfully Added On Your Wishlist']);
            }else{
                return response()->json(['error' => 'The Product Has Already On Your Wishlist']);
            }
        }else{
            return response()->json(['error' => 'At First Login Your Account']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round( Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]);
        }
        return response()->json('increment');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        if ($row->qty == 1) {
            return response()->json('not decrement');
        }else {
            Cart::update($rowId, $row->qty - 1);
            if (Session::has('coupon')) {
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name',$coupon_name)->first();
                Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                    'total_amount' => round( Cart::total() - Cart::total() * $coupon->coupon_discount/100)
                ]);
            }
            return response()->json('decrement');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cartDestroy($rowId)
    {
        Cart::remove($rowId);
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        return response()->json(['success' => 'Product Remove From Cart']);
    }
    
    /*
     * Apply Coupon Method
     */
    public function couponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();
        if($coupon){
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round( Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]);
            
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Success'
            ));
        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }
    
    /*
     * Coupon Calculation Method
     */
    
    public function couponCalculation() 
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }
    
    /*
     * Coupon Remove Method
     */
    
    public function couponRemove() 
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Success']);
    }
    
    /*
     * Checkout Page View  Method
     */
    
    public function checkout() 
    {
        if(Auth::check()){
            if(Cart::total() > 0){
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $divisions = Division::orderBy('name','ASC')->get();
                return view('frontend.pages.checkouts.index',compact('carts','cartQty','cartTotal','divisions'));
            }else{
                $notification=array(
                    'message'=>'Shopping Now',
                    'alert-type'=>'error'
                );
                return Redirect()->to('/')->with($notification);
            }
        }else{
            $notification=array(
                'message'=>'You Nedd to Login First',
                'alert-type'=>'error'
            );
            return Redirect()->route('login')->with($notification);
        }
    }
}
