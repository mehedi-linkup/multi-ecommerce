<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;

class SubcategoryController extends Controller
{
    
    public function index()
    {
        $subcategories = Subcategory::latest()->get();
        return view('backend.pages.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name_en', 'ASC')->get();
        return view('backend.pages.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name_en' => 'required',
            'name_bn' => 'required',
            'category_id' => 'required',
        ]);
        
        $subcategory = new Subcategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->name_en = $request->name_en;
        $subcategory->name_bn = $request->name_bn;
        $subcategory->slug_en = strtolower(str_replace(' ','-',$request->name_en));
        $subcategory->slug_bn = str_replace(' ','-',$request->name_bn);
        $subcategory->save();
        
        $notification=array(
            'message'=>'Subcategory Craeted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::orderBy('name_en', 'ASC')->get();
        $subcategory = Subcategory::findOrFail($id);
        return view('backend.pages.subcategories.edit', compact('categories', 'subcategory'));
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
        $this->validate($request,[
            'name_en' => 'required',
            'name_bn' => 'required',
            'category_id' => 'required',
        ]);
        
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->category_id = $request->category_id;
        $subcategory->name_en = $request->name_en;
        $subcategory->name_bn = $request->name_bn;
        $subcategory->slug_en = strtolower(str_replace(' ','-',$request->name_en));
        $subcategory->slug_bn = str_replace(' ','-',$request->name_bn);
        $subcategory->save();
        
        $notification=array(
            'message'=>'Subcategory Updated Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.subcategories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $subcategory = Subcategory::find($request->id);
        if(!is_null($subcategory)){
            $subcategory->delete();
        }
        
        $notification=array(
            'message'=>'Subcategory Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
