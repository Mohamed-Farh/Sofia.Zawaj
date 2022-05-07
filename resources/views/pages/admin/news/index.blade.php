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



            <button type="button" class="button x-small">
                <a href="{{ route('news.create') }}">{{ trans('اضافة مـقـال') }}</a>
            </button>
            <br><br>


            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('front_trans.photo') }}</th>
                            <th>{{ trans('المقال') }}</th>
                            <th>{{ trans('محتوي المقال') }}</th>
                            <th>{{ trans('feature_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($news as $new)
                            <tr>
                                <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    @if($new->photo)
                                        <td><img class="img-responsive thumbnail" src="{{url('image/news/'.$new->photo)}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                    @else
                                        <td><img class="img-responsive thumbnail" src="{{url('image/news/default.jpg')}}" style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                    @endif

                                    <th>{{ \Str::limit($new->head,50)}}</th>
                                    <th>{{ \Str::limit($new->body,50)}}</th>


                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#show{{ $new->id }}"
                                            title="{{ trans('feature_trans.show_news') }}"><i
                                                class="fa fa-eye"></i></button>

                                        <a href="{{ route('news.edit',$new->id) }}"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button></a>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $new->id }}"
                                            title="{{ trans('feature_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                            </tr>

                            <!-- show_modal_feature -->
                            <div class="modal fade" id="show{{ $new->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('عـرض الـمـقـال') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row" style="border: ridge;">
                                                <div class="col-12 small_space">
                                                    <h3>{{ trans('الـمـقـال') }}</h3>
                                                    <h6>{{ $new->head }}</h6><br>
                                                    <h6>{{ $new->body }}</h6>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- delete_modal_feature -->
                            <div class="modal fade" id="delete{{ $new->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('news.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('feature_trans.Warning_feature') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $new->id }}">
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
                        @endforeach
                </table>
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
