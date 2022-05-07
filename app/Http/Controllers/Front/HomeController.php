<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Models\App_Feature;
use App\Models\State;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $app_feature_title = App_Feature::where('status', '0')->where('feature_type', 'مميزات التطبيق')->get();

        return view('home', compact('app_feature_title'));
    }

    public function secondHome()
    {
        return view('includes.sofia_front.index');
    }

    ######################################## Country################################
    public function frontGetState(Request $request)
    {
        $states = State::whereCountryId($request->country)->whereStatus(true)->get(['id', 'name'])->toArray();
        return response()->json($states);
    }

}
