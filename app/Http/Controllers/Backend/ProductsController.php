<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Subcategory;
use App\Models\SubsubCategory;

class ProductsController extends Controller
{
    
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.pages.products.create', compact('categories', 'brands'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubCate($subcat_id)
    {
        $subcate = Subcategory::where('category_id', $subcat_id)->orderBy('name_en' , 'ASC')->get();
        return json_encode($subcate);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubsubCate($subsubcat_id)
    {
        $subsubcate = SubsubCategory::where('subcategory_id', $subsubcat_id)->orderBy('subcatename_en' , 'ASC')->get();
        return json_encode($subsubcate);
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
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'name_en' => 'required',
            'name_bn' => 'required',
            'product_code' => 'required',
            'quantity' => 'required|numeric',
            'tag_en' => 'required',
            'tag_bn' => 'required',
            'short_desc_en' => 'required',
            'short_desc_bn' => 'required',
            'long_desc_en' => 'required',
            'long_desc_bn' => 'required',
            'selling_price' => 'required',
            'product_image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);
        
        $products = new Product();
        $products->user_id = Auth::user()->id;
        $products->brand_id = $request->brand_id;
        $products->category_id = $request->category_id;
        $products->subcategory_id = $request->subcategory_id;
        $products->subsubcategory_id = $request->subsubcategory_id;
        $products->name_en = $request->name_en;
        $products->name_bn = $request->name_bn;
        $products->slug_en = strtolower(str_replace(' ','-',$request->name_en));
        $products->slug_bn = str_replace(' ','-',$request->name_bn);
        $products->product_code = $request->product_code;
        $products->quantity = $request->quantity;
        $products->tag_en = $request->tag_en;
        $products->tag_bn = $request->tag_bn;
        $products->short_desc_en = $request->short_desc_en;
        $products->short_desc_bn = $request->short_desc_bn;
        $products->long_desc_en = $request->long_desc_en;
        $products->long_desc_bn = $request->long_desc_bn;
        $products->size_en = $request->size_en;
        $products->size_bn = $request->size_bn;
        $products->color_en = $request->color_en;
        $products->color_bn = $request->color_bn;
        $products->selling_price = $request->selling_price;
        $products->discount_price = $request->discount_price;
        
        $img = $request->file('product_image');
        if($img){
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move('backend/images/products/', $imgName);
            $products['product_image'] = $imgName;
        }
        $products->hot_deals = $request->hot_deals;
        $products->featured = $request->featured;
        $products->special_offer = $request->special_offer;
        $products->special_deals = $request->special_deals;
        $products->status = 1;
        $products->save();
        
        //multiple images inserted
        $files = $request->images;
        if(!empty($files)){
            foreach ($files as $file) {
                $imageName = date('YmdHi').$file->getClientOriginalName();
                $file->move('backend/images/sub_products/', $imageName);
                $subImage['images'] = $imageName;
                
                $subImage = new ProductImage();
                $subImage->product_id = $products->id;
                $subImage->images = $imageName;
                $subImage->save();
            }
        }
        
        $notification=array(
            'message'=>'Product Added Successfully',
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
        $product = Product::findOrFail($id);
        $multiimages = ProductImage::where('product_id', $product->id)->latest()->get();
        return view('backend.pages.products.show', compact('product', 'multiimages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $multiimages = ProductImage::where('product_id', $product->id)->latest()->get();
        return view('backend.pages.products.edit', compact('product', 'categories', 'brands', 'multiimages'));
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
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',
            'name_en' => 'required',
            'name_bn' => 'required',
            'product_code' => 'required',
            'quantity' => 'required|numeric',
            'tag_en' => 'required',
            'tag_bn' => 'required',
            'short_desc_en' => 'required',
            'short_desc_bn' => 'required',
            'long_desc_en' => 'required',
            'long_desc_bn' => 'required',
            'selling_price' => 'required',
            'product_image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);
        
        $products = Product::findOrFail($id);
        $products->user_id = Auth::user()->id;
        $products->brand_id = $request->brand_id;
        $products->category_id = $request->category_id;
        $products->subcategory_id = $request->subcategory_id;
        $products->subsubcategory_id = $request->subsubcategory_id;
        $products->name_en = $request->name_en;
        $products->name_bn = $request->name_bn;
        $products->slug_en = strtolower(str_replace(' ','-',$request->name_en));
        $products->slug_bn = str_replace(' ','-',$request->name_bn);
        $products->product_code = $request->product_code;
        $products->quantity = $request->quantity;
        $products->tag_en = $request->tag_en;
        $products->tag_bn = $request->tag_bn;
        $products->short_desc_en = $request->short_desc_en;
        $products->short_desc_bn = $request->short_desc_bn;
        $products->long_desc_en = $request->long_desc_en;
        $products->long_desc_bn = $request->long_desc_bn;
        $products->size_en = $request->size_en;
        $products->size_bn = $request->size_bn;
        $products->color_en = $request->color_en;
        $products->color_bn = $request->color_bn;
        $products->selling_price = $request->selling_price;
        $products->discount_price = $request->discount_price;
        
        $img = $request->file('product_image');
        if($img){
            $imgName = date('YmdHi').$img->getClientOriginalName();
            $img->move('backend/images/products/', $imgName);
            if(file_exists('backend/images/products/'.$products->product_image) AND !empty($products->product_image)){
                unlink('backend/images/products/'.$products->product_image);
            }
            $products['product_image'] = $imgName;
        }
        $products->hot_deals = $request->hot_deals;
        $products->featured = $request->featured;
        $products->special_offer = $request->special_offer;
        $products->special_deals = $request->special_deals;
        $products->status = 1;
        $products->save();
        
        //multiple images inserted
        $files = $request->images;
        
        //Old iMage deleted
        if(!empty($files)){
            $subImages = ProductImage::where('product_id', $id)->get()->toArray();
            
            foreach ($subImages as $value) {
                if(!empty($value)){
                    unlink('backend/images/sub_products/'.$value['images']);
                }
            }
            ProductImage::where('product_id', $id)->delete();
        }
        
        if(!empty($files)){
            foreach ($files as $file) {
                $imageName = date('YmdHi').$file->getClientOriginalName();
                $file->move('backend/images/sub_products/', $imageName);
                $subImage['images'] = $imageName;
                
                $subImage = new ProductImage();
                $subImage->product_id = $products->id;
                $subImage->images = $imageName;
                $subImage->save();
            }
        }
        
        $notification=array(
            'message'=>'Product Update Successfully',
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
        $product = Product::find($request->id);
        if(!is_null($product)){
            if(file_exists('backend/images/products/'.$product->product_image) AND !empty($product->product_image)){
                unlink('backend/images/products/'.$product->product_image);
            }
            
            $subImage = ProductImage::where('product_id', $product->id)->get()->toArray();
            if(!empty($subImage)){
                foreach ($subImage as $value) {
                    if(!empty($value)){
                        unlink('images/sub_products/'.$value['sub_image']);
                    }
                }
            }
            ProductImage::where('product_id', $product->id)->delete();
            $product->delete();
        }
        
        $notification=array(
            'message'=>'Product Deleted Successfully',
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
    public function inActive($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 0;
        $product->save();
        
        $notification=array(
            'message'=>'Product Inactivated',
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
    public function active($id)
    {
        $product = Product::findOrFail($id);
        $product->status = 1;
        $product->save();
        
        $notification=array(
            'message'=>'Product Activated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
