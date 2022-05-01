<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Size;
use Illuminate\Http\Request;
use Auth;

class SizeController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $sizes = Size::all();
        $data = ['page_title'=>'Sizes', 'sizes'=>$sizes];
        return view('admin.size', $data);
    }

    public function manage(Request $request, $id = '')
    {
        $user_id = Auth::user()->id;
        if($id > 0) {
            $result = Size::where(['id' => $id])->get();
            $data['size'] = $result['0']->size;
            $data['id'] = $result['0']->id;
        }
        else {
            $data['size'] = '';
            $data['id'] = 0;
        }
        $data['page_title'] = 'Manage Size';
        return view('admin.manage_size', $data);        
    }

    public function process(Request $request)
    {
        $data = $request->validate([
            'size' => 'required|unique:sizes,size,'.$request->post('id'),
        ]);

        $data = ([
            'size' => $request->post('size'),
        ]);

        if($request->post('id') > 0) {
            $size = Size::find($request->post('id'));
            $size->update($data);
            return redirect()->route('size')->with('success', 'Size Updated Successfully');
        }
        else {
            Size::create($data);
            return redirect()->route('size')->with('success', 'Size Created Successfully');
        }
    }

    public function status(Request $request, $status, $id)
    {
        $size = Size::find($id);
        $size->update(['status' => $status]);
        return redirect()->route('size')->with('success', 'Size Updated Successfully');
    }

    public function destroy(Request $request, $id)
    {
        $size = Size::find($id);
        $size->delete();
        return redirect()->route('size')->with('success', 'Size Deleted Successfully');
    }
}
