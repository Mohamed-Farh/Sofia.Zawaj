<!DOCTYPE html>
<html>

<head>
    {{-- Done --}}
    <title>الاسئلة الشائعة</title>
    @include('layouts.partials.head')
    @toastr_css
    <style>
        .pagination {
            display: flex;
        }
    </style>
</head>

<body>
    {{-- @include('layouts.partials.nav') --}}
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.flash')
        </div>
    </div>




    <!-- start title -->
    <div class="title-sec-faq">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="{{asset('app-assets/images/Mask Group 1.png')}}">

                </div>
                <div class="col">
                    <p>اول موقع زواج للمسلمين</p>

                </div>

            </div>

        </div>

    </div>
    <!-- end title -->
    <!-- start search sec -->
    <div class="search-sec-faq mt-3 ">
        <div class="container">
            <h3>كيف نستطيع مساعدتك</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    {!! Form::open(['route' => 'search_common_question', 'method' => 'get']) !!}

                    {!! Form::text('keyword', old('keyword', request()->input('keyword')), ['placeholder' => 'ابحث عن ماتريد', 'required' => 'required']) !!}

                    {!! Form::button(trans('بحث'), ['type' => 'submit']) !!}

                    {!! Form::close() !!}
                    {{-- <form>
                        <input type="text" placeholder="ابحث عن ماتريد" name="search">
                        <button type="submit">بحث</button>
                    </form> --}}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                </div>
            </div>
        </div>
    </div>
    <!--end search sec -->


    <!-- start menu sec -->
    <div class="menu-faq mt-2">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <p><a href="{{ route('login_page') }}">تسجيل دخول</a></p>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <p> <a href="{{ route('package_index') }}">باقات التمييز</a></p>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <p><a href="{{ route('my_inbox_message_page') }}">الرسائل</a></p>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <p><a href="{{ route('show_mysettings') }}">تعديل بيانات</a></p>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <p> <a href="{{ route('contact_us_page') }}">التواصل مع الادارة</a></p>

                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <p><a href="{{ route('search_full_page') }}">البحث المتقدم</a></p>

                </div>

            </div>

        </div>

    </div>
    <!-- end menu sec -->
    <!-- start question sec -->
    <div class="questions-sec-faq py-4">
        <div class="container">
            {{-- @if ($common_questions_counts != '0') --}}
                <div class="row">
                    @foreach ($common_questions as $common_question)
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                            <h4>{{ $common_question->question }}</h4>
                            <p>{{ $common_question->answer }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col" style="text-align: center;    display: flex; margin-top:30px">
                        <p style="float: left">{{ $common_questions->links() }}</p>
                    </div>
                </div>
            {{-- @else
            <div class="row">
                <div class="col" style="text-align: center;    display: flex; margin-top:30px">
                        <h3 style="text-align: center">صندوق الرسائل الواردة فارغ</h3>
                    </div>
                </div>
            @endif --}}
        </div>
    </div>
    <!-- end  question sec -->




    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
