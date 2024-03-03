<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.categories.create');
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
            'icon' => 'required',
        ]);
        
        $category = new Category();
        $category->name_en = $request->name_en;
        $category->name_bn = $request->name_bn;
        $category->slug_en = strtolower(str_replace(' ','-',$request->name_en));
        $category->slug_bn = str_replace(' ','-',$request->name_bn);
        $category->icon = $request->icon;
        $category->save();
        
        $notification=array(
            'message'=>'Category Craeted Succefully..',
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
        $category = Category::findOrFail($id);
        return view('backend.pages.categories.edit', compact('category'));
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
            'icon' => 'required',
        ]);
        
        $category = Category::findOrFail($id);
        $category->name_en = $request->name_en;
        $category->name_bn = $request->name_bn;
        $category->slug_en = strtolower(str_replace(' ','-',$request->name_en));
        $category->slug_bn = str_replace(' ','-',$request->name_bn);
        $category->icon = $request->icon;
        $category->save();
        
        $notification=array(
            'message'=>'Category Updated Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.categories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $category = Category::find($request->id);
        if(!is_null($category)){
            $category->delete();
        }
        
        $notification=array(
            'message'=>'Category Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
