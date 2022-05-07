<!DOCTYPE html>
<html>

<head>
    <title>اعدادات الحساب</title>
    @include('layouts.partials.head')
    @toastr_css

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

    <style>
        .select2-container {
        min-width: 400px;
        }

        .select2-results__option {
        padding-right: 20px;
        vertical-align: middle;
        }
        .select2-results__option:before {
        content: "";
        display: inline-block;
        position: relative;
        height: 20px;
        width: 20px;
        border: 2px solid #e9e9e9;
        border-radius: 4px;
        background-color: #fff;
        margin-right: 20px;
        vertical-align: middle;
        }
        .select2-results__option[aria-selected=true]:before {
        font-family:fontAwesome;
        content: "\f00c";
        color: #fff;
        background-color: #f77750;
        border: 0;
        display: inline-block;
        padding-left: 3px;
        }
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #fff;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #eaeaeb;
            color: #272727;
        }
        .select2-container--default .select2-selection--multiple {
            margin-bottom: 10px;
        }
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            border-radius: 4px;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #f77750;
            border-width: 2px;
        }
        .select2-container--default .select2-selection--multiple {
            border-width: 2px;
        }
        .select2-container--open .select2-dropdown--below {

            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);

        }
        .select2-selection .select2-selection--multiple:after {
            content: 'hhghgh';
        }
        /* select with icons badges single*/
        .select-icon .select2-selection__placeholder .badge {
            display: none;
        }
        .select-icon .placeholder {
        /* 	display: none; */
        }
        .select-icon .select2-results__option:before,
        .select-icon .select2-results__option[aria-selected=true]:before {
            display: none !important;
            /* content: "" !important; */
        }
        .select-icon  .select2-search--dropdown {
            display: none;
        }
        .select2-container--open .select2-dropdown--above {
            text-align: initial !important;
        }
        .select2-container--default .select2-results>.select2-results__options {
            text-align: initial !important;
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
                    <h3>اعدادات الحساب</h3>
                    <p>ضبط اعدادات حسابك بما يتناسب مع استخدامك</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->


    <!-- start sidebar-section -->
    <div class="sidebar-sec py-4 search-information profile-setting-bar">
        <div class="container container-1">
            <div class="row">

                @include('includes.sidebar')


                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <form action="{{ route('update_mysettings') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $member_id }}">

                        <div class="login-data mt-3">
                            <h5>دول الأعضاء الذين اسمح لهم بمراسلتي</h5>
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="profile-form">
                                        <input type="radio" class="radio-sec male-radio profile-radio"
                                            name="who_can_text_me" id="all" value="all" <?php if ($mysettings->who_can_text_me == 'all') { echo 'checked'; } ?> />
                                        <label for="all" class="hidden-entrance male-entrance">السماح للمقيمين بجميع
                                            الدول
                                            بمراسلتي
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="profile-form">
                                        <input type="radio" class="radio-sec male-radio profile-radio"
                                            name="who_can_text_me" id="in_member" value="in_member"
                                            <?php if ($mysettings->who_can_text_me == 'in_member') {
                                                echo 'checked';
                                            } ?> />
                                        <label for="in_member" class="hidden-entrance male-entrance">السماح فقط للمقيمين
                                            بدولتي
                                            بمراسلتي
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- في حالة اختيار دول محددة --}}
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="profile-form">
                                        <input type="radio" name="who_can_text_me" value="some_countries" onclick="showDiv()" style="float: right;
                                            border: 1px solid #efefef;
                                            border-radius: 5px;
                                            height: 34px;
                                            margin-bottom: 10px;
                                            background: #f3f3f3;
                                            border-radius: unset;
                                            height: unset;
                                            margin-bottom: unset;
                                            width: unset"  <?php if ($mysettings->who_can_text_me == 'some_countries') { echo 'checked'; } ?> >
                                        <label for="html" class="hidden-entrance male-entrance">السماح فقط للاعضاء
                                            المقيمين في دول محددة بمراسلتي</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <?php $my_choose_countries = \App\Models\Country_Member_Setting::where(['member_id'=>$mysettings->member_id, 'type'=>'country_text_me'])->pluck('country_name')->toArray(); ?>
                                    <div class="container-msg-1   text-right" id="welcomeDivv" style="{{ $mysettings->who_can_text_me == 'some_countries' ? '' : 'display:none' }}"
                                        class="answer_list">
                                        <div class="container">
                                            <div class="row">
                                            <h4>اختر الدول</h4>
                                                <select class="js-select2 text-right" multiple="multiple" name="text_me_country[]">
                                                    <option data-badge="" value="" style="background-color: grey; color:white" disabled>{{ __('الوطن العربي') }}</option>
                                                    <?php $countries = \App\Models\Country::where('status', 1)
                                                        ->where('arabic', '1')
                                                        ->orderBy('name', 'asc')
                                                        ->get(['id', 'name']); ?>
                                                    @forelse ($countries as $country)
                                                        <option data-badge="" value="{{ $country->name }}"
                                                            <?php if (in_array($country->name, $my_choose_countries)) echo "selected"; ?>  >
                                                            {{ $country->name }}</option>
                                                    @empty
                                                    @endforelse
                                                    <option data-badge="" value="" style="background-color: grey; color:white" disabled>{{ __('باقي دول العالم') }}</option>
                                                    <?php $countries = \App\Models\Country::where('status', 1)
                                                        ->where('arabic', '0')
                                                        ->orderBy('name', 'asc')
                                                        ->get(['id', 'name']); ?>
                                                    @forelse ($countries as $country)
                                                        <option data-badge="" value="{{ $country->name }}"
                                                            <?php if (in_array($country->name, $my_choose_countries)) echo "selected"; ?>  >
                                                            {{ $country->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <script>
                                            $(".js-select2").select2({
                                                closeOnSelect : false,
                                                placeholder : "اختر الدول",
                                                // allowHtml: true,
                                                allowClear: true,
                                                tags: true // создает новые опции на лету
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function showDiv() {
                                    document.getElementById('welcomeDivv').style.display = "block";
                                }
                                var expanded = false;

                                function showCheckboxes() {
                                    var checkboxes = document.getElementById("checkboxes");
                                    if (!expanded) {
                                        checkboxes.style.display = "grid";
                                        expanded = true;
                                    } else {
                                        checkboxes.style.display = "none";
                                        expanded = false;
                                    }
                                }
                            </script>
                        </div>

                        <div class="login-data mt-3">
                            <h5>جنسيات الأعضاء الذين اسمح لهم بمراسلتي</h5>
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="profile-form">
                                        <input type="radio" class="radio-sec male-radio profile-radio"
                                            name="nationality_can_text_me" id="all" value="all" <?php if ($mysettings->nationality_can_text_me == 'all') { echo 'checked'; } ?> />
                                        <label for="all" class="hidden-entrance male-entrance">السماح لجميع الجنسيات
                                            بمراسلتي
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="profile-form">
                                        <input type="radio" class="radio-sec male-radio profile-radio"
                                            name="nationality_can_text_me" id="in_nationality" value="in_nationality"
                                            <?php if ($mysettings->nationality_can_text_me == 'in_nationality') { echo 'checked'; } ?> />
                                        <label for="in_nationality" class="hidden-entrance male-entrance">السماح فقط
                                            للاعضاء من نفس
                                            جنسيتي بمراسلتي
                                        </label>
                                    </div>
                                </div>
                            </div>


                            {{-- في حالة اختيار دول محددة --}}
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="profile-form">
                                        <input type="radio" name="nationality_can_text_me" value="some_nationality" onclick="showDiv2()" style="float: right;
                                            border: 1px solid #efefef;
                                            border-radius: 5px;
                                            height: 34px;
                                            margin-bottom: 10px;
                                            background: #f3f3f3;
                                            border-radius: unset;
                                            height: unset;
                                            margin-bottom: unset;
                                            width: unset"  <?php if ($mysettings->nationality_can_text_me == 'some_nationality') { echo 'checked'; } ?> />
                                        <label for="html" class="hidden-entrance male-entrance">السماح فقط لجنسيات
                                               معينة بمراسلتي</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <?php $my_choose_nationality = \App\Models\Country_Member_Setting::where(['member_id'=>$mysettings->member_id, 'type'=>'nationality_text_me'])->pluck('country_name')->toArray(); ?>
                                    <div class="container-msg-1   text-right" id="welcomeDivv2" style="{{ $mysettings->nationality_can_text_me == 'some_nationality' ? '' : 'display:none' }}"
                                        class="answer_list">
                                        <div class="container">
                                            <div class="row">
                                            <h4>اختر الدول</h4>
                                                <select class="js-select3 text-right" multiple="multiple" name="text_me_nationality[]" >
                                                    <option data-badge="" value="" style="background-color: grey; color:white" disabled>{{ __('الوطن العربي') }}</option>
                                                    <?php $countries = \App\Models\Country::where('status', 1)
                                                        ->where('arabic', '1')
                                                        ->orderBy('name', 'asc')
                                                        ->get(['id', 'name']); ?>
                                                    @forelse ($countries as $country)
                                                        <option data-badge="" value="{{ $country->name }}"
                                                            <?php if (in_array($country->name, $my_choose_nationality)) echo "selected"; ?>  >
                                                            {{ $country->name }}</option>
                                                    @empty
                                                    @endforelse
                                                    <option data-badge="" value="" style="background-color: grey; color:white" disabled>{{ __('باقي دول العالم') }}</option>
                                                    <?php $countries = \App\Models\Country::where('status', 1)
                                                        ->where('arabic', '0')
                                                        ->orderBy('name', 'asc')
                                                        ->get(['id', 'name']); ?>
                                                    @forelse ($countries as $country)
                                                        <option data-badge="" value="{{ $country->name }}"
                                                            <?php if (in_array($country->name, $my_choose_nationality)) echo "selected"; ?>  >
                                                            {{ $country->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <script>
                                            $(".js-select3").select2({
                                                closeOnSelect : false,
                                                placeholder : "اختر الدول",
                                                // allowHtml: true,
                                                allowClear: true,
                                                tags: true // создает новые опции на лету
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function showDiv2() {
                                    document.getElementById('welcomeDivv2').style.display = "block";
                                }
                                var expanded = false;

                                function showCheckboxes() {
                                    var checkboxes = document.getElementById("checkboxes");
                                    if (!expanded) {
                                        checkboxes.style.display = "grid";
                                        expanded = true;
                                    } else {
                                        checkboxes.style.display = "none";
                                        expanded = false;
                                    }
                                }
                            </script>
                        </div>

                        <div class="login-data mt-3">
                            <h5>أعمار الأعضاء الذين اسمح لهم بمراسلتي</h5>
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="profile-form">
                                        <input type="radio" class="radio-sec male-radio profile-radio"
                                            name="age_can_text_me" id="all" value="all" <?php if ($mysettings->age_can_text_me == 'all') {
                                                                                                            echo 'checked';
                                                                                                        } ?> />
                                        <label for="all_member" class="hidden-entrance male-entrance">السماح لأي عضو
                                            بالمراسلة بغض
                                            النظر عن عمره
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="profile-form">
                                        <input type="radio" class="radio-sec male-radio profile-radio"
                                            name="age_can_text_me" id="young_member" value="young_member"
                                            <?php if ($mysettings->age_can_text_me == 'young_member') {
                                                echo 'checked';
                                            } ?> />
                                        <label for="young_member" class="hidden-entrance male-entrance">عدم السماح
                                            بمراسلتي للأعضاء
                                            الأصغر مني عمرا"
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="login-data mt-3">
                            <h5>اعدادات الإشعارات</h5>
                            <div class="row mt-2">
                                <div class="col">
                                    <p style="padding-top: 6px; color: #929394">
                                        من أضافني إلي إهتمامه
                                    </p>
                                </div>
                                <div class="col">
                                    <label class="switch">
                                        <input type="checkbox" name="show_who_care_me" <?php if ($mysettings->show_who_care_me == 'on') {
                                                                                                    echo 'checked';
                                                                                                } ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p style="padding-top: 6px; color: #929394">من زار بياناتي</p>
                                </div>
                                <div class="col">
                                    <label class="switch">
                                        <input type="checkbox" name="show_visit_me" <?php if ($mysettings->show_visit_me == 'on') {
                                                                                    echo 'checked';
                                                                                } ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p style="padding-top: 6px; color: #929394">
                                        من أضافني إلي قائمة التجاهل
                                    </p>
                                </div>
                                <div class="col">
                                    <label class="switch">
                                        <input type="checkbox" name="show_block_me" <?php if ($mysettings->show_block_me == 'on') {
                                                                                                                        echo 'checked';
                                                                                                                    } ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p style="padding-top: 6px; color: #929394">
                                        من حذفني من قائمة التجاهل
                                    </p>
                                </div>
                                <div class="col">
                                    <label class="switch">
                                        <input type="checkbox" name="show_unblock_me" <?php if ($mysettings->show_unblock_me == 'on') {
                                                                                                echo 'checked';
                                                                                            } ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p style="padding-top: 6px; color: #929394">
                                        استلام الرسائل الجديدة
                                    </p>
                                </div>
                                <div class="col">
                                    <label class="switch">
                                        <input type="checkbox" name="show_new_messages" <?php if ($mysettings->show_new_messages == 'on') {
                                                                                                echo 'checked';
                                                                                            } ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p style="padding-top: 6px; color: #929394">القصص الناجحة</p>
                                </div>
                                <div class="col">
                                    <label class="switch">
                                        <input type="checkbox" name="show_success_stories" <?php if ($mysettings->show_success_stories == 'on') {
                                                                                                                    echo 'checked';
                                                                                                                } ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row mt-2">
                                <div class="col">
                                    <p style="padding-top: 6px; color: #929394">استلام هذه الاشعارات علي البريد
                                        الإلكتروني أيضا</p>
                                </div>
                                <div class="col">
                                    <label class="switch">
                                        <input type="checkbox" name="email_send" <?php if ($mysettings->email_send == 'on') {
                                                                                                                echo 'checked';
                                                                                                            } ?> />
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="login-data mt-3">
                            <div class="row mt-2">
                                <div class="col"></div>
                                <div class="col">
                                    <button type="submit">حفظ التعديلات</button>
                                </div>
                                <div class="col"></div>
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

</body>
@jquery
@toastr_js
@toastr_render

</html>
