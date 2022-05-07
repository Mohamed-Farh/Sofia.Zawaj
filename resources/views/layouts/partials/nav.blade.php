<!-- start header -->
<div class="header1">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('secondHome') }}">الرئيسية <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">صـوفـيـا </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}#nav_app_features">مميزات التطبيق</a>
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


                {{-- @if(session()->has('login_key'))
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    background-color: unset;  border: unset; color: black;">
                                حسابي
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('myprofile_page') }}">حسابي</a>
                            <a class="dropdown-item" href="/front_logout">تسجيل خروج</a>
                            </div>
                        </div>
                    </li>
                @endif --}}
            </ul>
        </div>
    </nav>

</div>
<!-- end header -->
