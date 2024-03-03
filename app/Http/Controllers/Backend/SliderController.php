<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('backend.pages.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
            'title_bn' => 'required',
            'description_en' => 'required',
            'description_bn' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);
        
        $slider = new Slider();
        $slider->title_en = $request->title_en;
        $slider->title_bn = $request->title_bn;
        $slider->description_en = $request->description_en;
        $slider->description_bn = $request->description_bn;
        $img = $request->file('image');
        if($img){
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move('backend/images/slider/', $imgName);
            $slider['image'] = $imgName;
        }
        $slider->save();
        
        $notification=array(
            'message'=>'Slider Upload Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = 0;
        $slider->save();
        
        $notification=array(
            'message'=>'Slider Inactivated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = 1;
        $slider->save();
        
        $notification=array(
            'message'=>'Slider Activated Successfully',
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
        $slider = Slider::findOrFail($id);
        return view('backend.pages.sliders.edit', compact('slider'));
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
        $request->validate([
            'title_en' => 'required',
            'title_bn' => 'required',
            'description_en' => 'required',
            'description_bn' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif',
        ]);
        
        $slider = Slider::findOrFail($id);
        $slider->title_en = $request->title_en;
        $slider->title_bn = $request->title_bn;
        $slider->description_en = $request->description_en;
        $slider->description_bn = $request->description_bn;
        $img = $request->file('image');
        if($img){
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move('backend/images/slider/', $imgName);
            if(file_exists('backend/images/slider/'.$slider->image) AND !empty($slider->image)){
                unlink('backend/images/slider/'.$slider->image);
            }
            $slider['image'] = $imgName;
        }
        $slider->save();
        
        $notification=array(
            'message'=>'Slider Image Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.sliders')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $slider = Slider::find($request->id);
        if(!is_null($slider)){
            if(file_exists('backend/images/slider/'.$slider->image) AND !empty($slider->image)){
                unlink('backend/images/slider/'.$slider->image);
            }
            
            $slider->delete();
        }
        
        $notification=array(
            'message'=>'Slider Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
