@extends('layouts.mainlayout')

@section('content')


    <!-- start header -->
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('home') }}"><img
                    src="{{ asset('app-assets/images/Mask Group 1.png') }}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('secondHome') }}">الرئيسية <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">صـوفـيـا </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#nav_app_features">مميزات التطبيق</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('successful_stories') }}">قصص زواج ناجحة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">تحميل التطبيق</a>
                    </li>
                    @if (Auth::guard('member')->check())
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    background-color: unset;  border: unset; color: black;">
                                    حسابي
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('myprofile_page') }}">حسابي</a>
                                <a class="dropdown-item" href="{{ route('member_signout') }}">تسجيل خروج</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login_page') }}">التسجيل</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

    </div>
    <!-- end header -->



    <!-- start first sec -->
    <div class="first-sec py-4">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-right">
                    <h2>
                        تطبيق صوفيا هو رفيقك للحصول علي الشريك
                        المناسب بكل سهولة
                    </h2>
                    @foreach (\App\Models\Homepage_Word::where('vision', '0')->where('type', 'تطبيق صوفيا هو رفيقك للحصول علي الشريك المناسب بكل سهولة')->get() as $word)
                        <p style="text-align: justify !important;">{{ $word->description }}</p>
                    @endforeach
                    <div class="row py-2">
                        <div class="col">
                            <button>Get It On Google Play</button>
                        </div>
                        <div class="col">
                            <button>App Store</button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <img src="{{ asset('app-assets/images/Group 28015.png') }}">
                </div>
            </div>
        </div>
    </div>
    <!-- end first sec -->




    <!-- start feautures of app -->
    <div class="featues-app py-4" id="nav_app_features">
        <div class="container">
            <h3>
                مميزات التطبيق
            </h3>
            @foreach (\App\Models\App_Feature::where('status', '0')->where('feature_type', 'مميزات التطبيق')->get()
        as $title)
                <p>{{ $title->feature_text }}</p>
            @endforeach

            <div class="row text-right">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset('app-assets/images/Mask Group 1665.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">بناء ملفك الشخصي</h5>
                            @foreach (\App\Models\App_Feature::where('status', '0')->where('feature_type', 'بناء ملفك الشخصي')->get()
        as $title)
                                <p class="card-text text-right" style="text-align: justify !important;">
                                    {{ $title->feature_text }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset('app-assets/images/Mask Group 1668.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">البحث عن شريك حياة</h5>
                            @foreach (\App\Models\App_Feature::where('status', '0')->where('feature_type', 'البحث عن شريك حياة')->get()
        as $title)
                                <p class="card-text text-right" style="text-align: justify !important;">
                                    {{ $title->feature_text }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset('app-assets/images/Mask Group 1669.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">ضبط اعداداتك بما يتناسب معك</h5>
                            @foreach (\App\Models\App_Feature::where('status', '0')->where('feature_type', 'ضبط اعداداتك بما يتناسب معك')->get()
        as $title)
                                <p class="card-text text-right" style="text-align: justify !important;">
                                    {{ $title->feature_text }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset('app-assets/images/Mask Group 1667.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">عرض ملفات الاشخاص</h5>
                            @foreach (\App\Models\App_Feature::where('status', '0')->where('feature_type', 'عرض ملفات الاشخاص')->get()
        as $title)
                                <p class="card-text text-right" style="text-align: justify !important;">
                                    {{ $title->feature_text }}</p>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset('app-assets/images/Mask Group 1666.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">التفاعل مع حسابات الاعضاء</h5>
                            @foreach (\App\Models\App_Feature::where('status', '0')->where('feature_type', 'التفاعل مع حسابات الاعضاء')->get()
        as $title)
                                <p class="card-text text-right" style="text-align: justify !important;">
                                    {{ $title->feature_text }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset('app-assets/images/Mask Group 1670.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">ارسال الرسائل مع الاعضاء</h5>
                            @foreach (\App\Models\App_Feature::where('status', '0')->where('feature_type', 'ارسال الرسائل مع الاعضاء')->get()
        as $title)
                                <p class="card-text text-right" style="text-align: justify !important;">
                                    {{ $title->feature_text }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start feautures of app -->





    <!-- start card carousel -->
    <div class="card-carousel py-4">
        <div class="container">
            <h3>قصص زواج ناجحة</h3>
            @foreach (\App\Models\Homepage_Word::where('vision', '0')->where('type', 'قصص زواج ناجحة')->get() as $word)
                <p class="content-para" style="text-align: center !important;">{{ $word->description }}</p>
            @endforeach
        </div>


        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach (\App\Models\Success_Relation::where('status', '0')->orderBy('id', 'desc')->get() as $relation)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            <div class="carousel-inner" role="listbox">
                @foreach (\App\Models\Success_Relation::where('status', '0')->orderBy('id', 'desc')->get() as $relation)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="card" style="width: 100%;">
                                    <div class="media">
                                        <img src="{{ url('image/success_relation/' . $relation->image) }}"
                                            class="___class_+?76___" alt="...">
                                        <div class="media-body" style="direction: rtl">
                                            <p style="text-align: justify">{{ $relation->word }}</p>
                                            <p>{{ $relation->created_at->diffForHumans() }}</p>
                                            <h5 class="mt-0">
                                                {{ $relation->name }} , {{ $relation->age }} سنة
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- end card carousel -->



    <!-- start progress steps sec -->
    <div class="progress-steps-sec py-4" id="how_to_sofia">
        <div class="container">
            <h2>خطواتك للتعامل مع تطبيق صوفيا</h2>
            @foreach (\App\Models\Homepage_Word::where('vision', '0')->where('type', 'خطواتك للتعامل مع تطبيق صوفيا')->get() as $word)
                <p style="text-align: center !important;">{{ $word->description }}</p>
            @endforeach
            <div class="row mt-2">
                <div class="col">
                    <img src="{{ asset('app-assets/images/Group 28012.png') }}" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
    <!-- end progress steps sec -->




    <!-- start download sec -->
    <div class="download-app-sec py-4">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <img src="{{ asset('app-assets/images/Group 28025.png') }}" style="width: 100%; object-fit: cover;">

                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <h3>حمل تطبيق صوفيا الان</h3>
                    @foreach (\App\Models\Homepage_Word::where('vision', '0')->where('type', 'حمل تطبيق صوفيا الان')->get() as $word)
                        <p style="text-align: center !important;">{{ $word->description }}</p>
                    @endforeach
                    <div class="row">
                        <div class="col">
                            <button>Google Play</button>
                        </div>
                        <div class="col">
                            <button> App Store</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end download sec -->




    <!-- start footer -->
    <div class="footer py-4 text-center">
        <div class="container">
            <div class="row  py-3 ">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <img src="{{ asset('app-assets/images/Mask Group 1.png') }}">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                </div>
            </div>
            <div class="row py-2">
                <div class="col">
                    <?php
                    $whats = \App\Models\Company_Location::pluck('whats')->first();
                    $Twitters = \App\Models\Social_Mail::where('type', 'Twitter')->get();
                    $Facebooks = \App\Models\Social_Mail::where('type', 'Facebook')->get();
                    $YouTubes = \App\Models\Social_Mail::where('type', 'YouTube')->get();
                    $Instagrams = \App\Models\Social_Mail::where('type', 'Instagram')->get();
                    $G_Mails = \App\Models\Social_Mail::where('type', 'G_Mail')->get();
                    $Yahoos = \App\Models\Social_Mail::where('type', 'Yahoo')->get();
                    $Telegrams = \App\Models\Social_Mail::where('type', 'Telegram')->get();
                    $Linkeds = \App\Models\Social_Mail::where('type', 'Linked')->get();
                    ?>

                    @if ($whats)
                        <a href="https://api.whatsapp.com/send?phone={{ $whats }}" target="_blank"><i
                                class="fab fa-whatsapp whats"></i></a>
                    @endif

                    @foreach ($Facebooks as $Facebook)
                        @if ($Facebook->status == '0')
                            <a href="{{ $Facebook->link }}" target="_blank"><i class="fab fa-facebook"></i></a>
                        @endif
                    @endforeach

                    @foreach ($Instagrams as $Instagram)
                        @if ($Instagram->status == '0')
                            <a href="{{ $Instagram->link }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                    @endforeach

                    @foreach ($YouTubes as $YouTube)
                        @if ($YouTube->status == '0')
                            <a href="{{ $YouTube->link }}" target="_blank"><i class="fab fa-youtube"></i></a>
                        @endif
                    @endforeach

                    @foreach ($Twitters as $Twitter)
                        @if ($Twitter->status == '0')
                            <a href="{{ $Twitter->link }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        @endif
                    @endforeach


                    @foreach ($G_Mails as $G_Mail)
                        @if ($G_Mail->status == '0')
                            <a href="{{ $G_Mail->link }}" target="_blank"><i class="fa fa-envelope"></i></a>
                        @endif
                    @endforeach

                    @foreach ($Linkeds as $Linked)
                        @if ($Linked->status == '0')
                            <a href="{{ $Linked->link }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                        @endif
                    @endforeach

                    @foreach ($Yahoos as $Yahoo)
                        @if ($Yahoo->status == '0')
                            <a href="{{ $Yahoo->link }}" target="_blank"><i class="fab fa-yahoo"></i></a>
                        @endif
                    @endforeach

                    @foreach ($Telegrams as $Telegram)
                        @if ($Telegram->status == '0')
                            <a href="{{ $Telegram->link }}" target="_blank"><i class="fab fa-telegram"></i></a>
                        @endif
                    @endforeach

                </div>
            </div>
            <div class="row  py-3">
                <div class="col">
                    <a href="{{ route('privacy_page') }}">سياسة الخصوصية</a>
                    <a href="{{ route('rules_page') }}">الشروط والاحكام</a>
                    <a href="{{ route('contact_us_page') }}">اتصل بنا</a>
                    <a href="{{ route('login_page') }}">التسجيل</a>
                    {{-- <a href="index.html">العودة للموقع</a> --}}
                </div>
            </div>
            <div class="row  py-3">
                <div class="col">
                    <p>جميع الحقوق محفوظة الى موقع زواج صوفيا للزواج الاسلامي 2021
                    </p>
                </div>
            </div>
        </div>

    </div>
    <!-- end footer -->


@endsection
