<!DOCTYPE html>
<html>

<head>
    {{-- Done --}}
    <title>تعديل بياناتي</title>
    @include('layouts.partials.head')
    @toastr_css

    <style type="text/css">
        .ui-selectmenu-button.ui-button {
            width: 100%;
        }

        h2 {
            font-family: "Strait";
            font-size: 280%;
            font-weight: bold;
        }

        .ui-widget {
            font-family: courier;
        }

        .form-control {
            font-family: courier;
            font-size: 1em;
        }

        #display {
            display: block;
            text-align: center;
            font-size: 180%;
            font-family: 'Chonburi', cursive;
            font-weight: normal;
        }

        label {
            font-family: 'Chonburi';
        }
        .search-information form select {
            width: 100%;
            margin-top: unset !important;
            border: 1px solid #dedede;
            height: 35px;
            border-radius: 4px;
        }
        .search-information label {
            float: right;
            padding: 0 15px;
        }
    </style>

</head>

<body
    style="background-image: url('app-assets/images/Web\ 1920\ –\ 1.png'); background-repeat: no-repeat;background-size: cover;">
    @include('layouts.partials.nav')
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.flash')
        </div>
    </div>


    <!-- start search result sec -->
    <div class="search-result py-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col search-result-col">
                    <h3>تعديل بياناتي</h3>
                    <p>هنا يمكنك تعديل جميع البيانات التي قمت بإدخالها من قبل</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->
    <!-- start sidebar-section -->
    <div class="sidebar-sec py-4 search-information">
        <div class="container container-1">
            <div class="row">

                @include('includes.sidebar')


                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <form action="{{ route('member_update_profile', 'test') }}" method="post" enctype="multipart/form-data">
                        {{ method_field('POST') }}
                        @csrf

                        <input id="id" type="hidden" name="id" class="form-control" value="{{ $member->id }}">

                        <div class="login-data mt-3">
                            <h5>بيانات التسجيل</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">اسم مستعار<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="text" name="name" value="{{ $member->name }}" required/>
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <p class="user-name-hidden">
                                        اسمك المستعار سيظهر لجميع الأعضاء فيجب ان يكون لائق والا
                                        يزيد عن 15 حرف
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">كلمة المرور<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="password" name="password"/>
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p for="password-confirm" class="user-name">تأكيد كلمة المرور<span style="color: red"> * </span> </ح>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password">
                                    @error('password-confirm')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">صورة شخصية (اختياري)</p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="file" name="image">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6"></div>
                            </div>
                        </div>
                        <div class="login-data mt-3">
                            <h5>بيانات خاصة</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الاسم الحقيقي<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="text" name="full_name" value="{{ $member->full_name }}" required/>
                                    @error('full_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <p class="user-name-hidden">
                                        لم تظهر تلك البيانات للأعضاء وستظهر فقط لإدارة الموقع
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">البريد الالكتروني<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="email" name="email" value="{{ $member->email }}" required/>
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">رقم الموبايل<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="text" name="phone" value="{{ $member->phone }}" required />
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <p class="user-name-hidden">
                                        إدخالك لرقم جوالك , سيمكنك من استخدام خدمة "تطبيق صوفيا التي
                                        تتيح لك استقبال وارسال رسائل الجوال
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- البيانات العامة --}}
                        <div class="login-data mt-3">
                            <h5>البيانات العامة</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">حاليا اقيم في دولة<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="country" required class="form-control custom-select selectpicker gender">
                                        {{-- <?php $countries = \App\Models\Country::where('status', 1)->get(['id', 'name']); ?>
                                        <option value="" <?php if($member->country == "")    echo "selected"; ?> >       {{__('---') }} </option>
                                        @forelse ($countries as $country)
                                            <option value="{{ $country->name }}" {{ old('country', $member->country) == $country->name ? 'selected' : null }}>{{ $country->name }}</option>
                                        @empty
                                        @endforelse --}}


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
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">حاليا اقيم في مدينة<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="city" class="form-control  custom-select selectpicker gender"
                                        id="gds-cr-one">
                                        <option value="{{ $member->city }}" {{ old('city') == $member->city ? 'selected' : null }}>{{ $member->city }}</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الجنسية<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
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
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">العمر<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="age" required class="form-control custom-select selectpicker gender">
                                        <?php
                                            $intial = 18;
                                            $end = 60;
                                        ?>
                                        {{-- <option value="0" <?php if($member->age == "0")    echo "selected"; ?> >       {{__('-') }} </option> --}}
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}" <?php if($member->age == $i)    echo "selected"; ?> >{{ $i }}</option>
                                        @endfor
                                        <option value="60+" <?php if($member->age == "60+")    echo "selected"; ?> >{{__("60+") }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>




                        {{-- الحالة الاجتماعية --}}
                        <div class="login-data mt-3">
                            <h5>الحالة الاجتماعية</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الحالة الاجتماعية<span style="color: red">*</span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="marital_status" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->marital_status == "0")    echo "selected"; ?> >       {{__('-') }} </option>

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
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الزواج المرغوب<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="marriage_type" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->marriage_type == "0")    echo "selected"; ?> >       {{__('-') }} </option>
                                        <option value="الوحيدة" <?php if($member->marriage_type == "الوحيدة")    echo "selected"; ?> >الوحيدة</option>
                                        <option value="زواج تعدد" <?php if($member->marriage_type == "زواج تعدد")    echo "selected"; ?> >زواج تعدد</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">عدد الأولاد<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="children_number" required
                                        class="form-control custom-select selectpicker gender">
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
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الاطفال مع<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="children_with" required
                                        class="form-control custom-select selectpicker">
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
                        </div>

                        {{-- البنية الجسدية --}}
                        <div class="login-data mt-3">
                            <h5>البنية الجسدية</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الطول<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
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
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الوزن<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="weight" required
                                        class="form-control custom-select selectpicker gender">
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
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">لون البشرة<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="skin" required class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->skin == "")    echo "selected"; ?> >       {{__('-') }} </option>
                                        <option value="أبيض" <?php if($member->skin == "أبيض")    echo "selected"; ?> >{{__("أبيض") }}</option>
                                        <option value="قمحي" <?php if($member->skin == "قمحي")    echo "selected"; ?> >{{__("قمحي") }}</option>
                                        <option value="أسمر" <?php if($member->skin == "أسمر")    echo "selected"; ?> >{{__("أسمر") }}</option>
                                        <option value="أسمر غامق" <?php if($member->skin == "أسمر غامق")    echo "selected"; ?> >{{__("أسمر غامق") }}</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">بنية الجسم<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="body_status" required
                                        class="form-control custom-select selectpicker gender">
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

                            <div class="row mt-4">
                                @if ($member->hair_color != null && $member->gender == 'ذكر')
                                    <div class="col-xs-12 col-sm-12 col-md-2">
                                        <p class="user-name">لون الشعر<span style="color: red"> * </span></p>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
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
                                @endif
                            </div>
                        </div>



                        {{-- الدين --}}
                        <div class="login-data mt-3">
                            <h5>الدين</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name"style="margin-top:10px">الديانة<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <p class="user-name" style="font-weight: 600;" style="padding-bottom: unset;">
                                        <input type="text" value="الاسلام" style="background-color: white; margin-top: unset;" readonly>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">التدين<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="religiosity" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->religiosity == "")    echo "selected"; ?> >       {{__('-') }} </option>
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

                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الصلاة<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="pray" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->pray == "")    echo "selected"; ?> >       {{__('-') }} </option>
                                        <option value="دائما" <?php if($member->pray == "دائما")    echo "selected"; ?> >         دائما      </option>
                                        <option value="أغلب الاوقات" <?php if($member->pray == "أغلب الاوقات")    echo "selected"; ?> >           أغلب الاوقات      </option>
                                        <option value="بعض الأوقات" <?php if($member->pray == "بعض الأوقات")    echo "selected"; ?> >         بعض الأوقات      </option>
                                        <option value="لا أصلي" <?php if($member->pray == "لا أصلي")    echo "selected"; ?> >         لا أصلي      </option>
                                    </select>
                                </div>

                                @if ($member->beard != null && $member->gender == 'ذكر')
                                    <div class="col-xs-12 col-sm-12 col-md-2">
                                        <p class="user-name">اللحية<span style="color: red"> * </span></p>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <select name="beard" required
                                            class="form-control custom-select selectpicker gender">
                                            <option value="" <?php if($member->beard == "")    echo "selected"; ?> >       {{__('-') }} </option>
                                            <option value="نعم" <?php if($member->beard == "نعم")    echo "selected"; ?> >         نعم      </option>
                                            <option value="لا" <?php if($member->beard == "لا")    echo "selected"; ?> >          لا      </option>
                                        </select>
                                    </div>
                                @elseif ($member->gender != 'ذكر')
                                    <div class="col-xs-12 col-sm-12 col-md-2">
                                        <p class="user-name">الـحـجـاب<span style="color: red"> * </span></p>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <select name="hegab" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->hegab == "")    echo "selected"; ?> >       {{__('-') }} </option>
                                        <option value="منقبة" <?php if($member->hegab == "منقبة")    echo "selected"; ?> >         منقبة      </option>
                                        <option value="محجبة" <?php if($member->hegab == "محجبة")    echo "selected"; ?> >          محجبة      </option>
                                        <option value="غير محجبة" <?php if($member->hegab == "غير محجبة")    echo "selected"; ?> >          غير محجبة      </option>
                                    </select>
                                    </div>
                                @endif
                            </div>

                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">التدخين<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="smoke" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->smoke == "")    echo "selected"; ?> >       {{__('-') }} </option>
                                        <option value="نعم" <?php if($member->smoke == "نعم")    echo "selected"; ?> >         نعم      </option>
                                        <option value="لا" <?php if($member->smoke == "لا")    echo "selected"; ?> >          لا      </option>
                                    </select>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">مستمع للموسيقي<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="listen_music" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->listen_music == "")    echo "selected"; ?> > {{ __('-') }} </option>
                                        <option value="نعم" <?php if($member->listen_music == "نعم")    echo "selected"; ?> > نعم </option>
                                        <option value="احيانا" <?php if($member->listen_music == "احيانا")    echo "selected"; ?> > احيانا </option>
                                        <option value="لا" <?php if($member->listen_music == "لا")    echo "selected"; ?> > لا </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- بيانات أخرى --}}
                        <div class="login-data mt-3">
                            <h5>بيانات أخرى</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">المستوى التعليمي<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="education" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->education == "0")    echo "selected"; ?> >       {{__('-') }} </option>
                                        <option value="بدون تعليم" <?php if($member->education == "بدون تعليم")    echo "selected"; ?> >{{_("بدون تعليم") }}</option>
                                        <option value="متوسط" <?php if($member->education == "متوسط")    echo "selected"; ?> >{{_("متوسط") }}</option>
                                        {{-- <option value="ثانوي" <?php if($member->education == "ثانوي")    echo "selected"; ?> >{{_("ثانوي") }}</option> --}}
                                        <option value="جامعة" <?php if($member->education == "جامعة")    echo "selected"; ?> >{{_("جامعة") }}</option>
                                        <option value="ماجستير ودكتوراه" <?php if($member->education == "ماجستير ودكتوراه")    echo "selected"; ?> >{{_("ماجستير ودكتوراه") }}</option>
                                        <option value="تعليم ذاتي" <?php if($member->education == "تعليم ذاتي")    echo "selected"; ?> >{{_("تعليم ذاتي") }}</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">نوع المؤهل<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="text" name="education_type" style="background-color: white;margin-bottom: 30px; margin-top: unset;" value="{{ $member->education_type }}" required>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">مجال العمل<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="work_field" required
                                        class="form-control custom-select selectpicker gender">
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

                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الوظيفة<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="text" name="work" style="background-color: white;margin-bottom: 30px; margin-top: unset;" value="{{ $member->work }}" required>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الوضع المادي<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="money_status" required
                                        class="form-control custom-select selectpicker gender">
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
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الدخل الشهري<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="money_month" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="" <?php if($member->money_month == "")    echo "selected"; ?> >       {{__('دخلك الشهري') }} </option>
                                        <option value="أقل من 500 دولار" <?php if($member->money_month == "أقل من 500 دولار")    echo "selected"; ?> >            أقل من 500 دولار      </option>
                                        <option value="500 - 1000 دولار" <?php if($member->money_month == "500 - 1000 دولار")    echo "selected"; ?> >           500 - 1000 دولار      </option>
                                        <option value="1000 - 1500 دولار" <?php if($member->money_month == "1000 - 1500 دولار")    echo "selected"; ?> >           1000 - 1500 دولار      </option>
                                        <option value="1500 - 2000 دولار" <?php if($member->money_month == "1500 - 2000 دولار")    echo "selected"; ?> >           1500 - 2000 دولار      </option>
                                        <option value="أكبر من 2000 دولار" <?php if($member->money_month == "أكبر من 2000 دولار")    echo "selected"; ?> >            أكبر من 2000 دولار      </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- الحالة الصحية--}}
                        <div class="login-data mt-3">
                            <h5>الحالة الصحية</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الحالة الصحية<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="health_status" required
                                        class="form-control custom-select selectpicker gender">
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


                        <div class="login-data mt-3">
                            <h5>مواصفات شريك الاحلام<span style="color: red"> * </span></h5>
                            <p style="padding-bottom: 10px; padding-top: 10px">
                                 اكتب عن مواصفات شريك أحلامك هنا :
                            </p>
                            <div class="row">
                                <div class="col">
                                    <textarea name="partner_description">{{ $member->partner_description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="login-data mt-3">
                            <h5>اكتب عن نفسك<span style="color: red"> * </span></h5>
                            <p style="padding-bottom: 10px; padding-top: 10px">
                                اكتب عن نفسك هنا
                            </p>
                            <div class="row">
                                <div class="col">
                                    <textarea name="your_description">{{ $member->your_description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="last-button text-center mt-2">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4"></div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <button type="submit" style="background: #ff7b54; color: white; font-weight: 600">
                                        تعديل البيانات
                                    </button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end sidebar-section -->




    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

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

</body>
@jquery
@toastr_js
@toastr_render

</html>
