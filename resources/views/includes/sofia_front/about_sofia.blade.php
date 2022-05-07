<!DOCTYPE html>
<html>

<head>
    {{-- Done --}}
    <title>عن صوفيا</title>
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
                    <h3>عن صوفيا</h3>
                    <p>موقعك المفضل والمناسب للحصول على شريك الحياة</p>
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


                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 all-result-sec">
                    <h6>نبذة عن صوفيا</h6>
                    <p class="para-login" style="text-align: justify">
                        @foreach ($about_sofia as $about)
                            {{ $about->aboutus }}
                        @endforeach
                    </p>
                    <h6>ليه تختار صوفيا</h6>
                    <p class="para-sec" style="text-align: justify">
                        @foreach ($about_sofia as $about)
                            {{ $about->why_us }}
                        @endforeach
                    </p>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card card-1" style="width: 100%">
                                <div class="card-body">
                                    <img src="{{asset('app-assets/images/Mask Group 1621.png')}}" alt="..." />
                                    <br />
                                    <h5 class="card-title">امن سهل الاستخدام</h5>
                                    <p class="card-text" style="text-align: justify">
                                        @foreach ($about_sofia as $about)
                                            {{ $about->safe }}
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card card-1" style="width: 100%">
                                <div class="card-body">
                                    <img src="{{asset('app-assets/images/Mask Group 1622.png')}}" alt="..." />
                                    <br />
                                    <h5 class="card-title">المطابقة الذكية</h5>
                                    <p class="card-text" style="text-align: justify">
                                        @foreach ($about_sofia as $about)
                                            {{ $about->smart }}
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="card card-1" style="width: 100%">
                                <div class="card-body">
                                    <img src="{{asset('app-assets/images/Mask Group 1623.png')}}" alt="..." />
                                    <br />
                                    <h5 class="card-title">السرية التامة</h5>
                                    <p class="card-text" style="text-align: justify">
                                        @foreach ($about_sofia as $about)
                                            {{ $about->secret }}
                                        @endforeach
                                    </p>
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
