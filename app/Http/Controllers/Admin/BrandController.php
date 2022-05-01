<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Storage;

class BrandController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $brands = Brand::all();
        $data = ['page_title'=>'Brands', 'brands'=>$brands];
        return view('admin.brand', $data);
    }

    public function manage(Request $request, $id = '')
    {
        $user_id = Auth::user()->id;
        if($id > 0) {
            $result = Brand::where(['id' => $id])->get();
            $data['name'] = $result['0']->name;
            $data['image'] = $result['0']->image;
            $data['id'] = $result['0']->id;
        }
        else {
            $data['name'] = '';
            $data['image'] = '';
            $data['id'] = 0;
        }
        $data['page_title'] = 'Manage Brand';
        return view('admin.manage_brand', $data);        
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
            'name' => 'required|unique:brands,name,'.$request->post('id'),
            'image' => $image_validation,
        ]);

        $data = ([
            'name' => $request->post('name'),
        ]);

        if($request->hasfile('image')) {
            if($request->post('id') > 0) {
                $arrImage = DB::table('brands')->where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/'.$arrImage[0]->image)) {
                    Storage::delete('/public/media/'.$arrImage[0]->image);
                }
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media/', $image_name);
        }

        if($request->post('id') > 0) {
            $data['image'] = $image_name;
            $brand = Brand::find($request->post('id'));
            $brand->update($data);
            return redirect()->route('brand')->with('success', 'Brand Updated Successfully');
        }
        else {
            $data['image'] = $image_name;
            Brand::create($data);
            return redirect()->route('brand')->with('success', 'Brand Created Successfully');
        }
    }

    public function status(Request $request, $status, $id)
    {
        $brand = Brand::find($id);
        $brand->update(['status' => $status]);
        return redirect()->route('brand')->with('success', 'Brand Updated Successfully');
    }

    public function destroy(Request $request, $id)
    {
        $arrImage = DB::table('brands')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->image)) {
            Storage::delete('/public/media/'.$arrImage[0]->image);
        }
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('brand')->with('success', 'Brand Deleted Successfully');
    }
}
