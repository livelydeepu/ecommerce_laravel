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
        $home_categories = DB::table('categories')->where(['is_home'=>1])->get();
        $data = ['home_categories'=>$home_categories];
        return view('site.index', $data);
    }
}

