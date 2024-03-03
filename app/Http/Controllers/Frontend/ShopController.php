<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ShopController extends Controller
{
    
    public function index()
    {
        $products = Product::query();
        
        //category filter
        if (!empty($_GET['category'])) {
            $slugs = explode(',',$_GET['category']);
            $catIds = Category::select('id')->whereIn('slug_en',$slugs)->pluck('id')->toArray();
            $products = $products->whereIn('category_id',$catIds);
        }
        
        //brand filter
        if (!empty($_GET['brand'])) {
            $slugs = explode(',',$_GET['brand']);
            $brandIds = Brand::select('id')->whereIn('slug_en',$slugs)->pluck('id')->toArray();
            $products = $products->whereIn('brand_id',$brandIds);
        }
        
        //price range product
         if (!empty($_GET['price'])) {
            $price = explode('-',$_GET['price']);
            $products = $products->whereBetween('selling_price',$price);
        }
        
        //sortByProduct
        if(!empty($_GET['sortBy'])){
            if ($_GET['sortBy'] == 'priceLowtoHigh') {
                $products = $products->where(['status' => 1])->orderBy('selling_price','ASC')->paginate(12);

            }elseif ($_GET['sortBy'] == 'priceHightoLow') {

                $products = $products->where(['status' => 1])->orderBy('selling_price','DESC')->paginate(12);

            }elseif ($_GET['sortBy'] == 'nameAtoZ') {
                $products = $products->where(['status' => 1])->orderBy('name_en','ASC')->paginate(12);

            }elseif ($_GET['sortBy'] == 'nameZtoA') {

                $products = $products->where(['status' => 1])->orderBy('name_en','DESC')->paginate(12);

            }else {
                $products = $products->where('status',1)->orderBy('id','DESC')->paginate(12);
            }
        }else{
            $products =$products->where('status',1)->orderBy('id','DESC')->paginate(12);
        }
        
        $categories = Category::orderBy('name_en', 'ASC')->get();
        $brands = Brand::orderBy('name_en', 'ASC')->get();
        return view('frontend.pages.products.shop_page', compact('products', 'categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function shopFilter(Request $request)
    {
        //dd($request->all());
        
        $data = $request->all();
        
        //filter category
        $catUrl = "";
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category='.$category;
                }else {
                    $catUrl .= ','.$category;
                }
            }
        }
        
        //filter brand
        $brandUrl = "";
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand='.$brand;
                }else {
                    $brandUrl .= ','.$brand;
                }
            }
        }
        
        //filter sortBy
        $sortByUrl = "";
        if (!empty($data['sortBy'])) {
            $sortByUrl .= '&sortBy='.$data['sortBy'];
        }
        
        //filter Price range
        $priceRangeUrl = "";
        if (!empty($data['price_range'])) {
            $priceRangeUrl .= '&price='.$data['price_range'];
        }
        
        return redirect()->route('product.shop',$catUrl.$brandUrl.$sortByUrl.$priceRangeUrl);
    }

    
}
