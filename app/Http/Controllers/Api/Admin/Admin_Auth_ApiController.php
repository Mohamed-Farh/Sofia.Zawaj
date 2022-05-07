<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Admin_Auth_ApiController extends Controller
{
    use GeneralTrait;


    public function index()
    {
        if (Auth::user()) {
            $admins = User::where('admin', '1')->where('id', '!=', auth()->id())->get();
            return response()->json($admins);
        }else{
            $admins = User::get();
            return response()->json($admins);
        }
    }
    //------------------------------------
    public function admin_login(Request $request)
    {
        try {
            $rules = [
                "email"     => "required|email|exists:users",
                "password"  => "required"
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login
            $credentials = $request -> only(['email','password']) ;

            $token =  Auth::guard('api')->attempt($credentials);

            if(!$token)
                return $this->returnError('E001','The Input Data Are not Correct, Please Check The Data And Try Again');

            $user = Auth::guard('api')->user();
            $user -> user_token = $token;
            //return token
            return $this -> returnData('user' , $user);

        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    //------------------------------------
    public function admin_logout(Request $request)
    {
        $token = $request -> header('auth-token');

        if($token){
            try {
                JWTAuth::setToken($token)->invalidate(); //logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError('','Some Thing Went Wrongs');
            }
            return $this->returnSuccessMessage('Admin Logged Out Successfully');
        }else{
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }
    //------------------------------------
    public function admin_register(Request $request)
    {
        try{
            $rules = [
                "name"      => "required",
                "email"     => "required|string|email|unique:users",
                "password"  => "required|string|confirmed|min:6"
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $new_admin = User::insertGetId([
                "name"      => $request->name,
                "email"     => $request->email,
                "password"  => Hash::make($request->password),
                "admin"     => $request->admin,
                "created_at"=>now(),
                "updated_at"=>now(),
            ]);

            // $new_admin->syncRoles($request->roles);

            $image_name = date('mdYHis') . uniqid() . $request->file('image')->getClientOriginalName();
            $path =('image/users/');
            $request->file('image')->move($path,$image_name);
            User::where('id', $new_admin)->update([
                'image' => $image_name ,
            ]);

            return $this->returnSuccessMessage('New Admin Successfully Registration');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }

    }

    //------------------------------------
    public function user_register(Request $request)
    {
        try{
            $rules = [
                "name"      => "required",
                "email"     => "required|string|email|unique:users",
                "password"  => "required|string|confirmed|min:6"
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $new_user = User::insertGetId([
                "name"      => $request->name,
                "email"     => $request->email,
                "password"  => Hash::make($request->password),
                "created_at"=>now(),
                "updated_at"=>now(),
            ]);

            $image_name = date('mdYHis') . uniqid() . $request->file('image')->getClientOriginalName();
            $path =('image/users/');
            $request->file('image')->move($path,$image_name);
            User::where('id', $new_user)->update([
                'image' => $image_name ,
            ]);

            return $this->returnSuccessMessage('New User Successfully Registration');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }

    }
}
