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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h6> الحصول علي كلمة المرور الجديدة</h6>
                    <p class="para-login">
                        من فضلك قم بإدخال كلمة المرور الجديدة وتأكيدها حتي تتمكن من الدخول بكلمة المرور الجديدة إلي حسابك بموقعنا مره أخرى
                    </p>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row text-right">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('بريدك الالكتروني') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row text-right">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة المرور الجديدة') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row text-right">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تأكيد كلمة المرور') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <label for="password" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('تغيير كلمة المرور') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-2 text-center">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <p style="    text-align: center;"></p>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
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
