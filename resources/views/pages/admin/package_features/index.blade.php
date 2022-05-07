@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{ trans('مميزات الباقة') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('مميزات الباقة') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

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

            @if (auth()->user()->hasRole(['super_admin','admin']))
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ __('اضـافـة') }}
                </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('عنوان الميزة') }}</th>
                            <th>{{ trans('الميزة') }}</th>
                            <th>{{ trans('تاريخ الميزة') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('عرض الميزة') }}</th>
                                <th>{{ trans('social_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                        ?>
                        @foreach ($features as $feature)
                            @if ($feature)
                                <tr>
                                    <?php
                                        $i++;
                                            $package = \App\Models\Package::where('id', $feature->package_id )->first();
                                        ?>
                                    <td>{{ $i }}</td>

                                    <td>{{ $feature->title }}</td>
                                    <td>{{ $feature->name }}</td>
                                    <td>{{ $feature->created_at->diffForHumans() }}</td>

                                    @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                        <td>
                                            @if  ($feature->show == '0')
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#comment{{ $feature->id }}" ><i class="fa fa-eye-slash"></i> {{__('اخفاء')}}</button>
                                            @elseif ($feature->show == '1')
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#comment{{ $feature->id }}" ><i class="fa fa-eye"></i> {{__('عرض')}}</button>
                                            @endif
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $feature->id }}"
                                                title="{{ trans('category_trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                            @if (auth()->user()->hasRole('super_admin'))
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $feature->id }}"
                                                title="{{ trans('category_trans.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                            @endif
                                        </td>
                                    @endif
                                </tr>


                                <!-- edit_modal_feature -->
                                <div class="modal fade" id="edit{{ $feature->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{__('تعديل الميزة') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('package_features.update', 'test') }}" method="post"
                                                enctype="multipart/form-data" autocomplete="off">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $feature->id }}">

                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="title" class="mr-sm-2  space_top">{{ __('عنوان الميزة') }} : <span
                                                                    style="color: red"> * </span> </label>
                                                            <input type="text" class="form-control" name="title" value="{{ $feature->title }}">
                                                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="name" class="mr-sm-2">{{__('الميزة') }} :  <span style="color: red"> * </span> </label>
                                                            <textarea class="form-control" name="name" rows="10" style="    line-height: 30px;">{{ $feature->name }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('اغــلاق') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-success">{{ __('حفظ البيانات') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Make_feature_Visible -->
                                <div class="modal fade" id="comment{{ $feature->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('social_trans.edit_social') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('/package_features/visible', 'test') }}" method="post">
                                                    {{ method_field('post') }}
                                                    @csrf
                                                        @if  ($feature->show == '1')
                                                            {{ trans('social_trans.unvisible_social') }}
                                                        @elseif ($feature->show == '0')
                                                            {{ trans('social_trans.visible_social') }}
                                                        @endif
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $feature->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">{{ trans('social_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-info">{{ trans('social_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- delete_modal_feature -->
                                <div class="modal fade" id="delete{{ $feature->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('feature_trans.Delete') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('package_features.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('feature_trans.Warning_feature') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $feature->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('feature_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ trans('front_trans.Delete') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_social -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('اضـافـة') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('package_features.store') }}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" name="package_id" value="{{ $package->id }}">

                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="title" class="mr-sm-2  space_top">{{ __('عنوان الميزة') }} : <span
                                    style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="title">
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{__('الميزة') }} :  <span style="color: red"> * </span> </label>
                            <textarea class="form-control" name="name" rows="10" style="    line-height: 30px;"></textarea>
                        </div>
                    </div>

                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('اغــلاق') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('حفظ البيانات') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

@endsection
