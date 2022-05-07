<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Member;
use App\Models\Setting;

class MemberController extends Controller
{

    public function index()
    {
        $members =Member::orderBy('id', 'desc')->get();

        $title_name = 'جميع الأعضاء';

        return view('pages.admin.members.index', compact('members', 'title_name'));
    }


    public function create(Request $request)
    {
        switch($request->submitbutton) {

            case 'اضافة زوج':
                $gender = 'ذكر';
                $add_type = 'زوج';
                return view('pages.admin.members.create', compact('gender', 'add_type'));
            break;

            case 'اضافة زوجة':
                $gender = 'أنثي';
                $add_type = 'زوجة';
                return view('pages.admin.members.create', compact('gender', 'add_type'));
            break;
        }
    }


    public function store(Request $request)
    {

        try{

            do
            {
                $code = mt_rand(1111111111,9999999999);
                $member_code = Member::where('code_no', $code)->get();
            }
            while(!$member_code->isEmpty());

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
            $member->image         = $save;
            $member->code_no       = $code;
            $member->name          = $request->name;
            $member->email         = $request->email;
            $member->password      = Hash::make($request['password']);
            $member->gender        = $request->gender;

            $member->country                = $request->country;
            $member->city                = $request->city;
            $member->nationality             = $request->nationality;
            $member->dual_nationality            = $request->dual_nationality;

            $member->marriage_type              = $request->marriage_type;
            $member->marital_status               = $request->marital_status;
            $member->age                = $request->age;
            $member->children_number                = $request->children_number;
            $member->children_with                = $request->children_with;
            $member->hair_color                = $request->hair_color;
            $member->listen_music               = $request->listen_music;

            $member->weight              = $request->weight;
            $member->tall               = $request->tall;
            $member->skin                = $request->skin;
            $member->body_status                = $request->body_status;


            $member->religiosity              = $request->religiosity;
            $member->pray               = $request->pray;
            $member->smoke                = $request->smoke;

            if($request->beard != null){
                $member->beard                  = $request->beard;
            }
            if($request->hair_color != null){
                $member->hair_color             = $request->hair_color;
            }
            $member->hegab                  = $request->hegab;

            $member->education          = $request->education;
            $member->education_type         = $request->education_type;
            $member->money_status              = $request->money_status;
            $member->work_field             = $request->work_field;
            $member->work          = $request->work;
            $member->money_month             = $request->money_month;
            $member->health_status          = $request->health_status;

            $member->partner_description    = str_replace("&nbsp;"," ", ( strip_tags($request->partner_description) ));
            $member->your_description       = str_replace("&nbsp;"," ", ( strip_tags($request->your_description) ));

            $member->full_name                = $request->full_name;
            $member->phone                = $request->phone;

            $member->save();


            $setting = new Setting;
            $setting->member_id     = $member->id;
            $setting->save();


            toastr()->success('message', 'لقد تم إضافة عضو جديد بنجاح.');
            return redirect()->route('members.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('pages.admin.members.show', compact('member'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('pages.admin.members.edit', compact('member'));
    }


    public function update(Request $request, $id)
    {
        try {
            $member = Member::whereId($request->id)->first();

            //To Store One Photo For Home Page
            if($request->file('image'))
            {
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();

                $resize_image = Image::make($file)->resize(135, 135);
                $resize_image->save('image/members/'.$file_name);

                // $filePath =('image/members/');

                if ( $resize_image->save('image/members/'.$file_name) ){

                    if( $member->image == 'female1.png' | $member->image != 'female2.png' | $member->image != 'female3.png'){

                        $member->image = $file_name;
                        $member->save();

                    }elseif($member->image == 'male1.png' | $member->image != 'male2.png'){

                        $member->image = $file_name;
                        $member->save();

                    }else{

                        $old_file = $member->image; //get old photo
                        unlink('image/members/'.$old_file);  //delete old photo from folder
                        $member->image = $file_name;
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
                $member->gender                 = $request->gender,

                $member->country                = $country,
                $member->city                   = $city,
                $member->nationality            = $nationality,
                $member->dual_nationality       = $dual_nationality,

                $member->marriage_type          = $request->marriage_type,
                $member->marital_status         = $request->marital_status,
                $member->age                    = $request->age,
                $member->children_number        = $request->children_number,
                $member->children_with                = $request->children_with,
                $member->hair_color             = $hair_color,
                $member->listen_music               = $request->listen_music,

                $member->weight                 = $request->weight,
                $member->tall                   = $request->tall,
                $member->skin                   = $request->skin,
                $member->body_status            = $request->body_status,


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

                $member->partner_description    = str_replace("&nbsp;"," ", ( strip_tags($request->partner_description ) )),
                $member->your_description       = str_replace("&nbsp;"," ", ( strip_tags($request->your_description ) )),

                $member->full_name              = $request->full_name,
                $member->phone                  = $request->phone,
            ]);

            toastr()->success('message', 'لقد تم تعديل بيانات العضو بنجاح.');
            return redirect()->route('members.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $member = Member::where('id', $request->id)->first();

            if ($member) {

                if($member->image)
                {
                    if (File::exists('image/members/' .$member->image) ) {
                        unlink('image/members/'.$member->image);
                    }
                }
                $member->delete();

                toastr()->error(trans('تم حذف العضو بنجاح'));
                return redirect()->route('members.index');
            }
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    // --------------------------------------------------------------------------------------------
    public function show_male_members()
    {
        $members =Member::where('gender', 'ذكر')->orderBy('id', 'desc')->get();

        $title_name = 'الأعضاء الرجال';

        return view('pages.admin.members.index', compact('members', 'title_name'));
    }

    public function show_female_members()
    {
        $members =Member::where('gender', 'أنثي')->orderBy('id', 'desc')->get();

        $title_name = 'الأعضاء النساء';

        return view('pages.admin.members.index', compact('members', 'title_name'));
    }


    public function show_filter_page()
    {
        $members =Member::orderBy('id', 'desc')->get();

        return view('pages.admin.members.filter', compact('members'));
    }


    // --------------------------------------------------------------------------------------------
    public function member_filter_search(Request $request)
    {

        $members = Member::when($request->first_nationality, function ($query, $first_nationality) {
            return $query->where('nationality', 'like', "%{$first_nationality}%");

            })->when($request->dual_nationality, function ($query, $dual_nationality) {
                return $query->where('dual_nationality', 'like', "%{$dual_nationality}%");

            })->when($request->country, function ($query, $country) {
                return $query->where('country', 'like', "%{$country}%");

            })->when($request->city, function ($query, $city) {
                return $query->where('city', 'like', "%{$city}%");


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


        })->paginate(10);

        // dd($members);

        $title_name = 'قائمة الاعضاء بعد الفلترة';

        return view('pages.admin.members.index', compact('members', 'title_name'));
    }





}

