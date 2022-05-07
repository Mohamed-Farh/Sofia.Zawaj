@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ trans('مميزات التطبيق') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('مميزات التطبيق') }}
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

            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('اضافة ميزة') }}
                </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> {{ trans('نوع الميزة') }}</th>
                            <th> {{__('نص الميزة') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('main_trans.visible') }}</th>
                                <th>{{ trans('social_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($app_features as $app_feature)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $app_feature->feature_type }}</td>
                                <td>{{ $app_feature->feature_text }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <td>
                                    @if  ($app_feature->status == '1')
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#vis_social{{ $app_feature->id }}"
                                        title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                    @elseif ($app_feature->status == '0')
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#vis_social{{ $app_feature->id }}"
                                        title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $app_feature->id }}"
                                        title="{{ trans('social_trans.Edit') }}"><i
                                            class="fa fa-edit"></i></button>

                                    @if (auth()->user()->hasRole('super_admin'))
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $app_feature->id }}"
                                            title="{{ trans('social_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    @endif
                                </td>
                                @endif
                            </tr>

                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $app_feature->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('app_features.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $app_feature->id }}">

                                                <div class="form-group">
                                                    <div class="col">
                                                        <label class="mr-sm-2" for="feature_type">{{ trans('main_trans.type') }}</label>
                                                        <select name="feature_type" required class="form-control custom-select selectpicker">
                                                            <option value="0"                            <?php if($app_feature->feature_type == "0")          echo "selected"; ?> >  -- اختر من فضلك -- </option>
                                                            <option value="مميزات التطبيق"            <?php if($app_feature->feature_type == "مميزات التطبيق")    echo "selected"; ?> >       مميزات التطبيق      </option>
                                                            <option value="بناء ملفك الشخصي"            <?php if($app_feature->feature_type == "بناء ملفك الشخصي")    echo "selected"; ?> >       بناء ملفك الشخصي      </option>
                                                            <option value="البحث عن شريك حياة"          <?php if($app_feature->feature_type == "البحث عن شريك حياة")   echo "selected"; ?> >       البحث عن شريك حياة     </option>
                                                            <option value="ضبط اعداداتك بما يتناسب معك"<?php if($app_feature->feature_type == "ضبط اعداداتك بما يتناسب معك")   echo "selected"; ?> >       ضبط اعداداتك بما يتناسب معك     </option>
                                                            <option value="عرض ملفات الاشخاص"            <?php if($app_feature->feature_type == "عرض ملفات الاشخاص")     echo "selected"; ?> >       عرض ملفات الاشخاص       </option>
                                                            <option value="التفاعل مع حسابات الاعضاء"   <?php if($app_feature->feature_type == "التفاعل مع حسابات الاعضاء")      echo "selected"; ?> >       التفاعل مع حسابات الاعضاء        </option>
                                                            <option value="ارسال الرسائل مع الاعضاء"    <?php if($app_feature->feature_type == "ارسال الرسائل مع الاعضاء")   echo "selected"; ?> >       ارسال الرسائل مع الاعضاء     </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="feature_text" class="mr-sm-2">{{ __('نص الميزة') }} : </label>
                                                        <textarea class="form-control" name="feature_text" rows="8">{{ $app_feature->feature_text }}</textarea>
                                                        @if ($errors->has('feature_text'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('feature_text') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('social_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ trans('social_trans.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Make_Image_Visible -->
                            <div class="modal fade" id="vis_social{{ $app_feature->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('تعديل ميزة التطبيق') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('app_features/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($app_feature->status == '1')
                                                        {{ trans('social_trans.unvisible_social') }}
                                                    @elseif ($app_feature->status == '0')
                                                        {{ trans('social_trans.visible_social') }}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $app_feature->id }}">
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


                            <!-- delete_modal_social -->
                            <div class="modal fade" id="delete{{ $app_feature->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('social_trans.delete_social') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('app_features.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('social_trans.Warning_social') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $app_feature->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('social_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans('front_trans.Delete') }}</button>
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


<!-- add_modal_social -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('social_trans.add_social') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('app_features.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="col">
                            <label class="mr-sm-2" for="feature_type">{{ trans('main_trans.type') }}</label>
                            <select name="feature_type" required class="form-control custom-select selectpicker">
                                <option value="0"                            >  -- اختر من فضلك -- </option>
                                <option value="مميزات التطبيق"            >       مميزات التطبيق      </option>
                                <option value="بناء ملفك الشخصي"            >       بناء ملفك الشخصي      </option>
                                <option value="البحث عن شريك حياة"          >       البحث عن شريك حياة     </option>
                                <option value="ضبط اعداداتك بما يتناسب معك" >       ضبط اعداداتك بما يتناسب معك     </option>
                                <option value="عرض ملفات الاشخاص"            >       عرض ملفات الاشخاص       </option>
                                <option value="التفاعل مع حسابات الاعضاء"   >       التفاعل مع حسابات الاعضاء        </option>
                                <option value="ارسال الرسائل مع الاعضاء"   >       ارسال الرسائل مع الاعضاء     </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="feature_text" class="mr-sm-2">{{ __('نص الميزة') }} : </label>
                            <textarea class="form-control" name="feature_text" rows="8"></textarea>
                            @if ($errors->has('feature_text'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('feature_text') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('social_trans.Close') }}</button>
                        <button type="submit"
                            class="btn btn-success">{{ trans('social_trans.submit') }}</button>
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


<script type="text/javascript">
    $(document).ready(function() {
                $('.summernote').summernote({
                    tabSize: 2,
                    height: 200,
                });
                $("#summernote").code()
                    .replace(/<\/p>/gi, "\n")
                    .replace(/<br\// ** end_phptag ** //gi, "\n")
                        .replace(/<\/?[^>]+(>|$)/g, "");
                    });

</script>
@endsection
