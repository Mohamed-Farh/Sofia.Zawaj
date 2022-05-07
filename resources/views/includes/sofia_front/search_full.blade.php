<!DOCTYPE html>
<html>

<head>
    {{-- Done --}}
    <title>البحث المتقدم</title>
    @include('layouts.partials.head')
    @toastr_css


    <!-- link for jquery style -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <script src="{{ URL::asset('country-region-dropdown-menu-master/assets/js/geodatasource-cr.js') }}"></script>
    <link rel="stylesheet"
        href="{{ URL::asset('country-region-dropdown-menu-master/assets/css/geodatasource-countryflag.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Strait|Chonburi" rel="stylesheet">

    <!-- link to ar language po file -->
    <link rel="gettext" type="application/x-po"
        href="{{ URL::asset('country-region-dropdown-menu-master/languages/ar/LC_MESSAGES/ar.po') }}" />
    <script type="text/javascript" src="{{ URL::asset('country-region-dropdown-menu-master/assets/js/Gettext.js') }}">
    </script>
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
            font-family: 'Chonburi', cursive;
            font-weight: normal;
        }

        label {
            font-family: Arial Bold;
        }

    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#gds-cr-one").on('change', function() {
                $("#display").html($(this).children("option").filter(":selected").text() + " < " + $(
                        "#countrySelection").children("option").filter(":selected").text() +
                    "لقد قمت باختيار ");

                $("#display_country").html($("#countrySelection").children("option").filter(":selected")
                    .text());
                $("#display_city").html($(this).children("option").filter(":selected").text());

                // document.getElementById('display_country').value = $("#countrySelection").children("option").filter(":selected").text();
            });

        });
    </script>
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
                    <h3>البحث المتقدم</h3>
                    <p>البحث بأدق التفاصيل للحصول على أفضل شريك مناسب لك</p>
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


                <?php
                    $first_nationality = \App\Models\Member::distinct()->get(['nationality']);

                    $dual_nationality  = \App\Models\Member::distinct()->get(['dual_nationality']);

                    $countries         = \App\Models\Member::distinct()->get(['country']);

                    $cities            = \App\Models\Member::distinct()->get(['city']);

                    $skins             = \App\Models\Member::distinct()->get(['skin']);

                    $marital_status    = \App\Models\Member::distinct()->get(['marital_status']);

                    $marriage_type     = \App\Models\Member::distinct()->get(['marriage_type']);

                    $educations        = \App\Models\Member::distinct()->get(['education']);

                    $money_months      = \App\Models\Member::distinct()->get(['money_month']);

                ?>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                    <div class="row mt-2">

                        @if( Auth::guard('member')->check() )
                            <?php
                                $auth_id = Auth::guard('member')->id();
                                $auth_member = App\Models\Member::whereId($auth_id)->first();
                            ?>
                            @if( $auth_member->gender != 'ذكر' )
                                <div class="col">
                                    {!! Form::open(['route' => 'front_male_members_filter_search', 'method' => 'get']) !!}
                                            {!! Form::button(trans('البحث عن زوج'), ['class' => 'search-button', 'type' => 'submit']) !!}
                                    {!! Form::close() !!}
                                </div>
                            @else
                                <div class="col">
                                    {!! Form::open(['route' => 'front_female_members_filter_search', 'method' => 'get']) !!}
                                            {!! Form::button(trans('البحث عن زوجة'), ['class' => 'search-button', 'type' => 'submit']) !!}
                                    {!! Form::close() !!}
                                </div>
                            @endif

                        @else
                                {{------------------------------------  البحث عن زوجة   ------------------------------}}
                                <div class="col">
                                    {!! Form::open(['route' => 'front_female_members_filter_search', 'method' => 'get']) !!}
                                            {!! Form::button(trans('البحث عن زوجة'), ['class' => 'search-button', 'type' => 'submit']) !!}
                                    {!! Form::close() !!}
                                </div>
                                {{------------------------------------  البحث عن زوج   ------------------------------}}
                                <div class="col">
                                    {!! Form::open(['route' => 'front_male_members_filter_search', 'method' => 'get']) !!}
                                            {!! Form::button(trans('البحث عن زوج'), ['class' => 'search-button', 'type' => 'submit']) !!}
                                    {!! Form::close() !!}
                                </div>
                        @endif
                    </div>


                    {{------------------------------------ بحث بكل الاعضاء   ------------------------------}}
                    {!! Form::open(['route' => 'front_members_full_filter_search', 'method' => 'get']) !!}
                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>الجنسية</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <select name="first_nationality" required class="form-control custom-select selectpicker gender">
                                    <option value="0">{{__("اختر---") }}</option>
                                    <option value="" style="background-color: grey; color:white"  disabled>{{__("الوطن العربي") }}</option>
                                    <?php $all_countries = \App\Models\Country::where('status', 1)->where('arabic', '1')->orderBy('name', 'asc')->get(['id', 'name']); ?>
                                    @forelse ($all_countries as $country)
                                        <option value="{{ $country->name }}" {{ old('first_nationality') == $country->name ? 'selected' : null }}>{{ $country->name }}</option>
                                    @empty
                                    @endforelse
                                    <option value="" style="background-color: grey; color:white"  disabled>{{__("باقي دول العالم") }}</option>
                                    <?php $all_countries = \App\Models\Country::where('status', 1)->where('arabic', '0')->orderBy('name', 'asc')->get(['id', 'name']); ?>
                                    @forelse ($all_countries as $country)
                                        <option value="{{ $country->name }}" {{ old('first_nationality') == $country->name ? 'selected' : null }}>{{ $country->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>الاقامة</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <select name="country" required class="form-control custom-select selectpicker gender">
                                    <option value="0">{{__("اختر---") }}</option>
                                    <option value="" style="background-color: grey; color:white"  disabled>{{__("الوطن العربي") }}</option>
                                    <?php $countries = \App\Models\Country::where('status', 1)->where('arabic', '1')->orderBy('name', 'asc')->get(['id', 'name']); ?>
                                    @forelse ($countries as $country)
                                        <option value="{{ $country->name }}" {{ old('country') == $country->name ? 'selected' : null }}>{{ $country->name }}</option>
                                    @empty
                                    @endforelse
                                    <option value="" style="background-color: grey; color:white"  disabled>{{__("باقي دول العالم") }}</option>
                                    <?php $countries = \App\Models\Country::where('status', 1)->where('arabic', '0')->orderBy('name', 'asc')->get(['id', 'name']); ?>
                                    @forelse ($countries as $country)
                                        <option value="{{ $country->name }}" {{ old('country') == $country->name ? 'selected' : null }}>{{ $country->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>المدينة</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <select name="city" class="form-control custom-select selectpicker gender">
                                    <option value="0">{{__("اختر---") }}</option>
                                </select>
                            </div>
                        </div>

                        @if( !Auth::guard('member')->check() )
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>زوج / زوجة</label>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <select name="gender" required class="form-control custom-select selectpicker gender">
                                        <option value="0">{{__("اختر---") }}</option>
                                        <option value="male">زوج</option>
                                        <option value="female">زوجة</option>
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>الديانة</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <input  class="islamic" value="الاسلام" readonly style="width: 75%; text-align:right !important;">
                            </div>
                        </div>

                        @if( Auth::guard('member')->check() )
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <label>الحالة الاجتماعية</label>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                    <select name="marital_status" class="form-control custom-select selectpicker gender">
                                        <option value="0">{{__("اختر---") }}</option>
                                        @if( $auth_member->gender == 'ذكر' )
                                            <option value="أنسة">أنسة</option>
                                            <option value="منفصلة">منفصلة</option>
                                            <option value="أرملة">أرملة</option>
                                        @else
                                            <option value="أعزب">أعزب</option>
                                            <option value="متزوج">متزوج</option>
                                            <option value="منفصل">منفصل</option>
                                            <option value="أرمل">أرمل</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>لون البشرة</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <select name="skin" class="form-control custom-select selectpicker gender">
                                    <option value=""> {{ __('اختر---') }} </option>
                                        <option value="أبيض">أبيض</option>
                                        <option value="قمحي">قمحي</option>
                                        <option value="أسمر">أسمر</option>
                                        <option value="أسمر غامق">أسمر غامق</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-4">
                                {!! Form::label('age', trans(' اخـتـر الـعـمـر ')) !!}
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                {!! Form::number('min_age', old('min_age'), ['min'=>'18', 'max'=>'60', 'class' => 'form-control', 'placeholder' => trans('18عام')]) !!} <br>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <label>الى</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                {!! Form::number('max_age', old('max_age'), ['min'=>'18', 'max'=>'60', 'class' => 'form-control', 'placeholder' => trans('60عام')]) !!}
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-4">
                                {!! Form::label('weight', trans(' اخـتـر الـوزن ')) !!}
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                {!! Form::number('min_weight', old('min_weight'), ['min'=>'40', 'max'=>'180', 'class' => 'form-control', 'placeholder' => trans('40')]) !!} <br>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <label>الى</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                {!! Form::number('max_weight', old('max_weight'), ['min'=>'40', 'max'=>'180', 'class' => 'form-control', 'placeholder' => trans('180')]) !!}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-4">
                                {!! Form::label('tall', trans(' اخـتـر الـطـول ')) !!}
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                {!! Form::number('min_tall', old('min_tall'), ['min'=>'110', 'max'=>'200', 'class' => 'form-control', 'placeholder' => trans('110')]) !!} <br>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                <label>الى</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                                {!! Form::number('max_tall', old('max_tall'), ['min'=>'110', 'max'=>'200', 'class' => 'form-control', 'placeholder' => trans('200')]) !!}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>المؤهل التعليمي</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <select name="education" class="form-control custom-select selectpicker gender">
                                    <option value=""> {{ __('اختر---') }} </option>
                                    <option value="بدون تعليم">{{_("بدون تعليم") }}</option>
                                    <option value="متوسط">{{_("متوسط") }}</option>
                                    {{-- <option value="ثانوي">{{_("ثانوي") }}</option> --}}
                                    <option value="جامعة">{{_("جامعة") }}</option>
                                    <option value="ماجستير ودكتوراه">{{_("ماجستير ودكتوراه") }}</option>
                                    <option value="تعليم ذاتي">{{_("تعليم ذاتي") }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>الدخل الشهري</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <select name="money_month" class="form-control custom-select selectpicker gender">
                                    <option value=""> {{ __('اختر---') }} </option>
                                    <option value="أقل من 500 دولار"> أقل من 500 دولار </option>
                                    <option value="500 - 1000 دولار"> 500 - 1000 دولار </option>
                                    <option value="1000 - 1500 دولار"> 1000 - 1500 دولار </option>
                                    <option value="1500 - 2000 دولار"> 1500 - 2000 دولار </option>
                                    <option value="أكبر من 2000 دولار"> أكبر من 2000 دولار </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <label>الزواج المرغوب</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <select name="marriage_type" class="form-control custom-select selectpicker gender">
                                    <option value=""> {{ __('اختر---') }} </option>
                                    <option value="الوحيدة">الوحيدة	</option>
                                    <option value="زواج تعدد">زواج تعدد	</option>
                                </select>
                            </div>
                        </div>
                        @if( Auth::guard('member')->check() )
                            <?php
                                $auth_id = Auth::guard('member')->id();
                                $auth_member = App\Models\Member::whereId($auth_id)->first();
                            ?>
                            @if( $auth_member->gender == 'ذكر' )
                                <div class="row mt-2">
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                        <input type="hidden" value="أنثي" name="gender">
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        {!! Form::button(trans('ابحث'), ['class' => 'search-button', 'type' => 'submit']) !!}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                                </div>
                            @else
                                <div class="row mt-2">
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                        <input type="hidden" value="ذكر" name="gender">
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        {!! Form::button(trans('ابحث'), ['class' => 'search-button', 'type' => 'submit']) !!}
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                                </div>
                            @endif
                        @else
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                    {!! Form::button(trans('ابحث'), ['class' => 'search-button', 'type' => 'submit']) !!}
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
                            </div>
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- end sidebar-section -->




    @include('layouts.partials.footer')

        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

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
