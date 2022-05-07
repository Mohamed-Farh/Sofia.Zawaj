<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country_Member_Setting;
use App\Models\Member;
use App\Models\Member_Inbox;
use App\Models\Member_Relation;
use App\Models\My_Notification;
use App\Models\Setting;
use Illuminate\Http\Request;

class Member_RelationController extends Controller
{

    //====================================================================================================================
    //====================================================================================================================
    //====================================================================================================================
    //====================================================================================================================
    //====================================================================================================================
    //Done
    public function member_message_to_member(Request $request)
    {
        try{
            if( Auth::guard('member')->check() )
            {
                $auth_id = Auth::guard('member')->id();
                $auth_member = \App\Models\Member::where('id', $auth_id)->first();

                //هيشوف لو الشخص دا معمول ليه حظر ولا لاء
                if( !Member_Relation::where(['my_id'=> $request->member_id, 'member_id'=> $auth_id, 'ignore_list'=> '1' ])->first() && !Member_Relation::where(['my_id'=> $auth_id, 'member_id'=> $request->member_id, 'ignore_list'=> '1' ])->first() )
                {
                    //لو الشخص دا مختار ان كل الدول تقدر تبعت ليه رسايل
                    if( Setting::where(['member_id'=> $request->member_id, 'who_can_text_me'=>'all'])->first() )
                    {
                        //لو الشخص دا مختار ان كل الجنسيات تقدر تبعت ليه رسايل
                        if( Setting::where(['member_id'=> $request->member_id, 'nationality_can_text_me'=>'all'])->first() )
                        {
                            //لو الشخص دا مختار ان كل الاعمار تقدر تبعت ليه رسايل
                            if( Setting::where(['member_id'=> $request->member_id, 'age_can_text_me'=>'all'])->first() )
                            {
                                $member_inbox = new Member_Inbox();
                                $member_inbox->member_id          = $request->member_id;
                                $member_inbox->subject            = $request->subject;
                                $member_inbox->message            = $request->message;
                                $member_inbox->sender_member_id   = Auth::guard('member')->id();
                                $member_inbox->save();

                                //START------------للحصول علي اشعارات
                                $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                                $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                                $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                                $notification = new My_Notification();
                                $notification->my_id         = $request->member_id;
                                $notification->member_id     = $auth_id;
                                $notification->type          = 'send_message';
                                $notification->notifications = 'لقد تم ارسال رسالة الي صفحتك الشخصية بواسطة ' .$myName->name ;

                                if($my_settings->show_new_messages == 'on')
                                {
                                    $notification->status          = true;
                                }else{
                                    $notification->status          = false;
                                }
                                $notification->save();
                                //END------------للحصول علي اشعارات
                                toastr()->success(trans('تم ارسال رسالتك بنجاح'));
                                return redirect()->back();

                            }elseif( Setting::where(['member_id'=> $request->member_id, 'age_can_text_me'=>'young_member'])->first() ){
                                //رفض هذا العضو التواصل مع اعضاء اقل منه سن
                                if( ($auth_member->age) <= (Member::where('id', $request->member_id)->first('age')))
                                {
                                    toastr()->error(trans('نأسف لعدم ارسال رسالتك , وذلك لرفض هذا العضو التواصل مع اعضاء اقل منه سناً '));
                                    return redirect()->back();
                                }
                            }

                        //في حالة اختيار الشخص التواصل مع اعضاء في نفس جنسيته فقط
                        }elseif( Setting::where(['member_id'=> $request->member_id, 'nationality_can_text_me'=>'in_nationality'])->first() ){
                            //هنشوف الشخص اللي هيبعت دا نفس الجنسية ولا لاء
                            $memberNationality      = Member::where('id', $request->member_id)->pluck('nationality')->toArray();
                            $memberDualNationality  = Member::where('id', $request->member_id)->pluck('dual_nationality')->toArray();
                            $memberAllNationalities = array_merge($memberNationality, $memberDualNationality); //اراي تجمع الجنسيتين الاتنين

                            $authmemberNationality      = Member::where('id', $auth_id)->pluck('nationality')->toArray();
                            $authmemberDualNationality  = Member::where('id', $auth_id)->pluck('dual_nationality')->toArray();
                            $authmemberAllNationalities = array_merge($authmemberNationality, $authmemberDualNationality); //اراي تجمع الجنسيتين الاتنين

                            $result = array_intersect($memberAllNationalities, $authmemberAllNationalities);//هل يوجد جنسيه متشابهه في الجنسيات

                            //لو وجدت جنسيات متشابهه نفذ الاتي
                            if($result)
                            {
                                //لو الشخص دا مختار ان كل الاعمار تقدر تبعت ليه رسايل
                                if( Setting::where(['member_id'=> $request->member_id, 'age_can_text_me'=>'all'])->first() )
                                {
                                    $member_inbox = new Member_Inbox();
                                    $member_inbox->member_id          = $request->member_id;
                                    $member_inbox->subject            = $request->subject;
                                    $member_inbox->message            = $request->message;
                                    $member_inbox->sender_member_id   = Auth::guard('member')->id();
                                    $member_inbox->save();

                                    //START------------للحصول علي اشعارات
                                    $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                                    $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                                    $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                                    $notification = new My_Notification();
                                    $notification->my_id         = $request->member_id;
                                    $notification->member_id     = $auth_id;
                                    $notification->type          = 'send_message';
                                    $notification->notifications = 'لقد تم ارسال رسالة الي صفحتك الشخصية بواسطة ' .$myName->name ;

                                    if($my_settings->show_new_messages == 'on')
                                    {
                                        $notification->status          = true;
                                    }else{
                                        $notification->status          = false;
                                    }
                                    $notification->save();
                                    //END------------للحصول علي اشعارات
                                    toastr()->success(trans('تم ارسال رسالتك بنجاح'));
                                    return redirect()->back();

                                }elseif( Setting::where(['member_id'=> $request->member_id, 'age_can_text_me'=>'young_member'])->first() ){
                                    //رفض هذا العضو التواصل مع اعضاء اقل منه سن
                                    if( ($auth_member->age) <= (Member::where('id', $request->member_id)->first('age')))
                                    {
                                        toastr()->error(trans('نأسف لعدم ارسال رسالتك , وذلك لرفض هذا العضو التواصل مع اعضاء اقل منه سناً '));
                                        return redirect()->back();
                                    }
                                }
                            }else{
                                toastr()->error(trans('نأسف لعدم ارسال رسالتك , وذلك لرفض هذا العضو التواصل مع اعضاء لهم جنسيات مختلفة عن جنسيته '));
                                return redirect()->back();
                            }

                        //في حالة اختيار الشخص التواصل مع اعضاء في جنسيات محددة
                        }elseif( Setting::where(['member_id'=> $request->member_id, 'nationality_can_text_me'=>'some_nationality'])->first() ){
                            //هنجيب الجنسيات اللي اختارها العضو اللي هبعتله الرساله
                            $memberChooseNationality      = Country_Member_Setting::where(['member_id'=> $request->member_id, 'type'=>'nationality_text_me'])->pluck('country_name')->toArray();

                            $authmemberNationality      = Member::where('id', $auth_id)->pluck('nationality')->toArray();
                            $authmemberDualNationality  = Member::where('id', $auth_id)->pluck('dual_nationality')->toArray();
                            $authmemberAllNationalities = array_merge($authmemberNationality, $authmemberDualNationality); //اراي تجمع الجنسيتين الاتنين

                            $resultChooseNationality = array_intersect($memberChooseNationality, $authmemberAllNationalities);//هل يوجد جنسيه متشابهه في الجنسيات

                            //لو وجدت جنسيات متشابهه نفذ الاتي
                            if($resultChooseNationality)
                            {
                                //لو الشخص دا مختار ان كل الاعمار تقدر تبعت ليه رسايل
                                if( Setting::where(['member_id'=> $request->member_id, 'age_can_text_me'=>'all'])->first() )
                                {
                                    $member_inbox = new Member_Inbox();
                                    $member_inbox->member_id          = $request->member_id;
                                    $member_inbox->subject            = $request->subject;
                                    $member_inbox->message            = $request->message;
                                    $member_inbox->sender_member_id   = Auth::guard('member')->id();
                                    $member_inbox->save();

                                    //START------------للحصول علي اشعارات
                                    $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                                    $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                                    $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                                    $notification = new My_Notification();
                                    $notification->my_id         = $request->member_id;
                                    $notification->member_id     = $auth_id;
                                    $notification->type          = 'send_message';
                                    $notification->notifications = 'لقد تم ارسال رسالة الي صفحتك الشخصية بواسطة ' .$myName->name ;

                                    if($my_settings->show_new_messages == 'on')
                                    {
                                        $notification->status          = true;
                                    }else{
                                        $notification->status          = false;
                                    }
                                    $notification->save();
                                    //END------------للحصول علي اشعارات
                                    toastr()->success(trans('تم ارسال رسالتك بنجاح'));
                                    return redirect()->back();

                                }elseif( Setting::where(['member_id'=> $request->member_id, 'age_can_text_me'=>'young_member'])->first() ){
                                    //رفض هذا العضو التواصل مع اعضاء اقل منه سن
                                    if( ($auth_member->age) <= (Member::where('id', $request->member_id)->first('age')))
                                    {
                                        toastr()->error(trans('نأسف لعدم ارسال رسالتك , وذلك لرفض هذا العضو التواصل مع اعضاء اقل منه سناً '));
                                        return redirect()->back();
                                    }
                                }
                            }else{
                                toastr()->error(trans('نأسف لعدم ارسال رسالتك , وذلك لرفض هذا العضو التواصل مع اعضاء لهم جنسيات معينة '));
                                return redirect()->back();
                            }
                        }


                    //في حالة اختيار الشخص التواصل مع اعضاء في نفس بلده فقط
                    }elseif( Setting::where(['member_id'=> $request->member_id, 'who_can_text_me'=>'in_member'])->first() ){
                        //هنشوف الشخص اللي هيبعت دا نفس بلده ولا لاء
                        $memberCountry          = Member::where('id', $request->member_id)->pluck('country')->toArray();

                        $authmemberCountry      = Member::where('id', $auth_id)->pluck('nationality')->toArray();

                        $result = array_intersect($memberCountry, $authmemberCountry);//هل يوجد بلد متشابهه في البلدان

                        //لو وجدت البلدان متشابهه نفذ الاتي
                        if($result)
                        {
                            //لو الشخص دا مختار ان كل الاعمار تقدر تبعت ليه رسايل
                            if( Setting::where(['member_id'=> $request->member_id, 'age_can_text_me'=>'all'])->first() )
                            {
                                $member_inbox = new Member_Inbox();
                                $member_inbox->member_id          = $request->member_id;
                                $member_inbox->subject            = $request->subject;
                                $member_inbox->message            = $request->message;
                                $member_inbox->sender_member_id   = Auth::guard('member')->id();
                                $member_inbox->save();

                                //START------------للحصول علي اشعارات
                                $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                                $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                                $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                                $notification = new My_Notification();
                                $notification->my_id         = $request->member_id;
                                $notification->member_id     = $auth_id;
                                $notification->type          = 'send_message';
                                $notification->notifications = 'لقد تم ارسال رسالة الي صفحتك الشخصية بواسطة ' .$myName->name ;

                                if($my_settings->show_new_messages == 'on')
                                {
                                    $notification->status          = true;
                                }else{
                                    $notification->status          = false;
                                }
                                $notification->save();
                                //END------------للحصول علي اشعارات
                                toastr()->success(trans('تم ارسال رسالتك بنجاح'));
                                return redirect()->back();

                            }elseif( Setting::where(['member_id'=> $request->member_id, 'age_can_text_me'=>'young_member'])->first() ){
                                //رفض هذا العضو التواصل مع اعضاء اقل منه سن
                                if( ($auth_member->age) <= (Member::where('id', $request->member_id)->first('age')))
                                {
                                    toastr()->error(trans('نأسف لعدم ارسال رسالتك , وذلك لرفض هذا العضو التواصل مع اعضاء اقل منه سناً '));
                                    return redirect()->back();
                                }
                            }
                        }else{
                            toastr()->error(trans('نأسف لعدم ارسال رسالتك , وذلك لرفض هذا العضو التواصل مع اعضاء خارج بلده '));
                            return redirect()->back();
                        }

                    //في حالة اختيار الشخص التواصل مع اعضاء في بلدان محددة
                    }elseif( Setting::where(['member_id'=> $request->member_id, 'nationality_can_text_me'=>'some_nationality'])->first() ){
                        //هنجيب البلدان اللي اختارها العضو اللي هبعتله الرساله
                        $memberChooseCountries      = Country_Member_Setting::where(['member_id'=> $request->member_id, 'type'=>'country_text_me'])->pluck('country_name')->toArray();

                        $authmemberCountry      = Member::where('id', $auth_id)->pluck('country')->toArray();

                        $resultChooseCountries = array_intersect($memberChooseCountries, $authmemberCountry);//هل يوجد جنسيه متشابهه في البلدان

                        //لو وجدت البلدان متشابهه نفذ الاتي
                        if($resultChooseCountries)
                        {
                            //لو الشخص دا مختار ان كل الاعمار تقدر تبعت ليه رسايل
                            if( Setting::where(['member_id'=> $request->member_id, 'age_can_text_me'=>'all'])->first() )
                            {
                                $member_inbox = new Member_Inbox();
                                $member_inbox->member_id          = $request->member_id;
                                $member_inbox->subject            = $request->subject;
                                $member_inbox->message            = $request->message;
                                $member_inbox->sender_member_id   = Auth::guard('member')->id();
                                $member_inbox->save();

                                //START------------للحصول علي اشعارات
                                $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                                $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                                $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                                $notification = new My_Notification();
                                $notification->my_id         = $request->member_id;
                                $notification->member_id     = $auth_id;
                                $notification->type          = 'send_message';
                                $notification->notifications = 'لقد تم ارسال رسالة الي صفحتك الشخصية بواسطة ' .$myName->name ;

                                if($my_settings->show_new_messages == 'on')
                                {
                                    $notification->status          = true;
                                }else{
                                    $notification->status          = false;
                                }
                                $notification->save();
                                //END------------للحصول علي اشعارات
                                toastr()->success(trans('تم ارسال رسالتك بنجاح'));
                                return redirect()->back();

                            }elseif( Setting::where(['member_id'=> $request->member_id, 'age_can_text_me'=>'young_member'])->first() ){
                                //رفض هذا العضو التواصل مع اعضاء اقل منه سن
                                if( ($auth_member->age) <= (Member::where('id', $request->member_id)->first('age')))
                                {
                                    toastr()->error(trans('نأسف لعدم ارسال رسالتك , وذلك لرفض هذا العضو التواصل مع اعضاء اقل منه سناً '));
                                    return redirect()->back();
                                }
                            }
                        }else{
                            toastr()->error(trans('نأسف لعدم ارسال رسالتك , وذلك لرفض هذا العضو التواصل مع اعضاء في بلدان معينة '));
                            return redirect()->back();
                        }
                    }


                }else{
                    toastr()->error(trans('نأسف لعدم ارسال رسالتك , وذلك لوجود أحدكم في قائمة الحظر لدي العضو الأخر '));
                    return redirect()->back();
                }

            }else{
                toastr()->error(trans('يرجي تسجيل الدخول حتي تتمكن من التواصل مع بقية الاعضاء بالموقع'));
                return redirect()->back();
            }

        }
       catch (\Exception $e){
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }
//====================================================================================================================
//====================================================================================================================
//====================================================================================================================
//====================================================================================================================
//====================================================================================================================
    //Show My Full data
    //Done
    public function show_my_data_page(Request $request)
    {
        try{
            if( Auth::guard('member')->check() )
            {
                $auth_id = Auth::guard('member')->id();
                $member = Member::where('id', $auth_id )->first();
                return view('includes.member_info.my_data', compact('member'));
            }else{
                toastr()->error(trans('يرجي تسجيل الدخول اولا'));
                return redirect()->back();
            }
        }
       catch (\Exception $e){
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
    }

    //------------------------------------------------------------------------
    //Done
    public function show_my_inbox_message_page()
    {
        try{
            if (Auth::guard('member')->check())
            {
                $auth_id = Auth::guard('member')->id();

                $messages = Member_Inbox::where('member_id', $auth_id )->where('show', '0')->orderBy('id', 'desc')->paginate(5);

                $messages_count = count($messages);

                $messages->each(function ($item1){
                    $item1->update(['read'=>"1"]);
                });


                return view('includes.member_info.my_inbox_message', compact('messages', 'messages_count'));

            }else{
                toastr()->error(trans('يرجي تسجيل الدخول اولاً '));
                return view('home');
            }

        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function number(Request $request){
        //للحصول علي الشخص اللي عامل تسجيل دخول
        $auth_id = Auth::guard('member')->id();
        $member = Member::where('id', $auth_id)->first();

        $data = Member_Inbox::select('*')->where('member_id', $auth_id)->where('show', '0')->where('read', "0")->count();
        return response()->json($data);
    }



}
