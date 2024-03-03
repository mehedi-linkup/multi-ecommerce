<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\District;
use App\Models\State;
use Cart;

class CheckoutController extends Controller
{
    
    public function getDistrict($division_id)
    {
        $district = District::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($district);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getState($district_id)
    {
        $state = State::where('district_id',$district_id)->orderBy('state_name','ASC')->get();
        return json_encode($state);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkoutStore(Request $request)
    {
        $data = array();
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['post_code'] = $request->post_code;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();
        $carts = Cart::content();
        
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round(Cart::total());
        }
        
        if ($request->payment_method == 'stripe') {
            return view('frontend.pages.payments.stripe',compact('data','cartTotal'));
        }elseif ($request->payment_method == 'sslHost') {
            return view('frontend.pages.payments.hostedPayment',compact('data','total_amount','carts'));
        }elseif ($request->payment_method == 'sslEasy') {
            return view('frontend.pages.payments.easyPayment',compact('data','total_amount','carts'));
        }else
        {
            return 'handcash';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
