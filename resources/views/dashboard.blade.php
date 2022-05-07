<!DOCTYPE html>
<html lang="en">
@section('title')
{{trans('main_trans.Main_title')}}
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
</head>

<?php
        $user_count            =\App\User::where('admin', 0)->count();
        $male_member_count     =\App\Models\Member::where('gender', 'ذكر')->get()->count();
        $female_member_count   =\App\Models\Member::where('gender', 'أنثي')->get()->count();
        $story_count           =\App\Models\Success_Relation::all()->count();
?>

<?php
    $users          =App\User::orderBy('id', 'desc')->limit(5)->get();
    $members        =App\Models\Member::orderBy('id', 'desc')->limit(10)->get();
    $packages       =App\Models\Package::orderBy('id', 'desc')->limit(5)->get();
?>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <!--=================================
 preloader -->

 <div id="pre-loader">
     <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
 </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title" >
                <div class="row">
                    <div class="col-sm-6" >
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">{{trans('main_trans.Dashboard_page')}}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row" >
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-danger">
                                        <i class="fa fa-users highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{ trans('main_trans.Users') }}</p>
                                    <h4>{{$user_count}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fa fa-bookmark-o mr-1" aria-hidden="true"></i>{{$user_count}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-warning">
                                        <i class="fas fa-male highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{__('الاعضاء الرجال') }}</p>
                                    <h4>{{$male_member_count}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-male mr-1"></i>{{$male_member_count}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-female highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{__('الاعضاء النساء') }}</p>
                                    <h4>{{$female_member_count}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-female mr-1" aria-hidden="true"></i> {{$female_member_count}} </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-restroom highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">{{ trans('القصص الناجحة') }}</p>
                                    <h4>{{$story_count}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-restroom mr-1" aria-hidden="true"></i> {{$story_count}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt--7">
                <div class="row">

                    <!------------- Users In Dashboard -------------------->
                    <div class="col-xl-6 mb-5 mb-xl-0">
                        <div class="card bg-gradient-default dashboard_track">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0"  style="font-size: x-large;">{{  trans('main_trans.latest-user') }}</h3>
                                    </div>
                                    <div class="col text-right">
                                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">{{  trans('main_trans.see-all') }}</a>
                                    </div>
                                </div>
                            </div>
                            @if(count($users))
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">{{ trans('contactus_trans.Name') }}</th></th>
                                                <th scope="col">{{ trans('contactus_trans.email') }}</th>
                                                <th scope="col">{{ trans('users_trans.created_at') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($users as $user)
                                                <tr>
                                                    @if (App::getLocale() == 'en')
                                                        @if ($user->name !='')
                                                            <td>{{ $user->name }}</td>
                                                        @else
                                                            <td>{{ $user->name_ar }}</td>
                                                        @endif
                                                    @else
                                                        @if ($user->name_ar !='')
                                                            <td>{{ $user->name_ar }}</td>
                                                        @else
                                                            <td>{{ $user->name }}</td>
                                                        @endif
                                                    @endif

                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                    <p class="lead text-center"> No Users Was Found </p>
                                @endif
                            </div>
                        </div>



                    <!------------- Category In Dashboard -------------------->
                    <div class="col-xl-6 mb-5 mb-xl-0">
                        <div class="card bg-gradient-default dashboard_track">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0" style="font-size: x-large;">{{  trans('باقات صوفيا') }}</h3>
                                    </div>
                                    <div class="col text-right">
                                        <a href="{{ route('packages.index') }}" class="btn btn-sm btn-primary">{{  trans('main_trans.see-all') }}</a>
                                    </div>
                                </div>
                            </div>
                            @if(count($packages))
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{__('اسم الباقة') }}</th>
                                                <th>{{__('مدة الباقة') }}</th>
                                                <th>{{__('سعر الباقة') }}</th>
                                                <th>{{__('مميزات الباقة') }}</th>
                                                <th>{{__('تاريخ اضافتها') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($packages as $package)
                                                <tr>
                                                    <td>{{ $package->name }}</td>
                                                    <td>{{ $package->month_no }}</td>
                                                    <td>{{ $package->price }}</td>

                                                    <td><a href="/package/show_package_features/{{ $package->id }}" target="_blank" style="color: blue">{{trans('عرض المميزات')}}</a></td>

                                                    <td>{{ $package->created_at->diffForHumans() }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            @else
                                <p class="lead text-center"> No Category Was Found </p>
                            @endif
                        </div>
                    </div>



                    <!------------- Courses In Dashboard -------------------->
                    <div class="col-xl-12" style="margin-top: 70px;">
                        <div class="card bg-gradient-default dashboard_course">

                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="mb-0"  style="font-size: x-large;">{{  trans('الاعضاء') }}</h3>
                                    </div>
                                    <div class="col text-right">
                                        <a href="{{ route('members.index') }}" class="btn btn-sm btn-primary">{{  trans('main_trans.see-all') }}</a>
                                    </div>
                                </div>
                            </div>

                            @if(count($members))
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{__('الصورة') }}</th>
                                                <th>{{__('الاسم') }}</th>
                                                <th>{{__('العمر') }}</th>
                                                <th>{{__('البريد الالكتروني') }}</th>
                                                <th>{{__('النوع') }}</th>
                                                <th>{{__('البلد') }}</th>
                                                <th>{{__('المدينة') }}</th>
                                                <th>{{__('الجنسية') }}</th>
                                                <th>{{__('ثنائي الجنسية') }}</th>
                                                <th>{{__('نوع الزواج') }}</th>
                                                <th>{{__('الحالة الاجتماعية') }}</th>
                                                <th>{{__('تاريخ انضمامة') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($members as $member)
                                                @if ($member)
                                                    <tr>
                                                        @if($member->image != '')
                                                    <td><img class="img-responsive thumbnail" src="{{url('image/members/'.$member->image)}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                                @else
                                                    <td><img class="img-responsive thumbnail" src="{{url('image/members/avatar.png')}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                                @endif

                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->age }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->gender }}</td>
                                                <td>{{ $member->country }}</td>
                                                <td>{{ $member->city }}</td>
                                                <td>{{ $member->nationality }}</td>
                                                <td>{{ $member->dual_nationality }}</td>
                                                <td>{{ $member->marriage_type }}</td>
                                                <td>{{ $member->marital_status }}</td>
                                                <td>{{ $member->created_at->diffForHumans() }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </table>
                                </div>

                            @else
                                <p class="lead text-center"> No Members Was Found </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <!--=================================
             wrapper -->

            <!--=================================
             footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')

</body>

</html>
