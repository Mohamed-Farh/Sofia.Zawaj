<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class Login_FrontController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_login_page()
    {
        return view('includes.sofia_front.login_page');
    }



    public function front_sign(Request $request)
    {
        $member = Member::where(['email'=> $request->email, 'password'=>password_verify('password', $request->password) ])->first();

        if( $member ){
            Session::forget('login_key');
            Session::put('login_key', $member->id);

            if($member->active_now == '1'){
                $member->update([
                    $member->active_now = '0',
                ]);
            }

            toastr()->success(trans('تم تسجيل دخولك بنجاح'));
            return view('includes.sofia_front.myprofile');

        }else{
            toastr()->error(trans('يرجي التأكد من البيانات و اعادة المحاولة مرة اخري'));
            return view('includes.sofia_front.login_page');
        }
    }

    public function front_logout(Request $request)
    {
        $member_id = Session::get('login_key');
        $member = Member::where('id', $member_id )->first();

        // if($member->active_now == '0'){
        //     $member->update([
        //         $member->active_now = '1',
        //     ]);
        // }
        Session::forget('login_key');


        toastr()->error(trans('تم تسجيل خروجك بنجاح'));
        return redirect()->route('home');
    }
}
