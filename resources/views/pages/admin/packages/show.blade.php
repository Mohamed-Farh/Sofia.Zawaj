@extends('layouts.master')
@section('css')
    @toastr_css

    <link href="{{ asset('app-assets/css/style.css') }}" rel="stylesheet">
@section('title')
    {{ trans('عرض بيانات الأعضاء') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('عرض بيانات الأعضاء') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')






<!-- start search result sec -->
<div class=" search-result py-4 text-center">
    @if ($errors->any())
        <div class="error">{{ $errors->first('Name') }}</div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 search-result-col">
                <h3>{{ $package->name }}</h3>
                <p>المدة (شهر) : {{ $package->month_no }}</p><br>
                <p>السعر (دولار) : {{ $package->price }}</p>
            </div>
        </div>
    </div>
</div>
<!-- end search result sec -->


<!-- start sidebar-section -->
<div class="sidebar-sec py-4 search-information">
    <div class="container container-1">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 all-result-sec">

                <div class="login-data mt-3">
                    <h5>وصف الباقة</h5>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p class="friend-prop">{{ $package->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="login-data mt-3">
                    <h5>ممبزات الباقة</h5>
                    <div class="row mt-2">
                        @foreach ( \App\Models\Package_Feature::where('package_id', $package->id)->get() as $feature )
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <p class="friend-prop">{{ $feature->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="login-data mt-3">
                    <h5>الدفع والالشتراك</h5>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p class="friend-prop">{{ $package->pay_join }}</p>
                        </div>
                    </div>
                </div>

                <div class="login-data mt-3">
                    <h5>توجيهات للاشتراك</h5>
                    <div class="row mt-2">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p class="friend-prop">{{ $package->after_choose_pay }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end sidebar-section -->

<script src="{{ asset('app-assets/js/popper.min.js') }}"></script>
<script src="{{ asset('app-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('app-assets/js/bootstrap.js') }}"></script>

@endsection
