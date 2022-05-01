<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Color;
use Illuminate\Http\Request;
use Auth;

class ColorController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $colors = Color::all();
        $data = ['page_title'=>'Colors', 'colors'=>$colors];
        return view('admin.color', $data);
    }

    public function manage(Request $request, $id = '')
    {
        $user_id = Auth::user()->id;
        if($id > 0) {
            $result = Color::where(['id' => $id])->get();
            $data['color'] = $result['0']->color;
            $data['id'] = $result['0']->id;
        }
        else {
            $data['color'] = '';
            $data['id'] = 0;
        }
        $data['page_title'] = 'Manage Color';
        return view('admin.manage_color', $data);        
    }

    public function process(Request $request)
    {
        $data = $request->validate([
            'color' => 'required|unique:colors,color,'.$request->post('id'),
        ]);

        $data = ([
            'color' => $request->post('color'),
        ]);

        if($request->post('id') > 0) {
            $color = Color::find($request->post('id'));
            $color->update($data);
            return redirect()->route('color')->with('success', 'Color Updated Successfully');
        }
        else {
            Color::create($data);
            return redirect()->route('color')->with('success', 'Color Created Successfully');
        }
    }

    public function status(Request $request, $status, $id)
    {
        $color = Color::find($id);
        $color->update(['status' => $status]);
        return redirect()->route('color')->with('success', 'Color Updated Successfully');
    }

    public function destroy(Request $request, $id)
    {
        $color = Color::find($id);
        $color->delete();
        return redirect()->route('color')->with('success', 'Color Deleted Successfully');
    }
}
