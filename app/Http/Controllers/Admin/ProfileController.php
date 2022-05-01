<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Todolist;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function dashboard()
    {
        $user_id = Auth::user()->id;
        $todolists = Todolist::paginate(4);

        $overdueTaskCounts = Todolist::where('user_id','=', auth()->user()->id)->where('created_at', '<', date('Y-m-d'))->where('completed', false)->count();

        $data = ['page_title'=>'Dashboard', 'todolists'=>$todolists, 'overdueTaskCounts'=>$overdueTaskCounts];
        return view('admin.dashboard', $data);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->validate([
            'task' => 'required',
        ]);

        $data['user_id'] = $user_id;

        Todolist::create($data);
        return redirect()->back();
    }

    public function update(Todolist $todolist)
    {
        $user_id = Auth::user()->id;
        if($todolist->completed == "0"){
            $todolist->update(['completed' => true]);
        }
        else
        {
            $todolist->update(['completed' => false]);
        }
        return redirect()->back();
    }

    public function destroy(Todolist $todolist)
    {
        if($todolist->completed == "0"){
            $todolist->delete();
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'You have been successfully logged out');
    }
}

