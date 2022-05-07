<!DOCTYPE html>
<html>

<head>
    {{-- Done --}}
    <title>حسابي</title>
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
                    <h3>حسابي</h3>
                    <p>الصفحة الرسمية لك على موقع صوفيا للزواج</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->


    <!-- start sidebar-section -->
    <div class="sidebar-sec py-4 search-information">
        <div class="container container-1">
            <div class="row">

                {{-- include sidebar page in the frontend --}}
                @include('includes.sidebar')

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 all-result-sec">
                    <div class="row mt-4">
                        <div class="col-xs-12 col-sm-12 col-md-8 mt-2">
                            <div class="card" style="width: 100%; border: unset; border-radius: 5px">
                                <div class="media" style="background: #f9f9f9">
                                    <img src="{{ url($member->image) }}" class="___class_+?38___"
                                        alt="..." style="height: 140px" />
                                    <div class="media-body">
                                        <h5 class="mt-0">الأسم : {{ $member->full_name }}</h5>
                                        <p>العمر : {{ $member->age }}</p>
                                        <p style="padding-bottom: 15px;"><i class="fas fa-map-marker-alt"></i> الجنسية :
                                            {{ $member->nationality }}</p>
                                        <!--@if ($member->dual_nationality)-->
                                        <!--    <p style="padding-bottom: 15px;"><i-->
                                        <!--            class="fas fa-map-marker-alt"></i> الجنسية الثانية :-->
                                        <!--        {{ $member->dual_nationality }}</p>-->
                                        <!--@endif-->

                                        <p><i class="fas fa-map-marker-alt"
                                                style=" color: #969696; font-size: 15px; padding-left: 5px;"></i> الاقامة
                                            : {{ $member->country }}</p>
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
                    <div class="row mt-4">
                        <div class="col-xs-12 col-sm-12 col-md-8 mt-2">
                            <div class="row mt-2">
                                <div class="col">
                                    <p>الاسم المستعار</p>
                                </div>
                                <div class="col">
                                    <p class="text-left">{{ $member->name }}</p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p>تاريخ التسجيل</p>
                                </div>
                                <div class="col">
                                    <p class="text-left">{{ $member->created_at->addYear()->format('Y/m/d') }}</p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p>البريد الالكتروني</p>
                                </div>
                                <div class="col">
                                    <p class="text-left">{{ $member->email }}</p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p>رقم العضوية</p>
                                </div>
                                <div class="col">
                                    <p class="text-left">{{ $member->code_no }}</p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <p>صفحتي</p>
                                </div>
                                <div class="col">
                                    <p class="text-left">zaytona.online/show_member_details_page/{{ $member->id }}</p>
                                </div>
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
