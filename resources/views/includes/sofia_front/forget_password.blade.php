<!DOCTYPE html>
<html>

<head>
    {{-- Done --}}
    <title>نسيت كلمة المرور</title>
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
                    <h3>نسيت كلمة المرور</h3>
                    <p>لا تقلق ! سوف نساعدك في استرداد كلمة المرور الخاصة بك</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->


    <!-- start sidebar-section -->
    <div class="sidebar-sec py-4 search-information">
        <div class="container container-1">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 ">
                    <div class="row mt-4">
                        <div class="col sidebar-col  form-col-1">
                            <h4>تسجيل الدخول</h4>
                            <form method="POST" action="{{ route('member_login') }}">
                                @csrf
                                <label for="email" class="user-name-label"
                                    style="margin-bottom: 0px">{{ __('البريد الالكتروني') }}</label>
                                <input id="email" type="email" class="user-name @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="password" class="user-name-label"
                                    style="margin-bottom: 0px">{{ __('كلمة المرور') }}</label>
                                <input id="password" type="password"
                                    class="user-name @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button type="submit" class="btn btn-primary" style="margin-top:20px;">
                                    {{ __('تسجيل دخول') }}
                                </button>

                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{ route('forget_password_page') }}" style="float: right;">نسيت كلمة
                                            المرور</a>
                                    </div>
                                    <div class="col-12">
                                        <br>
                                        <a href="{{ route('home') }}#how_to_sofia" style="float: right;">طريقة استخدام
                                            الموقع</a>
                                    </div>
                                </div><br>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <h6>هل نسيت كلمة المرور؟</h6>
                    <p class="para-login">
                        من فضلك قم بإدخال بريدك الإلكتروني أولاً لنقوم بارسال كلمة المرور الجديدة الخاصه بك لتتمكن
                        من الدخول إلي موقع صوفيا مره أخرى
                    </p>


                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <label for="email">{{ __('البريد الالكتروني') }}</label>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <button type="submit" class="btn btn-primary" style="background: #ff7b54; color: white;font-weight: 600;">
                                    {{ __('الحصول علي كلمة المرور جديدة') }}
                                </button>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                            </div>
                        </div>
                    </form>

                    <div class="row mt-2 text-center">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <p style="    text-align: center;">او<a href="{{ route('contact_us_page') }}"
                                    style="color: #ff7b54;">تواصل</a> مع الادارة</p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2">
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
