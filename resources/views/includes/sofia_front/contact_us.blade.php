<!DOCTYPE html>
<html>

<head>
    {{-- Done --}}
    <title>تواصل معنا</title>
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
                    <h3>تواصل معنا</h3>
                    <p>تواصل معنا الآن وأرسل استفسارك وسنقوم بالرد عليك سريعا</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->



    <!-- start sidebar-section -->
    <div class="sidebar-sec py-4 search-information members-cards">
        <div class="container container-1">
            <div class="row">

                @include('includes.sidebar')

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 all-result-sec ">
                    <h6>تواصل معنا الان</h6>
                    @foreach (\App\Models\Homepage_Word::where('vision', '0')->where('type', 'تواصل معنا الان')->get() as $word)
                        <p class="para-login" style="text-align: justify !important;color: #2b2b2b;">{{ $word->description }}</p>
                    @endforeach
                    <p class="para-login mt-3" style="color: #2b2b2b;">قم بملء البيانات التالية وأرسل رسالتك وسنقوم
                        بالرد عليك
                        في أقرب وقت

                    </p>

                    <form action="{{ route('send_message_from_front') }}" method="POST">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p class="user-name">الاسم</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <input type="text" name="name" style="border: 1px solid #efefef; border-radius: 5px;height: 34px; margin-bottom: 10px;background: #f3f3f3;" class="@error('name') is-invalid @enderror" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p class="user-name">البريد الالكتروني</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <input type="email" name="email" style="border: 1px solid #efefef; border-radius: 5px;height: 34px; margin-bottom: 10px;background: #f3f3f3;" class="@error('email') is-invalid @enderror" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p class="user-name">رقم الهاتف</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <input type="text" name="phone" style="border: 1px solid #efefef; border-radius: 5px;height: 34px; margin-bottom: 10px;background: #f3f3f3;" class="@error('phone') is-invalid @enderror" required>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p class="user-name">البلد</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <input type="text" name="country" style="border: 1px solid #efefef; border-radius: 5px;height: 34px; margin-bottom: 10px;background: #f3f3f3;" class="@error('country') is-invalid @enderror" required>
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p class="user-name">موضوع الرسالة</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <input type="text" name="subject" style="border: 1px solid #efefef; border-radius: 5px;height: 34px; margin-bottom: 10px;background: #f3f3f3;" class="@error('subject') is-invalid @enderror" required>
                                @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <p class="user-name">نص الرسالة</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <textarea  name="message" style=" width:100%;border: 1px solid #efefef; border-radius: 5px;height: 162px; margin-bottom: 10px;background: #f3f3f3;" required="required"></textarea>
                                </div>
                            </div>
                            <div class=" last-button text-center mt-2">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <button style="background: #ff7b54; color: white; font-weight: 600;">ارسال</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
