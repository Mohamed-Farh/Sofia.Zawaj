<!DOCTYPE html>
<html>

<head>
    <title>تم التسجيل بنجاح</title>
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
    <div class=" search-result py-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col search-result-col">
                    <h3>تسجيل الدخول</h3>
                    <p>انضم الآن الي فريق عمل صوفيا وأحصل على الشريك المناسب</p>
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
                        <div class="col sidebar-col form-col-1">
                            <h4>تسجيل الدخول</h4>
                            <form method="POST" action="{{ route('member_login') }}">
                                @csrf
                                <label for="email" class="user-name-label" style="margin-bottom: 0px">{{ __('البريد الالكتروني') }}</label>
                                <input id="email" type="email" class="user-name @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="password" class="user-name-label" style="margin-bottom: 0px">{{ __('كلمة المرور') }}</label>
                                <input id="password" type="password" class="user-name @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <button type="submit" class="btn btn-primary"  style="margin-top:20px;">
                                    {{ __('تسجيل دخول') }}
                                </button>

                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{ route('forget_password_page') }}" style="float: right;">نسيت كلمة المرور</a>
                                    </div>
                                    <div class="col-12">
                                        <br>
                                        <a href="{{ route('home') }}#how_to_sofia" style="float: right;">طريقة استخدام الموقع</a>
                                    </div>
                                </div><br>
                            </form>
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

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

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


                    <h6>تم التسجيل بنجاح</h6>
                    <p class="para-login">
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى،
                        حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                        التطبيق.
                        إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد
                    </p>
                    <a href="{{ route('login_page') }}" class="link-login">
                        والآن ! عليك بإدخال كلمة المرور والاسم المستعار لاستكمال عملية الدخول الي الموقع

                    </a>

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
