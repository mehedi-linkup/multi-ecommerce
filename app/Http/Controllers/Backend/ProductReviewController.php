<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ProductReviewController extends Controller
{
    
    public function index()
    {
        $reviews = Review::with('user','product')->latest()->get();
        return view('backend.pages.review.index',compact('reviews'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approved($id)
    {
        Review::findOrFail($id)->update([
            'status' => 'approved'
        ]);

        $notification=array(
            'message'=>'Approved Successfully',
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
    public function delete(Request $request)
    {
        $review = Review::find($request->id);
        if(!is_null($review)){
            $review->delete();
        }
        
        $notification=array(
            'message'=>'Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
