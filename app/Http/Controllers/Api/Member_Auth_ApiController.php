<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthMemberResource;
use App\Models\Member;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use TymonJWTAuthExceptionsJWTException;
use SymfonyComponentHttpFoundationResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;
use App\Mail\ResetPasswordMail;
use App\Http\Requests\Api\ResetRequest;
use App\Models\Setting;

class Member_Auth_ApiController extends Controller
{
    use GeneralTrait;

    //------------------------------------
    //✅
    public function member_login(Request $request)
    {
        try {
            $rules = [
                "email"     => "required|email|exists:members",
                "password"  => "required"
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login
            $credentials = $request -> only(['email','password']) ;

            // $token =  Auth::guard('member_api')->attempt($credentials, ['exp' => \Carbon\Carbon::now()->addDays(7)->timestamp]);
            $token =  Auth::guard('member_api')->attempt($credentials);

            if(!$token)
                return $this->returnError('E001','The Input Data Are not Correct, Please Check The Data And Try Again');

            $member = Auth::guard('member_api')->user();
            // $member -> member_token = $token;

            $data = [
                'token' => $token,
                'member' => $member,
                "profile_link" => "zaytona.online/show_member_details_page/".$member->id,
            ];

            //return token
            return $this -> returnData('member' , $data);
            // return $this -> returnData('data', new AuthMemberResource($member), 'Member Login In Successfully.' );

        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    //------------------------------------
    //✅
    public function member_register(Request $request)
    {
        try{
            do
            {
                $code = mt_rand(1111111111,9999999999);
                $member_code = Member::where('code_no', $code)->get();
            }
            while(!$member_code->isEmpty());

            $rules = [
                "name" => "required",
                "email" => "required|string|email|unique:members,email",
                "phone" => "required|unique:members,phone",
                "password" => "required|confirmed|min:8",
                "image" => "required|file|mimes:png,jpg,svg,gif",
                "gender" => "required",
                "country" => "required|exists:countries,id",
                "city" => "required|exists:states,id",
                "nationality" => "required",
                "marriage_type" => "required",
                "marital_status" => "required",
                "age" => "required",
                "children_number" => "required",
                "children_with" => "required",
                "listen_music" => "required",
                "weight" => "required",
                "tall" => "required",
                "skin" => "required",
                "body_status" => "required",
                "religiosity" => "required",
                "pray" => "required",
                "smoke" => "required",
                "beard" => "nullable",
                "hair_color" => "nullable",
                "hegab" => "nullable",
                "education" => "required",
                "education_type" => "required",
                "money_status" => "required",
                "work_field" => "required",
                "work" => "required",
                "money_month" => "required",
                "health_status" => "required",
                "partner_description" => "required",
                "your_description" => "required",
                "full_name" => "required",

            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $member = Member::create($request->all());
            Member::where('id', $member->id)->update(['code_no'=> $code]);

            $image_name = date('mdYHis') . uniqid() . $request->file('image')->getClientOriginalName();
            $path =('image/members/');
            $request->file('image')->move($path,$image_name);
            Member::where('id', $member->id)->update([
                'image' => $path.$image_name ,
            ]);

            // return $this->returnSuccessMessage('New Member Successfully Registration, Please Go And Sign In');
            return $this -> returnData('data', new AuthMemberResource($member), 'New Member Successfully Registration, Please Go And Sign In' );

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }

    }


        //✅
        public function register_name_1(Request $request)
        {
            try{
                do
                {
                    $code = mt_rand(1111111111,9999999999);
                    $member_code = Member::where('code_no', $code)->get();
                }
                while(!$member_code->isEmpty());

                $rules = [
                    "name" => "required",
                    "full_name" => "required",
                    "email" => "required|string|email|unique:members,email",
                    "phone" => "required|unique:members,phone",
                    "password" => "required|confirmed|min:8",
                    // "image" => "required|file|mimes:png,jpg,svg,gif",
                    "gender" => "required",
                ];
                
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }

                $member = Member::create($request->all());
                $token = JWTAuth::fromUser($member);
                Member::where('id', $member->id)->update(['code_no'=> $code]);

                $setting = new Setting();
                $setting->member_id     = $member->id;
                $setting->save();

                return $this -> returnData('token', $token, 'New Member Successfully Registration, Please Go To The Second Step To Complete Your Registeration' );

            }catch (\Exception $e){
                $this -> returnError('400','Some Thing Went Wrongs');
            }
        }

        //✅
        public function register_select_2(Request $request)
        {
            try{
                $rules = [
                    "country" => "required|exists:countries,name",
                    "city" => "required|exists:states,name",
                    "nationality" => "required",
                    "marriage_type" => "required",
                    "marital_status" => "required",
                    "age" => "required",
                    "children_number" => "required",
                    "children_with" => "required",
                    "listen_music" => "required",
                    "weight" => "required",
                    "tall" => "required",
                    "skin" => "required",
                    "body_status" => "required",
                    "religiosity" => "required",
                    "pray" => "required",
                    "smoke" => "required",
                    "beard" => "nullable",
                    "hair_color" => "nullable",
                    "hegab" => "nullable",
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }

                $member = Member::whereId(Auth::guard('member_api')->id())->first();
                $member->update($request->all());

                return $this -> returnData('data', new AuthMemberResource($member), 'Second Part Completed Successfully, Please Go To The Second Step To Complete Your Registeration' );

            }catch (\Exception $e){
                $this -> returnError('400','Some Thing Went Wrongs');
            }
        }

        //✅
        public function register_text_3(Request $request)
        {
            try{
                $rules = [
                    "education" => "required",
                    "education_type" => "required",
                    "money_status" => "required",
                    "work_field" => "required",
                    "work" => "required",
                    "money_month" => "required",
                    "health_status" => "required",
                    "partner_description" => "required",
                    "your_description" => "required",
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }

                $member = Member::whereId(Auth::guard('member_api')->id())->first();
                $member->update($request->all());

                //Member Image
                if( $member->gender == 'ذكر'){
                    if( $member->beard == 'لا'){
                        $image = 'male2.png';
                    }else{
                        $image = 'male1.png';
                    }
                }else{
                    if( $member->hegab == 'منقبة'){
                        $image = 'female1.jpg';
                    }elseif( $member->hegab == 'غير محجبة'){
                        $image = 'female3.png';
                    }else{
                        $image = 'female2.png';
                    }
                }

                $member->update([
                    $member->image          = $image,
                ]);

                return $this -> returnData('data', new AuthMemberResource($member), 'Third Part Completed Successfully, Please Go To Upload Image To Complete Your Registeration' );

            }catch (\Exception $e){
                $this -> returnError('400','Some Thing Went Wrongs');
            }
        }

        //✅
        public function update_image(Request $request)
        {
            try{
                $rules = [
                    "image" => "required|file|mimes:png,jpg,svg,gif",
                ];
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }

                $member = Member::whereId(Auth::guard('member_api')->id())->first();

                //To Store One Photo For Home Page
                if ($request->hasFile('image')) {
                    $image_name = ('image/members/') . date('mdYHis') . uniqid() . $request->file('image')->getClientOriginalName();
                    $path =('image/members/');


                    if($member->image == 'male1.png'){
                        $request->file('image')->move($path,$image_name);
                        $member->update([
                            'image' => $image_name,
                        ]);
                    }elseif($member->image == 'male2.png'){
                        $request->file('image')->move($path,$image_name);
                        $member->update([
                            'image' => $image_name,
                        ]);
                    }elseif($member->image == 'female1.png'){
                        $request->file('image')->move($path,$image_name);
                        $member->update([
                            'image' => $image_name,
                        ]);
                    }elseif($member->image == 'female2.png'){
                        $request->file('image')->move($path,$image_name);
                        $member->update([
                            'image' => $image_name,
                        ]);
                    }elseif($member->image == 'female3.png'){
                        $request->file('image')->move($path,$image_name);
                        $member->update([
                            'image' => $image_name,
                        ]);
                    }else{
                        $old_file = $member->image; //get old photo
                        unlink($old_file);  //delete old photo from folder
                        $request->file('image')->move($path,$image_name);
                        $member->update([
                            'image' => $image_name,
                        ]);
                    }


                }

                return $this -> returnData('data', new AuthMemberResource($member), 'Profile Image Updated Successfully' );

            }catch (\Exception $e){
                $this -> returnError('400','Some Thing Went Wrongs');
            }
        }


    //------------------------------------
    //✅
    public function member_logout(Request $request)
    {
        // $token = $request -> header('authToken');
        $member = Member::whereId(Auth::guard('member_api')->id())->first();
        $token = JWTAuth::fromUser($member);

        if($token){
            try {
                JWTAuth::setToken($token)->invalidate(); //logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError('','Some Thing Went Wrongs');
            }
            return $this->returnSuccessMessage('Member Logged Out Successfully');
        }else{
            $this -> returnError('','Some Thing Went Wrongs');
        }
    }

    //------------------------------------
    //✅
    public function newPassword(Request $request)
    {
        $rules = [
            "password" => "required|confirmed|min:8",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }
        $member = Member::whereId(Auth::guard('member_api')->id())->first();
        $member->update(["password" => $request->password]);
        return $this -> returnSuccessMessage('Password Updated Successfully.');
    }

    //------------------------------------
    //✅
    public function updateProfileData(Request $request)
    {
        try{
            $loginId = Auth::guard('member_api')->id();
            

            $rules = [
                "email" =>'nullable|email|unique:members,email,'.$loginId,
                "phone" => "nullable|unique:members,phone,".$loginId,
                "password" => "nullable|confirmed|min:8",
                "image" => "nullable|mimes:png,jpg,svg,gif",
                "country" => "nullable|exists:countries,name",
                "city" => "nullable|exists:states,name",
                "partner_description" => "nullable|min:10",
                "your_description" => "nullable|min:10",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $member = Member::whereId(Auth::guard('member_api')->id())->first();

            //To Store One Photo For Home Page
            if ($request->hasFile('image')) {
                $image_name = ('image/members/') . date('mdYHis') . uniqid() . $request->file('image')->getClientOriginalName();
                $path =('image/members/');

                if($member->image == 'male1.png'){
                    $request->file('image')->move($path,$image_name);
                    $member->update([
                        'image' => $image_name,
                    ]);
                }elseif($member->image == 'male2.png'){
                    $request->file('image')->move($path,$image_name);
                    $member->update([
                        'image' => $image_name,
                    ]);
                }elseif($member->image == 'female1.png'){
                    $request->file('image')->move($path,$image_name);
                    $member->update([
                        'image' => $image_name,
                    ]);
                }elseif($member->image == 'female2.png'){
                    $request->file('image')->move($path,$image_name);
                    $member->update([
                        'image' => $image_name,
                    ]);
                }elseif($member->image == 'female3.png'){
                    $request->file('image')->move($path,$image_name);
                    $member->update([
                        'image' => $image_name,
                    ]);
                }else{
                    $old_file = $member->image; //get old photo
                    // unlink($old_file);  //delete old photo from folder
                    $request->file('image')->move($path,$image_name);
                    $member->update([
                        'image' => $image_name,
                    ]);
                }
            }

            $member->update($request->all());
            $member->update([
                        'image' => $image_name,
                    ]);

            return $this -> returnData('data', new AuthMemberResource($member), 'Member Updated Successfully.' );
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    
    /////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////
    public  function forgotPassword(Request $request){
        $rules = [
            "email" => "required|exists:members,email",

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnValidationErrorNew($validator);
        }
        $code = rand(1000,9999);
        $created_at = Carbon::now();
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],

            [
                'token' => $code,
                'created_at' => $created_at
            ]);

        $reset_code =  DB::table('password_resets')->where("token", $code)->first();
        Mail::to($reset_code->email)->send(new ResetPasswordMail($reset_code));
        if (Mail::failures()) {
            return $this->returnError('E001','Sorry! Please try again latter');
        }else{
            return $this->returnSuccessMessage('Great! Successfully send in your mail');
        }

    }

    public function resetPassword(ResetRequest $request){
        $Token = DB::table('password_resets')->where("token", $request->token)
            ->where("token", "!=", null)->first();

        if(empty($Token->email)){
            return $this->returnError('E001','Sorry! Invalid Code');
        }

        $user= Member::where("email",$Token->email)->first();
        if ($user) :
            $user->password = bcrypt($request->password);
            if ($user->save()) :
                return $this->returnSuccessMessage("Password Changed Successfully");

            else :
                return $this->returnError('E001','Sorry! Please try again ');
            endif;
            else:
                return $this->returnError('E001','Sorry! Invalid Code');
        endif;
    }


}
