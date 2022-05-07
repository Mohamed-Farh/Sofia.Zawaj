@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ trans('البلدان') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('البلدان') }}
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
                    {{ trans('اضافة بلد') }}
                </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="10" style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> {{ trans('اسم البلد') }}</th>
                            <th> {{ trans('اسم الدوله') }}</th>
                            <th> {{__('الحالة') }}</th>
                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('social_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($states as $state)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $state->name }}</td>
                                <td>{{ $state->country->name }}</td>
                                <td>{{ $state->status =='1' ? 'نشط' : 'غير نشط' }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $state->id }}"
                                        title="{{ trans('social_trans.Edit') }}"><i
                                            class="fa fa-edit"></i></button>

                                    @if (auth()->user()->hasRole('super_admin'))
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $state->id }}"
                                            title="{{ trans('social_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    @endif
                                </td>
                                @endif
                            </tr>

                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $state->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('states.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $state->id }}">

                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="name" class="mr-sm-2">{{ trans('اسم البلد') }} :</label>
                                                        <input type="name" class="form-control" name="name"value="{{ $state->name }}">
                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="country_id" class="mr-sm-2">اسم الدولة</label>
                                                        <select name="country_id" class="form-control">
                                                            <option value="">---</option>
                                                            @forelse ($countries as $country)
                                                                <option value="{{ $country->id }}" {{ old('country_id', $state->country_id) == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                        @error('country_id')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>

                                                <div class="form-group  modual_space">
                                                    <div class="col">
                                                        <label class="mr-sm-2" for="status">{{__('الحالة') }}</label>
                                                        <select name="status" required class="form-control custom-select selectpicker">
                                                            <option value="1" {{ old('status', $state->status) == 1 ? 'selected' : null }}>نشط</option>
                                                            <option value="0" {{ old('status', $state->status) == 0 ? 'selected' : null }}>غير نشط</option>
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
                            <div class="modal fade" id="delete{{ $state->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('states.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('social_trans.Warning_social') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $state->id }}">
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
                        {{-- <tfoot>
                            <tr>
                                <th colspan="7">
                                    <div class="float-right">
                                        {!! $states->links() !!}
                                    </div>
                                </th>
                            </tr>
                        </tfoot> --}}
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
                <form action="{{ route('states.store') }}" method="POST">
                    @csrf
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ trans('اسم البلد') }} :</label>
                            <input type="name" class="form-control" name="name">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="country_id">{{ trans('اسم الدولة') }}</label>
                            <select name="country_id" class="form-control">
                                <option value="">---</option>
                                @forelse ($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : null }}>{{ $country->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('country_id')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="form-group  modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="status">{{ trans('الحالة') }}</label>
                            <select name="status" required class="form-control custom-select selectpicker">
                                <option value="1" {{ old('status') == 1 ? 'selected' : null }}>نشط</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : null }}>غير نشط</option>
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
