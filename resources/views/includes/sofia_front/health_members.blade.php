<!DOCTYPE html>
<html>

<head>
    <title>الحالات الصحية</title>
    @include('layouts.partials.head')
    @toastr_css
    <style>
        .pagination {
            display: flex !important;
        }


        button.search-button {
            width: 100%;
        }

        input.health_search{
            width: 60%;
            background-color: white;
            border: unset;
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
    <div class="search-result py-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col search-result-col">
                    <h3>الحالات الصحية</h3>
                    <p>{{ $title }}</p>
                    {{-- <p>عدد الأعضاء ( {{ $members_counts }} )</p> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- end search result sec -->


        <!-- start sidebar-section -->
        <div class="sidebar-sec py-4">
            <div class="container container-1">
                <div class="row mt-2">

                    @include('includes.sidebar')

                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                        @include('includes.adv')


                        <?php $health_status      = \App\Models\Member::distinct()->get(['health_status']); ?>

                        {!! Form::open(['route' => 'health_members', 'method' => 'get']) !!}
                            <div class="row mt-2">
                                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                                    <div class="row mt-2">
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                            <label>الحالة الصحية</label>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                            <select name="health_status" required class="form-control custom-select selectpicker gender">
                                                <option value="0"> {{ __('-') }} </option>
                                                <option value="حالتي جيدة الحمدلله" > {{__("حالتي جيدة الحمدلله") }} </option>
                                                <option value="اكتئاب" > {{__("اكتئاب") }} </option>
                                                <option value="انحناء وتقوس" > {{__("انحناء وتقوس") }} </option>
                                                <option value="انفصام شخصية" > {{__("انفصام شخصية") }} </option>
                                                <option value="إعاقة بصرية" > {{__("إعاقة بصرية") }} </option>
                                                <option value="إعاقة حركية" > {{__("إعاقة حركية") }} </option>
                                                <option value="إعاقة سمعية" > {{__("إعاقة سمعية") }} </option>
                                                <option value="إعاقة فكرية" > {{__("إعاقة فكرية") }} </option>
                                                <option value="باطنية" > {{__("باطنية") }} </option>
                                                <option value="برص" > {{__("برص") }} </option>
                                                <option value="بهاق" > {{__("بهاق") }} </option>
                                                <option value="توحد" > {{__("توحد") }} </option>
                                                <option value="جلدية" > {{__("جلدية") }} </option>
                                                <option value="حروق مشوهة" > {{__("حروق مشوهة") }} </option>
                                                <option value="سرطان" > {{__("سرطان") }} </option>
                                                <option value="سكري" > {{__("سكري") }} </option>
                                                <option value="سمنة مفرطة" > {{__("سمنة مفرطة") }} </option>
                                                <option value="شراهة في الأكل" > {{__("شراهة في الأكل") }} </option>
                                                <option value="شلل أطفال" > {{__("شلل أطفال") }} </option>
                                                <option value="شلل رباعي" > {{__("شلل رباعي") }} </option>
                                                <option value="صدفية" > {{__("صدفية") }} </option>
                                                <option value="صرع" > {{__("صرع") }} </option>
                                                <option value="صلع" > {{__("صلع") }} </option>
                                                <option value="ضغط" > {{__("ضغط") }} </option>
                                                <option value="عجز جنسي" > {{__("عجز جنسي") }} </option>
                                                <option value="عقم" > {{__("عقم") }} </option>
                                                <option value="فقدان طرف" > {{__("فقدان طرف") }} </option>
                                                <option value="فقدان عضو" > {{__("فقدان عضو") }} </option>
                                                <option value="قزم" > {{__("قزم") }} </option>
                                                <option value="قولون عصبي" > {{__("قولون عصبي") }} </option>
                                                <option value="كلامية - نطق" > {{__("كلامية - نطق") }} </option>
                                                <option value="متلازمة داون" > {{__("متلازمة داون") }} </option>
                                                <option value="مدمن" > {{__("مدمن") }} </option>
                                                <option value="نحافة شديدة" > {{__("نحافة شديدة") }} </option>
                                                <option value="نفسية" > {{__("نفسية") }} </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6  col-md-6 col-lg-4 mt-2">
                                            <img src="{{ asset('app-assets/images/Group 27801.png') }}">
                                            {!! Form::submit( 'الكل', ['class' => 'health_search', 'name' => 'submitbutton', 'value' => 'الكل'])!!}
                                        </div>
                                        <div class="col-xs-6 col-sm-6  col-md-6 col-lg-4 mt-2">
                                            <img src="{{ asset('app-assets/images/Group 278011.png') }}">
                                            {!! Form::submit( 'ذكر', ['class' => 'health_search', 'name' => 'submitbutton', 'value' => 'ذكر'])!!}
                                        </div>
                                        <div class="col-xs-6 col-sm-6  col-md-6 col-lg-4 mt-2">
                                            <img src="{{ asset('app-assets/images/Group 2780111.png') }}">
                                            {!! Form::submit( 'أنثي', ['class' => 'health_search', 'name' => 'submitbutton', 'value' => 'أنثي'])!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}

                        <div class="row mt-2">
                            @if ($members_counts != '0')
                            @foreach ($members as $member_search)
                                <?php
                                    $auth_id = Auth::guard('member')->id();
                                    $blocked_member = App\Models\Member_Relation::where(['my_id'=> $auth_id, 'member_id'=>($member_search->id), 'ignore_list'=> '1'])->first();
                                ?>
                                @if ($blocked_member)
                                    <?php  $member =\App\Models\Member::where('id', $blocked_member->member_id)->first(); ?>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mt-3">
                                        <div class="card" style="width: 100%">
                                            <div class="row media">
                                                <div class="col-6 media imagesthreeInRow">
                                                    <a href="/show_member_details_page/{{ $member->id }}">
                                                        <img src="{{ url('image/members/' . $member->image) }}"
                                                            class="" alt=" ..."   style="width:100%; height:auto "/>
                                                    </a>
                                                </div>

                                                <div class="col-6 media-body wordsThreeInRow">
                                                    <h5 class="mt-0 wordsThreeInRow">{{ $member->name }}</h5>
                                                    <p class="wordsThreeInRow">العمر: {{ $member->age }}سنة</p>
                                                    <p class="wordsThreeInRow">الجنسية: {{ $member->nationality }}</p>
                                                    <p class="wordsThreeInRow">أقيم في: {{ $member->country }}</p>
                                                    <p class="wordsThreeInRow"> الحالة: {{ $member->health_status }}</p>
                                                </div>
                                            </div>
                                            <div class="row media-body iconsInThree">
                                                <div class="col-3">
                                                    @if (Auth::guard('member')->check())
                                                        <?php
                                                            $auth_id = Auth::guard('member')->id();
                                                            $relation = \App\Models\Member_Relation::where(['my_id' => $auth_id, 'member_id' => $member->id])
                                                                ->where('care_list', '1')->first();
                                                        ?>

                                                        @if ($relation)
                                                            <button data-toggle="modal" data-target="#care{{ $member->id }}"
                                                                class="like" title="يجب فك الحظر لالغاء اعجابك">
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        @else
                                                            <button data-toggle="modal" data-target="#care{{ $member->id }}"
                                                                class="like" title="يجب فك الحظر لتسجيل اعجابك">
                                                                <i class="far fa-heart"></i>
                                                            </button>
                                                        @endif

                                                    @else
                                                        <button data-toggle="modal" data-target="#care{{ $member->id }}"
                                                            class="like" title="يجب فك الحظر لتسجيل اعجابك">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="col-3">
                                                    {{-- <a href="/show_member_details_page/{{ $member->id }}#send_message" title="يجب فك الحظر لارسال رسالة">
                                                        <i class="far fa-envelope"></i>
                                                    </a> --}}
                                                    <a  title="يجب فك الحظر لارسال رسالة" style="color: #ff8c6a;">
                                                        <i class="far fa-envelope"></i>
                                                    </a>
                                                </div>
                                                <div class="col-3">
                                                    <a href="/show_member_details_page/{{ $member->id }}" title="عرض مزيد من التفاصيل" style="color: #ff8c6a;">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </div>
                                                <div class="col-3">
                                                    <button data-toggle="modal" data-target="#block{{ $blocked_member->member_id }}" class="block" title="الغاء الحظر" style="color: #ff8c6a;">
                                                        <i class="fas fa-user-lock"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Member Block Another Member -->
                                    <div class="modal fade text-right" id="block{{ $blocked_member->member_id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('member_block', 'test') }}" method="post">
                                                        {{ method_field('post') }}
                                                        @csrf
                                                        {{ __('هـل أنـت مـتـأكـد مـن الـغـاء حـظـر هـذا الـشـخـص') }}

                                                        <input id="member_id" type="hidden" name="member_id"
                                                            class="form-control" value="{{ $blocked_member->member_id }}">

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('admins_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ __('تـأكـيـد') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <?php  $member =\App\Models\Member::where('id', $member_search->id)->first(); ?>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mt-3">
                                        <div class="card" style="width: 100%">
                                            <div class="row media">
                                                <div class="col-6 media imagesthreeInRow">
                                                    <a href="/show_member_details_page/{{ $member->id }}">
                                                        <img src="{{ url('image/members/' . $member->image) }}"
                                                            class="" alt=" ..."   style="width:100%; height:auto "/>
                                                    </a>
                                                </div>

                                                <div class="col-6 media-body wordsThreeInRow">
                                                    <h5 class="mt-0 wordsThreeInRow">{{ $member->name }}</h5>
                                                    <p class="wordsThreeInRow">العمر: {{ $member->age }}سنة</p>
                                                    <p class="wordsThreeInRow">الجنسية: {{ $member->nationality }}</p>
                                                    <p class="wordsThreeInRow">أقيم في: {{ $member->country }}</p>
                                                    <p class="wordsThreeInRow"> الحالة: {{ $member->health_status }}</p>
                                                </div>
                                            </div>
                                            <div class="row media-body iconsInThree">
                                                <div class="col-3">
                                                    @if (Auth::guard('member')->check())
                                                        <?php
                                                            $auth_id = Auth::guard('member')->id();
                                                            $relation = \App\Models\Member_Relation::where(['my_id' => $auth_id, 'member_id' => $member->id]) ->where('care_list', '1') ->first();
                                                        ?>

                                                        @if ($relation)
                                                            <button data-toggle="modal" data-target="#care{{ $member->id }}"
                                                                class="like" title="الغاء اعجابي">
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        @else
                                                            <button data-toggle="modal" data-target="#care{{ $member->id }}"
                                                                class="like" title="تسجيل اعجابي">
                                                                <i class="far fa-heart"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button data-toggle="modal" data-target="#care{{ $member->id }}"
                                                            class="like" title="تسجيل اعجابي">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                    @endif
                                                </div>

                                                <div class="col-3">
                                                    <a href="/show_member_details_page/{{ $member->id }}#send_message" title="ارسال رسالة" style="color: #ff8c6a;">
                                                        <i class="far fa-envelope"></i>
                                                    </a>
                                                </div>
                                                <div class="col-3">
                                                    <a href="/show_member_details_page/{{ $member->id }}" title="عرض مزيد من التفاصيل" style="color: #ff8c6a;">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                </div>
                                                <div class="col-3">
                                                    <button data-toggle="modal" data-target="#block{{ $member->id }}" class="block" title="حظر هذا العضو">
                                                        <i class="fa fa-lock"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Member Care Another Member -->
                                    <div class="modal fade text-right" id="care{{ $member->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('member_give_like', 'test') }}" method="post">
                                                        {{ method_field('post') }}
                                                        @csrf
                                                        {{ __('هـل أنـت مـتـأكـد مـن تـسـجـيـل اعـجـابـك بـهـذا الـعـضـو') }}

                                                        <input id="member_id" type="hidden" name="member_id"
                                                            class="form-control" value="{{ $member->id }}">

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('admins_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ __('تـأكـيـد') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Member Block Another Member -->
                                    <div class="modal fade text-right" id="block{{ $member->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('member_block', 'test') }}" method="post">
                                                        {{ method_field('post') }}
                                                        @csrf
                                                        {{ __('هـل أنـت مـتـأكـد مـن حـظـر هـذا الـعـضـو') }}

                                                        <input id="member_id" type="hidden" name="member_id"
                                                            class="form-control" value="{{ $member->id }}">

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('admins_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ __('تـأكـيـد') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                                <div class="col" style="text-align: center">
                                    <h3 style="text-align: center">عفوا لا يوجد اعضاء في هذة القائمة</h3>
                                </div>
                            @endif
                        </div>
                        <div class="pagination-sec text-center py-4">
                            <div class="pagination">
                                <p>{{ $members->links() }}</p>
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
