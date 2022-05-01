<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;
use Auth;

class TaxController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $taxes = Tax::all();
        $data = ['page_title'=>'Taxes', 'taxes'=>$taxes];
        return view('admin.tax', $data);
    }

    public function manage(Request $request, $id = '')
    {
        $user_id = Auth::user()->id;
        if($id > 0) {
            $result = Tax::where(['id' => $id])->get();
            $data['tax_name'] = $result['0']->tax_name;
            $data['tax_value'] = $result['0']->tax_value;
            $data['id'] = $result['0']->id;
        }
        else {
            $data['tax_name'] = '';
            $data['tax_value'] = '';
            $data['id'] = 0;
        }
        $data['page_title'] = 'Manage Tax';
        return view('admin.manage_tax', $data);        
    }

    public function process(Request $request)
    {
        $data = $request->validate([
            'tax_name' => 'required|unique:taxes,tax_name,'.$request->post('id'),
            'tax_value' => 'required',
        ]);

        $data = ([
            'tax_name' => $request->post('tax_name'),
            'tax_value' => $request->post('tax_value'),
        ]);

        if($request->post('id') > 0) {
            $tax = Tax::find($request->post('id'));
            $tax->update($data);
            return redirect()->route('tax')->with('success', 'Tax Updated Successfully');
        }
        else {
            Tax::create($data);
            return redirect()->route('tax')->with('success', 'Tax Created Successfully');
        }
    }

    public function destroy(Request $request, $id)
    {
        $tax = Tax::find($id);
        $tax->delete();
        return redirect()->route('tax')->with('success', 'Tax Deleted Successfully');
    }
}
