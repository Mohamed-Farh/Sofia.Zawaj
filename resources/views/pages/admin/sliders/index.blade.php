@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ trans('slider_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('slider_trans.title_page') }}
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

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('slider_trans.add_slider') }}
            </button>
            <br><br>

            <div class="row">
                @foreach($sliders as $slider)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="card" style="width:100%; margin-bottom: 25px;">
                            <img class="card-img-top" src="{{ Url($slider->path) }}" alt="Card image cap" style="width: 100%; height:252px;">
                            <div class="card-body"  style="text-align: -webkit-center;">

                                @if  ($slider->status == '0')
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#edit{{ $slider->id }}"
                                    title="{{ trans('slider_trans.Delete') }}"><i class="fa fa-eye-slash"></i> {{__('اخفاء')}}</button>
                                @elseif ($slider->status == '1')
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#edit{{ $slider->id }}"
                                    title="{{ trans('slider_trans.Delete') }}"><i class="fa fa-eye"></i> {{__('عرض')}}</button>
                                @endif

                                <?php $first_slider = \App\Models\Slider::where('type', '0')->count(); ?>
                                    @if ($first_slider >= '1' && $slider->type == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#set_main{{ $slider->id }}"
                                            title="{{ trans('slider_trans.Delete') }}"><i class="fa fa-eye-slash"></i> {{__('الغاء كرئيسية')}}</button>
                                    @elseif ($first_slider < '1')
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#set_main{{ $slider->id }}"
                                        title="{{ trans('slider_trans.Delete') }}"><i class="fa fa-eye"></i> {{__('تعيين كرئيسية')}}</button>

                                    @endif


                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#delete{{ $slider->id }}"
                                        title="{{ trans('slider_trans.Delete') }}"><i class="fa fa-trash"></i> {{__('حــــذف')}}</button>
                            </div>
                        </div>
                    </div>


                    <!-- Make_Image_Visible -->
                    <div class="modal fade" id="edit{{ $slider->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('slider_trans.edit_slider') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- add_form -->
                                    <form action="{{ route('sliders.update', 'test') }}" method="post">
                                        {{ method_field('patch') }}
                                        @csrf
                                            @if  ($slider->status == '0')
                                                {{ trans('slider_trans.unvisible_slider') }}
                                            @elseif ($slider->status == '1')
                                                {{ trans('slider_trans.visible_slider') }}
                                            @endif
                                        <input id="id" type="hidden" name="id" class="form-control"
                                            value="{{ $slider->id }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">{{ trans('slider_trans.Close') }}</button>
                                            <button type="submit"
                                                class="btn btn-info">{{ trans('slider_trans.submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Make_First_Image -->
                    <div class="modal fade" id="set_main{{ $slider->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{__('تعديل الصورة الموجودة في الصفحة الرئيسية') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- add_form -->
                                    <form action="{{ route('sliders/first_slider', 'test') }}" method="post">
                                        {{ method_field('post') }}
                                        @csrf
                                            @if  ($slider->type == '0')
                                                {{__('هل انت متأكد من الغاء هذة الصورة كصورة رئيسية')}}
                                            @elseif ($slider->type == '1')
                                            {{__('هل انت متأكد من تعيين هذة الصورة كصورة رئيسية')}}
                                            @endif
                                        <input id="id" type="hidden" name="id" class="form-control"
                                            value="{{ $slider->id }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">{{ trans('slider_trans.Close') }}</button>
                                            <button type="submit"
                                                class="btn btn-info">{{ trans('slider_trans.submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- delete_modal_slider -->
                    <div class="modal fade" id="delete{{ $slider->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('slider_trans.delete_slider') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('sliders.destroy', 'test') }}" method="post">
                                        {{ method_field('Delete') }}
                                        @csrf
                                        {{ trans('slider_trans.Warning_slider') }}
                                        <input id="id" type="hidden" name="id" class="form-control"
                                            value="{{ $slider->id }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('slider_trans.Close') }}</button>
                                            <button type="submit"
                                                class="btn btn-danger">{{ trans('front_trans.Delete') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="m-t-30 m-b-60 center">
                {{ $sliders->links() }}
            </div>
        </div>
    </div>
</div>


<!-- add_modal_slider -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content gallery">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('slider_trans.add_slider') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="1" id="type">
                    <div class="form-group">
                        <input type="file" name="files[]" id="post-images" multiple class="file-input-overview"
                            accept="image/*">
                        @if ($errors->has('files'))
                            @foreach ($errors->get('files') as $error)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endforeach
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
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

<script>
    $(function() {
        $('.summernote').summernote({
            tabSize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
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
@endsection
