<?php

namespace App\Http\Controllers\Front;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


use App\Models\Member;
use App\Http\Controllers\Controller;
use App\Models\Country_Member_Setting;
use App\Models\Member_Relation;
use App\Models\My_Notification;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Member_DataController extends Controller
{
    use SendsPasswordResetEmails;

    //Done
    public function show_myprofile_page()
    {
        if( Auth::guard('member')->check() )
        {
            $member_id = Auth::guard('member')->id();
            $member = \App\Models\Member::where('id', $member_id)->first();
            return view('includes.sofia_front.myprofile', compact('member'));

        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }
    }


    //First Form To Send Request To Get New Password
    //Done
    public function show_forget_password_page()
    {
        return view('includes.sofia_front.forget_password');
    }

    //Done
    public function show_male_register_page()
    {
        if( Auth::guard('member')->check() ){
            toastr()->error(trans('انت حاليا مُسجل دخول بموقع صوفيا'));
            return redirect()->back();
        }else{
            return view('includes.sofia_front.male_register');
        }
    }

    //Done
    public function show_female_register_page()
    {
        if( Auth::guard('member')->check() ){
            toastr()->error(trans('انت حاليا مُسجل دخول بموقع صوفيا'));
            return redirect()->back();
        }else{
            return view('includes.sofia_front.female_register');
        }
    }


    //------------------------------------------------------------------------
    //Done
    public function member_register(Request $request)
    {
        // try{
            do
            {
                $code = mt_rand(1111111111,9999999999);
                $member_code = Member::where('code_no', $code)->get();
            }
            while(!$member_code->isEmpty());

            $validate = $request->validate([
                'email'         => 'required|email|unique:members,email',
                'password'      => 'required|min:8',
                'phone'         => 'required|unique:members,phone',
            ]);

            //To Store One Photo For Home Page
            $file = $request->hasFile('image');

            if ($file != '' ) {
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();

                $resize_image = Image::make($file)->resize(135, 135);
                $resize_image->save('image/members/'.$file_name);

                $save = $file_name;
            }else{
                if( $request->gender == 'ذكر'){
                    if( $request->beard == 'لا'){
                        $save = 'male2.png';
                    }else{
                        $save = 'male1.png';
                    }
                }else{
                    if( $request->hegab == 'منقبة'){
                        $save = 'female1.jpg';
                    }elseif( $request->hegab == 'غير محجبة'){
                        $save = 'female3.png';
                    }else{
                        $save = 'female2.png';
                    }
                }
            }

            $member = new Member();
            $member->image                  = $save;
            $member->code_no                = $code;
            $member->name                   = $request->name;
            $member->email                  = $request->email;
            // $member->password               = Hash::make($request['password']);
            $member->password               = $request->password;
            $member->gender                 = $request->gender;
            $member->phone                  = $request->phone;

            $member->country                = $request->country;
            $member->city                   = $request->city;
            $member->nationality            = $request->nationality;
            $member->dual_nationality       = $request->dual_nationality;

            $member->marriage_type          = $request->marriage_type;
            $member->marital_status         = $request->marital_status;
            $member->age                    = $request->age;
            $member->children_number        = $request->children_number;
            $member->children_with          = $request->children_with;

            $member->weight                 = $request->weight;
            $member->tall                   = $request->tall;
            $member->skin                   = $request->skin;
            $member->body_status            = $request->body_status;
            $member->listen_music           = $request->listen_music;


            $member->religiosity            = $request->religiosity;
            $member->pray                   = $request->pray;
            $member->smoke                  = $request->smoke;

            if($request->beard != null){
                $member->beard                  = $request->beard;
            }
            if($request->hair_color != null){
                $member->hair_color             = $request->hair_color;
            }
            $member->hegab                  = $request->hegab;

            $member->education              = $request->education;
            $member->education_type         = $request->education_type;
            $member->money_status           = $request->money_status;
            $member->work_field             = $request->work_field;
            $member->work                   = $request->work;
            $member->money_month            = $request->money_month;
            $member->health_status          = $request->health_status;

            $member->partner_description    = str_replace("&nbsp;"," ", ( strip_tags($request->partner_description) ));
            $member->your_description       = str_replace("&nbsp;"," ", ( strip_tags($request->your_description) ));

            $member->full_name              = $request->full_name;

            $member->save();


            $setting = new Setting;
            $setting->member_id     = $member->id;
            $setting->save();

            toastr()->success('لقد تم تسجيلك عضو بموقع صوفيا بنجاح .');
            return redirect()->route('login_success_page');
        // }
        // catch (\Exception $e){
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }

    }

    //------------------------------------------------------------------------
    public function show_login_success_page()
    {
        return view('includes.sofia_front.login_success');
    }

    //---------------------- Show Member Page && Show How visit My Page ----------------------------------------
    //Done
    public function show_member_details_page($id)
    {
        Carbon::setLocale('ar');
        $member = Member::where('id', $id)->first();

        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();

            $relation = Member_Relation::where(['my_id'=> $auth_id, 'member_id'=> $id ])->first();

            if($relation){
                $relation->update([
                    $relation->visit_profile = '1',
                ]);

                //START------------للحصول علي اشعارات
                $my_settings  = Setting::where('member_id', $id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                $notification = new My_Notification();
                $notification->my_id         = $id;
                $notification->member_id     = $auth_id;
                $notification->type          = 'visit_profile';
                $notification->notifications = 'لقد تم زيارة صفحتك الشخصية بواسطة ' .$myName->name ;

                if($my_settings && $my_settings->show_visit_me == 'on')
                {
                    $notification->status          = true;
                }else{
                    $notification->status          = false;
                }
                $notification->save();
                //END------------للحصول علي اشعارات

                return view('includes.sofia_front.member_details', compact('member'));

            }else{
                $relation = new Member_Relation();
                $relation->member_id        = $id;
                $relation->visit_profile    = '1' ;
                $relation->my_id            = $auth_id;
                $relation->save();

                //START------------للحصول علي اشعارات
                $my_settings  = Setting::where('member_id', $id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                $auth_id = Auth::guard('member')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                $notification = new My_Notification();
                $notification->my_id         = $id;
                $notification->member_id     = $auth_id;
                $notification->type          = 'visit_profile';
                $notification->notifications = 'لقد تم زيارة صفحتك الشخصية بواسطة ' .$myName->name ;

                if($my_settings && $my_settings->show_visit_me == 'on')
                {
                    $notification->status          = true;
                }else{
                    $notification->status          = false;
                }
                $notification->save();
                //END------------للحصول علي اشعارات

                return view('includes.sofia_front.member_details', compact('member'));
            }

        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }

    }

    //------------------------------------------------------------------------
    //Show View Of Edit Form
    //DoneP*
    public function show_edit_myprofile_page()
    {
        if( Auth::guard('member')->check() )
        {
            $member_id = Auth::guard('member')->id();
            $member = \App\Models\Member::where('id', $member_id)->first();
            return view('includes.member_info.edit_profile', compact('member'));
        }else{
            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }
    }
    //------------------------------------------------------------------------
    //update My Data In Edit
    //Done
    public function member_update_profile(Request $request)
    {
        try{
            $member = Member::whereId($request->id)->first();
            // Validate the form data
            $request->validate([
                'email'         => 'required|email|unique:members,email,'.$request->id,
                'password'      => 'nullable|min:8',
                'phone'         => 'required|unique:members,phone,'.$request->id,
            ]);
            //To Store One Photo For Home Page
            $file = $request->hasFile('image');
            if ($file != '' ) {
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $path = 'image/members/';

                $resize_image = Image::make($file)->resize(135, 135);
                $resize_image->save('image/members/'.$file_name);

                if ( $resize_image->save($file_name) ){
                    $img = $path.$file_name;

                    if($member->image == 'male1.png'){
                        $member->image = $img;
                        $member->save();
                    }elseif($member->image == 'male2.png'){
                        $member->image = $img;
                        $member->save();
                    }elseif($member->image == 'female1.png'){
                        $member->image = $img;
                        $member->save();
                    }elseif($member->image == 'female2.png'){
                        $member->image = $img;
                        $member->save();
                    }elseif($member->image == 'female3.png'){
                        $member->image = $img;
                        $member->save();
                    }else{
                        $old_file = $member->image; //get old photo
                        unlink($old_file);  //delete old photo from folder
                        $member->image = $img;
                        $member->save();
                    }
                }
            }

            if($request->country != null){
                $country = $request->country;
            }else{
                $country = $member->country;
            }

            if($request->city != null){
                $city = $request->city;
            }else{
                $city = $member->city;
            }

            if($request->nationality != null){
                $nationality = $request->nationality;
            }else{
                $nationality = $member->nationality;
            }

            if($request->dual_nationality != null){
                $dual_nationality = $request->dual_nationality;
            }else{
                $dual_nationality = $member->dual_nationality;
            }

            if($request->hair_color != null){
                $hair_color = $request->hair_color;
            }else{
                $hair_color = $member->hair_color;
            }
            if($request->beard != null){
                $beard = $request->beard;
            }else{
                $beard = $member->beard;
            }
            if($request->hegab != null){
                $hegab = $request->hegab;
            }else{
                $hegab = $member->hegab;
            }

            $member->update([
                $member->name                   = $request->name,
                $member->email                  = $request->email,
                $member->password               = Hash::make($request['password']),

                $member->country                = $country,
                $member->city                   = $city,
                $member->nationality            = $nationality,
                $member->dual_nationality       = $dual_nationality,

                $member->marriage_type          = $request->marriage_type,
                $member->marital_status         = $request->marital_status,
                $member->age                    = $request->age,
                $member->children_number        = $request->children_number,
                $member->children_with          = $request->children_with,

                $member->weight                 = $request->weight,
                $member->tall                   = $request->tall,
                $member->skin                   = $request->skin,
                $member->body_status            = $request->body_status,
                $member->hair_color             = $hair_color,
                $member->listen_music           = $request->listen_music,


                $member->religiosity            = $request->religiosity,
                $member->pray                   = $request->pray,
                $member->smoke                  = $request->smoke,
                $member->beard                  = $beard,
                $member->hegab                  = $hegab,

                $member->education              = $request->education,
                $member->education_type         = $request->education_type,
                $member->money_status           = $request->money_status,
                $member->work_field             = $request->work_field,
                $member->work                   = $request->work,
                $member->money_month            = $request->money_month,
                $member->health_status          = $request->health_status,

                $member->partner_description    = str_replace("&nbsp;"," ", ( strip_tags($request->partner_description) )),
                $member->your_description       = str_replace("&nbsp;"," ", ( strip_tags($request->your_description) )),

                $member->full_name              = $request->full_name,
                $member->phone                  = $request->phone,
            ]);

            toastr()->success('message', 'لقد تم تحديث بياناتكم بموقع صوفيا بنجاح .');
            return view('includes.member_info.my_data', compact('member'));
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //------------------------------------------------------------------------
    //------------------------------------------------------------------------
    public function show_mysettings()
    {
        if( Auth::guard('member')->check() )
        {
            $member_id = Auth::guard('member')->id();
            $member = \App\Models\Member::where('id', $member_id)->first();
            $mysettings = \App\Models\Setting::where('member_id', $member_id)->first();

            return view('includes.member_info.mysettings', compact('member_id', 'mysettings'));

        }else{

            toastr()->error(trans('يرجي تسجيل الدخول اولا'));
            return redirect()->back();
        }
    }

    public function update_mysettings(Request $request)
    {
        // dd($request);
        try{

            if( Auth::guard('member')->check() )
            {
                $member_id = Auth::guard('member')->id();
                $settings = Setting::whereMember_id($member_id)->first();


                if($request->show_who_care_me == "on")
                    {  $show_who_care_me = "on" ; }
                else
                    {  $show_who_care_me = "off" ; }

                if($request->show_visit_me == "on")
                    {  $show_visit_me = "on" ; }
                else
                    {  $show_visit_me = "off" ; }

                if($request->show_block_me == "on")
                    {  $show_block_me = "on" ; }
                else
                    {  $show_block_me = "off" ; }

                if($request->show_unblock_me == "on")
                    {  $show_unblock_me = "on" ; }
                else
                    {  $show_unblock_me = "off" ; }

                if($request->show_new_messages == "on")
                    {  $show_new_messages = "on" ; }
                else
                    {  $show_new_messages = "off" ; }

                if($request->show_success_stories == "on")
                    {  $show_success_stories = "on" ; }
                else
                    {  $show_success_stories = "off" ; }

                if($request->email_send == "on")
                    {  $email_send = "on" ; }
                else
                    {  $email_send = "off" ; }

                $settings->update([
                    $settings->who_can_text_me          = $request->who_can_text_me,
                    $settings->nationality_can_text_me  = $request->nationality_can_text_me,
                    $settings->age_can_text_me          = $request->age_can_text_me,

                    $settings->show_who_care_me         = $show_who_care_me,
                    $settings->show_visit_me            = $show_visit_me,
                    $settings->show_block_me            = $show_block_me,
                    $settings->show_unblock_me          = $show_unblock_me,
                    $settings->show_new_messages        = $show_new_messages,
                    $settings->show_success_stories     = $show_success_stories,
                    $settings->email_send               = $email_send,

                ]);


                //في حالة اختيار دول معينة لارسال الرسايل
                if($request->who_can_text_me == "some_countries" && ($request->text_me_country) != null )
                {
                    foreach( ($request->text_me_country) as $country_name)
                    {
                        $country = new Country_Member_Setting();
                        $country->member_id         = $member_id;
                        $country->country_name      = $country_name;
                        $country->type              = 'country_text_me';
                        $country->save();
                    }
                }else{
                    $country = Country_Member_Setting::where(['member_id'=>$member_id, 'type'=> 'country_text_me' ])->delete();
                }

                //في حالة اختيار جنسيات معينة لارسال الرسايل
                if($request->nationality_can_text_me == "some_nationality" && ($request->text_me_nationality) != null )
                {
                    foreach( ($request->text_me_nationality) as $nationality_name)
                    {
                        $nationality = new Country_Member_Setting();
                        $nationality->member_id         = $member_id;
                        $nationality->country_name      = $nationality_name;
                        $nationality->type              = 'nationality_text_me';
                        $nationality->save();
                    }
                }else{
                    $nationality = Country_Member_Setting::where(['member_id'=>$member_id, 'type'=> 'nationality_text_me' ])->delete();
                }




                toastr()->success('message', 'لقد تم تحديث بياناتكم بموقع صوفيا بنجاح .');
                return redirect()->back();

            }else{

                toastr()->error(trans('يرجي تسجيل الدخول اولا'));
                return redirect()->back();
            }
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
