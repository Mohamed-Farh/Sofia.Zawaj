<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ url('/dashboard') }}" target="_blank">
                            <div class="pull-left"><i class="ti-home"></i><span
                                    class="right-nav-text">{{ __('الـرئـيـسـيـة') }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('صـوفـيـا - Sofia') }} </li>



                    <!-- Members-->
                    <!--<li>-->
                    <!--    <a href="javascript:void(0);" data-toggle="collapse" data-target="#website_banner-icon">-->
                    <!--        <div class="pull-left"><i class="fas fa-eye-dropper"></i><span-->
                    <!--                class="right-nav-text">{{ __('اللوجو & الاسم') }}</span></div>-->
                    <!--        <div class="pull-right"><i class="ti-plus"></i></div>-->
                    <!--        <div class="clearfix"></div>-->
                    <!--    </a>-->
                    <!--    <ul id="website_banner-icon" class="collapse" data-parent="#sidebarnav">-->
                    <!--        <li><a href="{{ route('website_banner.index') }}">{{ __('اللوجو & الاسم') }}</a></li>-->
                    <!--    </ul>-->
                    <!--</li>-->


                    <!-- Admins-->
                    {{-- @if (auth()->user()->hasRole(['super_admin', 'admin'])) --}}
                    @if (auth()->user()->hasRole('super_admin'))
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#admins-icon">
                                <div class="pull-left"><i class="fas fa-user"></i><span
                                        class="right-nav-text">{{ __('الادمــن') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>

                            <ul id="admins-icon" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{ route('admins.index') }}">{{ __('قـائـمـة الادمـن') }}</a></li>
                            </ul>
                        </li>
                    @endif


                    <!-- Users-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#users-icon">
                            <div class="pull-left"><i class="fas fa-users"></i><span
                                    class="right-nav-text">{{ __('الـمـسـتـخـدمـيـن') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="users-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('users.index') }}">{{ __('قائمة المستخدمين') }}</a></li>
                        </ul>
                    </li>

                    <!-- Members-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#app_homepages-icon">
                            <div class="pull-left"><i class="fas fa-tablet-alt"></i><span
                                    class="right-nav-text">{{ __('التطبيق') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="app_homepages-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('app_homepages.index') }}">{{ __('الصفحات الرئيسية') }}</a></li>
                            <li><a href="{{ route('website_banner.index') }}">{{ __('اللوجو & الاسم') }}</a></li>
                        </ul>
                    </li>


                    <!-- Members-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#members-icon">
                            <div class="pull-left"><i class="fas fa-street-view"></i><span
                                    class="right-nav-text">{{ __('الاعـضـاء') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="members-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('members.index') }}">{{ __('قائمة الاعـضـاء') }}</a></li>
                            <li><a href="{{ route('show_male_members') }}">{{ __('الاعضاء الرجال') }}</a></li>
                            <li><a href="{{ route('show_female_members') }}">{{ __('الاعضاء النساء') }}</a></li>
                        </ul>
                    </li>


                    <!-- packages-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#packages-icon">
                            <div class="pull-left"><i class="fas fa-donate"></i><span
                                    class="right-nav-text">{{ __('باقات التمييز') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="packages-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('packages.index') }}">{{ __('قائمة باقات التمييز') }}</a></li>
                        </ul>
                    </li>


                    <!-- Members-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#success_relations-icon">
                            <div class="pull-left"><i class="fas fa-restroom"></i><span
                                    class="right-nav-text">{{ __('الحالات الناجحة') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="success_relations-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('success_relations.index') }}">{{ __('قائمة الحالات الناجحة') }}</a>
                            </li>
                        </ul>
                    </li>


                    <!-- Common Questions-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Common-icon">
                            <div class="pull-left"><i class="fas fa-question-circle"></i><span
                                    class="right-nav-text">{{ __('الاسئلة الشائعة') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Common-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('common_questions.index') }}">{{ __('قائمة الاسئلة الشائعة') }}</a>
                            </li>
                        </ul>
                    </li>

                    <!-- News-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#news-menu">
                            <div class="pull-left"><i class="far fa-newspaper"></i><span
                                    class="right-nav-text">{{ trans('الـمـقـالات') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="news-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('news.index') }}">{{ trans('قـائـمـة الـمـقـالات') }}</a></li>
                        </ul>
                    </li>

                    <!-- advs-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#advs-menu">
                            <div class="pull-left"><i class="fab fa-adversal"></i><span
                                    class="right-nav-text">{{ trans('الاعـلانـات') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="advs-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('advs.index') }}">{{ trans('قـائـمـة الاعـلانـات') }}</a></li>
                        </ul>
                    </li>

                    <!-- advs-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#countries-menu">
                            <div class="pull-left"><i class="fas fa-globe-europe"></i><span
                                    class="right-nav-text">{{ trans('الدول و البلدان') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="countries-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('countries.index') }}">{{ trans('قـائـمـة الدول') }}</a></li>
                            <li><a href="{{ route('states.index') }}">{{ trans('قـائـمـة البلدان') }}</a></li>
                        </ul>
                    </li>

                    <!-- Aboutus-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Aboutus-icon">
                            <div class="pull-left"><i class="far fa-address-card"></i><span
                                    class="right-nav-text">{{ __('نبذة عن صوفيا ') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Aboutus-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('aboutus.index') }}">{{ __('نبذة عن صوفيا ') }}</a></li>
                        </ul>
                    </li>


                    <!-- App Features -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#app_features-menu">
                            <div class="pull-left"><i class="fas fa-gifts"></i><span
                                    class="right-nav-text">{{ __('مـمـيـزات الـتـطـبـيـق') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="app_features-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('app_features.index') }}">{{ __('مـمـيـزات الـتـطـبـيـق') }}</a>
                            </li>
                        </ul>
                    </li>

                    <!-- الشروط و الاحكام / سياسة الخصوصية-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#privacy-icon">
                            <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
                                    class="right-nav-text">{{ __('الشروط / سياسة الخصوصية') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="privacy-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('rule.index') }}">{{ __('الشروط و الاحكام') }}</a></li>
                            <li><a href="{{ route('privacy.index') }}">{{ __('سياسة الخصوصية') }}</a></li>
                        </ul>
                    </li>

                    <!-- gallery-->
                    {{-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#gallery-menu">
                            <div class="pull-left"><i class="fad fa-images"></i><span
                                    class="right-nav-text">{{trans('main_trans.gallery')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="gallery-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('sliders.index')}}">{{trans('slider_trans.List_slider')}}</a></li>
                        </ul>
                    </li> --}}


                    <!-- Socials -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#social-menu">
                            <div class="pull-left"><i class="fas fa-share-alt-square"></i><span
                                    class="right-nav-text">{{ __('سـوشـيـال مـيـديـا') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="social-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('socials.index') }}">{{ __('سـوشـيـال مـيـديـا') }}</a></li>
                        </ul>
                    </li>

                    <!-- messages -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#messages-menu">
                            <div class="pull-left"><i class="fas fa-envelope-square"></i><span
                                    class="right-nav-text">{{ __('الــرســـائــل') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="messages-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('contacts.index') }}">{{ __('قائمة الرسائل') }}</a></li>
                        </ul>
                    </li>


                    <!-- Location-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#location-menu">
                            <div class="pull-left"><i class="fas fa-search-location"></i><span
                                    class="right-nav-text">{{ 'اتصل/مقر الشركة' }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="location-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a
                                    href="{{ route('company_location.index') }}">{{ trans('front_trans.company_location') }}</a>
                            </li>
                        </ul>
                    </li>

                    {{-- ---------------------------------------------------------------------------------------------------------- --}}
                    <!-- Homepage Words-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#homepage_word-menu">
                            <div class="pull-left"><i class="fas fa-tasks"></i><span
                                    class="right-nav-text">{{ 'كلمة الصفحة الرئيسية' }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="homepage_word-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('homepage_words.index') }}">{{ 'كلمة الصفحة الرئيسية' }}</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
