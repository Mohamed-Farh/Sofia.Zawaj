@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('فلترة الاعضاء') }}
@stop


<style type="text/css">
    .ui-selectmenu-button.ui-button {
        width: 100%;
    }

    h2 {
        font-family: "Arial Bold";
        font-size: 280%;
        font-weight: bold;
    }

    .ui-widget {
        font-family: "Arial Bold";
    }

    .form-control {
        font-family: "Arial Bold";
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
        font-family: "Arial Bold";
    }

</style>

@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('فلترة الاعضاء') }}
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
                    <a href="{{ route('members.index') }}">{{ trans('front_trans.return') }}</a>
                </button>
                <br><br>

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

                <div class="card-body">
                    {!! Form::open(['route' => 'members_filter_search', 'method' => 'get']) !!}
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('first_nationality', trans(' الجنسية ')) !!}
                                <select name="first_nationality" class="form-control custom-select selectpicker gender">
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


                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('country', trans(' الدولة ')) !!}
                                <select name="country" class="form-control custom-select selectpicker gender">
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

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('age', trans(' المدينة ')) !!}
                                <select name="city" class="form-control custom-select selectpicker gender">
                                    <select name="city" class="form-control custom-select selectpicker gender">
                                        <option value="0">{{__("اختر---") }}</option>
                                    </select>
                                </select>
                            </div>
                        </div>


                        {{-- ---------------------------------------------------------------------------------------------------- --}}
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('age', trans(' العمر ')) !!}
                                <div class="row">
                                    <div class="col-6">
                                        {!! Form::number('min_age', old('min_age'), ['min'=>'18', 'max'=>'60', 'class' => 'form-control', 'placeholder' => trans('18عام')]) !!} <br>
                                    </div>
                                    <div class="col-6">
                                        {!! Form::number('max_age', old('max_age'), ['min'=>'18', 'max'=>'60', 'class' => 'form-control', 'placeholder' => trans('60عام')]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('tall', trans(' الـطـول ')) !!}
                                <div class="row">
                                    <div class="col-6">
                                        {!! Form::number('min_tall', old('min_tall'), ['min'=>'110', 'max'=>'200', 'class' => 'form-control', 'placeholder' => trans('110')]) !!} <br>
                                    </div>
                                    <div class="col-6">
                                        {!! Form::number('max_tall', old('max_tall'), ['min'=>'110', 'max'=>'200', 'class' => 'form-control', 'placeholder' => trans('200')]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ---------------------------------------------------------------------------------------------------- --}}
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('weight', trans(' الـوزن ')) !!}
                                <div class="row">
                                    <div class="col-6">
                                        {!! Form::number('min_weight', old('min_weight'), ['min'=>'40', 'max'=>'180', 'class' => 'form-control', 'placeholder' => trans('40')]) !!} <br>
                                    </div>
                                    <div class="col-6">
                                        {!! Form::number('max_weight', old('max_weight'), ['min'=>'40', 'max'=>'180', 'class' => 'form-control', 'placeholder' => trans('180')]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('skin', trans('  لون البشرة ')) !!}
                                <select name="skin" class="form-control custom-select selectpicker gender">
                                    <option value=""> {{ __('اختر---') }} </option>
                                        <option value="أبيض">أبيض</option>
                                        <option value="قمحي">قمحي</option>
                                        <option value="أسمر">أسمر</option>
                                        <option value="أسمر غامق">أسمر غامق</option>
                                </select>
                            </div>
                        </div>

                        {{-- ---------------------------------------------------------------------------------------------------- --}}
                        {{-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('marital_status', trans('الحالة الاجتماعية')) !!}
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
                        </div> --}}

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('marriage_type', trans('الزواج المرغوب')) !!}
                                <select name="marriage_type" required class="form-control custom-select selectpicker gender">
                                    <option value="0"> اختر نوع الزواج --- </option>
                                    <option value="الوحيدة">الوحيدة	</option>
                                    <option value="زواج تعدد">زواج تعدد	</option>
                                </select>
                            </select>
                            </div>
                        </div>


                        {{-- ---------------------------------------------------------------------------------------------------- --}}
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('education', trans('المؤهل التعليمي')) !!}
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

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 space_top_filter">
                            <div class="form-group">
                                {!! Form::label('money_month', trans('الدخل الشهري')) !!}
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


                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 28px; text-align:center ">
                            <div class="form-group">
                                {!! Form::button(trans('فـلـتـرة الأعـضـاء'), ['class' => 'btn btn-success property_search', 'type' => 'submit']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
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
