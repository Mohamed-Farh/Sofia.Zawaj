<!DOCTYPE html>
<html>

<head>
    <title>سياسة الخصوصية</title>
    @include('layouts.partials.head')
    @toastr_css
</head>

<body style="background-image: url('app-assets/images/Web\ 1920\ –\ 1.png'); background-repeat: no-repeat;background-size: cover;" >

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
                    <h3>سياسة الخصوصية</h3>
                    <p>سياسة الخصوصية والإستخدام في صوفيا</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->


    <!-- start sidebar-section -->
    <div class="sidebar-sec py-4 search-information members-cards text-center">
        <div class="container container-1">
            <div class="row mt-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <img src="{{asset('app-assets/images/Mask Group 1.png')}}" style="float: unset;">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <h4 style="color: unset;">سياسة الخصوصية في صوفيا</h4>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                </div>
            </div>
            @foreach ($rules as $rule)
                <p class="mt-2">{{ $rule->name }}</p>
            @endforeach


            <div class="last-button text-center mt-2">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <a href="{{ route('login_page') }}">
                            <button style="background: #ff7b54; color: white; font-weight: 600;">موافق</button>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">

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
