<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $data['home_categories'] = DB::table('categories')->where(['is_home'=>1])->get();

        foreach($data['home_categories'] as $clist) {
            $data['home_category_products'][$clist->id] = DB::table('products')->where(['category_id'=>$clist->id])->get();
        
            foreach($data['home_category_products'][$clist->id] as $plist) {
                $data['home_product_attrs'][$plist->id] = DB::table('product_attributes')
                                                            ->leftJoin('sizes','sizes.id','=','product_attributes.size_id')
                                                            ->leftJoin('colors','colors.id','=','product_attributes.color_id')
                                                            ->where(['product_attributes.product_id'=>$plist->id])->get();
            }
        }

        
        
        /*$home_products = DB::table('products')
                                    ->join('categories', 'categories.id', '=', 'products.category_id')
                                    ->join('brands', 'brands.id', '=', 'products.brand_id')
                                    ->get();
        */

        /*$home_product_attrs = DB::table('product_attributes')
                                    ->join('sizes', 'sizes.id', '=', 'product_attributes.size_id')
                                    ->join('colors', 'colors.id', '=', 'product_attributes.color_id')
                                    ->join('products', 'products.id', '=', 'product_attributes.product_id')
                                    ->join('categories', 'categories.id', '=', 'products.category_id')
                                    ->join('brands', 'brands.id', '=', 'products.brand_id')
                                    ->get();
        */

        return view('site.index', $data);
    }
}

