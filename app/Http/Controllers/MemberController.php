<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\Member_Inbox;
use App\Models\Member_Relation;
use App\Models\My_Notification;
use App\Models\Setting;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;


class MemberController extends Controller
{

    //Show Login Form And Terms Before Register
    //Done
    public function show_login_page()
    {
        if( Auth::guard('member')->check() ){
            toastr()->error(trans('انت حاليا مُسجل دخول بموقع صوفيا'));
            return redirect()->back();
        }else{
            return view('includes.sofia_front.login_page');
        }
    }

    //Done
    public function member_login(Request $request)
    {
        // dd($request);
        if( Auth::guard('member')->check() )
        {
            toastr()->error(trans('انت حاليا مُسجل دخول بموقع صوفيا'));
            return redirect()->back();
            dd('Already Logined');
        }else{
            // Validate the form data
            $this->validate($request, [
                'email'   => 'required|email',
                'password' => 'required|min:6'
            ]);

            // Attempt to log the user in
            if (Auth::guard('member')->attempt(['email' => $request->email, 'password' =>$request->password ], $request->remember)) {
                // if successful, then redirect to their intended location
                toastr()->success(trans('تم تسجيل دخولك بنجاح'));
                return redirect()->route('myprofile_page');

            }elseif (Auth::guard('member')->attempt(['email' => $request->email, 'password' =>password_verify('password', $request->password)], $request->remember)) {
                // if successful, then redirect to their intended location
                toastr()->success(trans('تم تسجيل دخولك بنجاح'));
                return redirect()->route('myprofile_page');
            }else{
                toastr()->error(trans('يرجي التأكد من البيانات و اعادة المحاولة مرة اخري'));
                return redirect()->back();
            }
            // if unsuccessful, then redirect back to the login with the form data
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }

    }

    //Done
    public function member_signout()
    {
        Auth::guard('member')->logout();
        toastr()->success(trans('تم تسجيل خروجك بنجاح'));
        return Redirect('home');
    }

    //------------------------------------------------------------------------
    //------------------------------------------------------------------------
    //Done
    public function member_give_like(Request $request)
    {
        if( Auth::guard('member')->check() )
        {
            $my_id = Auth::guard('member')->id();
            $relation = Member_Relation::where(['my_id'=> $my_id, 'member_id'=> $request->member_id ])->first();
            if($relation){

                if($relation->care_list == '0'){
                    $relation->update([
                        $relation->care_list = '1',
                    ]);

                    //START------------للحصول علي اشعارات
                    $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                    $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                    $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                    $notification = new My_Notification();
                    $notification->my_id         = $request->member_id;
                    $notification->member_id     = $auth_id;
                    $notification->type          = 'like_profile';
                    $notification->notifications = 'لقد تم تسجيل اعجاب بصفحتك الشخصية بواسطة ' .$myName->name ;

                    if($my_settings->show_who_care_me == 'on')
                    {
                        $notification->status          = true;
                    }else{
                        $notification->status          = false;
                    }
                    $notification->save();
                    //END------------للحصول علي اشعارات

                    toastr()->success(trans('تم تسجيل اعجابك بنجاح'));

                }elseif($relation->care_list == '1'){
                    $relation->update([
                        $relation->care_list = '0',
                    ]);

                    //START------------للحصول علي اشعارات
                    $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                    $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                    $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                    $notification = new My_Notification();
                    $notification->my_id         = $request->member_id;
                    $notification->member_id     = $auth_id;
                    $notification->type          = 'unlike_profile';
                    $notification->notifications = 'لقد تم الغاء تسجيل اعجاب بصفحتك الشخصية بواسطة ' .$myName->name ;

                    if($my_settings->show_who_care_me == 'on')
                    {
                        $notification->status          = true;
                    }else{
                        $notification->status          = false;
                    }
                    $notification->save();
                    //END------------للحصول علي اشعارات

                    toastr()->error(trans('تم الغاء تسجيل اعجابك بنجاح'));
                }

                return redirect()->back();

            }else{
                $relation = new Member_Relation();
                $relation->member_id              = $request->member_id;
                $relation->care_list              = '1' ;
                $relation->my_id              = Auth::guard('member')->id();
                $relation->save();

                //START------------للحصول علي اشعارات
                $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                $notification = new My_Notification();
                $notification->my_id         = $request->member_id;
                $notification->member_id     = $auth_id;
                $notification->type          = 'like_profile';
                $notification->notifications = 'لقد تم تسجيل اعجاب بصفحتك الشخصية بواسطة ' .$myName->name ;

                if($my_settings->show_who_care_me == 'on')
                {
                    $notification->status          = true;
                }else{
                    $notification->status          = false;
                }
                $notification->save();
                //END------------للحصول علي اشعارات

                toastr()->success(trans('تم تسجيل اعجابك بنجاح'));
                return redirect()->back();
            }

        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا حتي تتمكن من التفاعل مع الاعضاء الاخرين'));
            return redirect()->back();
        }
    }


