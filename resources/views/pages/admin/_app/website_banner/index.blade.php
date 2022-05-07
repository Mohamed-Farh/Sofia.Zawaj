@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('الاسم و اللوجو') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('الاسم و اللوجو') }}
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

            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                @if (\App\Models\App\WebsiteBanner::count() == 0)
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{__('اضـافـة')}}
                    </button>
                @endif
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('اللـوجـو') }}</th>
                            <th>{{__('اسم الموقع') }}</th>
                            <th>{{__('نص تعريفي') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('users_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($records as $record)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td><img class="img-responsive thumbnail" src="{{url($record->image)}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                <td>{{ $record->name }}</td>
                                <td>{{ $record->text }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td class="#">
                                        <button type="button" class="btn btn-info btn-sm given" data-toggle="modal"
                                            data-target="#edit{{ $record->id }}"
                                            title="{{ trans('users_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    </td>
                                @endif
                            </tr>

                            <!-- edit_modal_user -->
                            <div class="modal fade" id="edit{{ $record->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('تعديل الصفحة') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('website_banner.update', 'test') }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $record->id }}">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="name" class="mr-sm-2 space_top">{{ trans('اسم الموقع') }} : <span style="color: red"> * </span> </label>
                                                        <input id="name" type="text" name="name" class="form-control" value="{{ $record->name }}" required autocomplete="name" autofocus>
                                                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>

                                                    <div class="col-md-12  make-space">
                                                        <label for="text" class="mr-sm-2">{{ __('النص التعريفي') }} : <span style="color: red"> * </span> </label>
                                                        <textarea class="form-control" name="text" rows="5" required>{{ $record->text }}</textarea>
                                                        @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>


                                                    <div class="col-md-12  make-space">
                                                        <label for="image" class="mr-sm-2">{{__('الصورة') }} : </label>
                                                        <input type="file" class="form-control" name="image">
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('image') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <br><br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('users_trans.Close') }}</button>
                                                    <button type="submit" class="btn btn-success">{{ trans('users_trans.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_user -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('اضافة اللوجو و الاسم ') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('website_banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="mr-sm-2 space_top">{{ trans('اسم الموقع') }} : <span style="color: red"> * </span> </label>
                            <input id="name" type="text" name="name" class="form-control" required autocomplete="name" autofocus>
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-12  make-space">
                            <label for="text" class="mr-sm-2">{{ __('النص التعريقي') }} : <span style="color: red"> * </span> </label>
                            <textarea class="form-control" name="text" rows="5" required></textarea>
                            @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-12  make-space">
                            <label for="image" class="mr-sm-2">{{__('الصورة') }} : </label>
                            <input type="file" class="form-control" name="image" required>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                        <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('users_trans.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('users_trans.submit') }}</button>
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

