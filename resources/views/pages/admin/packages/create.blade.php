@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('اضافة باقات التمييز') }}
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('اضافة باقات التمييز') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<!-- row -->
<div class="row">
    @if ($errors->any())
        <div class="error">{{ $errors->first('Name') }}</div>
    @endif

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="button" class="button x-small back_property">
                    <a href="{{ route('packages.index') }}">{{ trans('رجـوع') }}</a>
                </button>
                <br><br>

                <div class="card-body">
                    <form action="{{ route('packages.store') }}" method="POST">
                        @csrf
                        <div class="row beauty_top">
                            <h2 class="help">{{ __('تفاصيل الباقة') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="mr-sm-2  space_top">{{ __('الاســم') }} : <span
                                            style="color: red"> * </span> </label>
                                    <input type="text" class="form-control" name="name">

                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="month_no" class="mr-sm-2">{{ __('مدة الباقة') }} : <span
                                            style="color: red"> * </span> </label>
                                    <input type="number" class="form-control" name="month_no" min="1">
                                    @error('month_no')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="price" class="mr-sm-2">{{ __('سعر الباقة') }} : <span
                                            style="color: red"> * </span> </label>
                                    <input type="number" class="form-control" name="price" min="1">
                                    @error('price')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                        </div>

                        {{-- ------- وصف الباقة --------- --}}
                        <div class="row beauty_top">
                            <h2 class="help">{{ __('وصف الباقة') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description"
                                        class="mr-sm-2  space_top">{{ __('يرجى كتابة وصف للباقة') }}
                                        : <span style="color: red"> * </span> </label>
                                    <textarea class="form-control" name="description" rows="5"></textarea>
                                    @error('description')<span
                                        class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                        </div>

                        {{-- ------- الدفع والالشتراك --------- --}}
                        <div class="row beauty_top">
                            <h2 class="help">{{ __('الدفع والالشتراك') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="pay_join"
                                        class="mr-sm-2  space_top">{{ __('هنا يتم كتابة وصف لطريقة الدفع والالشتراك') }}
                                        : <span style="color: red"> * </span> </label>
                                    <textarea class="form-control" name="pay_join" rows="5"></textarea>
                                    @error('pay_join')<span
                                        class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                        </div>


                        {{-- ------- بعد عملية اختيارالدفع والالشتراك --------- --}}
                        <div class="row beauty_top">
                            <h2 class="help">{{ __('الدفع والالشتراك') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="after_choose_pay" class="mr-sm-2  space_top">{{ __('تعليمات بعد اختيار عملية الدفع والالشتراك') }} :
                                        <span style="color: red"> * </span> </label>
                                    <textarea class="form-control" name="after_choose_pay" rows="5"></textarea>
                                        @error('after_choose_pay')<span
                                            class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br>
                        </div>


                        <div class="form-group pt-4" style="text-align: center;">
                            <button type="submit" class="btn btn-success">{{ __('حفظ البيانات') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- @include('pages.admin.packages.country_filter') --}}
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

@endsection
