<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\SubsubCategory;

class SubsubcategoryController extends Controller
{
    
    public function index()
    {
        $subsubcategories = SubsubCategory::latest()->get();
        return view('backend.pages.subsubcategories.index', compact('subsubcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubCate($subcate_id)
    {
        $subcate = Subcategory::where('category_id', $subcate_id)->orderBy('name_en', 'ASC')->get();
        return json_encode($subcate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name_en', 'ASC')->get();
        return view('backend.pages.subsubcategories.create', compact('categories'));
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
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subcatename_en' => 'required',
            'subcatename_bn' => 'required',
        ]);

        $subsubcategory = new SubsubCategory();
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->subcatename_en = $request->subcatename_en;
        $subsubcategory->subcatename_bn = $request->subcatename_bn;
        $subsubcategory->subcateslug_en = strtolower(str_replace(' ','-',$request->subcatename_en));
        $subsubcategory->subcateslug_bn = str_replace(' ','-',$request->subcatename_bn);
        $subsubcategory->save();

        $notification=array(
            'message'=>'Sub Subcategory Craeted Succefully..',
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
        $subsubcategory = SubsubCategory::findOrFail($id);
        $categories = Category::orderBy('name_en', 'ASC')->get();
        return view('backend.pages.subsubcategories.edit', compact('categories', 'subsubcategory'));
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
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subcatename_en' => 'required',
            'subcatename_bn' => 'required',
        ]);

        $subsubcategory = SubsubCategory::findOrFail($id);
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->subcatename_en = $request->subcatename_en;
        $subsubcategory->subcatename_bn = $request->subcatename_bn;
        $subsubcategory->subcateslug_en = strtolower(str_replace(' ','-',$request->subcatename_en));
        $subsubcategory->subcateslug_bn = str_replace(' ','-',$request->subcatename_bn);
        $subsubcategory->save();

        $notification=array(
            'message'=>'Sub Subcategory Updated Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin.subsubcategories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $subsubcategory = SubsubCategory::find($request->id);
        if(!is_null($subsubcategory)){
            $subsubcategory->delete();
        }
        
        $notification=array(
            'message'=>'Sub Subcategory Deleted Succefully..',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
