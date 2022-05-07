@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ trans('الدول') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('الدول') }}
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
                    {{ trans('اضافة دولة') }}
                </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="25"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> {{ trans('اسم الدوله') }}</th>
                            <th> {{__('الحالة') }}</th>
                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('social_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($countries as $country)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $country->name }}</td>
                                <td>{{ $country->status =='1' ? 'Active' : 'InActive' }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                {{-- <td>
                                    @if  ($country->status == '1')
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#vis_social{{ $country->id }}"
                                        title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                    @elseif ($country->status == '0')
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#vis_social{{ $country->id }}"
                                        title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                    @endif
                                </td> --}}

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $country->id }}"
                                        title="{{ trans('social_trans.Edit') }}"><i
                                            class="fa fa-edit"></i></button>

                                    @if (auth()->user()->hasRole('super_admin'))
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $country->id }}"
                                            title="{{ trans('social_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    @endif
                                </td>
                                @endif
                            </tr>

                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $country->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('countries.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $country->id }}">

                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="name" class="mr-sm-2">{{ trans('اسم الدولة') }} :</label>
                                                        <input type="name" class="form-control" name="name"value="{{ $country->name }}">
                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group  modual_space">
                                                    <div class="col">
                                                        <label class="mr-sm-2" for="status">{{__('الحالة') }}</label>
                                                        <select name="status" required class="form-control custom-select selectpicker">
                                                            <option value="0" <?php if($country->status == "0") echo "selected"; ?> >غير نشط</option>
                                                            <option value="1" <?php if($country->status == "1") echo "selected"; ?> >نشط</option>
                                                        </select>
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


                            <!-- delete_modal_social -->
                            <div class="modal fade" id="delete{{ $country->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('countries.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('social_trans.Warning_social') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $country->id }}">
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
                <form action="{{ route('countries.store') }}" method="POST">
                    @csrf
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ trans('اسم الدولة') }} :</label>
                            <input type="name" class="form-control" name="name">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group  modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="status">{{ trans('الحالة') }}</label>
                            <select name="status" required class="form-control custom-select selectpicker">
                                <option value="0">نشط</option>
                                <option value="1">غير نشط</option>
                            </select>
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

@endsection
