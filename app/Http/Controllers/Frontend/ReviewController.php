<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    
    public function create($product_id)
    {
        $id = $product_id;
        return view('users.orders.review',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'rating' => 'required',
            'comment' => 'required',
        ]);
        
        $review = new Review();
        $review->user_id = Auth::id();
        $review->product_id = $request->product_id;
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->save();
        
        $notification=array(
            'message'=>'Review Done',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    
}
