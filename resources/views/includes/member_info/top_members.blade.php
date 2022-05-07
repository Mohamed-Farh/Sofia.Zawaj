<!DOCTYPE html>
<html>

<head>
    <title>اعضاء متميزون</title>
    @include('layouts.partials.head')
    @toastr_css
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
                    <h3>اعضاء متميزون</h3>
                    <p>اعضاء صوفيا المشتركين في باقة التميز</p>
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


                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 all-result-sec">

                    <!--  -->
                    @include('includes.adv')
                    <!--  -->



                        <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <p>الاعضاء المميزون  <span>0</span></p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 mt-2">
                                    <img src="{{ asset('app-assets/images/Group 27801.png') }}" /><a href="#" class="link-result-1">الكل</a>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 mt-2">
                                    <img src="{{ asset('app-assets/images/Group 278011.png') }}" /><a href="#" class="link-result-1">ذكر</a>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 mt-2">
                                    <img src="{{ asset('app-assets/images/Group 2780111.png') }}" /><a href="#" class="link-result-1">انثى</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col" style="text-align: center">
                            <h3 style="text-align: center">عفوا لا يوجد اعضاء مميزيين في الوقت الحالي</h3>
                        </div>

                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 mt-3">-->
                        <!--    <div class="card" style="width: 100%">-->
                        <!--        <div class="media">-->
                        <!--            <img src="{{ asset('app-assets/images/Mask Group 1647.png') }}" class="" alt=" ..." />-->
                        <!--            <div class="media-body">-->
                        <!--                <h5 class="mt-0">اسماء ابراهيم ,25سنة</h5>-->
                        <!--                <p>الجنسية:مصرية</p>-->
                        <!--                <p>الاقامة:الامارات</p>-->
                        <!--                <i class="far fa-heart"></i><i class="far fa-envelope"></i><i-->
                        <!--                    class="fas fa-info-circle"></i>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
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
