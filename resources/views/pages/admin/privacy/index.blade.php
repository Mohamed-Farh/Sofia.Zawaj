@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
{{__('سياسة الخصوصية في صوفيا') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('سياسة الخصوصية في صوفيا') }}
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
                            <th>{{__('البند')}}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{__('الـحـالـة')}}</th>
                                <th>{{__('الـعـمـلـيـات')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($privacy_rules as $privacy_rule)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $privacy_rule->name }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td>
                                        @if  ($privacy_rule->status == '1')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_privacy_rule{{ $privacy_rule->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                        @elseif ($privacy_rule->status == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_privacy_rule{{ $privacy_rule->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                        @endif
                                    </td>
                                    <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $privacy_rule->id }}"
                                                title="{{__('تـعـديـل')}}"><i
                                                    class="fa fa-edit"></i></button>

                                        @if (auth()->user()->hasRole('super_admin'))
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $privacy_rule->id }}"
                                                title="{{__('حــذف')}}"><i
                                                    class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                @endif
                            </tr>

                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $privacy_rule->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('تـعـديـل')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('privacy.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $privacy_rule->id }}">
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="name" class="mr-sm-2">{{__('البند') }} :  <span style="color: red"> * </span> </label>
                                                        {{-- <input type="text" class="form-control" name="name" value="{{ $privacy_rule->name }}"> --}}
                                                        <textarea class="form-control" name="name" rows="10">{{ $privacy_rule->name }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('اغــلاق') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{__('حفظ البيانات') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Make_lab_Visible -->
                            <div class="modal fade" id="vis_privacy_rule{{ $privacy_rule->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('show_privacy/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($privacy_rule->status == '1')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @elseif ($privacy_rule->status == '0')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $privacy_rule->id }}">
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


                            <!-- delete_modal_social -->
                            <div class="modal fade" id="delete{{ $privacy_rule->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('حـذف نوع منتج') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('privacy.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                    {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $privacy_rule->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('اغــلاق')}}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{__('حــذف')}}</button>
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
                    {{__('اضـافـة')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('privacy.store') }}" method="POST">
                    @csrf

                    <input id="type" type="hidden" name="type" class="form-control"
                                                    value="privacy">

                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{__('البند') }} :  <span style="color: red"> * </span> </label>
                            {{-- <input type="text" class="form-control" name="name"> --}}
                            <textarea class="form-control" name="name" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{__('اغــلاق') }}</button>
                        <button type="submit"
                            class="btn btn-success">{{__('حفظ البيانات') }}</button>
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
