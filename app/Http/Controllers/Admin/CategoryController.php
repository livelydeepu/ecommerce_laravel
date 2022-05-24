<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $categories = Category::all();
        //$categories = Category::with('category')->get();
        $data = ['page_title'=>'Categories', 'categories'=>$categories];
        return view('admin.category', $data);
    }

    public function getDepth($parent_category_id) {
        $categories = Categories::find($parent_category_id);
 
        if ($categories) {
            if ($categories->parent_category_id == 0) {
                return $categories->category_name;
            } else {
                return self::getDepth($categories->parent_category_id);
            }
        }
    }

    public function manage(Request $request, $id = '')
    {
        $user_id = Auth::user()->id;
        if($id > 0) {
            $result = Category::where(['id' => $id])->get();
            $data['category_name'] = $result['0']->category_name;
            $data['category_slug'] = $result['0']->category_slug;
            $data['parent_category_id'] = $result['0']->parent_category_id;
            $data['category_image'] = $result['0']->category_image;
            $data['is_home'] = $result['0']->is_home;
            $data['is_home_selected'] = "";
            if($result['0']->is_home==1){
                $data['is_home_selected'] = "checked";
            }
            $data['id'] = $result['0']->id;
            $data['category'] = DB::table('categories')->where('id','!=',$id)->get();
        }
        else {
            $data['category_name'] = '';
            $data['category_slug'] = '';
            $data['parent_category_id'] = '';
            $data['category_image'] = '';
            $data['is_home'] = '';
            $data['is_home_selected'] = "";
            $data['id'] = 0;
            $data['category'] = DB::table('categories')->get();
        }

        $data['page_title'] = 'Manage Category';
        return view('admin.manage_category', $data);        
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
            'category_name' => 'required',
            'category_slug' => 'required|unique:categories,category_slug,'.$request->post('id'),
            'category_image' => $image_validation,
        ]);

        if($request->post('id') > 0) {
            $category = Category::find($request->post('id'));
            $msg = 'Category Updated Successfully';
        }
        else {
            $category = new Category();
            $msg = 'Category Created Successfully';
        }

        if($request->hasfile('category_image')) {
            if($request->post('id') > 0) {
                $arrImage = DB::table('categories')->where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/'.$arrImage[0]->category_image)) {
                    Storage::delete('/public/media/'.$arrImage[0]->category_image);
                }
            }
            $image = $request->file('category_image');
            $ext = $image->extension();
            $image_name = 'C'.time().'.'.$ext;
            $image->storeAs('/public/media/', $image_name);
            $category->category_image = $image_name;
        }

        if($request->post('parent_category_id') == "") {
            $category->parent_category_id = 0;
        }
        else {
            $category->parent_category_id = $request->post('parent_category_id');
        }

        $category->is_home = 0;
        if($request->post('is_home')!==null) {
            $category->is_home = 1;
        } 

        $category->category_name = $request->post('category_name');
        $category->category_slug = $request->post('category_slug');
        $category->save();

        return redirect()->route('category')->with('success', $msg);
    }

    public function destroy(Request $request, $id)
    {
        $arrImage = DB::table('categories')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->category_image)) {
            Storage::delete('/public/media/'.$arrImage[0]->category_image);
        }
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category')->with('success', 'Category Deleted Successfully');
    }
}
