<!DOCTYPE html>
<html>

<head>
    <title>{{ $member->name }}</title>
    @include('layouts.partials.head')
    @toastr_css

    <style>
        p.user-name {
            color: #ff7b54;
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
    <div class=" search-result py-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col search-result-col">
                    <h3>{{ $member->name }}</h3>
                    <p>{{ $member->email }}</p>
                    <p>بـيـانـاتـي</p>
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
                    <div class="row mt-4">
                        <div class="col-xs-12 col-sm-12 col-md-8 mt-2">
                            <div class="card" style="width: 100%; border: unset; border-radius: 5px">
                                <div class="media" style="background: #f9f9f9">
                                    <img src="{{url('image/members/'.$member->image)}}" class="___class_+?38___" alt="..."  style="height: 140px"/>
                                    <div class="media-body">
                                        <h6 class="member_profile">{{ $member->name }}</h6>
                                        <h6 class="member_profile">العمر : {{ $member->age }}</h6>
                                        <h6 class="member_profile">أقيم في : {{ $member->country }}</h6>
                                        <h6 class="member_profile">الجنسية : {{ $member->nationality }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 mt-2">
                            <h5>
                                <a href="{{ route('edit_myprofile_page', $member) }}" style="color: #ff7b54"><i
                                        class="fas fa-edit" style="color: #ff7b54; padding-left: 5px"></i>تعديل</a>
                            </h5>
                        </div>
                    </div>
                                        <div class="login-data mt-3">
                        <h5>البيانات العامة</h5>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الجنسية</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->nationality }}</p>
                            </div>
                            <!--<div class="col-xs-12 col-sm-12 col-md-2">-->
                            <!--    <p class="user-name">الجنسية الثانية</p>-->
                            <!--</div>-->
                            <!--<div class="col-xs-12 col-sm-12 col-md-4">-->
                            <!--    @if ($member->dual_nationality)-->
                            <!--        <p>{{ $member->dual_nationality }}</p>-->
                            <!--    @else-->
                            <!--        <p> لا يوجد </p>-->
                            <!--    @endif-->
                            <!--</div>-->
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">انا من</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->country }}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">اقيم في</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->city }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="login-data mt-3">
                        <h5>الحالة الاجتماعية</h5>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الحالة الاجتماعية</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->marital_status }}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الزواج المرغوب</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->marriage_type }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">عدد الأطفال</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->children_number }}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الاطفال مع</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->children_with }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="login-data mt-3">
                        <h5>البنية الجسدية</h5>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">العمر</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->age }}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الطول</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->tall }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الوزن</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->weight }}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">البنية الجسدية</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->health_status }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">لون البشرة</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->skin }}</p>
                            </div>
                            @if ($member->gender == 'ذكر')
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">لون الشعر</p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <p>{{ $member->hair_color }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="login-data mt-3">
                        <h5>التدين</h5>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الديانة</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>الاسلام</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">التدين</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->religiosity }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الصلاة</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->pray }}</p>
                            </div>
                            @if ($member->gender == 'ذكر')
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">اللحية</p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <p>{{ $member->beard }}</p>
                                </div>
                            @else
                                <div class="col-xs-12 col-sm-12 col-md-2">
                                    <p class="user-name">الحجاب</p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                    <p>{{ $member->hegab }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">التدخين</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->smoke }}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">مستمع للاغاني</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->listen_music }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="login-data mt-3">
                        <h5>بيانات الدراسة والتعليم</h5>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">المستوى التعليمي</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->education }}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">نوع المؤهل</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->education_type }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">مجال العمل</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->work_field }}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الوظيفة</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->work }}</p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الوضع المادي</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->money_status }}</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الدخل الشهري</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->money_month }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="login-data mt-3">
                        <h5>الحالة الصحية</h5>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <p class="user-name">الحالة الصحية</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p>{{ $member->health_status }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="login-data mt-3">
                        <h5 style="padding-bottom: 10px">مواصفات شريك الاحلام</h5>
                        <div class="row">
                            <div class="col">
                                <p >{{ $member->partner_description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="login-data mt-3">
                        <h5 style="padding-bottom: 10px">نبذة شخصية عني</h5>
                        <div class="row">
                            <div class="col">
                                <p >{{ $member->your_description }}</p>
                            </div>
                        </div>
                    </div>
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
