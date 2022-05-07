@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{__('تعديل بيانات عضو') }}
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('تعديل بيانات عضو') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<!-- row -->
<div class="row">
    @if ($errors->any())
        <div class="error">{{ $errors->first('Name') }}</div>
    @endif

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="button" class="button x-small back_property">
                    <a href="{{ route('members.index') }}">{{ trans('property_trans.return') }}</a>
                </button>
                <br><br>


                <div class="card-body">
                    <form action="{{ route('members.update', 'test') }}" method="post" enctype="multipart/form-data">
                        {{ method_field('patch') }}
                        @csrf
                        <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $member->id }}">

                        <div class="row beauty_top">
                            <h2 class="help">{{__('بيانات الدخول') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="mr-sm-2  space_top">{{ __('الاســم') }} : <span style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="name" value="{{ $member->name }}">

                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email" class="mr-sm-2">{{ __('البريد الالكتروني') }} : <span style="color: red"> * </span> </label>
                                    <input type="email" class="form-control" name="email" value="{{ $member->email }}">

                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password" class="mr-sm-2">{{ __('كلمة المرور') }} : <span style="color: red"> * </span> </label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                    @error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password-confirm" class="mr-sm-2">{{ __('تأكيد كلمة المرور') }} : <span style="color: red"> * </span> </label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">

                                    {{-- @error('email')<span class="text-danger">{{ $message }}</span>@enderror --}}
                                </div>
                            </div>
                            <br><br><br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="gender" class="mr-sm-2  space_top">{{ __('نوع (ذكر / أنثي)') }} : <span style="color: red"> * </span> </label>
                                    <select name="gender" required class="form-control custom-select selectpicker gender">
                                        <option value="0" <?php if($member->gender == "0")    echo "selected"; ?> >       {{ trans('social_trans.0') }} </option>
                                        <option value="ذكر" <?php if($member->gender == "ذكر")    echo "selected"; ?> >        ذكر      </option>
                                        <option value="أنثي" <?php if($member->gender == "أنثي")    echo "selected"; ?> >       أنثي     </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="image" class="mr-sm-2  space_top">{{__('الصورة الشخصية') }} : </label>
                                <input type="file" class="form-control" name="image">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        {{--------- الجنسية والإقامة -----------}}
                        <div class="row beauty">
                            <h2 class="help">{{__('الجنسية والإقامة') }}</h2>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nationality" class="mr-sm-2  space_top">{{ __('الجنسية') }} : <span style="color: red"> * </span> </label>
                                            <select name="nationality" required class="form-control custom-select selectpicker gender">
                                                <option value="0">{{ __('اختر---') }}</option>
                                                <option value="" style="background-color: grey; color:white" disabled>
                                                    {{ __('الوطن العربي') }}</option>
                                                <?php $all_countries = \App\Models\Country::where('status', 1)
                                                    ->where('arabic', '1')
                                                    ->orderBy('name', 'asc')
                                                    ->get(['id', 'name']); ?>
                                                @forelse ($all_countries as $country)
                                                    <option value="{{ $country->name }}"
                                                        {{ old('nationality', $member->nationality) == $country->name ? 'selected' : null }}>
                                                        {{ $country->name }}</option>
                                                @empty
                                                @endforelse
                                                <option value="" style="background-color: grey; color:white" disabled>
                                                    {{ __('باقي دول العالم') }}</option>
                                                <?php $all_countries = \App\Models\Country::where('status', 1)
                                                    ->where('arabic', '0')
                                                    ->orderBy('name', 'asc')
                                                    ->get(['id', 'name']); ?>
                                                @forelse ($all_countries as $country)
                                                    <option value="{{ $country->name }}"
                                                        {{ old('nationality', $member->nationality) == $country->name ? 'selected' : null }}>
                                                        {{ $country->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label class="col-sm-2 control-label">بلد  : <span style="color: red"> * </span> </label>
                                        <div class="col-sm-12">
                                            <?php $countries = \App\Models\Country::get(['id', 'name']); ?>
                                            <select name="country" required class="form-control custom-select selectpicker gender">
                                                <option value="" <?php if($member->country == "")    echo "selected"; ?> >       {{__('---') }} </option>
                                                <option value="" style="background-color: grey; color:white"  disabled>{{__("الوطن العربي") }}</option>
                                                <?php $countries = \App\Models\Country::where('status', 1)->where('arabic', '1')->orderBy('name', 'asc')->get(['id', 'name']); ?>
                                                @forelse ($countries as $country)
                                                    <option value="{{ $country->name }}" {{ old('country', $member->country) == $country->name ? 'selected' : null }}>{{ $country->name }}</option>
                                                @empty
                                                @endforelse
                                                <option value="" style="background-color: grey; color:white"  disabled>{{__("باقي دول العالم") }}</option>
                                                <?php $countries = \App\Models\Country::where('status', 1)->where('arabic', '0')->orderBy('name', 'asc')->get(['id', 'name']); ?>
                                                @forelse ($countries as $country)
                                                    <option value="{{ $country->name }}" {{ old('country', $member->country) == $country->name ? 'selected' : null }}>{{ $country->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="gds-cr-one"  name ="city" class="col-sm-2 control-label">منطقة  : <span style="color: red"> * </span> </label>
                                        <div class="col-sm-12">
                                            <select name="city" class="form-control custom-select selectpicker gender">
                                                <option value="{{ $member->city }}" {{ old('city') == $member->city ? 'selected' : null }}>{{ $member->city }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <br><br>
                        </div>



                        {{--------- الحالة الإجتماعية -----------}}
                        <div class="row beauty">
                            <h2 class="help">{{__('الحالة الإجتماعية') }}</h2>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="marriage_type" class="mr-sm-2  space_top">{{ __('نوع الزواج الذي أرغب به') }} : <span style="color: red"> * </span> </label>
                                    <select name="marriage_type" required class="form-control custom-select selectpicker gender">
                                        <option value="0" <?php if($member->marriage_type == "0")    echo "selected"; ?> >       {{__('اختر نوع الزواج') }} </option>
                                        <option value="الوحيدة" <?php if($member->marriage_type == "الوحيدة")    echo "selected"; ?> >الوحيدة</option>
                                        <option value="زواج تعدد" <?php if($member->marriage_type == "زواج تعدد")    echo "selected"; ?> >زواج تعدد</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="marital_status" class="mr-sm-2  space_top">{{ __('الحالة الإجتماعية') }} : <span style="color: red"> * </span> </label>
                                    <select name="marital_status" required class="form-control custom-select selectpicker gender">
                                        @if ($member->gender == 'ذكر' )
                                            <option value="أعزب" <?php if($member->marital_status == "أعزب")    echo "selected"; ?> >أعزب</option>
                                            <option value="متزوج" <?php if($member->marital_status == "متزوج")    echo "selected"; ?> >متزوج</option>
                                            <option value="منفصل" <?php if($member->marital_status == "منفصل")    echo "selected"; ?> >منفصل</option>
                                            <option value="أرمل" <?php if($member->marital_status == "أرمل")    echo "selected"; ?> >أرمل</option>
                                        @else
                                            <option value="أنسة" <?php if($member->marital_status == "أنسة")    echo "selected"; ?> >أنسة</option>
                                            <option value="منفصلة" <?php if($member->marital_status == "منفصلة")    echo "selected"; ?> >منفصلة</option>
                                            <option value="أرملة" <?php if($member->marital_status == "أرملة")    echo "selected"; ?> >أرملة</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="age" class="mr-sm-2  space_top">{{ __('العمر') }} : <span style="color: red"> * </span> </label>
                                    <select name="age" required class="form-control custom-select selectpicker gender">
                                        <?php
                                            $intial = 18;
                                            $end = 60;
                                        ?>
                                        <option value="0" <?php if($member->age == "0")    echo "selected"; ?> >       {{__('اختر العمر ') }} </option>
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}" <?php if($member->age == $i)    echo "selected"; ?> >{{ $i }}</option>
                                        @endfor
                                        <option value="60+" <?php if($member->age == "60+")    echo "selected"; ?> >{{__("60+") }}</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="children_number" class="mr-sm-2  space_top">{{ __('عدد الأولاد') }} : <span style="color: red"> * </span> </label>
                                    <select name="children_number" required class="form-control custom-select selectpicker gender">
                                        <?php
                                            $intial= 1;
                                            $end= 5;
                                        ?>
                                        <option value="0" <?php if($member->children_number == "0")    echo "selected"; ?> >       {{__('0') }} </option>
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}" <?php if($member->children_number == $i)    echo "selected"; ?> >{{ $i }}</option>
                                        @endfor
                                        <option value="5+" <?php if($member->children_number == "5+")    echo "selected"; ?> >{{__("5+") }}</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="children_with" class="mr-sm-2  space_top">{{ __('الاطفال مع') }} : <span style="color: red"> * </span> </label>
                                    <select name="children_with" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="لا يوجد أطفال" <?php if($member->children_with == "لا يوجد أطفال")    echo "selected"; ?> > {{ __('لا يوجد أطفال') }} </option>
                                        <option value="معي" <?php if($member->children_with == "معي")    echo "selected"; ?> >معي</option>
                                        @if ($member->gender == 'ذكر')
                                            <option value="مع الأم" <?php if($member->children_with == "مع الأم")    echo "selected"; ?> >مع الأم</option>
                                        @else
                                            <option value="مع الأب" <?php if($member->children_with == "مع الأب")    echo "selected"; ?> >مع الأب</option>
                                        @endif
                                        <option value="بين الأب و الأم" <?php if($member->children_with == "بين الأب و الأم")    echo "selected"; ?> >بين الأب و الأم</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                        </div>



                        {{--------- مواصفاتك -----------}}
                        <div class="row beauty">
                            <h2 class="help">{{__('مواصفاتك') }}</h2>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="weight" class="mr-sm-2  space_top">{{ __('الوزن (كغ)') }} : <span style="color: red"> * </span> </label>
                                    <select name="weight" required class="form-control custom-select selectpicker gender">
                                        <?php
                                            $intial = 40;
                                            $end = 180;
                                        ?>
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}" <?php if($member->weight == $i )    echo "selected"; ?> >{{ $i }}</option>
                                        @endfor
                                        <option value="180+" <?php if($member->weight == "180+" )    echo "selected"; ?> >{{__("180+") }}</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tall" class="mr-sm-2  space_top">{{ __('الطول (سم)') }} : <span style="color: red"> * </span> </label>
                                    <select name="tall" required class="form-control custom-select selectpicker gender">
                                        <?php
                                            $intial = 110;
                                            $end = 200;
                                        ?>
                                        {{-- <option value="0" <?php if($member->tall == "0")    echo "selected"; ?> >       {{__('-') }} </option> --}}
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}" <?php if($member->tall == $i )    echo "selected"; ?> >{{ $i }}</option>
                                        @endfor
                                        <option value="200+" <?php if($member->tall == "200+" )    echo "selected"; ?> >{{__("200+") }}</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="skin" class="mr-sm-2  space_top">{{ __('لون البشرة') }} : <span style="color: red"> * </span> </label>
                                    <select name="skin" required class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->skin == "")    echo "selected"; ?> >       {{__('-') }} </option>
                                        <option value="أبيض" <?php if($member->skin == "أبيض")    echo "selected"; ?> >{{__("أبيض") }}</option>
                                        <option value="قمحي" <?php if($member->skin == "قمحي")    echo "selected"; ?> >{{__("قمحي") }}</option>
                                        <option value="أسمر" <?php if($member->skin == "أسمر")    echo "selected"; ?> >{{__("أسمر") }}</option>
                                        <option value="أسمر غامق" <?php if($member->skin == "أسمر غامق")    echo "selected"; ?> >{{__("أسمر غامق") }}</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="body_status" class="mr-sm-2  space_top">{{ __('بنية الجسم ') }} : <span style="color: red"> * </span> </label>
                                    <select name="body_status" required class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->body_status == "0")    echo "selected"; ?> >       {{__('-') }} </option>
                                        @if ($member->gender =='ذكر')
                                            <option value="نحيف" <?php if($member->body_status == "نحيف")    echo "selected"; ?> >{{_("نحيف") }}</option>
                                            <option value="متوسط" <?php if($member->body_status == "متوسط")    echo "selected"; ?> >{{_("متوسط") }}</option>
                                            <option value="رياضي" <?php if($member->body_status == "رياضي")    echo "selected"; ?> >{{_("رياضي") }}</option>
                                            <option value="سمين" <?php if($member->body_status == "سمين")    echo "selected"; ?> >{{_("سمين") }}</option>
                                            <option value="ضخم" <?php if($member->body_status == "ضخم")    echo "selected"; ?> >{{_("ضخم") }}</option>
                                        @else
                                            <option value="نحيفة" <?php if($member->body_status == "نحيفة")    echo "selected"; ?> >{{_("نحيفة") }}</option>
                                            <option value="متوسطة" <?php if($member->body_status == "متوسطة")    echo "selected"; ?> >{{_("متوسطة") }}</option>
                                            <option value="رياضية" <?php if($member->body_status == "رياضية")    echo "selected"; ?> >{{_("رياضية") }}</option>
                                            <option value="سمينة" <?php if($member->body_status == "سمينة")    echo "selected"; ?> >{{_("سمينة") }}</option>
                                            <option value="ضخمة" <?php if($member->body_status == "ضخمة")    echo "selected"; ?> >{{_("ضخمة") }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            @if ($member->hair_color != null && $member->gender == 'ذكر')
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="hair_color" class="mr-sm-2  space_top">{{ __('لون الشعر') }} : <span style="color: red"> * </span> </label>
                                        <select name="hair_color" required class="form-control custom-select selectpicker gender">
                                            <option value="" <?php if($member->hair_color == "")    echo "selected"; ?> > {{ __('-') }} </option>
                                            <option value="بني" <?php if($member->hair_color == "بني")    echo "selected"; ?> >بني</option>
                                            <option value="اسود" <?php if($member->hair_color == "اسود")    echo "selected"; ?> >اسود</option>
                                            <option value="ابيض" <?php if($member->hair_color == "ابيض")    echo "selected"; ?> >ابيض</option>
                                            <option value="رملي" <?php if($member->hair_color == "رملي")    echo "selected"; ?> >رملي</option>
                                            <option value="رمادي" <?php if($member->hair_color == "رمادي")    echo "selected"; ?> >رمادي</option>
                                            <option value="الأحمر" <?php if($member->hair_color == "الأحمر")    echo "selected"; ?> >الأحمر</option>
                                            <option value="أشقر" <?php if($member->hair_color == "أشقر")    echo "selected"; ?> >أشقر</option>
                                            <option value="ازرق" <?php if($member->hair_color == "ازرق")    echo "selected"; ?> >ازرق</option>
                                            <option value="اخضر" <?php if($member->hair_color == "اخضر")    echo "selected"; ?> >اخضر</option>
                                            <option value="برتقالي" <?php if($member->hair_color == "برتقالي")    echo "selected"; ?> >برتقالي</option>
                                            <option value="وردي" <?php if($member->hair_color == "وردي")    echo "selected"; ?> >وردي</option>
                                            <option value="بنفسجي" <?php if($member->hair_color == "بنفسجي")    echo "selected"; ?> >بنفسجي</option>
                                            <option value="أصلع جزئيا" <?php if($member->hair_color == "أصلع جزئيا")    echo "selected"; ?> >أصلع جزئيا</option>
                                            <option value="أصلع تماما" <?php if($member->hair_color == "أصلع تماما")    echo "selected"; ?> >أصلع تماما</option>
                                            <option value="غير ذلك" <?php if($member->hair_color == "غير ذلك")    echo "selected"; ?> >غير ذلك</option>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                            @endif
                        </div>



                        {{--------- الالتزام الديني -----------}}
                        <div class="row beauty">
                            <h2 class="help">{{__('الالتزام الديني') }}</h2>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="religiosity" class="mr-sm-2  space_top">{{ __('التدين ') }} : <span style="color: red"> * </span> </label>
                                    <select name="religiosity" required class="form-control custom-select selectpicker gender">
                                        <option value="0" <?php if($member->religiosity == "0")    echo "selected"; ?> >       {{__('--اختر--') }} </option>
                                        @if ($member->gender == 'ذكر')
                                            <option value="متدين كثيرا" <?php if($member->religiosity == "متدين كثيرا")    echo "selected"; ?> >         متدين كثيرا      </option>
                                            <option value="متدين" <?php if($member->religiosity == "متدين")    echo "selected"; ?> >           متدين      </option>
                                            <option value="متدين قليلا" <?php if($member->religiosity == "متدين قليلا")    echo "selected"; ?> >           متدين قليلا      </option>
                                            <option value="غير متدين" <?php if($member->religiosity == "غير متدين")    echo "selected"; ?> >         غير متدين      </option>
                                        @else
                                            <option value="متدينة كثيرا" <?php if($member->religiosity == "متدينة كثيرا")    echo "selected"; ?> >{{__("متدينة كثيرا") }}</option>
                                            <option value="متدينة" <?php if($member->religiosity == "متدينة")    echo "selected"; ?> >{{__("متدينة") }}</option>
                                            <option value="متدينة قليلا" <?php if($member->religiosity == "متدينة قليلا")    echo "selected"; ?> >{{__("متدينة قليلا") }}</option>
                                            <option value="غير متدينة" <?php if($member->religiosity == "غير متدينة")    echo "selected"; ?> >{{__("غير متدينة") }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pray" class="mr-sm-2  space_top">{{ __('الصلاة ') }} : <span style="color: red"> * </span> </label>
                                    <select name="pray" required class="form-control custom-select selectpicker gender">
                                        <option value="0" <?php if($member->pray == "0")    echo "selected"; ?> >       {{__('--اختر--') }} </option>
                                        <option value="دائما" <?php if($member->pray == "دائما")    echo "selected"; ?> >         دائما      </option>
                                        <option value="أغلب الاوقات" <?php if($member->pray == "أغلب الاوقات")    echo "selected"; ?> >           أغلب الاوقات      </option>
                                        <option value="بعض الأوقات" <?php if($member->pray == "بعض الأوقات")    echo "selected"; ?> >         بعض الأوقات      </option>
                                        <option value="لا أصلي" <?php if($member->pray == "لا أصلي")    echo "selected"; ?> >         لا أصلي      </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="smoke" class="mr-sm-2  space_top">{{ __('التدخين') }} : <span style="color: red"> * </span> </label>
                                    <select name="smoke" required class="form-control custom-select selectpicker gender">
                                        <option value="0" <?php if($member->smoke == "0")    echo "selected"; ?> >       {{__('--اختر--') }} </option>
                                        <option value="نعم" <?php if($member->smoke == "نعم")    echo "selected"; ?> >         نعم      </option>
                                        <option value="لا" <?php if($member->smoke == "لا")    echo "selected"; ?> >          لا      </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="listen_music" class="mr-sm-2  space_top">{{ __('مستمع للموسيقي') }} : <span style="color: red"> * </span> </label>
                                    <select name="listen_music" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0" <?php if($member->listen_music == "0")    echo "selected"; ?> > {{ __('-') }} </option>
                                        <option value="نعم" <?php if($member->listen_music == "نعم")    echo "selected"; ?> > نعم </option>
                                        <option value="احيانا" <?php if($member->listen_music == "احيانا")    echo "selected"; ?> > احيانا </option>
                                        <option value="لا" <?php if($member->listen_music == "لا")    echo "selected"; ?> > لا </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>

                            @if ($member->gender == 'ذكر')
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="beard" class="mr-sm-2  space_top">{{ __('اللحية') }} : <span style="color: red"> * </span> </label>
                                        <select name="beard" required class="form-control custom-select selectpicker gender">
                                            <option value="0" <?php if($member->beard == "0")    echo "selected"; ?> >       {{__('--اختر--') }} </option>
                                            <option value="نعم" <?php if($member->beard == "نعم")    echo "selected"; ?> >         نعم      </option>
                                            <option value="لا" <?php if($member->beard == "لا")    echo "selected"; ?> >          لا      </option>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="hair_color" class="mr-sm-2  space_top">{{ __('لون الشعر') }} : <span style="color: red"> * </span> </label>
                                        <select name="hair_color" required class="form-control custom-select selectpicker gender">
                                            <option value="0" <?php if($member->hair_color == "0")    echo "selected"; ?> > {{ __('-') }} </option>
                                            <option value="بني" <?php if($member->hair_color == "بني")    echo "selected"; ?> >بني</option>
                                            <option value="اسود" <?php if($member->hair_color == "اسود")    echo "selected"; ?> >اسود</option>
                                            <option value="ابيض" <?php if($member->hair_color == "ابيض")    echo "selected"; ?> >ابيض</option>
                                            <option value="رملي" <?php if($member->hair_color == "رملي")    echo "selected"; ?> >رملي</option>
                                            <option value="رمادي" <?php if($member->hair_color == "رمادي")    echo "selected"; ?> >رمادي</option>
                                            <option value="الأحمر" <?php if($member->hair_color == "الأحمر")    echo "selected"; ?> >الأحمر</option>
                                            <option value="أشقر" <?php if($member->hair_color == "أشقر")    echo "selected"; ?> >أشقر</option>
                                            <option value="ازرق" <?php if($member->hair_color == "ازرق")    echo "selected"; ?> >ازرق</option>
                                            <option value="اخضر" <?php if($member->hair_color == "اخضر")    echo "selected"; ?> >اخضر</option>
                                            <option value="برتقالي" <?php if($member->hair_color == "برتقالي")    echo "selected"; ?> >برتقالي</option>
                                            <option value="وردي" <?php if($member->hair_color == "وردي")    echo "selected"; ?> >وردي</option>
                                            <option value="بنفسجي" <?php if($member->hair_color == "بنفسجي")    echo "selected"; ?> >بنفسجي</option>
                                            <option value="أصلع جزئيا" <?php if($member->hair_color == "أصلع جزئيا")    echo "selected"; ?> >أصلع جزئيا</option>
                                            <option value="أصلع تماما" <?php if($member->hair_color == "أصلع تماما")    echo "selected"; ?> >أصلع تماما</option>
                                            <option value="غير ذلك" <?php if($member->hair_color == "غير ذلك")    echo "selected"; ?> >غير ذلك</option>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                            @elseif ($member->gender != 'ذكر')
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="smoke" class="mr-sm-2  space_top">{{ __('الـحـجـاب') }} : <span style="color: red"> * </span> </label>
                                        <select name="hegab" required
                                            class="form-control custom-select selectpicker gender">
                                            <option value="" <?php if($member->hegab == "")    echo "selected"; ?> >       {{__('-') }} </option>
                                            <option value="منقبة" <?php if($member->hegab == "منقبة")    echo "selected"; ?> >         منقبة      </option>
                                            <option value="محجبة" <?php if($member->hegab == "محجبة")    echo "selected"; ?> >          محجبة      </option>
                                            <option value="غير محجبة" <?php if($member->hegab == "غير محجبة")    echo "selected"; ?> >          غير محجبة      </option>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                            @endif
                        </div>


                        {{--------- الدراسة والعمل -----------}}
                        <div class="row beauty">
                            <h2 class="help">{{__('المستوى التعليمي') }}</h2>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="education" class="mr-sm-2  space_top">{{ __('المستوى التعليمي') }} : <span style="color: red"> * </span> </label>
                                    <select name="education" required class="form-control custom-select selectpicker gender">
                                        <option value="0" <?php if($member->education == "0")    echo "selected"; ?> >       {{__('اختر المؤهل التعليمي') }} </option>
                                        <option value="بدون تعليم" <?php if($member->education == "بدون تعليم")    echo "selected"; ?> >{{_("بدون تعليم") }}</option>
                                        <option value="متوسط" <?php if($member->education == "متوسط")    echo "selected"; ?> >{{_("متوسط") }}</option>
                                        <option value="ثانوي" <?php if($member->education == "ثانوي")    echo "selected"; ?> >{{_("ثانوي") }}</option>
                                        <option value="جامعة" <?php if($member->education == "جامعة")    echo "selected"; ?> >{{_("جامعة") }}</option>
                                        <option value="ماجستير ودكتوراه" <?php if($member->education == "ماجستير ودكتوراه")    echo "selected"; ?> >{{_("ماجستير ودكتوراه") }}</option>
                                        <option value="تعليم ذاتي" <?php if($member->education == "تعليم ذاتي")    echo "selected"; ?> >{{_("تعليم ذاتي") }}</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="education_type" class="mr-sm-2  space_top">{{ __('نوع المؤهل') }} : <span style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="education_type" value="{{ $member->education_type }}">

                                    @error('education_type')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="work_field" class="mr-sm-2  space_top">{{ __('مجال العمل') }} : <span style="color: red"> * </span> </label>
                                    <select name="work_field" required class="form-control custom-select selectpicker gender">
                                        @if ($member->gender =='ذكر')
                                            <option value="" <?php if($member->work_field == "")    echo "selected"; ?> >       {{__('مجال العمل') }} </option>
                                            <option value="قطاع حكومي" <?php if($member->work_field == "قطاع حكومي")    echo "selected"; ?> >{{_("قطاع حكومي") }}</option>
                                            <option value="قطاع خاص" <?php if($member->work_field == "قطاع خاص")    echo "selected"; ?> >{{_("قطاع خاص") }}</option>
                                            <option value="عمل حر" <?php if($member->work_field == "عمل حر")    echo "selected"; ?> >{{_("عمل حر") }}</option>
                                            <option value="صاحب عمل" <?php if($member->work_field == "صاحب عمل")    echo "selected"; ?> >{{_("صاحب عمل") }}</option>
                                            <option value="متقاعد" <?php if($member->work_field == "متقاعد")    echo "selected"; ?> >{{_("متقاعد") }}</option>
                                            <option value="بدون عمل" <?php if($member->work_field == "بدون عمل")    echo "selected"; ?> >{{_("بدون عمل") }}</option>
                                            <option value="لا زلت أدرس" <?php if($member->work_field == "لا زلت أدرس")    echo "selected"; ?> >{{_("لا زلت أدرس") }}</option>
                                        @else
                                            <option value="" <?php if($member->work_field == "")    echo "selected"; ?> >       {{__('مجال العمل') }} </option>
                                            <option value="قطاع حكومي" <?php if($member->work_field == "قطاع حكومي")    echo "selected"; ?> >{{_("قطاع حكومي") }}</option>
                                            <option value="قطاع خاص" <?php if($member->work_field == "قطاع خاص")    echo "selected"; ?> >{{_("قطاع خاص") }}</option>
                                            <option value="عمل حر" <?php if($member->work_field == "عمل حر")    echo "selected"; ?> >{{_("عمل حر") }}</option>
                                            <option value="صاحبة عمل" <?php if($member->work_field == "صاحبة عمل")    echo "selected"; ?> >{{_("صاحبة عمل") }}</option>
                                            <option value="متقاعدة" <?php if($member->work_field == "متقاعدة")    echo "selected"; ?> >{{_("متقاعدة") }}</option>
                                            <option value="بدون عمل" <?php if($member->work_field == "بدون عمل")    echo "selected"; ?> >{{_("بدون عمل") }}</option>
                                            <option value="لا زلت أدرس" <?php if($member->work_field == "لا زلت أدرس")    echo "selected"; ?> >{{_("لا زلت أدرس") }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="work" class="mr-sm-2  space_top">{{ __('الوظيفة') }} : <span style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="work" value="{{ $member->work }}">

                                    @error('work')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="money_status" class="mr-sm-2  space_top">{{ __('الوضع المادي ') }} : <span style="color: red"> * </span> </label>
                                    <select name="money_status" required class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->money_status == "")    echo "selected"; ?> >       {{__('وضعك المادي') }} </option>
                                        <option value="فقير" <?php if($member->money_status == "فقير")    echo "selected"; ?> >          فقير      </option>
                                        <option value="أقل من المتوسط" <?php if($member->money_status == "أقل من المتوسط")    echo "selected"; ?> >             أقل من المتوسط      </option>
                                        <option value="متوسط" <?php if($member->money_status == "متوسط")    echo "selected"; ?> >           متوسط      </option>
                                        <option value="أكبر من المتوسط" <?php if($member->money_status == "أكبر من المتوسط")    echo "selected"; ?> >          أكبر من المتوسط      </option>
                                        <option value="جيد" <?php if($member->money_status == "جيد")    echo "selected"; ?> >           جيد      </option>
                                        <option value="ميسور" <?php if($member->money_status == "ميسور")    echo "selected"; ?> >           ميسور      </option>
                                        <option value="غني" <?php if($member->money_status == "غني")    echo "selected"; ?> >           غني      </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="money_month" class="mr-sm-2  space_top">{{ __('الدخل الشهري') }} : <span style="color: red"> * </span> </label>
                                    <select name="money_month" required class="form-control custom-select selectpicker gender">
                                        <option value="0" <?php if($member->money_month == "0")    echo "selected"; ?> >       {{__('دخلك الشهري') }} </option>
                                        <option value="أقل من 500 دولار" <?php if($member->money_month == "أقل من 500 دولار")    echo "selected"; ?> >            أقل من 500 دولار      </option>
                                        <option value="500 - 1000 دولار" <?php if($member->money_month == "500 - 1000 دولار")    echo "selected"; ?> >           500 - 1000 دولار      </option>
                                        <option value="1000 - 1500 دولار" <?php if($member->money_month == "1000 - 1500 دولار")    echo "selected"; ?> >           1000 - 1500 دولار      </option>
                                        <option value="1500 - 2000 دولار" <?php if($member->money_month == "1500 - 2000 دولار")    echo "selected"; ?> >           1500 - 2000 دولار      </option>
                                        <option value="أكبر من 2000 دولار" <?php if($member->money_month == "أكبر من 2000 دولار")    echo "selected"; ?> >            أكبر من 2000 دولار      </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="health_status" class="mr-sm-2  space_top">{{ __('الحالة الصحية') }} : <span style="color: red"> * </span> </label>
                                    <select name="health_status" required class="form-control custom-select selectpicker gender">
                                        <option value="حالتي جيدة الحمدلله" <?php if($member->health_status == "حالتي جيدة الحمدلله")    echo "selected"; ?> >{{__("حالتي جيدة الحمدلله") }}</option>
                                        <option value="اكتئاب" <?php if($member->health_status == "اكتئاب")    echo "selected"; ?> >{{__("اكتئاب") }}</option>
                                        <option value="انحناء وتقوس" <?php if($member->health_status == "انحناء وتقوس")    echo "selected"; ?> >{{__("انحناء وتقوس") }}</option>
                                        <option value="انفصام شخصية" <?php if($member->health_status == "انفصام شخصية")    echo "selected"; ?> >{{__("انفصام شخصية") }}</option>
                                        <option value="إعاقة بصرية" <?php if($member->health_status == "إعاقة بصرية")    echo "selected"; ?> >{{__("إعاقة بصرية") }}</option>
                                        <option value="إعاقة حركية" <?php if($member->health_status == "إعاقة حركية")    echo "selected"; ?> >{{__("إعاقة حركية") }}</option>
                                        <option value="إعاقة سمعية" <?php if($member->health_status == "إعاقة سمعية")    echo "selected"; ?> >{{__("إعاقة سمعية") }}</option>
                                        <option value="إعاقة فكرية" <?php if($member->health_status == "إعاقة فكرية")    echo "selected"; ?> >{{__("إعاقة فكرية") }}</option>
                                        <option value="باطنية" <?php if($member->health_status == "باطنية")    echo "selected"; ?> >{{__("باطنية") }}</option>
                                        <option value="برص" <?php if($member->health_status == "برص")    echo "selected"; ?> >{{__("برص") }}</option>
                                        <option value="بهاق" <?php if($member->health_status == "بهاق")    echo "selected"; ?> >{{__("بهاق") }}</option>
                                        <option value="توحد" <?php if($member->health_status == "توحد")    echo "selected"; ?> >{{__("توحد") }}</option>
                                        <option value="جلدية" <?php if($member->health_status == "جلدية")    echo "selected"; ?> >{{__("جلدية") }}</option>
                                        <option value="حروق مشوهة" <?php if($member->health_status == "حروق مشوهة")    echo "selected"; ?> >{{__("حروق مشوهة") }}</option>
                                        <option value="سرطان" <?php if($member->health_status == "سرطان")    echo "selected"; ?> >{{__("سرطان") }}</option>
                                        <option value="سكري" <?php if($member->health_status == "سكري")    echo "selected"; ?> >{{__("سكري") }}</option>
                                        <option value="سمنة مفرطة" <?php if($member->health_status == "سمنة مفرطة")    echo "selected"; ?> >{{__("سمنة مفرطة") }}</option>
                                        <option value="شراهة في الأكل" <?php if($member->health_status == "شراهة في الأكل")    echo "selected"; ?> >{{__("شراهة في الأكل") }}</option>
                                        <option value="شلل أطفال" <?php if($member->health_status == "شلل أطفال")    echo "selected"; ?> >{{__("شلل أطفال") }}</option>
                                        <option value="شلل رباعي" <?php if($member->health_status == "شلل رباعي")    echo "selected"; ?> >{{__("شلل رباعي") }}</option>
                                        <option value="صدفية" <?php if($member->health_status == "صدفية")    echo "selected"; ?> >{{__("صدفية") }}</option>
                                        <option value="صرع" <?php if($member->health_status == "صرع")    echo "selected"; ?> >{{__("صرع") }}</option>
                                        <option value="صلع" <?php if($member->health_status == "صلع")    echo "selected"; ?> >{{__("صلع") }}</option>
                                        <option value="ضغط" <?php if($member->health_status == "ضغط")    echo "selected"; ?> >{{__("ضغط") }}</option>
                                        <option value="عجز جنسي" <?php if($member->health_status == "عجز جنسي")    echo "selected"; ?> >{{__("عجز جنسي") }}</option>
                                        <option value="عقم" <?php if($member->health_status == "عقم")    echo "selected"; ?> >{{__("عقم") }}</option>
                                        <option value="فقدان طرف" <?php if($member->health_status == "فقدان طرف")    echo "selected"; ?> >{{__("فقدان طرف") }}</option>
                                        <option value="فقدان عضو" <?php if($member->health_status == "فقدان عضو")    echo "selected"; ?> >{{__("فقدان عضو") }}</option>
                                        <option value="قزم" <?php if($member->health_status == "قزم")    echo "selected"; ?> >{{__("قزم") }}</option>
                                        <option value="قولون عصبي" <?php if($member->health_status == "قولون عصبي")    echo "selected"; ?> >{{__("قولون عصبي") }}</option>
                                        <option value="كلامية - نطق" <?php if($member->health_status == "كلامية - نطق")    echo "selected"; ?> >{{__("كلامية - نطق") }}</option>
                                        <option value="متلازمة داون" <?php if($member->health_status == "متلازمة داون")    echo "selected"; ?> >{{__("متلازمة داون") }}</option>
                                        <option value="مدمن" <?php if($member->health_status == "مدمن")    echo "selected"; ?> >{{__("مدمن") }}</option>
                                        <option value="نحافة شديدة" <?php if($member->health_status == "نحافة شديدة")    echo "selected"; ?> >{{__("نحافة شديدة") }}</option>
                                        <option value="نفسية" <?php if($member->health_status == "نفسية")    echo "selected"; ?> >{{__("نفسية") }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        {{--------- مواصفات شريكة حياتك التي ترغب الإرتباط بها -----------}}
                        <div class="row beauty_top">
                            <h2 class="help">{{__('مواصفات شريكة حياتك التي ترغب الإرتباط بها') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="partner_description" class="mr-sm-2  space_top">{{ __('يرجى الكتابة بطريقة جادة , ,ويمنع كتابة الإيميل أو رقم الجوال في هذا المكان') }} : <span style="color: red"> * </span> </label>
                                    <textarea class="form-control" name="partner_description" rows="5">{{ $member->partner_description }}</textarea>

                                    @error('partner_description')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                        </div>

                        {{--------- تحدث عن نفسك -----------}}
                        <div class="row beauty_top">
                            <h2 class="help">{{__('تحدث عن نفسك') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="your_description" class="mr-sm-2  space_top">{{ __('يرجى الكتابة بطريقة جادة , ,ويمنع كتابة الإيميل أو رقم الجوال في هذا المكان') }} : <span style="color: red"> * </span> </label>
                                    <textarea class="form-control" name="your_description" rows="5">{{ $member->your_description }}</textarea>

                                    @error('your_description')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                        </div>


                        {{--------- البيانات السرية جدا -----------}}
                        <div class="row beauty_top">
                            <h2 class="help">{{__('البيانات السرية جدا') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="full_name" class="mr-sm-2  space_top">{{ __('الاسم الكامل ') }} : <span style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="full_name" value="{{ $member->full_name }}">

                                    @error('full_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="phone" class="mr-sm-2  space_top">{{ __('رقم الجوال ') }} : <span style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="phone"value={{ $member->phone }}>

                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                        </div>


                        <div class="form-group pt-4" style="text-align: center;">
                            {{-- {!! Form::submit( trans('property_trans.submit') , ['class' => 'btn btn-primary']) !!} --}}

                            <button type="submit" class="btn btn-success">{{__('حفظ البيانات') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- @include('pages.admin.members.country_filter') --}}
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

<script>
    $(document).ready(function() {
        $('select[name="country"]').on('change', function() {
            var country = $(this).val();
            if (country) {
                $.ajax({
                    url: "{{ URL::to('getCities') }}/" + country,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option value="' + value + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

@endsection



