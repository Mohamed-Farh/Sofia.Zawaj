<!DOCTYPE html>
<html>

<head>
    <title>من زار صفحتي الشخصية</title>
    @include('layouts.partials.head')
    @toastr_css
    <style>
        .pagination {
            display: flex !important;
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
                    <h3>من زار صفحتي الشخصية</h3>
                    <p>عدد الاعضاء ( {{ $members_counts }} )</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->

    <!-- start sidebar-section -->
    <div class="sidebar-sec py-4">
        <div class="container container-1">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="row mt-4">
                        <div class="col sidebar-col">
                            <img src="{{ asset('app-assets/images/Mask Group 86.png') }}" />
                            <p><a href="{{ route('myprofile_page') }}">حسابي</a></p>
                            <br />
                            <img src="{{ asset('app-assets/images/Mask Group 86.png') }}" />
                            <p><a href="{{ route('my_data_page') }}">بياناتي</a></p>
                            <br />
                            <img src="{{ asset('app-assets/images/Notification.png') }}" />
                            <p><a href="{{ route('my_notifications_page') }}">
                                <span  id="order_notifi" class="badge badge-warning float-left" hidden>جديد</span>
                                الاشعارات</a>
                            </p>
                            <br />
                            <img src="{{ asset('app-assets/images/Mask Group 31.png') }}" />
                            <p><a href="{{ route('search_full_page') }}">الباحث الالي</a></p>
                            <br />
                            <img src="{{ asset('app-assets/images/Mask Group 1624.png') }}" />
                            <p><a href="{{ route('member_care') }}">من يهتم بي</a></p>
                            <br />
                            <img src="{{ asset('app-assets/images/Mask Group 1625.png') }}" />
                            <p><a href="{{ route('my_block_list') }}">قائمة التجاهل</a></p>
                            <br />
                            <img src="{{ asset('app-assets/images/Mask Group 1626.png') }}" />
                            <p><a href="{{ route('who_visit_myprofile') }}">من زار صفحتي الشخصية</a></p>
                            <br />
                            <img src="{{ asset('app-assets/images/Mask Group 1677.png') }}" />
                            <p><a href="{{ route('my_inbox_message_page') }}">الرسائل الواردة</a></p>
                            <br />
                            <img src="{{ asset('app-assets/images/Mask Group 11.png') }}" />
                            <p><a href="{{ route('package_index') }}">باقة التميز</a></p>
                            <br />
                            <img src="{{ asset('app-assets/images/Mask Group 125.png') }}" />
                            <p><a href="{{ route('show_mysettings') }}">اعدات الحساب</a></p>
                            <br />
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col side-bar2">
                            <div class="row mt-3 text-center">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 second-bar">
                                    <img src="{{ asset('app-assets/images/Group 267555.png') }}"
                                        class="side-bar-image" />
                                    <br />
                                    <p style="padding-bottom: 15px; text-align: center">
                                        <a href="{{ route('top_members_page') }}">اعضاء متميزون</a>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 third-bar">
                                    <img src="{{ asset('app-assets/images/Group 2680988.png') }}"
                                        class="side-bar-image" />
                                    <br />
                                    <p style="padding-bottom: 15px; text-align: center">
                                        <a href="{{ route('search_full_page') }}">البحث المتقدم</a>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 second-bar">
                                    <img src="{{ asset('app-assets/images/Group 267555.png') }}"
                                        class="side-bar-image" />
                                    <br />
                                    <p style="padding-bottom: 15px; text-align: center">
                                        <a href="{{ route('latest_members') }}">اعضاء الجدد</a>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 third-bar">
                                    <img src="{{ asset('app-assets/images/Group 267558.png') }}"
                                        class="side-bar-image" />
                                    <br />
                                    <p style="padding-bottom: 15px; text-align: center">
                                        <a href="{{ route('online_members') }}">المتواجدون الان</a>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 second-bar">
                                    <img src="{{ asset('app-assets/images/Group 267556.png') }}"
                                        class="side-bar-image" />
                                    <br />
                                    <p style="padding-bottom: 15px; text-align: center">
                                        <a href="{{ route('successful_stories') }}">القصص الناجحة</a>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  second-bar">
                                    <img src="{{ asset('app-assets/images/Group 2675599.png') }}"
                                        class="side-bar-image" />
                                    <br />
                                    <p style="padding-bottom: 15px; text-align: center">
                                        <a href="{{ route('health_members_index') }}">حالات صحية</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 text-center">
                        <div class="col col-sidbar-search">
                            <h4>بحث بالاسم</h4>
                            {!! Form::open(['route' => 'front_member_name_filter_search', 'method' => 'get']) !!}

                            <label> الاسم </label>
                            {!! Form::text('keyword', old('keyword', request()->input('keyword')), ['class' => 'form-control', 'required' => 'required']) !!}

                            {!! Form::button(trans('بحث'), ['class' => 'search-button', 'type' => 'submit', 'style'=>'width:100%']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 all-result-sec">

                     <!--  -->
                        @if (Auth::guard('member')->check())
                            <?php
                                $online_auth_member = \App\Models\Member::where('id', (Auth::guard('member')->id()) )->first();
                                $adv_count      = \App\Models\Adv::where('status', '0')->whereIn('country', ['كل الدول', $online_auth_member->country] )->orderBy('id', 'desc')->count();
                            ?>
                            @if ($adv_count > 0 )
                                <div class="adv-sale py-4">
                                    <div class="container">
                                        <div id="myDiv">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <button class="close advs" style="width: 100%; height: 75%;"
                                                        onclick="document.getElementById('myDiv').style.display='none'"> X
                                                    </button>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                        <ol class="carousel-indicators">
                                                            @foreach (\App\Models\Adv::where('status', '0')->whereIn('country', ['كل الدول', $online_auth_member->country] )->orderBy('id', 'desc')->get() as $advs)
                                                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"
                                                                    class="{{ $loop->first ? 'active' : '' }}"></li>
                                                            @endforeach
                                                        </ol>
    
                                                        <div class="carousel-inner" role="listbox">
    
                                                            @foreach (\App\Models\Adv::where('status', '0')->whereIn('country', ['كل الدول', $online_auth_member->country] )->orderBy('id', 'desc')->get() as $advs)
                                                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                                    <img src="{{ url('image/advertising/' . $advs->image) }}" class="d-block w-100"
                                                                        alt="...">
                                                                    <div class="carousel-caption d-none d-md-block">
                                                                        <h5 style="font-weight: bold !important;">{{ $advs->name }}</h5>
                                                                        <br>
                                                                        <p style="text-align: justify">{{ $advs->word }}</p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
    
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                                            role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleIndicators"
                                                            role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <?php
                                $adv_count      = \App\Models\Adv::where('status', '0')->where('country','كل الدول' )->orderBy('id', 'desc')->count();
                            ?>
                            @if ($adv_count > 0 )
                                <div class="adv-sale py-4">
                                    <div class="container">
                                        <div id="myDiv"> 
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <button class="close advs" style="width: 100%; height: 75%;"
                                                        onclick="document.getElementById('myDiv').style.display='none'"> X
                                                    </button>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                        <ol class="carousel-indicators">
                                                            @foreach (\App\Models\Adv::where('status', '0')->where('country','كل الدول' )->orderBy('id', 'desc')->get() as $advs)
                                                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"
                                                                    class="{{ $loop->first ? 'active' : '' }}"></li>
                                                            @endforeach
                                                        </ol>
    
                                                        <div class="carousel-inner" role="listbox">
    
                                                            @foreach (\App\Models\Adv::where('status', '0')->where('country','كل الدول' )->orderBy('id', 'desc')->get() as $advs)
                                                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                                    <img src="{{ url('image/advertising/' . $advs->image) }}" class="d-block w-100"
                                                                        alt="...">
                                                                    <div class="carousel-caption d-none d-md-block">
                                                                        <h5 style="font-weight: bold !important;">{{ $advs->name }}</h5>
                                                                        <br>
                                                                        {{-- <p style="text-align: justify">{{  \Str::limit($advs->word, 255) }}</p> --}}
                                                                        <p style="text-align: justify">{{  $advs->word }}</p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
    
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                                            role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleIndicators"
                                                            role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <!--  -->




                    <div class="row mt-2">
                        @if ($members_counts != '0')
                            @foreach ($members as $member_care)
                                <?php $member = \App\Models\Member::where('id', $member_care->my_id)->first(); ?>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mt-3">
                                    <div class="card"
                                        style=" width: 100%; border: none; box-shadow: 0px 0px 8px gainsboro; ">
                                        <a href="/show_member_details_page/{{ $member->id }}"
                                            style="padding-right: 0px !important;">
                                            <img src="{{ url('image/members/' . $member->image) }}"
                                                class="card-img-top who-care" alt="..." />
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title"
                                                style=" text-align: right; font-size: 16px; font-weight: 600; direction: ltr;">
                                                <a href="#">{{ $member->age }} , {{ $member->name }}</a>
                                            </h5>
                                            <p class="card-text" style="font-size: 13px">
                                                الجنسية : {{ $member->nationality }}
                                            </p>
                                            <p class="card-text" style="font-size: 13px">
                                                الاقامة: {{ $member->country }}
                                            </p>
                                            <p class="card-text" style="font-size: 13px">
                                                تاريخ الاهتمام :
                                                {{ $member->created_at->addYear()->format('Y/m/d') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col" style="text-align: center">
                                <h3 style="text-align: center">عفوا لا يوجد اعضاء في هذة القائمة</h3>
                            </div>
                        @endif
                    </div>
                    <div class="pagination-sec text-center py-4">
                        <div class="pagination">
                            <p>{{ $members->links() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="pagination-sec text-center py-4">-->
            <!--    <div class="pagination">-->
            <!--        <a href="#">1</a>-->
            <!--        <a class="active" href="#">2</a>-->
            <!--        <a href="#">3</a>-->
            <!--        <a href="#">4</a>-->
            <!--        <a href="#">5</a>-->
            <!--        <a href="#">6</a>-->
            <!--    </div>-->
            <!--</div>-->
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
