@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('اضافة ' . $add_type) }}
@stop

{{-- <style type="text/css">
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

</style> --}}

@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('اضافة ' . $add_type) }}
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
                    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row beauty_top">
                            <h2 class="help">{{ __('بيانات الدخول') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="mr-sm-2  space_top">{{ __('الاســم') }} : <span
                                            style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="name">

                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email" class="mr-sm-2">{{ __('البريد الالكتروني') }} : <span
                                            style="color: red"> * </span> </label>
                                    <input type="email" class="form-control" name="email">

                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password" class="mr-sm-2">{{ __('كلمة المرور') }} : <span
                                            style="color: red"> * </span> </label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password') <span class="invalid-feedback"
                                        role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="password-confirm"
                                        class="mr-sm-2">{{ __('تأكيد كلمة المرور') }} : <span
                                            style="color: red"> * </span> </label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">

                                    {{-- @error('email')<span class="text-danger">{{ $message }}</span>@enderror --}}
                                </div>
                            </div>
                            <br><br><br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="gender" class="mr-sm-2  space_top">{{ __('نوع (ذكر / أنثي)') }} : <span style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="gender" value="{{ $gender }}" readonly>
                                    @error('gender')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="image" class="mr-sm-2  space_top">{{ __('الصورة الشخصية') }} : </label>
                                <input type="file" class="form-control" name="image">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        {{-- ------- الجنسية والإقامة --------- --}}
                        <div class="row beauty">
                            <h2 class="help">{{ __('الجنسية والإقامة') }}</h2>


                            <div class="form-group col-6">
                                <label class="col-sm-2 control-label">الجنسية  : <span style="color: red"> * </span> </label>
                                <div class="col-sm-12">
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
                            </div>
                            <br><br>


                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label class="col-sm-2 control-label">بلد  : <span style="color: red"> * </span> </label>
                                        <div class="col-sm-12">
                                            <?php $countries = \App\Models\Country::get(['id', 'name']); ?>
                                            <select name="country" required class="form-control custom-select selectpicker gender">
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
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="gds-cr-one"  name ="city" class="col-sm-2 control-label">منطقة  : <span style="color: red"> * </span> </label>
                                        <div class="col-sm-12">
                                            <select name="city" class="form-control custom-select selectpicker gender">
                                                <option value="0">{{__("اختر---") }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>



                        {{-- ------- الحالة الإجتماعية --------- --}}
                        <div class="row beauty">
                            <h2 class="help">{{ __('الحالة الإجتماعية') }}</h2>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="marriage_type" class="mr-sm-2  space_top">{{ __('الزواج المرغوب') }} :
                                        <span style="color: red"> * </span> </label>
                                    <select name="marriage_type" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0"> {{ __('اختر نوع الزواج') }} </option>
                                        <option value="الوحيدة">الوحيدة	</option>
                                        <option value="زواج تعدد">زواج تعدد	</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="marital_status"
                                        class="mr-sm-2  space_top">{{ __('الحالة الإجتماعية') }} : <span
                                            style="color: red"> * </span> </label>
                                    <select name="marital_status" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0"> {{ __('اختر الحالة الإجتماعية ') }} </option>
                                        @if ($gender == 'ذكر')
                                            <option value="أعزب"> أعزب </option>
                                            <option value="متزوج"> متزوج </option>
                                            <option value="أرمل"> أرمل </option>
                                            <option value="منفصل"> منفصل </option>
                                        @else
                                            <option value="أنسة">أنسة</option>
                                            <option value="أرملة">أرملة</option>
                                            <option value="منفصلة">منفصلة</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="age" class="mr-sm-2  space_top">{{ __('العمر') }} : <span
                                            style="color: red"> * </span> </label>
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
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="children_number" class="mr-sm-2  space_top">{{ __('عدد الأولاد') }} :
                                        <span style="color: red"> * </span> </label>
                                    <select name="children_number" required
                                        class="form-control custom-select selectpicker gender">
                                        <?php
                                        $intial = 1;
                                        $end = 5;
                                        ?>
                                        <option value="no"> {{ __('اختر عدد الاطفال ') }} </option>
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        <option value="5+">{{__('5+') }}</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="children_with" class="mr-sm-2  space_top">{{ __('الاطفال مع') }} :
                                        <span style="color: red"> * </span> </label>
                                    <select name="children_with" required
                                        class="form-control custom-select selectpicker">
                                        <option value="0"> {{ __('-') }} </option>
                                        <option value="لا يوجد أطفال">لا يوجد أطفال</option>
                                        <option value="معي">معي</option>
                                        @if ($gender == 'ذكر')
                                            <option value="مع الأم">مع الأم</option>
                                        @else
                                            <option value="مع الأب">مع الأب</option>
                                        @endif
                                        <option value="بين الأب والأم">بين الأب والأم</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                        </div>



                        {{-- ------- البنية الجسدية  --------- --}}
                        <div class="row beauty">
                            <h2 class="help">{{ __('البنية الجسدية ') }}</h2>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="weight" class="mr-sm-2  space_top">{{ __('الوزن (كغ)') }} : <span
                                            style="color: red"> * </span> </label>
                                    <select name="weight" required
                                        class="form-control custom-select selectpicker gender">
                                        <?php
                                            $intial = 40;
                                            $end = 180;
                                        ?>
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        <option value="180+"> {{ __('180+') }} </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tall" class="mr-sm-2  space_top">{{ __('الطول (سم)') }} : <span
                                            style="color: red"> * </span> </label>
                                    <select name="tall" required class="form-control custom-select selectpicker gender">
                                        <?php
                                            $intial = 110;
                                            $end = 200;
                                        ?>
                                        <option value=""> {{ __('ما هو طولك ؟') }} </option>
                                        @for ($i = $intial; $i <= $end; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        <option value="200+"> {{ __('200+') }} </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="skin" class="mr-sm-2  space_top">{{ __('لون البشرة') }} : <span
                                            style="color: red"> * </span> </label>
                                    <select name="skin" required class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('اختر لون بشرتك ؟  ') }} </option>
                                        <option value="أبيض">أبيض</option>
                                        <option value="قمحي">قمحي</option>
                                        <option value="أسمر">أسمر</option>
                                        <option value="أسمر غامق">أسمر غامق</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="body_status" class="mr-sm-2  space_top">{{ __('بنية الجسم ') }} :
                                        <span style="color: red"> * </span> </label>
                                    <select name="body_status" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('اختر بنية جسمك ؟  ') }} </option>
                                        <option value="نحيف">نحيف</option>
                                        <option value="متوسط">متوسط</option>
                                        <option value="رياضي">رياضي</option>
                                        <option value="سمين ">سمين </option>
                                        <option value="ضخم">ضخم</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>

                            @if ($gender == 'ذكر')
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="hair_color" class="mr-sm-2  space_top">{{ __('لون الشعر') }} : <span
                                                style="color: red"></span> </label>
                                        <select name="hair_color" class="form-control custom-select selectpicker gender">
                                            <option value="0"> {{ __('-') }} </option>
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
                                <br><br>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="beard" class="mr-sm-2  space_top">{{ __('اللحية') }} : <span
                                                style="color: red"></span> </label>
                                        <select name="beard"
                                            class="form-control custom-select selectpicker gender">
                                            <option value="0"> {{ __('-') }} </option>
                                            <option value="نعم"> نعم </option>
                                            <option value="لا"> لا </option>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                            @else
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="hegab" class="mr-sm-2  space_top">{{ __('الـحـجـاب') }} : <span
                                                style="color: red"></span> </label>
                                        <select name="hegab" class="form-control custom-select selectpicker gender">
                                            <option value="0"> {{ __('-') }} </option>
                                            <option value="منقبة"> منقبة </option>
                                            <option value="محجبة"> محجبة </option>
                                            <option value="غير محجبة"> غير محجبة </option>
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                            @endif
                        </div>
                        {{-- ------- الالتزام الديني --------- --}}
                        <div class="row beauty">
                            <h2 class="help">{{ __('الالتزام الديني') }}</h2>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="religiosity" class="mr-sm-2  space_top">{{ __('التدين ') }} : <span
                                            style="color: red"> * </span> </label>
                                    <select name="religiosity" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0"> {{ __('--اختر--') }} </option>
                                        @if ($gender == 'ذكر')
                                            <option value="متدين كثيرا">{{__("متدين كثيرا") }}</option>
                                            <option value="متدين">{{__("متدين") }}</option>
                                            <option value="متدين قليلا">{{__("متدين قليلا") }}</option>
                                            <option value="غير متدين">{{__("غير متدين") }}</option>
                                        @else
                                            <option value="متدينة كثيرا">{{__("متدينة كثيرا") }}</option>
                                            <option value="متدينة">{{__("متدينة") }}</option>
                                            <option value="متدينة قليلا">{{__("متدينة قليلا") }}</option>
                                            <option value="غير متدينة">{{__("غير متدينة") }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pray" class="mr-sm-2  space_top">{{ __('الصلاة ') }} : <span
                                            style="color: red"> * </span> </label>
                                    <select name="pray" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0"> {{ __('--اختر--') }} </option>
                                        <option value="دائما">{{__("دائما") }}</option>
                                        <option value="أغلب الاوقات">{{__("أغلب الاوقات") }}</option>
                                        <option value="بعض الأوقات">{{__("بعض الأوقات") }}</option>
                                        <option value="لا أصلي">{{__("لا أصلي") }}</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="smoke" class="mr-sm-2  space_top">{{ __('التدخين') }} : <span
                                            style="color: red"> * </span> </label>
                                    <select name="smoke" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0"> {{ __('--اختر--') }} </option>
                                        <option value="نعم"> نعم </option>
                                        <option value="لا"> لا </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="listen_music" class="mr-sm-2  space_top">{{ __('مستمع للموسيقي') }} : <span
                                            style="color: red"> * </span> </label>
                                    <select name="listen_music" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0"> {{ __('--اختر--') }} </option>
                                        <option value="نعم"> نعم </option>
                                        <option value="احيانا"> احيانا </option>
                                        <option value="لا"> لا </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                        </div>


                        {{-- ------- الدراسة والعمل --------- --}}
                        <div class="row beauty">
                            <h2 class="help">{{ __('الدراسة والعمل') }}</h2>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="education" class="mr-sm-2  space_top">{{ __('المؤهل التعليمي ') }} :
                                        <span style="color: red"> * </span> </label>
                                    <select name="education" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0"> {{ __('اختر المؤهل التعليمي') }} </option>
                                        <option value="بدون تعليم">{{_("بدون تعليم") }}</option>
                                        <option value="متوسط">{{_("متوسط") }}</option>
                                        {{-- <option value="ثانوي">{{_("ثانوي") }}</option> --}}
                                        <option value="جامعة">{{_("جامعة") }}</option>
                                        <option value="ماجستير ودكتوراه">{{_("ماجستير ودكتوراه") }}</option>
                                        <option value="تعليم ذاتي">{{_("تعليم ذاتي") }}</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="education_type" class="mr-sm-2  space_top">{{ __('نوع المؤهل') }} :
                                        <span style="color: red"> * </span> </label>
                                    <input type="text" name="education_type" class="form-control">
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="money_status" class="mr-sm-2  space_top">{{ __('الوضع المادي ') }} :
                                        <span style="color: red"> * </span> </label>
                                    <select name="money_status" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0"> {{ __('وضعك المادي') }} </option>
                                        <option value="فقير"> فقير </option>
                                        <option value="أقل من المتوسط"> أقل من المتوسط </option>
                                        <option value="متوسط"> متوسط </option>
                                        <option value="أكبر من المتوسط"> أكبر من المتوسط </option>
                                        <option value="جيد"> جيد </option>
                                        <option value="ميسور"> ميسور </option>
                                        <option value="غني"> غني </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="work_field" class="mr-sm-2  space_top">{{ __('مجال العمل') }} :
                                        <span style="color: red"> * </span> </label>
                                    <select name="work_field" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value=""> {{ __('-') }} </option>
                                        <option value="قطاع حكومي">{{__("قطاع حكومي") }}</option>
                                        <option value="قطاع خاص">{{__("قطاع خاص") }}</option>
                                        <option value="عمل حر">{{__("عمل حر") }}</option>
                                        @if ($gender == 'ذكر')
                                            <option value="صاحب عمل">{{__("صاحب عمل") }}</option>
                                            <option value="متقاعد">{{__("متقاعد") }}</option>
                                        @else
                                            <option value="صاحبة عمل">{{__("صاحبة عمل") }}</option>
                                            <option value="متقاعدة">{{__("متقاعدة") }}</option>
                                        @endif
                                        <option value="بدون عمل">{{__("بدون عمل") }}</option>
                                        <option value="لا زلت أدرس">{{__("لا زلت أدرس") }}</option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="work" class="mr-sm-2  space_top">{{ __('الوظيفة') }} : <span
                                            style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="work">

                                    @error('work')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="money_month" class="mr-sm-2  space_top">{{ __('الدخل الشهري') }} :
                                        <span style="color: red"> * </span> </label>
                                    <select name="money_month" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0"> {{ __('دخلك الشهري') }} </option>
                                        <option value="أقل من 500 دولار"> أقل من 500 دولار </option>
                                        <option value="500 - 1000 دولار"> 500 - 1000 دولار </option>
                                        <option value="1000 - 1500 دولار"> 1000 - 1500 دولار </option>
                                        <option value="1500 - 2000 دولار"> 1500 - 2000 دولار </option>
                                        <option value="أكبر من 2000 دولار"> أكبر من 2000 دولار </option>
                                    </select>
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="health_status" class="mr-sm-2  space_top">{{ __('الحالة الصحية') }}
                                        : <span style="color: red"> * </span> </label>
                                    <select name="health_status" required
                                        class="form-control custom-select selectpicker gender">
                                        <option value="0"> {{ __('حالتك الصحية') }} </option>
                                        <option value="حالتي جيدة الحمدلله" > {{__("حالتي جيدة الحمدلله") }} </option>
                                        <option value="اكتئاب" > {{__("اكتئاب") }} </option>
                                        <option value="انحناء وتقوس" > {{__("انحناء وتقوس") }} </option>
                                        <option value="انفصام شخصية" > {{__("انفصام شخصية") }} </option>
                                        <option value="إعاقة بصرية" > {{__("إعاقة بصرية") }} </option>
                                        <option value="إعاقة حركية" > {{__("إعاقة حركية") }} </option>
                                        <option value="إعاقة سمعية" > {{__("إعاقة سمعية") }} </option>
                                        <option value="إعاقة فكرية" > {{__("إعاقة فكرية") }} </option>
                                        <option value="باطنية" > {{__("باطنية") }} </option>
                                        <option value="برص" > {{__("برص") }} </option>
                                        <option value="بهاق" > {{__("بهاق") }} </option>
                                        <option value="توحد" > {{__("توحد") }} </option>
                                        <option value="جلدية" > {{__("جلدية") }} </option>
                                        <option value="حروق مشوهة" > {{__("حروق مشوهة") }} </option>
                                        <option value="سرطان" > {{__("سرطان") }} </option>
                                        <option value="سكري" > {{__("سكري") }} </option>
                                        <option value="سمنة مفرطة" > {{__("سمنة مفرطة") }} </option>
                                        <option value="شراهة في الأكل" > {{__("شراهة في الأكل") }} </option>
                                        <option value="شلل أطفال" > {{__("شلل أطفال") }} </option>
                                        <option value="شلل رباعي" > {{__("شلل رباعي") }} </option>
                                        <option value="صدفية" > {{__("صدفية") }} </option>
                                        <option value="صرع" > {{__("صرع") }} </option>
                                        <option value="صلع" > {{__("صلع") }} </option>
                                        <option value="ضغط" > {{__("ضغط") }} </option>
                                        <option value="عجز جنسي" > {{__("عجز جنسي") }} </option>
                                        <option value="عقم" > {{__("عقم") }} </option>
                                        <option value="فقدان طرف" > {{__("فقدان طرف") }} </option>
                                        <option value="فقدان عضو" > {{__("فقدان عضو") }} </option>
                                        <option value="قزم" > {{__("قزم") }} </option>
                                        <option value="قولون عصبي" > {{__("قولون عصبي") }} </option>
                                        <option value="كلامية - نطق" > {{__("كلامية - نطق") }} </option>
                                        <option value="متلازمة داون" > {{__("متلازمة داون") }} </option>
                                        <option value="مدمن" > {{__("مدمن") }} </option>
                                        <option value="نحافة شديدة" > {{__("نحافة شديدة") }} </option>
                                        <option value="نفسية" > {{__("نفسية") }} </option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        {{-- ------- مواصفات شريكة حياتك التي ترغب الإرتباط بها --------- --}}
                        <div class="row beauty_top">
                            <h2 class="help">{{ __('مواصفات شريكة حياتك التي ترغب الإرتباط بها') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="partner_description"
                                        class="mr-sm-2  space_top">{{ __('يرجى الكتابة بطريقة جادة , ,ويمنع كتابة الإيميل أو رقم الجوال في هذا المكان') }}
                                        : <span style="color: red"> * </span> </label>
                                    <textarea class="form-control" name="partner_description" rows="5"></textarea>

                                    @error('partner_description')<span
                                        class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                        </div>

                        {{-- ------- تحدث عن نفسك --------- --}}
                        <div class="row beauty_top">
                            <h2 class="help">{{ __('تحدث عن نفسك') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="your_description"
                                        class="mr-sm-2  space_top">{{ __('يرجى الكتابة بطريقة جادة , ,ويمنع كتابة الإيميل أو رقم الجوال في هذا المكان') }}
                                        : <span style="color: red"> * </span> </label>
                                    <textarea class="form-control" name="your_description" rows="5"></textarea>

                                    @error('your_description')<span
                                        class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                        </div>


                        {{-- ------- البيانات السرية جدا --------- --}}
                        <div class="row beauty_top">
                            <h2 class="help">{{ __('البيانات السرية جدا') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="full_name" class="mr-sm-2  space_top">{{ __('الاسم الكامل ') }} :
                                        <span style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="full_name">

                                    @error('full_name')<span
                                        class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="phone" class="mr-sm-2  space_top">{{ __('رقم الجوال ') }} : <span
                                            style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="phone">

                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                        </div>


                        <div class="form-group pt-4" style="text-align: center;">
                            {{-- {!! Form::submit( trans('property_trans.submit') , ['class' => 'btn btn-primary']) !!} --}}

                            <button type="submit" class="btn btn-success">{{ __('حفظ البيانات') }}</button>
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
