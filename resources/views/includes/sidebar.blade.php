@if (Auth::guard('member')->check())
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
                <p>
                    <a href="{{ route('my_notifications_page') }}">
                        <span  id="order_notifi" class="badge badge-warning float-left" hidden>جديد</span>
                        الاشعارات
                    </a>
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
                <p>
                    <a href="{{ route('my_inbox_message_page') }}">
                        <span  id="message_notifi" class="badge badge-warning float-left" hidden>جديد</span>
                        الرسائل الواردة
                    </a>
                </p>
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
            <div class="col col-sidbar-search sidebarDiv">
                <h4>البحث في الاعضاء</h4>
                {!! Form::open(['route' => 'front_member_name_filter_search', 'method' => 'get']) !!}

                {!! Form::text('keyword', old('keyword', request()->input('keyword')), ['class' => 'form-control', 'required' => 'required', 'placeholder'=> 'اسم العضو الذي تريد البحث عنه ...']) !!}

                {!! Form::button(trans('بحث'), ['class' => 'search-button search-button-v2 sidebarSearchBotton', 'type' => 'submit']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@else
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="row mt-4">
            <div class="col sidebar-col form-col-1">
                <h4>تسجيل الدخول</h4>
                <form method="POST" action="{{ route('member_login') }}">
                    @csrf
                    <label for="email" class="user-name-label sidebar-login-label-v2" style="margin-bottom: 0px">{{ __('البريد الالكتروني') }}</label>
                    <input id="email" type="email" class="user-name sidebar-login-v2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <label for="password" class="user-name-label sidebar-login-label-v2" style="margin-bottom: 0px">{{ __('كلمة المرور') }}</label>
                    <input id="password" type="password" class="user-name sidebar-login-v2 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <button type="submit" class="btn btn-primary sidebar-login-v2">
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
            <div class="col col-sidbar-search sidebarDiv">
                <h4>البحث في الاعضاء</h4>
                {!! Form::open(['route' => 'front_member_name_filter_search', 'method' => 'get']) !!}

                {!! Form::text('keyword', old('keyword', request()->input('keyword')), ['class' => 'form-control', 'required' => 'required', 'placeholder'=> 'اسم العضو الذي تريد البحث عنه ...']) !!}

                {!! Form::button(trans('بحث'), ['class' => 'search-button search-button-v2 sidebarSearchBotton', 'type' => 'submit']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endif
