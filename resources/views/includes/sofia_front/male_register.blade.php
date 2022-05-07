<!DOCTYPE html>
<html>

<head>
    {{-- Done --}}
    <title>التسجيل كذكر</title>
    @include('layouts.partials.head')
    @toastr_css

    <style type="text/css">
        .ui-selectmenu-button.ui-button {
            width: 100%;
        }

        h2 {
            font-family: Arial Bold;
            font-size: 280%;
            font-weight: bold;
        }

        .ui-widget {
            font-family: Arial Bold;
        }

        .form-control {
            font-family: Arial Bold;
            font-size: 1em;
        }

        #display {
            display: block;
            text-align: center;
            font-size: 180%;
            font-family: Arial Bold;
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
                    <h3>التسجيل كذكر</h3>
                    <p>انضم الآن الي فريق عمل صوفيا وأحصل على الشريك المناسب</p>
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
                    <form action="{{ route('member_register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="gender" value="ذكر" class="@error('gender') is-invalid @enderror">
                        <div class="login-data mt-3">
                            <h5>بيانات التسجيل</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">اسم مستعار<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="text" name="name" required
                                        class="@error('name') is-invalid @enderror" />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    <p class="user-name">كلمة المرور<span style="color: red"
                                            class="@error('password') is-invalid @enderror"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="password" name="password" required />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p for="password-confirm" class="user-name">تأكيد كلمة المرور<span
                                            style="color: red"> * </span> </p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input id="password-confirm" type="password" name="password_confirmation" required
                                        autocomplete="new-password"
                                        class="@error('password-confirmation') is-invalid @enderror">
                                    @error('password_cofirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    <input type="text" name="full_name" required
                                        class="@error('full_name') is-invalid @enderror" />
                                    @error('full_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    <input type="email" name="email" required
                                        class="@error('email') is-invalid @enderror" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">رقم الموبايل<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="text" name="phone" required
                                        class="@error('phone') is-invalid @enderror" />
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    <p class="user-name">جنسية<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <?php $countries = \App\Models\Country::where('status', 1)->get(['id', 'name']); ?>
                                    <select name="nationality" required
                                        class="form-control">
                                        <option value="0">{{ __('اختر---') }}</option>
                                        <option value="" style="background-color: grey; color:white" disabled>
                                            {{ __('الوطن العربي') }}</option>
                                        <?php $all_countries = \App\Models\Country::where('status', 1)
                                            ->where('arabic', '1')
                                            ->orderBy('name', 'asc')
                                            ->get(['id', 'name']); ?>
                                        @forelse ($all_countries as $country)
                                            <option value="{{ $country->name }}"
                                                {{ old('nationality') == $country->name ? 'selected' : null }}>
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
                                                {{ old('nationality') == $country->name ? 'selected' : null }}>
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
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        <option value="60+"> {{ __('60+') }} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">حاليا اقيم في دولة<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="country" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0">{{ __('اختر---') }}</option>
                                        <option value="" style="background-color: grey; color:white" disabled>
                                            {{ __('الوطن العربي') }}</option>
                                        <?php $countries = \App\Models\Country::where('status', 1)
                                            ->where('arabic', '1')
                                            ->orderBy('name', 'asc')
                                            ->get(['id', 'name']); ?>
                                        @forelse ($countries as $country)
                                            <option value="{{ $country->name }}"
                                                {{ old('country') == $country->name ? 'selected' : null }}>
                                                {{ $country->name }}</option>
                                        @empty
                                        @endforelse
                                        <option value="" style="background-color: grey; color:white" disabled>
                                            {{ __('باقي دول العالم') }}</option>
                                        <?php $countries = \App\Models\Country::where('status', 1)
                                            ->where('arabic', '0')
                                            ->orderBy('name', 'asc')
                                            ->get(['id', 'name']); ?>
                                        @forelse ($countries as $country)
                                            <option value="{{ $country->name }}"
                                                {{ old('country') == $country->name ? 'selected' : null }}>
                                                {{ $country->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">حاليا اقيم في مدينة<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="city" class="form-control custom-select selectpicker gender">
                                        <option value="0">{{ __('اختر---') }}</option>
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
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="أعزب"> أعزب </option>
                                        <option value="متزوج"> متزوج </option>
                                        <option value="أرمل"> أرمل </option>
                                        <option value="منفصل"> منفصل </option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الزواج المرغوب<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="marriage_type" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="الوحيدة">الوحيدة </option>
                                        <option value="زواج تعدد">زواج تعدد </option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">عدد الأولاد<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="children_number"
                                        class="form-control custom-select selectpicker gender">
                                        <?php
                                        $intial = 1;
                                        $end = 5;
                                        ?>
                                        <option value="0"> {{ __('0') }} </option>
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        <option value="5+">{{ __('5+') }}</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الاطفال مع<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="children_with" required
                                        class="form-control custom-select selectpicker">
                                        <option value="لا يوجد أطفال">لا يوجد أطفال</option>
                                        <option value="معي">معي</option>
                                        <option value="مع الأم">مع الأم</option>
                                        <option value="بين الأب والأم">بين الأب والأم</option>
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
                                    <select name="tall" required
                                        class="form-control custom-select selectpicker gender">
                                        <?php
                                        $intial = 110;
                                        $end = 200;
                                        ?>
                                        {{-- <option value=""> {{ __('-') }} </option> --}}
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        <option value="200+"> {{ __('200+') }} </option>
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
                                        {{-- <option value=""> {{ __('-') }} </option> --}}
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        <option value="180+"> {{ __('180+') }} </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">لون البشرة<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="skin" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="أبيض">أبيض</option>
                                        <option value="قمحي">قمحي</option>
                                        <option value="أسمر">أسمر</option>
                                        <option value="أسمر غامق">أسمر غامق</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">بنية الجسم<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="body_status" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="نحيف">نحيف</option>
                                        <option value="متوسط">متوسط</option>
                                        <option value="رياضي">رياضي</option>
                                        <option value="سمين ">سمين </option>
                                        <option value="ضخم">ضخم</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">لون الشعر<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="hair_color" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="بني">بني</option>
                                        <option value="اسود">اسود</option>
                                        <option value="ابيض">ابيض</option>
                                        <option value="رملي">رملي</option>
                                        <option value="رمادي">رمادي</option>
                                        <option value="الأحمر">الأحمر</option>
                                        <option value="أشقر">أشقر</option>
                                        <option value="ازرق">ازرق</option>
                                        <option value="اخضر">اخضر</option>
                                        <option value="برتقالي">برتقالي</option>
                                        <option value="وردي">وردي</option>
                                        <option value="بنفسجي">بنفسجي</option>
                                        <option value="أصلع جزئيا">أصلع جزئيا</option>
                                        <option value="أصلع تماما">أصلع تماما</option>
                                        <option value="غير ذلك">غير ذلك</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        {{-- الدين --}}
                        <div class="login-data mt-3">
                            <h5>الدين</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name" style="margin-top:10px">الديانة<span style="color: red">
                                            * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <p class="user-name" style="font-weight: 600;" style="padding-bottom: unset;">
                                        <input type="text" value="الاسلام"
                                            style="background-color: white; margin-top: unset;" readonly>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">التدين<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="religiosity" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="متدين كثيرا">{{ __('متدين كثيرا') }}</option>
                                        <option value="متدين">{{ __('متدين') }}</option>
                                        <option value="متدين قليلا">{{ __('متدين قليلا') }}</option>
                                        <option value="غير متدين">{{ __('غير متدين') }}</option>
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
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="دائما">{{ __('دائما') }}</option>
                                        <option value="أغلب الاوقات">{{ __('أغلب الاوقات') }}</option>
                                        <option value="بعض الأوقات">{{ __('بعض الأوقات') }}</option>
                                        <option value="لا أصلي">{{ __('لا أصلي') }}</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">اللحية<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="beard" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="نعم"> نعم </option>
                                        <option value="لا"> لا </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">التدخين<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="smoke" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="نعم"> نعم </option>
                                        <option value="لا"> لا </option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">مستمع للموسيقي<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="listen_music" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="نعم"> نعم </option>
                                        <option value="لا"> لا </option>
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
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="بدون تعليم">{{ _('بدون تعليم') }}</option>
                                        <option value="متوسط">{{ _('متوسط') }}</option>
                                        {{-- <option value="ثانوي">{{ _('ثانوي') }}</option> --}}
                                        <option value="جامعة">{{ _('جامعة') }}</option>
                                        <option value="ماجستير ودكتوراه">{{ _('ماجستير ودكتوراه') }}</option>
                                        <option value="تعليم ذاتي">{{ _('تعليم ذاتي') }}</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">نوع المؤهل<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="text" name="education_type"
                                        style="background-color: white;margin-bottom: 30px; margin-top: unset;">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">مجال العمل<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="work_field" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="قطاع حكومي">{{ __('قطاع حكومي') }}</option>
                                        <option value="قطاع خاص">{{ __('قطاع خاص') }}</option>
                                        <option value="عمل حر">{{ __('عمل حر') }}</option>
                                        <option value="صاحب عمل">{{ __('صاحب عمل') }}</option>
                                        <option value="متقاعد">{{ __('متقاعد') }}</option>
                                        <option value="بدون عمل">{{ __('بدون عمل') }}</option>
                                        <option value="لا زلت أدرس">{{ __('لا زلت أدرس') }}</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الوظيفة<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <input type="text" name="work"
                                        style="background-color: white;margin-bottom: 30px; margin-top: unset;">
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الوضع المادي<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="money_status" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="فقير"> فقير </option>
                                        <option value="أقل من المتوسط"> أقل من المتوسط </option>
                                        <option value="متوسط"> متوسط </option>
                                        <option value="أكبر من المتوسط"> أكبر من المتوسط </option>
                                        <option value="جيد"> جيد </option>
                                        <option value="ميسور"> ميسور </option>
                                        <option value="غني"> غني </option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الدخل الشهري<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="money_month" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="أقل من 500 دولار"> أقل من 500 دولار </option>
                                        <option value="500 - 1000 دولار"> 500 - 1000 دولار </option>
                                        <option value="1000 - 1500 دولار"> 1000 - 1500 دولار </option>
                                        <option value="1500 - 2000 دولار"> 1500 - 2000 دولار </option>
                                        <option value="أكبر من 2000 دولار"> أكبر من 2000 دولار </option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        {{-- الحالة الصحية --}}
                        <div class="login-data mt-3">
                            <h5>الحالة الصحية</h5>
                            <div class="row mt-4">
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الحالة الصحية<span style="color: red"> * </span></p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <select name="health_status" required
                                        class="form-control custom-select selectpicker gender">
                                        {{-- <option value="0"> {{ __('-') }} </option> --}}
                                        <option value="حالتي جيدة الحمدلله"> {{ __('حالتي جيدة الحمدلله') }}
                                        </option>
                                        <option value="اكتئاب"> {{ __('اكتئاب') }} </option>
                                        <option value="انحناء وتقوس"> {{ __('انحناء وتقوس') }} </option>
                                        <option value="انفصام شخصية"> {{ __('انفصام شخصية') }} </option>
                                        <option value="إعاقة بصرية"> {{ __('إعاقة بصرية') }} </option>
                                        <option value="إعاقة حركية"> {{ __('إعاقة حركية') }} </option>
                                        <option value="إعاقة سمعية"> {{ __('إعاقة سمعية') }} </option>
                                        <option value="إعاقة فكرية"> {{ __('إعاقة فكرية') }} </option>
                                        <option value="باطنية"> {{ __('باطنية') }} </option>
                                        <option value="برص"> {{ __('برص') }} </option>
                                        <option value="بهاق"> {{ __('بهاق') }} </option>
                                        <option value="توحد"> {{ __('توحد') }} </option>
                                        <option value="جلدية"> {{ __('جلدية') }} </option>
                                        <option value="حروق مشوهة"> {{ __('حروق مشوهة') }} </option>
                                        <option value="سرطان"> {{ __('سرطان') }} </option>
                                        <option value="سكري"> {{ __('سكري') }} </option>
                                        <option value="سمنة مفرطة"> {{ __('سمنة مفرطة') }} </option>
                                        <option value="شراهة في الأكل"> {{ __('شراهة في الأكل') }} </option>
                                        <option value="شلل أطفال"> {{ __('شلل أطفال') }} </option>
                                        <option value="شلل رباعي"> {{ __('شلل رباعي') }} </option>
                                        <option value="صدفية"> {{ __('صدفية') }} </option>
                                        <option value="صرع"> {{ __('صرع') }} </option>
                                        <option value="صلع"> {{ __('صلع') }} </option>
                                        <option value="ضغط"> {{ __('ضغط') }} </option>
                                        <option value="عجز جنسي"> {{ __('عجز جنسي') }} </option>
                                        <option value="عقم"> {{ __('عقم') }} </option>
                                        <option value="فقدان طرف"> {{ __('فقدان طرف') }} </option>
                                        <option value="فقدان عضو"> {{ __('فقدان عضو') }} </option>
                                        <option value="قزم"> {{ __('قزم') }} </option>
                                        <option value="قولون عصبي"> {{ __('قولون عصبي') }} </option>
                                        <option value="كلامية - نطق"> {{ __('كلامية - نطق') }} </option>
                                        <option value="متلازمة داون"> {{ __('متلازمة داون') }} </option>
                                        <option value="مدمن"> {{ __('مدمن') }} </option>
                                        <option value="نحافة شديدة"> {{ __('نحافة شديدة') }} </option>
                                        <option value="نفسية"> {{ __('نفسية') }} </option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <p class="user-name-hidden">
                                        هل تعاني من حالة صحية خاصة أو مرض معين ؟ أكتب هنا
                                    </p>
                                </div>
                            </div>
                        </div>



                        <div class="login-data mt-3">
                            <h5>مواصفات شريك الاحلام<span style="color: red"> * </span></h5>
                            <p style="padding-bottom: 10px; padding-top: 10px" required>
                                اكتب عن مواصفات شريك أحلامك هنا :
                            </p>
                            <div class="row">
                                <div class="col">
                                    <textarea name="partner_description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="login-data mt-3">
                            <h5>اكتب عن نفسك<span style="color: red"> * </span></h5>
                            <p style="padding-bottom: 10px; padding-top: 10px" required>
                                اكتب عن نفسك هنا
                            </p>
                            <div class="row">
                                <div class="col">
                                    <textarea name="your_description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="last-button text-center mt-2">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4"></div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <button type="submit" style="background: #ff7b54; color: white; font-weight: 600">
                                        تسجيل الان
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
                                $('select[name="city"]').append('<option value="' +
                                    value + '">' + value + '</option>');
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
