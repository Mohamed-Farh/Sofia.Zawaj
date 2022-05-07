@extends('layouts.master')
@section('css')
    @toastr_css

    <link href="{{ asset('app-assets/css/style.css') }}" rel="stylesheet">
@section('title')
    {{ trans('عرض بيانات الأعضاء') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('عرض بيانات الأعضاء') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')






<!-- start search result sec -->
<div class=" search-result py-4 text-center">
    @if ($errors->any())
        <div class="error">{{ $errors->first('Name') }}</div>
    @endif
    <div class="container">
        <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 search-result-col">
                <h3>{{ $member->name }}</h3>
                <p>{{ $member->email }}</p><br>
                <p>{{ $member->phone }}</p>

            </div>



        </div>

    </div>


</div>
<!-- end search result sec -->
<!-- start sidebar-section -->
<div class="sidebar-sec py-4 search-information">
    <div class="container container-1">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 all-result-sec">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="media">

                            <img src="{{url('image/members/'.$member->image)}}" class="___class_+?52___ col-md-3" alt="...">

                            <div class="media-body col-md-6 col-lg-9">

                                <h6 class="mt-0" style="direction: rtl; padding-bottom:unset !important; padding-top:unset !important">{{ $member->name }}</h6>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <h5 class="mt-0">الأسم بالكامل</h5>
                                        <p style="padding-bottom: 15px;">الجنسية : </p>
                                        <!--@if ($member->dual_nationality)-->
                                        <!--    <p style="padding-bottom: 15px;">الجنسية الثانية : </p>-->
                                        <!--@endif-->
                                        <p style="padding-bottom: 15px;">بلد الاقامة : </p>
                                        <p style="padding-bottom: 15px;">المدينة : </p>
                                        <p style="padding-bottom: 15px;">النوع : </p>
                                        <p style="padding-bottom: 15px;">العمر : </p>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <h5 class="mt-0">{{ $member->full_name }}</h5>
                                        <p style="padding-bottom: 15px;">{{ $member->nationality }}</p>
                                        <!--@if ($member->dual_nationality)-->
                                        <!--    <p style="padding-bottom: 15px;">{{ $member->dual_nationality }}</p>-->
                                        <!--@endif-->
                                        <p style="padding-bottom: 15px;">{{ $member->country }}</p>
                                        <p style="padding-bottom: 15px;">{{ $member->city }}</p>
                                        <p style="padding-bottom: 15px;">{{ $member->gender }}</p>
                                        <p style="padding-bottom: 15px;">{{ $member->age }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">

                    </div>

                </div>
                <div class="login-data mt-3">
                    <h5>بيانات العضو</h5>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>الحالة الاجتماعية : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->marital_status }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>نوع الزواج الذي أرغب به : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->marriage_type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p> الديانة : </p>
                                </div>
                                <div class="col">
                                    <p>الدين الاسلامي</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>عدد الأطفال : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->children_number }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p> الاطفال مع : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->children_with }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>   الحالة الصحية : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->health_status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p> الوزن : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->weight }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p> الطول : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->tall }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p> لون البشرة : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->skin }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p> بنية الجسم : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->body_status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p> لون الشعر : </p>
                                </div>
                                <div class="col">
                                    @if ($member->gender == 'ذكر')
                                        <p>{{ $member->hair_color }}</p>
                                    @else
                                        <p>{{__('غير متاح') }}</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p> مستمع للموسيقي : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->listen_music }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>  التدين : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->religiosity }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>  الصلاة : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->pray }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>  التدخين : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->smoke }}</p>
                                </div>
                            </div>
                        </div>

                        @if ($member->gender == 'ذكر')
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                    <div class="col">
                                        <p>  اللحية : </p>
                                    </div>
                                    <div class="col">
                                        <p>{{ $member->beard }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                    <div class="col">
                                        <p>  الحجاب : </p>
                                    </div>
                                    <div class="col">
                                        <p>{{ $member->hegab }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>  المؤهل التعليمي : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->education }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>  نوع المؤهل : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->education_type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>   مجال العمل : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->work_field }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>   الوظيفة : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->work }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>   الدخل الشهري : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->money_month }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="row friend-details" style="margin-right: 0px; width: 100%;">
                                <div class="col">
                                    <p>  الوضع المادي : </p>
                                </div>
                                <div class="col">
                                    <p>{{ $member->money_status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="login-data mt-3">
                    <h5>مواصفات شريك الاحلام</h5>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p class="friend-prop">{{ $member->partner_description }}</p>
                        </div>
                    </div>
                </div>
                <div class="login-data mt-3">
                    <h5>مواصفاتي</h5>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p class="friend-prop">{{ $member->your_description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end sidebar-section -->

<script src="{{ asset('app-assets/js/popper.min.js') }}"></script>
<script src="{{ asset('app-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('app-assets/js/bootstrap.js') }}"></script>

@endsection
