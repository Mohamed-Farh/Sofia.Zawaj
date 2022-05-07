<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthMemberResource;
use App\Http\Resources\CountryCanTextMeResource;
use App\Http\Resources\GetMembersResource;
use App\Http\Resources\InboxResource;
use App\Models\Member;
use App\Models\Member_Inbox;
use App\Models\Member_Relation;
use App\Models\My_Notification;
use App\Models\Setting;
use App\Models\Common_Question;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Resources\MemberResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\GetHealthyMembersResource;
use App\Models\Contact;
use App\Models\Country_Member_Setting;

class Member_ApiController extends Controller
{
    use GeneralTrait;

    //-------Return Id Of Auth User (We Must Write auth-token in body and header)---------------------------------------------
    public function get_auth_id(Request $request)
    {
        return response()->json(Auth::guard('member_api')->id());
    }


    //-------------------------------
    //✅Get Members (All || Male || Female)
    public function get_all_members(Request $request)
    {
        try{
            $rules = [
                "gender" => "nullable","in:'أنثي,ذكر'",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            
            
            $all_members = Member::all();
            
            $member = Auth::user();
            if($request->gender){
                $all_members = Member::whereGender($request->gender)->get();
            }elseif($member->gender == 'أنثي'){
                $all_members = Member::whereGender('ذكر')->get();
            }elseif($member->gender == 'ذكر'){
                $all_members = Member::whereGender('أنثي')->get();
            }

            if(!$all_members){
                return $this->returnError('E3001', 'Sorry, There Are No Members');
            }
            return $this -> returnData('data', GetMembersResource::collection($all_members), 'These Are All The Members In The Website' );
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //-------------------------------
    //✅Get Members (All || Male || Female)
    public function getOnCountryMembers(Request $request)
    {
        try{
            $rules = [
                "country_name" => "required|exists:countries,name",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $all_members = Member::whereCountry($request->country_name)->get();
            $member = Auth::user();
            if($request->gender){
                $all_members = Member::whereGender($request->gender)->get();
            }elseif($member->gender == 'أنثي'){
                $all_members = Member::whereGender('ذكر')->get();
            }elseif($member->gender == 'ذكر'){
                $all_members = Member::whereGender('أنثي')->get();
            }

            if(!$all_members){
                return $this->returnError('E3001', 'Sorry, There Are No Members!');
            }
            return $this -> returnData('data', GetMembersResource::collection($all_members), 'These Are All The Members In Specific Country' );
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //-----------------------------------------------
    //✅✅
    public function get_member_byId(Request $request)
    {
        try{
            $rules = [
                "id" => "required|exists:members,id",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $member     = Member::whereId($request->id)->first();
            if (!$member){
                return $this->returnError('E3001', 'Sorry, This Member Doesn\'t Exist.');
            }

            $auth_id    = Auth::guard('member_api')->id();
            $relation   = Member_Relation::where('my_id', $auth_id)->where('member_id', $request->id)->first();

            if($relation){
                $relation->update([
                    $relation->visit_profile = '1',
                ]);

                //START------------للحصول علي اشعارات
                $my_settings  = Setting::where('member_id', $request->id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                $auth_id = Auth::guard('member_api')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                $notification = new My_Notification();
                $notification->my_id         = $request->id;
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

                return $this -> returnData('data', new MemberResource($member), 'This\'s The Member You\'re Looking For.' );

            }else{
                $relation = new Member_Relation();
                $relation->member_id        = $request->id;
                $relation->visit_profile    = '1' ;
                $relation->my_id            = $auth_id;
                $relation->save();

                //START------------للحصول علي اشعارات
                $my_settings  = Setting::where('member_id', $request->id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                $auth_id = Auth::guard('member_api')->id();  //  علشان اجيب الشخص اللي عامل لوجن
                $myName  = Member::where('id', $auth_id)->first(); //علشان اجيب الشخص اللي عامل لوجن
                $notification = new My_Notification();
                $notification->my_id         = $request->id;
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

                return $this -> returnData('data', new MemberResource($member), 'This\'s The Member You\'re Looking For.' );
            }
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }

    }


    //----------------------------------------------------
    public function change_member_status(Request $request)
    {
        try{
            Member::whereId($request->id)->update(['status' =>$request ->status]);
            $member = Member::whereId($request->id)->first();

            return $this->returnData('Member', $member, 'The Member\'s Status Has Been Successfully Changed.');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }
    //----------------------------------------------------
    //✅
    public function get_online_members(Request $request)
    {
        try{
            $rules = [
                "gender" => "nullable","in:'أنثي,ذكر'",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $auth_id = Auth::guard('member_api')->id();
            $members = Member::select("*")
                            ->whereNotNull('last_seen')
                            ->where('id', '!=', $auth_id)
                            ->orderBy('last_seen', 'DESC')
                            ->get();

            $member = Auth::user();
            if ($request->gender){
                $members = Member::where('gender', $request->gender)
                                ->whereNotNull('last_seen')
                                ->where('id', '!=', $auth_id)
                                ->orderBy('last_seen', 'DESC')
                                ->get();
            }elseif($member->gender == 'أنثي'){
                $members = Member::where('gender', 'ذكر')
                                ->whereNotNull('last_seen')
                                ->where('id', '!=', $auth_id)
                                ->orderBy('last_seen', 'DESC')
                                ->get();
            }elseif($member->gender == 'ذكر'){
                $members = Member::where('gender', 'أنثي')
                                ->whereNotNull('last_seen')
                                ->where('id', '!=', $auth_id)
                                ->orderBy('last_seen', 'DESC')
                                ->get();
            }

            if (!$members){
                return $this->returnError('E3001', 'Sorry, There Are No Online Members!');
            }
            return $this -> returnData('data', GetMembersResource::collection($members), 'All Online Members.');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }
    
    public function getHealthMembers(Request $request)
    {
        try{
            $rules = [
                "gender" => "nullable","in:'أنثي,ذكر'",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            
            $auth_id = Auth::guard('member_api')->id();
            $members = Member::where('id', '!=', $auth_id)->where('health_status', '!=', 'حالتي جيدة الحمدلله')->orderBy('id', 'desc')->get();
    
            if (!$members){
                return $this->returnError('E3001', 'Sorry, There Are No Members!');
            }
            return $this -> returnData('data', GetHealthyMembersResource::collection($members), 'All Healthy Members.');
            
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //----------------------------------------------------
    //✅
    public function get_new_members(Request $request)
    {
        try{
            $rules = [
                "gender" => "nullable","in:'أنثي,ذكر'",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            if( Auth::guard('member_api')->check() )
            {
                $member = Auth::user();
                
                $auth_id = Auth::guard('member_api')->id();
                $members = Member::where('id', '!=', $auth_id)->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->get();

                if ($request->gender){
                    $members = Member::where('gender', $request->gender)->where('id', '!=', $auth_id)->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->get();
                }elseif($member->gender == 'أنثي'){
                    $members = Member::where('gender', 'ذكر')->where('id', '!=', $auth_id)->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->get();
                }elseif($member->gender == 'ذكر'){
                    $members = Member::where('gender', 'أنثي')->where('id', '!=', $auth_id)->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->get();
                }

            }else{
                $members = Member::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->get();

                if ($request->gender){
                    $members = Member::where('gender', $request->gender)->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->get();
                }
            }

            return $this -> returnData('data', GetMembersResource::collection($members), 'All New Members.');
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }


    //----------------------------------------------------
    //✅
    public function get_member_care_me(Request $request)
    {
        try{
            $auth_id = Auth::guard('member_api')->id();
            $member = Member::where('id', $auth_id)->first();
            $members = Member_Relation::where(['member_id'=> $auth_id, 'care_list'=> '1'])->orderBy('id', 'desc')->pluck('my_id')->toArray();
            $all_members = Member::whereIn('id', $members)->get();

            return $this -> returnData('data', MemberResource::collection($all_members), 'Members Who Care About ( '.$member->name. ' ).');
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }
    
    public function myFavouriteList(Request $request)
    {
        try{
            $auth_id = Auth::guard('member_api')->id();
            $member = Member::where('id', $auth_id)->first();
            $members = Member_Relation::where('my_id', $auth_id)->where('care_list', '1')->orderBy('id', 'desc')->pluck('member_id')->toArray();
            $all_members = Member::whereIn('id', $members)->get();

            return $this -> returnData('data', MemberResource::collection($all_members), 'قائمة الأهتمامات');
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }
    
    public function myBlockList(Request $request)
    {
        try{
            $auth_id = Auth::guard('member_api')->id();
            $member = Member::where('id', $auth_id)->first();
            $members = Member_Relation::where('my_id', $auth_id)->where('ignore_list', '1')->orderBy('id', 'desc')->pluck('member_id')->toArray();
            $all_members = Member::whereIn('id', $members)->get();

            return $this -> returnData('data', MemberResource::collection($all_members), 'قائمة الحظر');
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }
    //----------------------------------------------------
    //✅
    public function get_member_block_me(Request $request)
    {
        try{
            $auth_id = Auth::guard('member_api')->id();
            $member = Member::where('id', $auth_id)->first();
            $members = Member_Relation::where(['my_id'=> $auth_id, 'ignore_list'=> '1'])->orderBy('id', 'desc')->pluck('my_id')->toArray();
            $all_members = Member::whereIn('id', $members)->get();

            return $this -> returnData('data', MemberResource::collection($all_members), 'Members Who Blocks ( '.$member->name. ' ).');
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }
    //----------------------------------------------------
    //✅
    public function get_member_visit_myprofile(Request $request)
    {
        try{
            $auth_id = Auth::guard('member_api')->id();
            $member = Member::where('id', $auth_id)->first();
            $members = Member_Relation::where(['member_id'=> $auth_id, 'visit_profile'=> '1'])->orderBy('id', 'desc')->pluck('my_id')->toArray();
            $all_members = Member::whereIn('id', $members)->get();

            return $this -> returnData('data', MemberResource::collection($all_members), 'Members Who Visit ( '.$member->name. ' ) Profile.');
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //------------------------------------------------------------------------
    //✅
    public function show_my_inbox_message()
    {
        try{
            $auth_id = Auth::guard('member_api')->id();
            $messages = Member_Inbox::where('member_id', $auth_id )->where('show', '0')->orderBy('id', 'desc')->get();

            return $this->returnData('data',$messages, 'My Inbox Messages.');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //----------------------------------------------------
    //✅
    public function give_like(Request $request)
    {
        try{
            $auth_id = Auth::guard('member_api')->id();
            $member = Member::where('id', $auth_id)->first();

            $relation = Member_Relation::where(['my_id'=> $auth_id, 'member_id'=> $request->member_id ])->first();

            if($relation)
            {
                if($relation->care_list == '0'){
                    $relation->update([
                        $relation->care_list = '1',
                    ]);

                    //START------------للحصول علي اشعارات
                    $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                    $auth_id = Auth::guard('member_api')->id();  //  علشان اجيب الشخص اللي عامل لوجن
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

                    return $this->returnSuccessMessage('Successfully Like Profile');

                }elseif($relation->care_list == '1'){

                    $relation->update([
                        $relation->care_list = '0',
                    ]);

                    //START------------للحصول علي اشعارات
                    $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                    $auth_id = Auth::guard('member_api')->id();  //  علشان اجيب الشخص اللي عامل لوجن
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

                    return $this->returnSuccessMessage('Successfully Dis_Like Profile');
                }

            }else{
                $relation = new Member_Relation();
                $relation->member_id        = $request->member_id;
                $relation->care_list        = '1' ;
                $relation->my_id            = Auth::guard('member_api')->id();
                $relation->save();

                //START------------للحصول علي اشعارات
                $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                $auth_id = Auth::guard('member_api')->id();  //  علشان اجيب الشخص اللي عامل لوجن
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

                return $this->returnSuccessMessage('Successfully Like Profile');
            }
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //----------------------------------------------------
    //✅
    public function give_block(Request $request)
    {
        try{
            $auth_id = Auth::guard('member_api')->id();
            $member = Member::where('id', $auth_id)->first();

            $relation = Member_Relation::where(['my_id'=> $auth_id, 'member_id'=> $request->member_id ])->first();

            if($relation)
            {
                if($relation->ignore_list == '0')
                {
                    $relation->update([
                        $relation->ignore_list = '1',
                    ]);

                    //START------------للحصول علي اشعارات
                    $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                    $auth_id = Auth::guard('member_api')->id();  //  علشان اجيب الشخص اللي عامل لوجن
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

                    return $this->returnSuccessMessage('Successfully Block Profile');

                }elseif($relation->ignore_list == '1'){
                    $relation->update([
                        $relation->ignore_list = '0',
                    ]);

                    //START------------للحصول علي اشعارات
                    $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                    $auth_id = Auth::guard('member_api')->id();  //  علشان اجيب الشخص اللي عامل لوجن
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

                    return $this->returnSuccessMessage('Successfully Unblock Profile');
                }

            }else{
                $relation = new Member_Relation();
                $relation->member_id         = $request->member_id;
                $relation->ignore_list       = '1' ;
                $relation->my_id             = $auth_id;
                $relation->save();

                //START------------للحصول علي اشعارات
                $my_settings  = Setting::where('member_id', $request->member_id)->first(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات
                $auth_id = Auth::guard('member_api')->id();  //  علشان اجيب الشخص اللي عامل لوجن
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

                return $this->returnSuccessMessage('Successfully Block Profile');
            }
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }

    }















    //---------------------------------------------------------------------------------------------------------------------------
    //------------------------------------------   New 2022  --------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------

    public function my_inbox_messages(Request $request)
    {
        $auth_id = Auth::guard('member_api')->id();

        $messages = Member_Inbox::where('member_id', $auth_id)->get();

        return $this->returnData('data', InboxResource::collection($messages) , 'My Inbox Messages');
    }

    public function delete_inbox_messages(Request $request)
    {
        $rules = [
            "message_id" => "required",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        $auth_id = Auth::guard('member_api')->id();

        foreach ($request->message_id as $id ){
            $message = Member_Inbox::where('member_id', $auth_id)
                                    ->where('id', $id)
                                    ->first();
            $message->delete();
        }

        return $this->returnSuccessMessage('Your Inbox Message Deleted Succefully');
    }

    public function authMember(Request $request)
    {
        $m = Member::whereId(Auth::guard('member_api')->id())->first();
        return $this->returnData('data', new AuthMemberResource($m) , 'Auth Member Details');
    }

    public function member_name_search(Request $request)
    {
        $rules = [
            "name" => "required",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $members = Member::when($request->name, function ($query, $name) {
            return $query->where('name', 'like', "%{$name}%");
        })->orderBy('id', 'desc')->get();

        return $this->returnData('data', GetMembersResource::collection($members) , 'Member Search Result');
    }
    
    public function commonQuestionSearch(Request $request)
    {
        $rules = [
            "keyword" => "required",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        
        $common_questions = Common_Question::when($request->keyword, function ($query, $keyword) {
            return $query->where('question', 'like', "%{$keyword}%");
        })->select(['id','type','question','answer'])->get();
        
        if ($common_questions->count() <= 0){
            return $this->returnError('E3001', 'Sorry, There Are No Common Question!');
        }
        return $this->returnData('data', $common_questions , 'Common Question Search Result');
    }

    //Done
    public function member_full_search(Request $request)
    {

        $auth_id = Auth::guard('member_api')->id();

        $members = Member::when($request->first_nationality, function ($query, $first_nationality) {
            return $query->where('nationality', 'like', "%{$first_nationality}%");

            })->when($request->dual_nationality, function ($query, $dual_nationality) {
                return $query->where('dual_nationality', 'like', "%{$dual_nationality}%");

            })->when($request->country, function ($query, $country) {
                return $query->where('country', 'like', "%{$country}%");

            })->when($request->city, function ($query, $city) {
                return $query->where('city', 'like', "%{$city}%");


            })->when($request->gender, function ($query, $gender) {
                $query =  $query->where('gender','=' ,$gender);
                return $query ;

            })->when( ($request->min_age && $request->max_age), function ($query) use ($request) {
                    $query = $query->where('age','>=',$request->min_age);
                    $query = $query->where('age','<=',$request->max_age);
                return $query ;

            })->when( ($request->min_tall && $request->max_tall), function ($query) use ($request) {
                    $query = $query->where('tall','>=',$request->min_tall);
                    $query = $query->where('tall','<=',$request->max_tall);
                return $query ;

            })->when( ($request->min_weight && $request->max_weight), function ($query) use ($request) {
                    $query = $query->where('weight','>=',$request->min_weight);
                    $query = $query->where('weight','<=',$request->max_weight);
                return $query ;


            })->when($request->skin, function ($query, $skin) {
                return $query->where('skin', 'like', "%{$skin}%");

            })->when($request->marital_status, function ($query, $marital_status) {
                return $query->where('marital_status', 'like', "%{$marital_status}%");

            })->when($request->marriage_type, function ($query, $marriage_type) {
                return $query->where('marriage_type', 'like', "%{$marriage_type}%");


            })->when($request->education, function ($query, $education) {
                return $query->where('education', 'like', "%{$education}%");

            })->when($request->money_month, function ($query, $money_month) {
                return $query->where('money_month', 'like', "%{$money_month}%");

        })->where('id', '!=', $auth_id)->orderBy('id', 'desc')->get();

        return $this->returnData('data', GetMembersResource::collection($members) , 'Member Search Result');

    }


    //Done
    public function healthMemberSearch(Request $request)
    {
        try{
            $rules = [
                "gender" => "nullable","in:'أنثي,ذكر'",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            
            $auth_id = Auth::guard('member_api')->id();
            if($request->gender != ''){
                $members = Member::where('health_status', '!=', 'حالتي جيدة الحمدلله')->when($request->health_status, function ($query, $health_status) {
                    return $query->where('health_status', 'like', "%{$health_status}%");
                })->where('id', '!=', $auth_id)->where('gender', $request->gender)->orderBy('id', 'desc')->get();
            }else{
                $members = Member::where('health_status', '!=', 'حالتي جيدة الحمدلله')->when($request->health_status, function ($query, $health_status) {
                    return $query->where('health_status', 'like', "%{$health_status}%");
                })->where('id', '!=', $auth_id)->orderBy('id', 'desc')->get();
            }
            
            if ($members->count() <= 0){
                return $this->returnError('E3001', 'Sorry, There Are No Members!');
            }
            return $this->returnData('data', GetHealthyMembersResource::collection($members) , 'Members');
            
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }



    ///////////////////////////////////////////
    public function messageSofiaSupport(Request $request)
    {
         try {
             $rules = [
                "subject" => "required|min:10",
                "message" => "required|min:10",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $id = Auth::guard('member_api')->id();
            $member = Member::whereId($id)->first();

            $contact = new Contact();
            $contact->name          = $member->name;
            $contact->phone         = $member->phone;
            $contact->email         = $member->email;
            $contact->country       = $member->country;
            $contact->subject       = $request->subject;
            $contact->message       = $request->message;
            $contact->save();

            return $this->returnSuccessMessage('Message Sent Successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //----------------------------------------------------
    public function get_my_notifications(Request $request)
    {
        try {
            $auth_id = Auth::guard('member_api')->id();

            $my_notifications = My_Notification::where('my_id', $auth_id)->where('status', true)->orderBy('id', 'DESC')->get();
            $my_notifications_counts = count($my_notifications);

            $data = [
                "count" => isset($my_notifications_counts) ? $my_notifications_counts : '',
                "notifications" => NotificationResource::collection($my_notifications)
            ];

            return $this->returnData('data', $data , 'All Notifications');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    public function get_notification_status(Request $request)
    {
        try{

            $auth_id = Auth::guard('member_api')->id();
            $my_settings = Setting::where('member_id', $auth_id)
                                    ->where("show_who_care_me", "on")
                                    ->where("show_visit_me", "on")
                                    ->where("show_block_me", "on")
                                    ->where("show_unblock_me", "on")
                                    ->where("show_new_messages", "on")
                                    ->where("show_success_stories", "on")
                                    ->where("email_send", "on")
                                    ->first();
            if($my_settings){
                $data = [
                    'status' => 'ON',
                ];
            }else{
                $data = [
                    'status' => 'OFF',
                ];
            }

            // return $this->returnSuccessMessage('Your Notification Status : ' . $on_off);
            return $this->returnData('data',  $data, 'Your Notification Status');
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }

    }

    public function change_notification_status(Request $request)
    {
        try{
            $rules = [
                "status" => "required|in:0,1",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $auth_id = Auth::guard('member_api')->id();
            $my_settings  = My_Notification::where('my_id', $auth_id)->get(); //علشان اجيب اعدادات الشخص اللي هتظهر ليه الاشعارات

            foreach ($my_settings as $setting){
                if($request->status == 1)
                {
                    $setting->status = true;
                    $on_off = 'ON';

                    $settings = Setting::whereMember_id($auth_id)->first();
                    $settings->update([
                        $settings->show_who_care_me         = "on",
                        $settings->show_visit_me            = "on",
                        $settings->show_block_me            = "on",
                        $settings->show_unblock_me          = "on",
                        $settings->show_new_messages        = "on",
                        $settings->show_success_stories     = "on",
                        $settings->email_send               = "on",
                    ]);

                }elseif($request->status == 0 ){
                    $setting->status  = false;
                    $on_off = 'OFF';

                    $settings = Setting::whereMember_id($auth_id)->first();
                    $settings->update([
                        $settings->show_who_care_me         = "off",
                        $settings->show_visit_me            = "off",
                        $settings->show_block_me            = "off",
                        $settings->show_unblock_me          = "off",
                        $settings->show_new_messages        = "off",
                        $settings->show_success_stories     = "off",
                        $settings->email_send               = "off",
                    ]);
                }
                $setting->save();
            }
            if($request->status == 1){
                $on_off = 'ON';
            }else{
                $on_off = 'OFF';
            }

            return $this->returnSuccessMessage('You Have Succefully Change Your Notification Status : ' . $on_off);
        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }

    }
    //---------------------------------------------------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------------------------------------

    public function addCountryCanTextMeSettings(Request $request)
    {
        try{
            $rules = [
                "who_can_text_me" => "required|in:all,some_countries",
                "text_me_country" => "nullable"
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $member_id = Auth::guard('member_api')->id();
            $settings = Setting::whereMember_id($member_id)->first();

            $settings->update([
                $settings->who_can_text_me          = $request->who_can_text_me,
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

            return $this->returnSuccessMessage('Succefully Done');

        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function getCountryCanTextMeSettings(Request $request)
    {
        try{
            $member_id = Auth::guard('member_api')->id();
            $countries = Country_Member_Setting::where(['member_id'=>$member_id, 'type'=> 'country_text_me', 'status'=> '0' ])->get();
            return $this->returnData('data', CountryCanTextMeResource::collection($countries) , 'Countries Can Text Me');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteCountryCanTextMeSettings(Request $request)
    {
        try{
            $rules = [
                "country_id" => "required|exists:country_member_settings,id",
                "text_me_country" => "nullable"
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $member_id = Auth::guard('member_api')->id();
            $countries = Country_Member_Setting::where(['id'=> $request->country_id, 'member_id'=>$member_id, 'type'=> 'country_text_me', 'status'=> '0' ])->delete();
            return $this->returnSuccessMessage('Succefully Done');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }










}
