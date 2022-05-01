<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use Auth;

class CouponController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $coupons = Coupon::all();
        $data = ['page_title'=>'Coupons', 'coupons'=>$coupons];
        return view('admin.coupon', $data);
    }

    public function manage(Request $request, $id = '')
    {
        $user_id = Auth::user()->id;
        if($id > 0) {
            $result = Coupon::where(['id' => $id])->get();
            $data['title'] = $result['0']->title;
            $data['code'] = $result['0']->code;
            $data['value'] = $result['0']->value;
            $data['type'] = $result['0']->type;
            $data['min_order_amt'] = $result['0']->min_order_amt;
            $data['is_one_time'] = $result['0']->is_one_time;
            $data['id'] = $result['0']->id;
        }
        else {
            $data['title'] = '';
            $data['code'] = '';
            $data['value'] = '';
            $data['type'] = '';
            $data['min_order_amt'] = '';
            $data['is_one_time'] = '';
            $data['id'] = 0;
        }
        $data['page_title'] = 'Manage Coupon';
        return view('admin.manage_coupon', $data);        
    }

    public function process(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'code' => 'required|unique:coupons,code,'.$request->post('id'),
            'value' => 'required',
            'type' => 'required',
            'min_order_amt' => 'required',
            'is_one_time' => 'required',
        ]);

        $data = ([
            'title' => $request->post('title'),
            'code' => $request->post('code'),
            'value' => $request->post('value'),
            'type' => $request->post('type'),
            'min_order_amt' => $request->post('min_order_amt'),
            'is_one_time' => $request->post('is_one_time')
        ]);

        if($request->post('id') > 0) {
            $coupon = Coupon::find($request->post('id'));
            $coupon->update($data);
            return redirect()->route('coupon')->with('success', 'Coupon Updated Successfully');
        }
        else {
            Coupon::create($data);
            return redirect()->route('coupon')->with('success', 'Coupon Created Successfully');
        }
    }

    public function status(Request $request, $status, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->update(['status' => $status]);
        return redirect()->route('coupon')->with('success', 'Coupon Updated Successfully');
    }

    public function destroy(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('coupon')->with('success', 'Coupon Deleted Successfully');
    }
}
