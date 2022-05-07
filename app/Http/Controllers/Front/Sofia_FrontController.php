<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Aboutus;
use App\Models\Common_Question;
use App\Models\Contact;
use App\Models\Member;
use App\Models\Privacy_Rule;
use App\Models\Success_Relation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Sofia_FrontController extends Controller
{
    //Done
    public function show_rules_page()
    {
        $rules = Privacy_Rule::where('type', 'rule')->where('status', '0')->paginate(12);
        return view('includes.sofia_front.rules', compact('rules'));
    }

    //Done
    public function show_privacy_page()
    {
        $rules = Privacy_Rule::where('type', 'rule')->where('status', '0')->paginate(12);
        return view('includes.sofia_front.privacy', compact('rules'));
    }

    //View Contact Us Page
    //Done
    public function show_contact_us_page()
    {
        $contacts = Contact::where('status', '0')->get();

        return view('includes.sofia_front.contact_us', compact('contacts'));
    }

    //Done
    public function show_about_sofia_page()
    {
        $about_sofia = Aboutus::all();
        return view('includes.sofia_front.about_sofia', compact('about_sofia'));
    }

    //---------------------------------------------------------------------------------------
    //Show Question Page
    //Done
    public function show_common_question_page()
    {
        $common_questions = Common_Question::orderBy('id', 'desc')->paginate(12);
        // $common_questions_counts = count($common_questions);

        return view('includes.sofia_front.common_question', compact('common_questions'));
    }

    //بحث عن سؤال معين من خلال كلمه فقط
    //Done
    public function search_common_question(Request $request)
    {
        $common_questions = Common_Question::when($request->keyword, function ($query, $keyword) {
            return $query->where('question', 'like', "%{$keyword}%");
        })->paginate(12);
        $common_questions_counts = count($common_questions);
        return view('includes.sofia_front.common_question', compact('common_questions'));
    }

    //---------------------------------------------------------------------------------------
    //Send Message From Members In Frontend
    //Done
    public function send_message_from_front(Request $request)
    {
         try {
            $rules = [
                'email' => 'email',
            ];
            $this->validate($request, $rules);

            $contact = new Contact();
            $contact->name          = $request->name;
            $contact->phone         = $request->phone;
            $contact->email         = $request->email;
            $contact->country       = $request->country;
            $contact->subject       = $request->subject;
            $contact->message       = $request->message;
            $contact->save();
            toastr()->success(trans('لقد تم ارسال رسالتكم بنجاح'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show_login_page()
    {
        return view('includes.sofia_front.login_page');
    }


    // --------------------------------------------------------------------------------------------
    // ---------------------------------- Search --------------------------------------------------
    // --------------------------------------------------------------------------------------------
    //Done
    public function show_search_full_page()
    {
        return view('includes.sofia_front.search_full');
    }


    //Done
    public function show_search_full_result_page()
    {
        return view('includes.sofia_front.search_full_result');
    }


    //Done
    public function front_members_full_filter_search(Request $request)
    {
        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();

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

            })->where('id', '!=', $auth_id)->orderBy('id', 'desc')->paginate(30);

        }else{

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

            })->orderBy('id', 'desc')->paginate(30);

        }

        $members_counts = count($members);

        return view('includes.sofia_front.search_full_result', compact('members', 'members_counts'));
    }


    //بحث عن عضو معين من خلال الاسم فقط و موجوده في ال سايدبار
    //Done
    public function front_member_name_filter_search(Request $request)
    {
        $members = Member::when($request->keyword, function ($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->orderBy('id', 'desc')->paginate(30);
        $members_counts = count($members);
        return view('includes.sofia_front.search_full_result', compact('members', 'members_counts'));
    }


    //بحث عن قصة معينة من خلال الاسم فقط و موجوده في القصص الناجحة
    //Done
    public function storySearch(Request $request)
    {
        $stories = Success_Relation::when($request->keyword, function ($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%");
        })->orderBy('id', 'desc')->paginate(30);
        $stories_counts  = count($stories);
        return view('includes.sofia_front.successful_stories', compact('stories', 'stories_counts'));
    }


    //بحث عن زوج معين من خلال الاسم فقط و موجوده في صفحة البحث
    //Done
    public function front_male_members_filter_search()
    {
        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $members = Member::where('gender', 'ذكر')->where('id', '!=', $auth_id)->orderBy('id', 'desc')->paginate(30);
            $members_counts = count($members);
            return view('includes.sofia_front.search_full_result', compact('members', 'members_counts'));
        }else{
            $members = Member::where('gender', 'ذكر')->orderBy('id', 'desc')->paginate(30);
            $members_counts = count($members);
            return view('includes.sofia_front.search_full_result', compact('members', 'members_counts'));
        }
    }


    //بحث عن زوجة معين من خلال الاسم فقط و موجوده في صفحة البحث
    //Done
    public function front_female_members_filter_search()
    {
        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $members = Member::where('gender', 'أنثي')->where('id', '!=', $auth_id)->orderBy('id', 'desc')->paginate(30);
            $members_counts = $members_counts = count($members);
            return view('includes.sofia_front.search_full_result', compact('members', 'members_counts'));
        }else{
            $members = Member::where('gender', 'أنثي')->orderBy('id', 'desc')->paginate(30);
            $members_counts = $members_counts = count($members);
            return view('includes.sofia_front.search_full_result', compact('members', 'members_counts'));
        }
    }


    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------

    //------------------------------------------------------------------------

    //Done
    public function successful_stories(Request $request)
    {
        $stories = Success_Relation::where('status', '0')->orderBy('id', 'desc')->paginate(30);
        $stories_counts = count($stories);
        return view('includes.sofia_front.successful_stories', compact('stories', 'stories_counts'));
    }


    //------------------------------------------------------------------------
    //Done
    public function latest_members(Request $request)
    {
        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $members = Member::where('id', '!=', $auth_id)->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->paginate(30);

        }else{
            $members = Member::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->paginate(30);
        }

        $members_counts = count($members);
        $title = 'الـكـل';
        return view('includes.sofia_front.latest_members', compact('members', 'members_counts', 'title'));
    }

    //Done
    public function latest_males(Request $request)
    {
        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $members = Member::where('id', '!=', $auth_id)->where('gender', 'ذكر')->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->paginate(30);

        }else{
            $members = Member::where('gender', 'ذكر')->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->paginate(30);
        }

        $members_counts = count($members);
        $title = 'الـذكـور';
        return view('includes.sofia_front.latest_members', compact('members', 'members_counts', 'title'));
    }

    //Done
    public function latest_females(Request $request)
    {
        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $members = Member::where('id', '!=', $auth_id)->where('gender', 'أنثي')->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->paginate(30);

        }else{
            $members = Member::where('gender', 'أنثي')->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->paginate(30);
        }

        $members_counts = count($members);
        $title = 'الإنـاث';
        return view('includes.sofia_front.latest_members', compact('members', 'members_counts', 'title'));
    }



    //------------------------------------------------------------------------
    //------------------------------------------------------------------------

    //Done
    public function health_members_index(Request $request)
    {
        if( Auth::guard('member')->check() )
        {
            $auth_id = Auth::guard('member')->id();
            $members = Member::where('id', '!=', $auth_id)->where('health_status', '!=', 'حالتي جيدة الحمدلله')->orderBy('id', 'desc')->paginate(30);

        }else{
            $members = Member::where('health_status', '!=', 'حالتي جيدة الحمدلله')->orderBy('id', 'desc')->paginate(30);
        }

        $members_counts = count($members);
        $title = 'الـكـل';
        return view('includes.sofia_front.health_members', compact('members', 'members_counts', 'title'));
    }

    //Done
    public function health_members(Request $request)
    {
        switch($request->submitbutton) {
            case 'الكل':
                if( Auth::guard('member')->check() )
                {
                    $auth_id = Auth::guard('member')->id();
                    $members = Member::when($request->health_status, function ($query, $health_status) {
                        return $query->where('health_status', 'like', "%{$health_status}%");
                    })->where('id', '!=', $auth_id)->orderBy('id', 'desc')->paginate(30);
                }else{
                    $members = Member::when($request->health_status, function ($query, $health_status) {
                        return $query->where('health_status', 'like', "%{$health_status}%");
                    })->orderBy('id', 'desc')->paginate(30);
                }
                $members_counts = count($members);
                $title = 'الـكـل';
                return view('includes.sofia_front.health_members', compact('members', 'members_counts', 'title'));
            break;

            case 'ذكر':
                if( Auth::guard('member')->check() )
                {
                    $auth_id = Auth::guard('member')->id();
                    $members = Member::when($request->health_status, function ($query, $health_status) {
                        return $query->where('health_status', 'like', "%{$health_status}%");
                    })->where('id', '!=', $auth_id)->where('gender', 'ذكر')->orderBy('id', 'desc')->paginate(30);
                }else{
                    $members = Member::when($request->health_status, function ($query, $health_status) {
                        return $query->where('health_status', 'like', "%{$health_status}%");
                    })->where('gender', 'ذكر')->orderBy('id', 'desc')->paginate(30);
                }
                $members_counts = count($members);
                $title = 'ذكر';
                return view('includes.sofia_front.health_members', compact('members', 'members_counts', 'title'));
            break;

            case 'أنثي':
                if( Auth::guard('member')->check() )
                {
                    $auth_id = Auth::guard('member')->id();
                    $members = Member::when($request->health_status, function ($query, $health_status) {
                        return $query->where('health_status', 'like', "%{$health_status}%");
                    })->where('id', '!=', $auth_id)->where('gender', 'أنثي')->orderBy('id', 'desc')->paginate(30);
                }else{
                    $members = Member::when($request->health_status, function ($query, $health_status) {
                        return $query->where('health_status', 'like', "%{$health_status}%");
                    })->where('gender', 'أنثي')->orderBy('id', 'desc')->paginate(30);
                }
                $members_counts = count($members);
                $title = 'أنثي';
                return view('includes.sofia_front.health_members', compact('members', 'members_counts', 'title'));
            break;
        }
    }

        // public function latest_males(Request $request)
        // {
        //     if( Auth::guard('member')->check() )
        //     {
        //         $auth_id = Auth::guard('member')->id();
        //         $members = Member::where('id', '!=', $auth_id)->where('gender', 'ذكر')->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->paginate(12);

        //     }else{
        //         $members = Member::where('gender', 'ذكر')->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->paginate(12);
        //     }

        //     $members_counts = count($members);
        //     $title = 'الـذكـور';

        //     return view('includes.sofia_front.latest_members', compact('members', 'members_counts', 'title'));
        // }

        // public function latest_females(Request $request)
        // {
        //     if( Auth::guard('member')->check() )
        //     {
        //         $auth_id = Auth::guard('member')->id();
        //         $members = Member::where('id', '!=', $auth_id)->where('gender', 'أنثي')->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->paginate(12);

        //     }else{
        //         $members = Member::where('gender', 'أنثي')->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString() )->orderBy('id', 'desc')->paginate(12);
        //     }

        //     $members_counts = count($members);
        //     $title = 'الإنـاث';

        //     return view('includes.sofia_front.latest_members', compact('members', 'members_counts', 'title'));
        // }


}
