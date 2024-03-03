<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.pages.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.brands.create');
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
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);
        
        $brand = new Brand();
        $brand->name_en = $request->name_en;
        $brand->name_bn = $request->name_bn;
        $brand->slug_en = strtolower(str_replace(' ','-',$request->name_en));
        $brand->slug_bn = str_replace(' ','-',$request->name_bn);
        
        $img = $request->file('image');
        if($img){
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move('backend/images/brand/', $imgName);
            $brand['image'] = $imgName;
        }
        $brand->save();
        
        $notification=array(
            'message'=>'Brand Craeted Succefully..',
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
        $brand = Brand::findOrFail($id);
        return view('backend.pages.brands.edit', compact('brand'));
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
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);
        
        $brand = Brand::findOrFail($id);
        $brand->name_en = $request->name_en;
        $brand->name_bn = $request->name_bn;
        $brand->slug_en = strtolower(str_replace(' ','-',$request->name_en));
        $brand->slug_bn = str_replace(' ','-',$request->name_bn);
        
        $img = $request->file('image');
        if($img){
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move('backend/images/brand/', $imgName);
            if(file_exists('backend/images/brand/'.$brand->image) AND !empty($brand->image)){
                unlink('backend/images/brand/'.$brand->image);
            }
            $brand['image'] = $imgName;
        }
        $brand->save();
        
        $notification=array(
            'message'=>'Brand Updated Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.brands')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $brand = Brand::find($request->id);
        if(!is_null($brand)){
            if(file_exists('backend/images/brand/'.$brand->image) AND !empty($brand->image)){
                unlink('backend/images/brand/'.$brand->image);
            }
            
            $brand->delete();
        }
        
        $notification=array(
            'message'=>'Brand Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
