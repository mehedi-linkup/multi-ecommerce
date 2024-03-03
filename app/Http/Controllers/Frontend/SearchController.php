<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        
        $products = Product::where("name_en", "LIKE", "%".$request->search."%")
                            ->orWhere("name_bn", "LIKE", "%".$request->search."%")
                            ->orWhere("tag_en", "LIKE", "%".$request->search."%")
                            ->orWhere("tag_bn", "LIKE", "%".$request->search."%")
                            ->orWhere("short_desc_en", "LIKE", "%".$request->search."%")
                            ->orWhere("short_desc_bn", "LIKE", "%".$request->search."%")
                            ->paginate(12);
        
        return view('frontend.pages.search.index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productGet(Request $request)
    {
        //dd($request->all());
        
        $request->validate([
            'search' => 'required'
        ]);
        
        $products = Product::where("name_en", "LIKE", "%".$request->search."%")
                            ->orWhere("name_bn", "LIKE", "%".$request->search."%")
                            ->orWhere("tag_en", "LIKE", "%".$request->search."%")
                            ->orWhere("tag_bn", "LIKE", "%".$request->search."%")
                            ->orWhere("short_desc_en", "LIKE", "%".$request->search."%")
                            ->orWhere("short_desc_bn", "LIKE", "%".$request->search."%")
                            ->take(5)->get();
        
        return view('frontend.pages.search.product_search', compact('products'));
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