    //---------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------
    //Done
    public function member_give_block(Request $request)
    {

        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();

            $relation = Member_Relation::where(['my_id'=> $auth_id, 'member_id'=> $request->member_id ])->first();

            if($relation){

                if($relation->ignore_list == '0'){
                    $relation->update([
                        $relation->ignore_list = '1',
                    ]);

                    //START------------للحصول علي اشعارات
                    $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                    $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                    $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                    $notification = new My_Notification();
                    $notification->my_id         = $request->member_id;
                    $notification->member_id     = $auth_id;
                    $notification->type          = 'block_profile';
                    $notification->notifications = 'لقد تم حظر صفحتك الشخصية بواسطة ' .$myName->name ;

                    if($my_settings->show_block_me == 'on')
                    {
                        $notification->status          = true;
                    }else{
                        $notification->status          = false;
                    }
                    $notification->save();
                    //END------------للحصول علي اشعارات

                    toastr()->error(trans('تم حظر هذا العضو بنجاح'));

                }elseif($relation->ignore_list == '1'){
                    $relation->update([
                        $relation->ignore_list = '0',
                    ]);

                    //START------------للحصول علي اشعارات
                    $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                    $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                    $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                    $notification = new My_Notification();
                    $notification->my_id         = $request->member_id;
                    $notification->member_id     = $auth_id;
                    $notification->type          = 'unblock_profile';
                    $notification->notifications = 'لقد تم الغاء حظر صفحتك الشخصية بواسطة ' .$myName->name ;

                    if($my_settings->show_unblock_me == 'on')
                    {
                        $notification->status          = true;
                    }else{
                        $notification->status          = false;
                    }
                    $notification->save();
                    //END------------للحصول علي اشعارات

                    toastr()->success(trans('تم الغاء حظر هذا العضو بنجاح'));
                }

                return redirect()->back();

            }else{
                $relation = new Member_Relation();
                $relation->member_id         = $request->member_id;
                $relation->ignore_list       = '1' ;
                $relation->my_id             = $auth_id;
                $relation->save();

                //START------------للحصول علي اشعارات
                $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                $notification = new My_Notification();
                $notification->my_id         = $request->member_id;
                $notification->member_id     = $auth_id;
                $notification->type          = 'block_profile';
                $notification->notifications = 'لقد تم حظر صفحتك الشخصية بواسطة ' .$myName->name ;

                if($my_settings->show_block_me == 'on')
                {
                    $notification->status          = true;
                }else{
                    $notification->status          = false;
                }
                $notification->save();
                //END------------للحصول علي اشعارات

                toastr()->error(trans('تم حظر هذا العضو بنجاح'));
                return redirect()->back();
            }

        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا حتي تتمكن من التفاعل مع الاعضاء الاخرين'));
            return redirect()->back();
        }

    }

    //------------------------------------------------------------------------
    //Done
    public function member_care(Request $request)
    {

        if( Auth::guard('member')->check() )
        {
            $member_id = Auth::guard('member')->id();
            $members = Member_Relation::where(['member_id'=> $member_id, 'care_list'=> '1'])->orderBy('id', 'desc')->paginate(30);
            $members_counts = Member_Relation::where(['member_id'=> $member_id, 'care_list'=> '1'])->count();
            //    foreach($members as $member_care){
            //         $blocked_member = Member_Relation::where(['my_id'=> $member_id, 'member_id'=>($member_care->my_id), 'ignore_list'=> '1'])->first();
            //    }
            return view('includes.member_info.member_care', compact('members', 'members_counts'));
        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }
    }

    //------------------------------------------------------------------------
    public function my_block_list(Request $request)
    {
        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $members = Member_Relation::where(['my_id'=> $auth_id, 'ignore_list'=> '1'])->orderBy('id', 'desc')->paginate(30);
            $members_counts =  count($members);
            return view('includes.member_info.my_block_list', compact('members', 'members_counts'));
        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }
    }


    //------------------------------------------------------------------------
    //Done
    public function who_visit_myprofile(Request $request)
    {
        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $member = Member::where('id', $auth_id)->first();
            $members = Member_Relation::where(['member_id'=> $auth_id, 'visit_profile'=> '1'])->orderBy('id', 'desc')->paginate(30);
            $members_counts = count($members);
            return view('includes.member_info.who_visit_myprofile', compact('members', 'members_counts', 'member'));
        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }
    }




