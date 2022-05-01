<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\ProductAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Storage;

class ProductController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        //$products = Product::all();
        //$products = Product::all()->load('category');
        $products = Product::with('category')->get();
        $data = ['page_title'=>'Products', 'products'=>$products];
        return view('admin.product', $data);
    }

    public function manage(Request $request, $id = '')
    {
        $user_id = Auth::user()->id;
        if($id > 0) {
            $result = Product::where(['id' => $id])->get();
            $data['category_id'] = $result['0']->category_id;
            $data['name'] = $result['0']->name;
            $data['image'] = $result['0']->image;
            $data['slug'] = $result['0']->slug;
            $data['description'] = $result['0']->description;
            $data['short_description'] = $result['0']->short_description;
            $data['brand_id'] = $result['0']->brand_id;
            $data['model'] = $result['0']->model;
            $data['keywords'] = $result['0']->keywords;
            $data['technical_specification'] = $result['0']->technical_specification;
            $data['uses'] = $result['0']->uses;
            $data['warranty'] = $result['0']->warranty;
            $data['lead_time'] = $result['0']->lead_time;
            $data['tax_id'] = $result['0']->tax_id;
            $data['is_promo'] = $result['0']->is_promo;
            $data['is_featured'] = $result['0']->is_featured;
            $data['is_discounted'] = $result['0']->is_discounted;
            $data['is_trending'] = $result['0']->is_trending;
            $data['id'] = $result['0']->id;

            $data['productAttrs'] = DB::table('product_attributes')->where(['product_id'=>$id])->get();
        }
        else {
            $data['category_id'] = '';
            $data['name'] = '';
            $data['image'] = '';
            $data['slug'] = '';
            $data['description'] = '';
            $data['short_description'] = '';
            $data['brand_id'] = '';
            $data['model'] = '';
            $data['keywords'] = '';
            $data['technical_specification'] = '';
            $data['uses'] = '';
            $data['warranty'] = '';
            $data['lead_time'] = '';
            $data['tax_id'] = '';
            $data['is_promo'] = '';
            $data['is_featured'] = '';
            $data['is_discounted'] = '';
            $data['is_trending'] = '';
            $data['id'] = 0;

            $data['productAttrs'][0]['id'] = '';
            $data['productAttrs'][0]['product_id'] = '';
            $data['productAttrs'][0]['sku'] = '';
            $data['productAttrs'][0]['attr_image'] = '';
            $data['productAttrs'][0]['mrp'] = '';
            $data['productAttrs'][0]['price'] = '';
            $data['productAttrs'][0]['quantity'] = '';
            $data['productAttrs'][0]['size_id'] = '';
            $data['productAttrs'][0]['color_id'] = '';
        }

        $data['category'] = DB::table('categories')->get();
        $data['brands'] = DB::table('brands')->where(['status'=>1])->get();
        $data['taxes'] = DB::table('taxes')->get();
        $data['sizes'] = DB::table('sizes')->where(['status'=>1])->get();
        $data['colors'] = DB::table('colors')->where(['status'=>1])->get();
        $data['page_title'] = 'Manage Product';
        return view('admin.manage_product', $data);        
    }

    public function process(Request $request)
    {
        if($request->post('id') > 0) {
            $image_validation = 'mimes:jpeg,jpg,png';
        }
        else {
            $image_validation = 'required|mimes:jpeg,jpg,png';
        }

        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$request->post('id'),
            'image' => $image_validation,
            'category_id' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'brand_id' => 'required',
            'model' => 'required',
            'keywords' => 'required',
            'technical_specification' => 'required',
            'uses' => 'required',
            'warranty' => 'required',
            'lead_time' => 'required',
            'tax_id' => 'required',
            'is_promo' => 'required',
            'is_featured' => 'required',
            'is_discounted' => 'required',
            'is_trending' => 'required',
            'attr_image.*' => 'mimes:jpeg,jpg,png',
        ]);

        //Product Attributes
        $idAttr = $request->post('idAttr');
        $skuArr = $request->post('sku');
        $imageArr = $request->post('attr_image');
        $mrpArr = $request->post('mrp');
        $priceArr = $request->post('price');
        $qtyArr = $request->post('quantity');
        $sizeArr = $request->post('size_id');
        $colorArr = $request->post('color_id');
        foreach ($skuArr as $key => $row) {
            $check = DB::table('product_attributes')->where('sku','=',$skuArr[$key])->where('id','!=',$idAttr[$key])->get();
            if(isset($check[0])) {
                return redirect()->back()->with('error', $skuArr[$key].' SKU already used');
            }
        }

        if($request->post('id') > 0) {
            $product = Product::find($request->post('id'));
            $msg = 'Product Updated Successfully';
        }
        else {
            $product = new Product();
            $msg = 'Product Created Successfully';
        }

        if($request->hasfile('image')) {
            if($request->post('id') > 0) {
                $arrImage = DB::table('products')->where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/'.$arrImage[0]->image)) {
                    Storage::delete('/public/media/'.$arrImage[0]->image);
                }
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media/', $image_name);
            $product->image = $image_name;
        }

        $product->category_id = $request->post('category_id');
        $product->name = $request->post('name');
        $product->slug = $request->post('slug');
        $product->description = $request->post('description');
        $product->short_description = $request->post('short_description');
        $product->brand_id = $request->post('brand_id');
        $product->model = $request->post('model');
        $product->keywords = $request->post('keywords');
        $product->technical_specification = $request->post('technical_specification');
        $product->uses = $request->post('uses');
        $product->warranty = $request->post('warranty');
        $product->lead_time = $request->post('lead_time');
        $product->tax_id = $request->post('tax_id');
        $product->is_promo = $request->post('is_promo');
        $product->is_featured = $request->post('is_featured');
        $product->is_discounted = $request->post('is_discounted');
        $product->is_trending = $request->post('is_trending');
        $product->save();
        $prod_id =  $product->id;
       //Product Attributes
       if($request->hasfile("attr_image.$key")) {
            if($idAttr[$key] != '') {
                $arrImage = DB::table('product_attributes')->where(['id'=>$id])->get();
                if(Storage::exists('/public/media/'.$arrImage[0]->attr_image)) {
                    Storage::delete('/public/media/'.$arrImage[0]->attr_image);
                }
            }
            $image = $request->file("attr_image.$key");
            $ext = $image->extension();
            $image_name_attr = time().'.'.$ext;
            $request->file("attr_image.$key")->storeAs('/public/media/', $image_name_attr);
        }
        foreach ($skuArr as $key => $row) {
            $productAttrs=[];
            $productAttrs['product_id'] = $prod_id;
            $productAttrs['sku'] = $skuArr[$key];
            $productAttrs['mrp'] = (int)$mrpArr[$key]; 
            $productAttrs['price'] = (int)$priceArr[$key]; 
            $productAttrs['quantity'] = (int)$qtyArr[$key]; 
            $productAttrs['size_id'] = $sizeArr[$key];
            $productAttrs['color_id'] = $colorArr[$key];

            if($idAttr[$key] != '') {
                $productAttrs['attr_image'] = $image_name_attr;
                DB::table('product_attributes')->where(['id'=>$idAttr[$key]])->update($productAttrs);
            }
            else {
                $productAttrs['attr_image'] = $image_name_attr;
                DB::table('product_attributes')->insert($productAttrs);
            }
        }
        return redirect()->route('product')->with('success', $msg);
    }

    public function status(Request $request, $status, $id)
    {
        $product = Product::find($id);
        $product->update(['status' => $status]);
        return redirect()->route('product')->with('success', 'Product Updated Successfully');
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        $arrImage = DB::table('products')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->image)) {
            Storage::delete('/public/media/'.$arrImage[0]->image);
        }
        $product->delete();
        return redirect()->route('product')->with('success', 'Product Deleted Successfully');
    }

    public function productAttr_delete(Request $request, $id, $pid)
    {
        $arrImage = DB::table('product_attributes')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->attr_image)) {
            Storage::delete('/public/media/'.$arrImage[0]->attr_image);
        }
        DB::table('product_attributes')->where(['id'=>$id])->delete();
        return redirect('product.manage_product'.$pid);
    }

    public function productImage_delete(Request $request, $id, $pid)
    {
        $arrImage = DB::table('product_attributes')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->attr_image)) {
            Storage::delete('/public/media/'.$arrImage[0]->attr_image);
        }
        DB::table('product_attributes')->where(['id'=>$id])->delete();
        return redirect('product.manage_product'.$pid);
    }
}
