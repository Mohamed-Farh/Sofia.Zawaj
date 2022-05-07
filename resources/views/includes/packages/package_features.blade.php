<!DOCTYPE html>
<html>

<head>
    <title>{{ $package->name }}</title>
    @include('layouts.partials.head')
    @toastr_css
</head>

<body
    style="background-image: url('/image/front_background.png'); background-repeat: no-repeat;background-size: cover;">
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
                    <h3>باقات التمييز</h3>
                    <p>{{ $package->name }}</p>
                    <p>( {{ $package->month_no }} ) شهراً</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->



    <!-- start sidebar-section -->
    <div class="sidebar-sec py-4 search-information">
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

                            {!! Form::button(trans('بحث'), ['class' => 'search-button', 'type' => 'submit']) !!}

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



                    <h6>باقات التميز من صوفيا</h6>
                    @foreach (\App\Models\Homepage_Word::where('vision', '0')->where('type', 'باقات التميز من صوفيا')->get() as $word)
                        <p class="para-login" style="text-align: justify !important;">{{ $word->description }}</p>
                    @endforeach
                    <div class="row mt-2 card-pakage">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-2">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-2">
                            <div class="card s" style="width: 100%;border: 2px solid #FF7B54;">
                                <h5 style="text-align: center;padding-top: 10px;padding-bottom: 10px;font-weight: 600;">
                                    <a>( {{ $package->month_no }} ) شهراً</a>
                                </h5>
                                <p style="text-align: center; font-size: 15px;padding-bottom: 10px;">(
                                    {{ $package->price }} ) دولار</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-2">
                        </div>
                    </div>
                    <h6>المميزات</h6>
                    <p class="para-login">
                        {{ $package->description }}
                    </p>
                    @foreach($features as $feature)
                        <h6 style="color: #ff8e6d;">{{ $feature->title }}</h6>
                        <p class="para-login">
                           {{ $feature->name }}
                        </p>
                    @endforeach

                    <h6>الدفع والالشتراك</h6>
                    <p class="para-login">
                        {{ $package->pay_join }}
                    </p>

                    <br>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <form>
                                <input type="radio" class="radio-sec male-radio profile-radio"
                                    style=" float:right;background: #f3f3f3;border-radius: unset; height: unset;margin-bottom: unset; width: unset;">
                                <label for="html" class="hidden-entrance male-entrance yes-check"
                                    style="padding-right: 10px; padding-top: 5px;color: #ff8e6d;">الدفع عن طريق البطاقة</label>
                            </form>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <form>
                                <input type="radio" class="radio-sec male-radio profile-radio"
                                    style=" float:right;background: #f3f3f3;border-radius: unset; height: unset;margin-bottom: unset; width: unset;">
                                <label for="html" class="hidden-entrance male-entrance yes-check"
                                    style="padding-right: 10px; padding-top: 5px;color: #ff8e6d;">الدفع عن طريق فوري</label>
                            </form>
                        </div>
                    </div>
                    <br>
                    <p class="para-login" style="color: black;">
                       {{ $package->after_choose_pay }}
                    </p>
                    <h6 style="text-align: center;color: #ff8e6d;">
                        اشتراك
                        ( {{ $package->month_no }} ) شهراً
                        بمبلغ
                        ( {{ $package->price }} ) دولار
                    </h6>
                    <div class="row mt-2">
                        <div class="col">
                            <form>
                                <label>تفاصيل البطاقة</label>
                                <input type="text" placeholder="card number" />

                            </form>

                        </div>


                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <button style="background-color: #ff8e6d;">اشتراك</button>

                        </div>
                        <div class="col">
                            <button>الغاء</button>

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