//------------------------------------------------------------------------
//------------------------------------------------------------------------
//------------------------------------------------------------------------
//------------------------------------------------------------------------
    //Done
    public function online_members()
    {
        Carbon::setLocale('ar');

        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $members = Member::select("*")
                        ->whereNotNull('last_seen')
                        ->where('id', '!=', $auth_id)
                        ->orderBy('last_seen', 'DESC')
                        ->paginate(30);

            $members_counts = count($members);
            $title = 'الـكـل';
            return view('includes.sofia_front.online_members', compact('members', 'members_counts','title'));
        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }
    }

    //Done
    public function online_male_members()
    {
        Carbon::setLocale('ar');

        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $members = Member::where('gender', 'ذكر')
                        ->whereNotNull('last_seen')
                        ->where('id', '!=', $auth_id)
                        ->orderBy('last_seen', 'DESC')
                        ->paginate(30);

            $members_counts = count($members);
            $title = 'الذكـور';
            return view('includes.sofia_front.online_members', compact('members', 'members_counts','title'));
        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }
    }

    //Done
    public function online_female_members()
    {
        Carbon::setLocale('ar');

        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $members = Member::where('gender', 'أنثي')
                        ->whereNotNull('last_seen')
                        ->where('id', '!=', $auth_id)
                        ->orderBy('last_seen', 'DESC')
                        ->paginate(30);

            $members_counts = count($members);
            $title = 'الإنـاث';
            return view('includes.sofia_front.online_members', compact('members', 'members_counts','title'));
        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }
    }




//------------------------------------------------------------------------
//------------------------------------------------------------------------
//------------------------------------------------------------------------
//------------------------------------------------------------------------
    public function my_notifications_page(Request $request)
    {
        Carbon::setLocale('ar');

        if( Auth::guard('member')->check() )
        {
            //للحصول علي الشخص اللي عامل تسجيل دخول
            $auth_id = Auth::guard('member')->id();
            $member = Member::where('id', $auth_id)->first();

            //للحصول علي الاعدادات الخاصة بهذا الشخص
            $member_settings = Setting::where('member_id', $auth_id)->first();

            $my_notifications = My_Notification::where('my_id', $auth_id)->where('status', true)->orderBy('id', 'DESC')->paginate(10);
            $my_notifications_counts = count($my_notifications);

            $my_notifications->each(function ($item){
                $item->update(['read'=>1]);
            });

            return view('includes.member_info.notifications', compact('member', 'my_notifications', 'my_notifications_counts'));

        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }

    }

    //To get Notification for the persion who make login
    //Done
    public function number(Request $request){
        //للحصول علي الشخص اللي عامل تسجيل دخول
        $auth_id = Auth::guard('member')->id();
        $member = Member::where('id', $auth_id)->first();

        $data = My_Notification::select('*')->where('my_id', $auth_id)->where('status', true)->where('read', 0)->count();
        return response()->json($data);
    }


    //------------------------------------------------------------------------
    public function top_members_page(Request $request)
    {
        if( Auth::guard('member')->check() )
        {
            return view('includes.member_info.top_members');

        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }

    }



    //------------------------------------------------------------------------
    public function read_my_message(Request $request)
    {

        if( Auth::guard('member')->check() )
        {
            $member_inbox = Member_Inbox::findOrFail($request->id);

            if($member_inbox->read == '0'){
                $member_inbox->update([
                    $member_inbox->read = '1',
                ]);
            // }elseif($member_inbox->read == '1'){
            //     $member_inbox->update([
            //         $member_inbox->read = '0',
            //     ]);
            }

            toastr()->error(Success('DONE'));
            return redirect()->back();

        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }

    }






}
