<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrivacyRuleResource;
use App\Models\Aboutus;
use App\Models\App\AppHomepages;
use App\Models\App\WebsiteBanner;
use App\Models\App_Feature;
use App\Models\Common_Question;
use App\Models\Company_Location;
use App\Models\Country;
use App\Models\Homepage_Word;
use App\Models\News;
use App\Models\Package;
use App\Models\Package_Feature;
use App\Models\Privacy_Rule;
use App\Models\Social_Mail;
use App\Models\State;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    use GeneralTrait;

    //✅
    public function get_location_whats_map()
    {
        try{
            $locations = Company_Location::where('status', '0')->get();
            return $this -> returnData('data' , $locations, 'Company Information');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    public function get_all_privacy()
    {
        try{
            $privacy = Privacy_Rule::where('type', 'privacy')->where('status', '0')->get();
            return $this->returnData('data', PrivacyRuleResource::collection($privacy), 'All Privacy In The Website');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //✅
    public function get_all_rule()
    {
        try{
            $rules = Privacy_Rule::where('type', 'rule')->where('status', '0')->get();
            return $this->returnData('data', PrivacyRuleResource::collection($rules), 'All Rules In The Website');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    public function get_all_social_media()
    {
        try{
            $socials = Social_Mail::where('status', '0')->get();
            return $this->returnData('data', $socials, 'All Social Media That allowed To Be Shown In The Website');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrong');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    public function get_all_common_question()
    {
        try{
            $common_questions = Common_Question::where('status', '0')->select(['id','type','question','answer'])->get();
            return $this->returnData('data', $common_questions, 'All Common Questions');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrong');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    public function get_aboutus()
    {
        try{
            $aboutus = Aboutus::all();
            return $this->returnData('data', $aboutus, 'All Content Of About Us in The Website');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrong');
        }
    }


    //-------------------------------------------------------------------------
    //✅
    public function get_all_news()
    {
        try{
            $all_news = News::where('vision', '0')->get();
            return $this->returnData('data', $all_news, 'All News in The Website');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrong');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    public function get_home_info()
    {
        try{
            $home_info = Homepage_Word::where('vision', '0')
                                        // ->where('type', 'تطبيق صوفيا هو رفيقك للحصول علي الشريك المناسب بكل سهولة')
                                        // ->where('type', 'قصص زواج ناجحة')
                                        // ->where('type', 'خطواتك للتعامل مع تطبيق صوفيا')
                                        // ->where('type', 'حمل تطبيق صوفيا الان')
                                        // ->where('type', 'تواصل معنا الان')
                                        // ->where('type', 'انشاء حساب جديد')
                                        // ->where('type', 'باقات التميز من صوفيا')
                                        ->get();
            return $this->returnData('data', $home_info, 'All Heads For Pages In The Website');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    public function get_app_features()
    {
        try{
            $app_features = App_Feature::where('status', '0') ->get();
            return $this->returnData('data', $app_features, 'All App Features That allowed To Shown In The Website HomePage');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    public function get_package(Request $request)
    {
        try{
            $packages = Package::whereStatus('0')->select(['id','name','month_no','price','description','created_at','updated_at'])->get();
            return $this->returnData('data', $packages, 'All App Packages');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //✅
    public function get_package_features(Request $request)
    {
        try{
            $package = Package::whereStatus('0')->whereId($request->package_id)->select(['id','name','description','pay_join','after_choose_pay'])->first();
            
            $features = Package_Feature::where('package_id', $request->package_id)->orderBy('id', 'desc')->select(['id','package_id','title','name'])->get();
            $data = [
                'package' => $package,
                'features' => $features,
            ];
            return $this -> returnData('data' , $data);

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    public function get_countries()
    {
        try{
            $countries = Country::where('status', '1') ->get();
            return $this->returnData('data', $countries, 'All Counties In The DataBase');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //✅
    public function get_cities(Request $request)
    {
        try{
            $rules = [
                "country_id" => "required|exists:countries,id",
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            $cities = State::whereCountryId($request->country_id)->whereStatus('1')->get();
            return $this->returnData('data', $cities, 'All Cities For One Country In The DataBase');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

    //-------------------------------------------------------------------------
    //✅
    public function get_homepages()
    {
        try{
            $homepages = AppHomepages::where('status', '0') ->get();
            return $this->returnData('data', $homepages, 'First Three HomePages');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }
    //-------------------------------------------------------------------------
    //✅
    public function get_logo_name()
    {
        try{
            $logo = WebsiteBanner::where('status', '0') ->get();
            return $this->returnData('data', $logo, 'Website Logo And Name');

        }catch (\Exception $e){
            $this -> returnError('400','Some Thing Went Wrongs');
        }
    }

}
