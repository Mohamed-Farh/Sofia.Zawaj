@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('الصفحات الرئيسية') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('الصفحات الرئيسية') }}
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
                @if (\App\Models\App\AppHomepages::count() != 3)
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
                            <th>{{__('رقم الصفحة') }}</th>
                            <th>{{__('الصورة') }}</th>
                            <th>{{__('العنوان') }}</th>
                            <th>{{__('المحتوي') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('users_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @forelse ($records as $record)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                @if ($record->page_no == 1)
                                    <td>{{__('الصفحة الاولي') }}</td>
                                @elseif ($record->page_no == 2)
                                    <td>{{__('الصفحة الثانية') }}</td>
                                @elseif ($record->page_no == 3)
                                    <td>{{__('الصفحة الثالثة') }}</td>
                                @endif
                                <td><img class="img-responsive thumbnail" src="{{url($record->image)}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                <td>{{ $record->title }}</td>
                                <td>{{ $record->content }}</td>

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
                                            <form action="{{ route('app_homepages.update', 'test') }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $record->id }}">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="title" class="mr-sm-2 space_top">{{ trans('العنوان') }} : <span style="color: red"> * </span> </label>
                                                        <input id="title" type="text" name="title" class="form-control" value="{{ $record->title }}" required autocomplete="title" autofocus>
                                                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>

                                                    <div class="col-md-12  make-space">
                                                        <label for="content" class="mr-sm-2">{{ __('المحتوي') }} : <span style="color: red"> * </span> </label>
                                                        <textarea class="form-control" name="content" rows="5" required>{{ $record->content }}</textarea>
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
                        @empty
                        @endforelse
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
                    {{ trans('اضافة اعلان جديدة') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('app_homepages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="title" class="mr-sm-2 space_top">{{ trans('العنوان') }} : <span style="color: red"> * </span> </label>
                            <input id="title" type="text" name="title" class="form-control" required autocomplete="title" autofocus>
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-12  make-space">
                            <label for="content" class="mr-sm-2">{{ __('المحتوي') }} : <span style="color: red"> * </span> </label>
                            <textarea class="form-control" name="content" rows="5" required></textarea>
                            @error('content')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-12  make-space">
                            <label class="mr-sm-2" for="page_no">{{__('مكان العرض') }} : </label>
                            <select name="page_no" required class="form-control custom-select selectpicker">
                                <?php $page_no = \App\Models\App\AppHomepages::pluck('page_no')->toArray (); ?>

                                @if (!in_array(1, $page_no))
                                    <option value="1"           <?php if($record->page_no == "1")          echo "selected"; ?> >{{__('الصفحة الاولي') }}</option>
                                @endif
                                @if (!in_array(2, $page_no))
                                    <option value="2"           <?php if($record->page_no == "2")          echo "selected"; ?> >{{__('الصفحة الثانية') }}</option>
                                @endif
                                @if (!in_array(3, $page_no))
                                    <option value="3"           <?php if($record->page_no == "3")          echo "selected"; ?> >{{__('الصفحة الثالثة') }}</option>
                                @endif
                            </select>
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

