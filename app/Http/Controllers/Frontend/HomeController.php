<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\Review;

class HomeController extends Controller
{
    
    public function index()
    {
        $data['categories'] = Category::orderBy('name_en', 'ASC')->get();
        $data['sliders'] = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
        $data['products'] = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        $data['featured'] = Product::where('featured', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        $data['special_offers'] = Product::where('special_offer', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        $data['special_deals'] = Product::where('special_deals', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        $data['skip_category'] = Category::skip(0)->first();
        $data['skip_product'] = Product::where('status', 1)->where('category_id', $data['skip_category']->id)->orderBy('id', 'DESC')->get();
        $data['skip_category1'] = Category::skip(3)->first();
        $data['skip_product1'] = Product::where('status', 1)->where('category_id', $data['skip_category1']->id)->orderBy('id', 'DESC')->get();
        $data['skip_brand'] = Brand::skip(3)->first();
        $data['skip_brandproduct'] = Product::where('status', 1)->where('brand_id', $data['skip_brand']->id)->orderBy('id', 'DESC')->get();
        return view('frontend.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tagWiseProduct($tag)
    {
        $products = Product::where('status', 1)->where('tag_en', $tag)->orWhere('tag_bn', $tag)->orderBy('id', 'DESC')->paginate(12);
        $categories = Category::orderBy('name_en', 'ASC')->get();
        return view('frontend.pages.products.product_tag', compact('products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subCatWiseProduct(Request $request, $id)
    {
        $categories = Category::orderBy('name_en', 'ASC')->get();
        
        $sort = '';
        if ($request->sort != null) {
             $sort = $request->sort;
        }
        
        if($id == null){
            return view('errors.404');
        }else{
            if($sort == 'priceLowtoHigh'){
                $products = Product::where(['status' => 1,'subcategory_id' => $id])->orderBy('selling_price', 'ASC')->paginate(3);
            }elseif($sort == 'priceHightoLow'){
                $products = Product::where(['status' => 1,'subcategory_id' => $id])->orderBy('selling_price', 'DESC')->paginate(3);
            }elseif($sort == 'nameAtoZ'){
                $products = Product::where(['status' => 1,'subcategory_id' => $id])->orderBy('name_en', 'ASC')->paginate(3);
            }elseif($sort == 'nameZtoA'){
                $products = Product::where(['status' => 1,'subcategory_id' => $id])->orderBy('name_en', 'DESC')->paginate(3);
            }else{
                $products = Product::where(['status' => 1,'subcategory_id' => $id])->paginate(3);
            }
        }
        
        $subCatId = $id;
        $route = 'subcategory/product';
        
        //loadmore product with ajax
        if ($request->ajax()) {
            $grid_view = view('frontend.partials.grid_view_product',compact('products'))->render();
            $list_view = view('frontend.partials.list_view_product',compact('products'))->render();
            return response()->json(['grid_view' => $grid_view,'list_view'=>$list_view]);
        }
        
        return view('frontend.pages.products.subcategory_product', compact('products', 'categories', 'subCatId', 'route', 'sort'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subSubCatWiseProduct(Request $request, $id)
    {
        $categories = Category::orderBy('name_en', 'ASC')->get();
        $products = Product::where(['status' => 1,'subsubcategory_id' => $id])->paginate(12);
        return view('frontend.pages.products.subsubcategory_product', compact('categories', 'products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['product'] = Product::findOrFail($id);
        
        $color_en = $data['product']->color_en;
        $data['color_en'] = explode(',', $color_en);
        
        $color_bn = $data['product']->color_bn;
        $data['color_bn'] = explode(',', $color_bn);
        
        $size_en = $data['product']->size_en;
        $data['size_en'] = explode(',', $size_en);
        
        $size_bn = $data['product']->size_bn;
        $data['size_bn'] = explode(',', $size_bn);
                
        $data['multiImages'] = ProductImage::where('product_id', $id)->get();
        $cat_id = $data['product']->category_id;
        $data['related_products'] = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        //Product Review
        $data['productReviews'] = Review::with(['user'])->where('product_id', $data['product']->id)->where('status', 'approved')->latest()->get();
        $rating = Review::where('product_id', $data['product']->id)->where('status', 'approved')->avg('rating');
        $data['avgRating'] = number_format($rating, 1);
        return view('frontend.pages.products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productViewAjax($id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);
        
        $color = $product->color_en;
        $product_color = explode(',',$color);
        $size = $product->size_en;
        $produt_size = explode(',',$size);
        
        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $produt_size,
        ));
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
