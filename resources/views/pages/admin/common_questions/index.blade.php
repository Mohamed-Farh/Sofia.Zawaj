@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{__('الأسئلة الشائعة') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('الأسئلة الشائعة') }}
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
                            <th>{{__('نوع السؤال') }}</th>
                            <th>{{__('السؤال') }}</th>
                            <th>{{__('الاجابة') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{__('عرض بالموقع') }}</th>
                                <th>{{ trans('feature_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                            <tr>
                            @foreach ($common_questions as $question)
                                <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $question->type }}</td>
                                    <td>{{ $question->question }}</td>
                                    <td>{{ $question->answer }}</td>

                                    @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                        <td>
                                            @if  ($question->status == '1')
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#vis_category{{ $question->id }}" > <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                            @elseif ($question->status == '0')
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#vis_category{{ $question->id }}" > <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                            @endif
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $question->id }}"
                                                title="{{ trans('feature_trans.Edit') }}"><i
                                                    class="fa fa-edit"></i></button>

                                            @if (auth()->user()->hasRole('super_admin'))
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $question->id }}"
                                                    title="{{ trans('feature_trans.Delete') }}"><i
                                                        class="fa fa-trash"></i></button>
                                            @endif
                                        </td>
                                    @endif
                            </tr>

                            <!-- edit_modal_feature -->
                            <div class="modal fade" id="edit{{ $question->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content"style="width: 140%">
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
                                            <form action="{{ route('common_questions.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $question->id }}">

                                                <div class="row"  style="padding: 25px 0px 5px 0px;">
                                                    <div class="col">
                                                        <label for="type" class="mr-sm-2">{{__('نوع/قسم السؤال') }} : </label>
                                                        <input type="text" class="form-control" name="type" value="{{ $question->type }}">
                                                    </div>
                                                </div>

                                                <div class="row"  style="padding: 25px 0px 5px 0px;">
                                                    <div class="col">
                                                        <label for="question" class="mr-sm-2">{{__('السؤال') }} : </label>
                                                        <textarea class="form-control" name="question" rows="8" id="summernote">{{ $question->question }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="row"  style="padding: 25px 0px 5px 0px;">
                                                    <div class="col">
                                                        <label for="answer" class="mr-sm-2">{{__('الاجابة') }} : </label>
                                                        <textarea class="form-control" name="answer" rows="8" id="summernote">{{ $question->answer }}</textarea>
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


                            <!-- Make_lab_Visible -->
                            <div class="modal fade" id="vis_category{{ $question->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('عـرض/اخـفاء بالصـفحـة الرئيـسـيـة') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('common_question/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($question->status == '1')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @elseif ($question->status == '0')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $question->id }}">
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

                            <!-- delete_modal_feature -->
                            <div class="modal fade" id="delete{{ $question->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('common_questions.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('social_trans.Warning_social') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $question->id }}">
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
        <div class="modal-content" style="width: 140%">
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
                <form action="{{ route('common_questions.store') }}" method="POST">
                    @csrf

                    <div class="row"  style="padding: 25px 0px 5px 0px;">
                        <div class="col">
                            <label for="type" class="mr-sm-2">{{__('نوع/قسم السؤال') }} : </label>
                            <input type="text" class="form-control" name="type">
                        </div>
                    </div>

                    <div class="row"  style="padding: 25px 0px 5px 0px;">
                        <div class="col">
                            <label for="question" class="mr-sm-2">{{__('السؤال') }} : </label>
                            <textarea class="form-control" name="question" rows="8"></textarea>
                        </div>
                    </div>

                    <div class="row"  style="padding: 25px 0px 5px 0px;">
                        <div class="col">
                            <label for="answer" class="mr-sm-2">{{__('الاجابة') }} : </label>
                            <textarea class="form-control" name="answer" rows="8"></textarea>
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

<!-- include summernote css/js-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<script>
      $(document).ready(function() {
          $('.summernote').summernote();
      });
</script>
@endsection
