@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('الـمـقـالات') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('الـمـقـالات') }}
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
                    <a href="{{ route('news.index') }}">{{ trans('front_trans.return') }}</a>
                </button>
                <br><br>


                <div class="card-body">

                    {!! Form::open(['route' => ['news.update', $new->id], 'method' => 'patch', 'files'=>true ]) !!}
                    {{--------- About Us -----------}}
                    <div class="row beauty_top">
                        <h2 class="help">{{ trans('عنوان المقال') }}</h2>
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('head', trans('عنوان المقال') ) !!}
                                {!! Form::textarea('head', old('head_ar', $new->head), ['class' => 'form-control summernote']) !!}
                                @error('head')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br><br><br><br>
                    </div>

                    {{--------- news Body  -----------}}
                    <div class="row beauty">
                        <h2 class="help">{{ trans('محتوي المقال') }}</h2>
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('body', trans('محتوي المقال') ) !!}
                                {!! Form::textarea('body', old('body_ar', $new->body), ['class' => 'form-control summernote']) !!}
                                @error('body_ar')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row beauty">
                        <h2 class="help">{{ trans('صورة للمقال') }}</h2>
                        <div class="col-12 small_space ">
                            {!! Form::label('photo', trans('صورة للمقال') )  !!}
                            {!! Form::file('photo', ['class' => 'form-control'] ) !!}
                        </div>
                            @error('photo')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group pt-4" style="text-align: center">
                        {!! Form::submit( trans('front_trans.submit') , ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
    <script>
        $(function () {
            // $('.summernote').summernote({
            //     tabSize: 2,
            //     height: 200,
            //     toolbar: [
            //         ['style', ['style']],
            //         ['font', ['bold', 'underline', 'clear']],
            //         ['color', ['color']],
            //         ['para', ['ul', 'ol', 'paragraph']],
            //         ['table', ['table']],
            //         ['insert', ['link', 'picture', 'video']],
            //         ['view', ['fullscreen', 'codeview', 'help']]
            //     ]
            // });
            $('#post-images').fileinput({
                theme: "fas",
                maxFileCount: 10,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,

            });

        });
    </script>
     <script type="text/javascript">
        $(document).ready(function() {
          $('.summernote').summernote({
                tabSize: 2,
                height: 200,
            });
        });
    </script>
@endsection


