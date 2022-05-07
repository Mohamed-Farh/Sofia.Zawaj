@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('الحالات الناجحة') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('الحالات الناجحة') }}
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
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{__('اضـافـة')}}
                </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('الصورة الشخصية') }}</th>
                            <th>{{__('الأســم') }}</th>
                            <th>{{__('النوع') }}</th>
                            <th>{{__('العمر') }}</th>
                            <th>{{__('تعليقه') }}</th>
                            <th>{{ trans('users_trans.created_at') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{__('الـحـالـة')}}</th>
                                <th>{{ trans('users_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($relations as $relation)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>

                                <td><img class="img-responsive thumbnail" src="{{url('image/success_relation/'.$relation->image)}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>

                                <td>{{ $relation->name }}</td>
                                <td>{{ $relation->gender }}</td>
                                <td>{{ $relation->age }}</td>
                                <td>{{ $relation->word }}</td>
                                <td>{{ $relation->created_at->diffForHumans() }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))

                                    <td>
                                        @if  ($relation->status == '1')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_contact{{ $relation->id }}"
                                            title="{{ trans('عـرض') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                        @elseif ($relation->status == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_contact{{ $relation->id }}"
                                            title="{{ trans('اخـفـاء') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                        @endif
                                    </td>

                                    <td class="#">
                                        <button type="button" class="btn btn-info btn-sm given" data-toggle="modal"
                                            data-target="#edit{{ $relation->id }}"
                                            title="{{ trans('users_trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                            @if (auth()->user()->hasRole('super_admin'))
                                                <form action="{{ route('success_relations.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $relation->id }}">
                                                    <button type="button" class="btn btn-danger btn-sm given"
                                                        onclick="confirm('{{ __("هل انت متاكد من عملية الحذف ؟") }}') ? this.parentElement.submit() : ''" style="position:absolute; margin-right: 20px; margin-top:-26px;"><i class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                    </td>
                                @endif
                            </tr>

                            <!-- edit_modal_user -->
                            <div class="modal fade" id="edit{{ $relation->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('تعديل حالة ناجحة') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('success_relations.update', 'test') }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                        value="{{ $relation->id }}">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="name" class="mr-sm-2 space_top">{{ trans('الاسم') }} :</label>
                                                        <input id="name" type="text" name="name" class="form-control" value="{{ $relation->name }}" required autocomplete="name" autofocus>
                                                    </div>

                                                    <div class="col-md-12  make-space">
                                                        <label for="age" class="mr-sm-2">{{ __('العمر') }} : <span
                                                                style="color: red"> * </span> </label>
                                                        <select name="age" required class="form-control custom-select selectpicker gender">
                                                            <?php
                                                                $intial= 21;
                                                                $end= 90;
                                                            ?>
                                                            <option value="0" <?php if($relation->age == "0")    echo "selected"; ?> >       {{__('اختر العمر ') }} </option>
                                                            @for ($i = $intial; $i <= $end; $i++)
                                                                <option value="{{ $i }}" <?php if($relation->age == $i)    echo "selected"; ?> >{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>


                                                    <div class="col-md-12  make-space">
                                                        <label for="gender" class="mr-sm-2">{{ __('نوع (ذكر / أنثي)') }} :
                                                            <span style="color: red"> * </span> </label>
                                                            <select name="gender" required class="form-control custom-select selectpicker gender">
                                                                <option value="0" <?php if($relation->gender == "0")    echo "selected"; ?> >       {{ trans('social_trans.0') }} </option>
                                                                <option value="ذكر" <?php if($relation->gender == "ذكر")    echo "selected"; ?> >        ذكر      </option>
                                                                <option value="أنثي" <?php if($relation->gender == "أنثي")    echo "selected"; ?> >       أنثي     </option>
                                                            </select>
                                                    </div>


                                                    <div class="col-md-12  make-space">
                                                        <label for="word"
                                                            class="mr-sm-2">{{ __('تعليق العضو') }}
                                                            : <span style="color: red"> * </span> </label>
                                                        <textarea class="form-control" name="word" rows="5">{{ $relation->word }}</textarea>
                                                        @error('word')<span
                                                            class="text-danger">{{ $message }}</span>@enderror
                                                    </div>


                                                    <div class="col-md-12  make-space">
                                                        <label for="image" class="mr-sm-2">{{__('الصورة الشخصية') }} : </label>
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


                            <!-- Make_contact_Visible -->
                            <div class="modal fade" id="vis_contact{{ $relation->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('عرض / اخفاء بالصفحة الرئيسية') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('success_relations/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($relation->status == '1')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @elseif ($relation->status == '0')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $relation->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('اغــلاق')}}</button>
                                                    <button type="submit"
                                                        class="btn btn-info">{{__('حفظ البيانات') }}</button>
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
                    {{ trans('اضافة حالة جديدة') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('success_relations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="mr-sm-2 space_top">{{ trans('الاسم') }} :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>

                        <div class="col-md-12  make-space">
                            <label for="age" class="mr-sm-2">{{ __('العمر') }} : <span
                                    style="color: red"> * </span> </label>
                            <select name="age" required class="form-control custom-select selectpicker gender">
                                <?php
                                $intial = 21;
                                $end = 90;
                                ?>
                                <option value="0"> {{ __('اختر العمر ') }} </option>
                                @for ($i = $intial; $i <= $end; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>


                        <div class="col-md-12  make-space">
                            <label for="gender" class="mr-sm-2">{{ __('نوع (ذكر / أنثي)') }} :
                                <span style="color: red"> * </span> </label>
                            <select name="gender" required
                                class="form-control custom-select selectpicker gender">
                                <option value="0"> {{ trans('social_trans.0') }} </option>
                                <option value="ذكر"> ذكر </option>
                                <option value="أنثي"> أنثي </option>
                            </select>
                        </div>


                        <div class="col-md-12  make-space">
                            <label for="word"
                                class="mr-sm-2">{{ __('تعليق العضو') }}
                                : <span style="color: red"> * </span> </label>
                            <textarea class="form-control" name="word" rows="5"></textarea>
                            @error('word')<span
                                class="text-danger">{{ $message }}</span>@enderror
                        </div>


                        <div class="col-md-12  make-space">
                            <label for="image" class="mr-sm-2">{{__('الصورة الشخصية') }} : </label>
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

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
