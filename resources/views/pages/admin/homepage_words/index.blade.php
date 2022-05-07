@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{__('كلمة الصفحة الرئيسية') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('كلمة الصفحة الرئيسية') }}
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

            <?php
                $words = \App\Models\Homepage_Word::all();
            ?>

            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('front_trans.add') }}
                </button>
            @endif
            <br><br>

            <!--start about us section-->
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('مكان العرض') }}</th>
                            <th>{{__('نص الكلمة') }}</th>
                            <th>{{ trans('عرض/اخفاء') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('feature_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                            <tr>
                            @foreach ($words as $word)
                                <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $word->type }}</td>
                                    <td>{{ $word->description }}</td>

                                    @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                        <td>
                                            @if  ($word->vision == '1')
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#vis_word{{ $word->id }}"
                                                title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                            @elseif ($word->vision == '0')
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#vis_word{{ $word->id }}"
                                                title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $word->id }}"
                                                title="{{ trans('feature_trans.Edit') }}"><i
                                                    class="fa fa-edit"></i></button>

                                            @if (auth()->user()->hasRole('super_admin'))
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $word->id }}"
                                                    title="{{ trans('feature_trans.Delete') }}"><i
                                                        class="fa fa-trash"></i></button>
                                            @endif
                                        </td>
                                    @endif
                            </tr>

                            <!-- edit_modal_feature -->
                            <div class="modal fade" id="edit{{ $word->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('front_trans.edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('homepage_words.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $word->id }}">

                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="description" class="mr-sm-2">{{ __('كلمة الصفحة الرئيسية') }}   </label>
                                                        <textarea class="form-control" name="description" rows="8">{{ $word->description }}</textarea>
                                                        @if ($errors->has('description'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('description') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label class="mr-sm-2" for="type">{{__('مكان العرض') }} : </label>
                                                        <select name="type" required class="form-control custom-select selectpicker">
                                                            <option value="0"                        <?php if($word->type == "0")                    echo "selected"; ?> >       {{ trans('social_trans.0') }}  </option>
                                                            <option value="تطبيق صوفيا هو رفيقك للحصول علي الشريك المناسب بكل سهولة"                <?php if($word->type == "تطبيق صوفيا هو رفيقك للحصول علي الشريك المناسب بكل سهولة")            echo "selected"; ?> >  تطبيق صوفيا هو رفيقك للحصول علي الشريك المناسب بكل سهولة               </option>
                                                            <option value="قصص زواج ناجحة"                <?php if($word->type == "قصص زواج ناجحة")            echo "selected"; ?> >  قصص زواج ناجحة               </option>
                                                            <option value="خطواتك للتعامل مع تطبيق صوفيا"                 <?php if($word->type == "خطواتك للتعامل مع تطبيق صوفيا")              echo "selected"; ?> >  خطواتك للتعامل مع تطبيق صوفيا                 </option>
                                                            <option value="حمل تطبيق صوفيا الان"                  <?php if($word->type == "حمل تطبيق صوفيا الان")              echo "selected"; ?> >  حمل تطبيق صوفيا الان                 </option>
                                                            <option value="تواصل معنا الان"                  <?php if($word->type == "تواصل معنا الان")              echo "selected"; ?> >  تواصل معنا الان                 </option>
                                                            <option value="انشاء حساب جديد"                  <?php if($word->type == "انشاء حساب جديد")              echo "selected"; ?> >  انشاء حساب جديد                 </option>
                                                            <option value="باقات التميز من صوفيا"                  <?php if($word->type == "باقات التميز من صوفيا")              echo "selected"; ?> >  باقات التميز من صوفيا                 </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('feature_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ trans('feature_trans.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Make_Company Word_Visible -->
                            <div class="modal fade" id="vis_word{{ $word->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('social_trans.Edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('homepage_words/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($word->vision == '1')
                                                        {{ trans('social_trans.unvisible_social') }}
                                                    @elseif ($word->vision == '0')
                                                        {{ trans('social_trans.visible_social') }}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $word->id }}">
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
                            <div class="modal fade" id="delete{{ $word->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('front_trans.Delete') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('homepage_words.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('social_trans.Warning_social') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $word->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('front_trans.Close') }}</button>
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


<!-- add_modal_feature -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('front_trans.add') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('homepage_words.store') }}" method="POST">
                    @csrf

                    <div class="form-group modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="type">{{__('مكان العرض') }} : </label>
                            <select name="type" required class="form-control custom-select selectpicker">
                                <option value="0"                         >       {{ trans('social_trans.0') }}  </option>
                                <option value="تطبيق صوفيا هو رفيقك للحصول علي الشريك المناسب بكل سهولة"                >  تطبيق صوفيا هو رفيقك للحصول علي الشريك المناسب بكل سهولة               </option>
                                <option value="قصص زواج ناجحة"                >  قصص زواج ناجحة               </option>
                                <option value="خطواتك للتعامل مع تطبيق صوفيا"                 >  خطواتك للتعامل مع تطبيق صوفيا                 </option>
                                <option value="حمل تطبيق صوفيا الان"                  >  حمل تطبيق صوفيا الان                 </option>
                                <option value="تواصل معنا الان"                  >  تواصل معنا الان                 </option>
                                <option value="انشاء حساب جديد"                  >  انشاء حساب جديد                 </option>
                                <option value="باقات التميز من صوفيا"                  >  باقات التميز من صوفيا                 </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="description" class="mr-sm-2">{{ __('كلمة الصفحة الرئيسية') }}   </label>
                            <textarea class="form-control" name="description" rows="8"></textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('feature_trans.Close') }}</button>
                        <button type="submit"
                            class="btn btn-success">{{ trans('feature_trans.submit') }}</button>
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
            height: 100,
        });
        $("#summernote").code()
                .replace(/<\/p>/gi, "\n")
                .replace(/<br\/?>/gi, "\n")
                .replace(/<\/?[^>]+(>|$)/g, "");
    });
</script>
@endsection
