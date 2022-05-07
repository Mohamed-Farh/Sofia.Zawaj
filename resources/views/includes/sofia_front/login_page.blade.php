<!DOCTYPE html>
<html>

<head>
    <title>التسجيل</title>
    @include('layouts.partials.head')
    @toastr_css

    <style>
        button.btn.btn-primary {
            background-color: #ff7b54;
            border: unset;
            width: 100%;
            margin-bottom: 20px;
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
                    <h3>التسجيل</h3>
                    <p>انضم الآن الي فريق عمل صوفيا وأحصل على الشريك المناسب</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->



    <!-- start  form sec -->
    <div class="form-sec-1 py-4 text-center login-info-sec">
        <div class="container container-1">
            <div class="row">


                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 form-col-1">
                    <h4>تسجيل الدخول</h4>
                    <form method="POST" action="{{ route('member_login') }}">
                        @csrf
                        <label for="email" class="user-name-label" style="margin-bottom: 15px;">{{ __('البريد الالكتروني') }}</label>
                        <input id="email" type="email" class="user-name @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror


                        <label for="password" class="user-name-label" style="margin-bottom: 15px;">{{ __('كلمة المرور') }}</label>
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



                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-info-1">
                    <h3>انشاء حساب جديد</h3>
                    @foreach (\App\Models\Homepage_Word::where('vision', '0')->where('type', 'انشاء حساب جديد')->get() as $word)
                        <p style="text-align: justify !important;">{{ $word->description }}</p>
                    @endforeach


                    <div class="gender-sec text-center py-4">
                        <h4 class="start-now">ابدا الان</h4>
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mt-2">
                                <form action="{{ route('male_register_page') }}" method="GET">
                                    @csrf
                                    <input type="radio" name="male" class="radio-sec" required="required" value="male">
                                    <label for="male" class="hidden-entrance">موافق على الشروط والاحكام</label>

                                    <div class="card" style="width: 100%; padding: 10px;">
                                        <img src="{{ asset('app-assets/images/Mask Group 10.png') }}"
                                            class="card-img-top" alt="...">
                                        <div class="media-body">
                                            <button type="submit">انا ذكر</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 mt-2">
                                <form action="{{ route('female_register_page') }}" method="GET">
                                    @csrf
                                    <input type="radio" name="female" class="radio-sec" required="required" value="female">
                                    <label for="female" class="hidden-entrance">موافقة على الشروط والاحكام</label>

                                    <div class="card" style="width: 100%;padding: 10px;">
                                        <img src="{{ asset('app-assets/images/Mask Grup 11.png') }}"
                                            class="card-img-top" alt="...">
                                        <div class="media-body">
                                            <button type="submit">انا انثي</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end  form sec -->




    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
