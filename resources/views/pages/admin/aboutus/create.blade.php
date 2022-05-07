@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{__('عن صوفيا')  }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('عن صوفيا')  }}
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
                    <a href="{{ route('aboutus.index') }}">{{ trans('front_trans.return') }}</a>
                </button>
                <br><br>

                <div class="card-body">

                    {!! Form::open(['route' => 'aboutus.store', 'method' => 'post' ]) !!}

                        {{--------- نبذة عن صوفيا -----------}}
                        <div class="row beauty_top">
                            <h2 class="help">{{ trans('نبذة عن صوفيا') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::label('aboutus', trans('نبذة عن صوفيا') ) !!}
                                    {!! Form::textarea('aboutus', old('aboutus'), ['class' => 'form-control summernote']) !!}
                                    @error('aboutus')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br><br><br>
                        </div>



                        {{--------- ليه تختار صوفيا -----------}}
                        <div class="row beauty_top">
                            <h2 class="help">{{ trans('ليه تختار صوفيا') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::label('why_us', trans('ليه تختار صوفيا') ) !!}
                                    {!! Form::textarea('why_us', old('why_us'), ['class' => 'form-control summernote']) !!}
                                    @error('why_us')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <br><br><br><br>
                        </div>



                        {{--------- امن /  سهل الستخدام -----------}}
                        <div class="row beauty">
                            <h2 class="help">{{ trans('امن /  سهل الستخدام') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::label('safe', trans('امن /  سهل الستخدام') ) !!}
                                    {!! Form::textarea('safe', old('safe'), ['class' => 'form-control summernote']) !!}
                                    @error('safe')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        {{--------- المطابقة الذكية  -----------}}
                        <div class="row beauty">
                            <h2 class="help">{{ trans('المطابقة الذكية') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::label('smart', trans('المطابقة الذكية') ) !!}
                                    {!! Form::textarea('smart', old('smart'), ['class' => 'form-control summernote']) !!}
                                    @error('smart')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        {{--------- السرية التامة  -----------}}
                        <div class="row beauty">
                            <h2 class="help">{{ trans('السرية التامة') }}</h2>
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::label('secret', trans('السرية التامة') ) !!}
                                    {!! Form::textarea('secret', old('secret'), ['class' => 'form-control summernote']) !!}
                                    @error('secret')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
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


